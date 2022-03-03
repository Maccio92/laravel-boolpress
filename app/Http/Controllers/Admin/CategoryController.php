<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Model\Post;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $validator =  [
        'name' => 'required|max:80',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'desc')->paginate(20);

        return view('admin.categories.index', ['categories' => $categories]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('admin.categories.create');
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
        $validateData = $request->validate($this->validator);
        
        
        $slug = Str::slug($data['name'], '-');
        $categoryPresente = Category::where('slug', $slug)->first();


        $counter = 0;
        while ($categoryPresente) {
            $slug = $slug . '-' . $counter;
            $categoryPresente = Category::where('slug', $slug)->first();
            $counter++;
        }

        $category = new Category();
        $category->fill($data);
        $category->slug = $slug;
        $category->save();
    
        return redirect()->route('admin.categories.index', $category->slug);
    }
    public function show(Category $category)
    {
        return view('admin.categories.show', ['category' => $category]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // if (Auth::user()->id != $post->user_id) {
        //     abort('403');
        // }
        // $categories = Category::all();
        return view('admin.categories.edit',['category' => $category]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validateData = $request->validate($this->validator);
        $data = $request->all();

        if ($data['name'] != $category->name) {
            $category->name = $data['name'];
            $category->slug = $category->getRouteKeyName($data['name']);
        }
        
        $category->update();
        return redirect()->route('admin.categories.show', $category->slug);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Post $posts)
    {
        // if (Auth::user()->id != $post->user_id) {
        //     abort('403');
        // }
        $category->delete();
        

        return redirect()->route('admin.categories.index')->with('status', "Category id $category->id deleted");
    }
}