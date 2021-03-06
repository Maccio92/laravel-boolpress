<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;
use App\Model\Category;
use App\Model\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    protected $validator =  [
        'title' => 'required|max:80',
        // 'author' => 'required|max:80',
        'content' => 'required',
        'category_id' => 'exists:App\Model\Category,id',
        'tags.*' => 'nullable|exists:App\Model\Tag,id',
        'image' => 'nullable|image'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', ['categories' => $categories, 'tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['author'] = Auth::user()->name;
        $validateData = $request->validate($this->validator);       

        $slug = Str::slug($data['title'], '-');
        $postPresente = Post::where('slug', $slug)->first();

        $counter = 0;
        while ($postPresente) {
            $slug = $slug . '-' . $counter;
            $postPresente = Post::where('slug', $slug)->first();
            $counter++;
        }

        $post = new Post();
        $post->fill($data);
        $post->slug = $slug;
        $post->save();

        if (!empty($data['tags'])) {
            $post->tags()->attach($data['tags']);
        }
        if (!empty($data['img_path'])) {
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = $img_path;
        }
    
    
        return redirect()->route('admin.posts.index', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'tags'=> $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validateData = $request->validate($this->validator);
        $data = $request->all();
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }
        if ($data['title'] != $post->title) {
            $post->title = $data['title'];
            $post->slug = $post->createSlug($data['title']);
        }
        if ($data['content'] != $post->content) {
            $post->content = $data['content'];
        }
        if ($data['category_id'] != $post->category_id) {
            $post->category_id = $data['category_id'];
        }

        $post->update();

        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', "Post id $post->id deleted");
    }
}
