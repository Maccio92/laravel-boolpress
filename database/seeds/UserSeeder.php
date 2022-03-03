<?php  
use Faker\Generator as Faker; 
use Illuminate\Support\Facades\Hash;  
use Illuminate\Database\Seeder; 
use App\User;  
class UserSeeder extends Seeder {     
    /**      * Run the database seeds.      *      * @return void      
     * */     
    public function run(Faker $faker)     
    {          
        $newUser = new User();         
        $newUser->name = 'Admin';         
        $newUser->email = 'valerio@gmail.com';         
        $string = 'valerio92';         
        $newUser->password = Hash::make($string);         
        $newUser->save();                  
        for ($i=0; $i < 10; $i++) {               
            $newUser = new User();             
            $newUser->name = $faker->name();             
            $newUser->email = $faker->email();                          
            $string = '215_maggio';                       
            $newUser->password = Hash::make($string);             $newUser->save();         
        }     
    } 
}