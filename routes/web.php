<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
 


// function getUsers(){
//    return $names = [
//         1 => ["name"=>"Amitabh","phone"=>"23234343543","city"=>"Goa"],
//         2 => ["name"=>"Salman","phone"=>"787868543","city"=>"Delhi"],
//         3 => ["name"=>"Sunny","phone"=>"062167543","city"=>"Mumbai"],
//         4 => ["name"=>"Akshay","phone"=>"944321543","city"=>"Agra"],
//     ];
// }


// Route::get("/{user}/{id?}",function($user = null,$id = null){
//     $tag = "<h1>Tag name </h1>";
//    $data = compact("user","id","tag");
//     return view("welcome")->with($data);
// });


// Route::get('/', function () {



    // return view('welcome',[
    //     "users"=>getUsers(),
    //     "email"=>"mdjavedShekh",
        
    // ]);
// });


// Route::get("",[PageController::class,'showUser']);
// Route::get("/home",[PageController::class,'showView']);


// Route::get("/user/{id}",function($id){

//     $user = getUsers()[$id];
     
//     return "<h3>User Id : ".$id.
//     "</h3><br><p>And User details are :"."<br>".
//     "Username is ".$user['name']."phone is ".$user['phone']." and also city is".$user['city'].
//     "</p>";
// })->name("view.user");


// Route::get('/', function () {
//     return view('page/home');
// });


// Route::get("/about/{id?}/comment/{commentId?}",function ($id = null,$commentId = null){
//     if($id != null){
//         return "<h1>About id </h1>".$id."<br><h1>Comment ID is : </h1>".$commentId; 
//     }
     
//     return view("about");
// })->whereNumber('id');



// Route::get("/about/falane",function (){

//     return view("about");
// })->name("chalo");



// Route::get("/about/sd",function (){

//     return view("about");
// }) ;


// Route::redirect('/test', '/about/sd');


// Route::prefix("page")->group(function (){

//     Route::get("/about",function (){

//         return view("about");
//     }) ;

    
//     Route::get("/gallery",function (){

//         return view("about");
//     }) ;

    

//     Route::get("/service",function (){

//         return view("about");
//     }) ;

// });
// Route::view('/post', 'post');
// Route::view('post', '/post');

 




// Route::match(['get','post'], '/user', function(){
//     return view("welcome");
// });



Route::get("/",function(){
    return view("welcome");
});


// =========================================================
// =========================================================

// Route::get("/products",[ProductController::class,'index'])->name("products.index");
// Route::get("/products/create",[ProductController::class,'create'])->name("products.create");
// Route::get("/products/{product}/edit",[ProductController::class,'edit'])->name("products.edit");
// Route::put("/products/{product}",[ProductController::class,'update'])->name("products.update");
// Route::delete("/products/{product}",[ProductController::class,'destroy'])->name("products.delete");

// Route::post('/product',[ProductController::class,'store'])->name('products.store');


Route::controller(ProductController::class)->group(function(){
    Route::get("/products",'index')->name("products.index");
Route::get("/products/create",'create')->name("products.create");
Route::get("/products/{product}/edit",'edit')->name("products.edit");
Route::put("/products/{product}",'update')->name("products.update");
Route::delete("/products/{product}",'destroy')->name("products.delete");

Route::post('/product','store')->name('products.store');

});