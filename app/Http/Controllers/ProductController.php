<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // This method will show products page 
    public function index(){

        $products = Product::orderBy('created_at','desc')->get();

        // dd($product->all()['0']);

        return view("products.list",[
            'products'=> $products
        ]);

    }

    // This method will show create product page 
    public function create(){
        return view("products.create");
    }


    // This method will store product in db
    public function store(Request $request){

    
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
        ];


        if($request->image != ""){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);


        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->route('products.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Here we will insert data into db
        $product = new Product();

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description ;

        $product->save();

       if($request->image != ""){
         // We will store image
         $image = $request->file("image");
         // dd($request->all());
         // dd($image);
        //  $image->getClientOriginalName();
         // dd($image->extension());

         $image = $request->file('image');
    
        //  echo 'Original Name: ' . $image->getClientOriginalName() . '<br>';
        //  echo 'MIME Type: ' . $image->getClientMimeType() . '<br>';
        //  echo 'Size: ' . $image->getSize() . ' bytes<br>';
        //  echo 'Temporary Path: ' . $image->getRealPath() . '<br>';
        //  echo 'File Extension: ' . $image->getClientOriginalExtension() . '<br>';
        //  $image = $request->image;
         $ext =  $image->getClientOriginalExtension();
        //  dd($ext);
         $imageName = time().'.'.$ext;
 
 
         // Save image to product directory 
         $image->move(public_path('uploads/products'),$imageName);
 
         // Save image name in database 
         $product->image = $imageName;
         $product->save();

       }

        return redirect()->route('products.index')->with('success',"Product added successfully");

         

    }

    // This method will show edit product page 
    public function edit($id){
        // dd($id);
        $product = Product::findOrFail($id);
        // dd($product);
        
        return view("products.edit",[
            'product'=>$product
        ]);

    }

    // This method will update a product 
    public function update($id,Request $request){
         

        $product = Product::findOrFail($id);

        $rules = [
            "name"=>"required | min:5",
            "sku"=>"required | min : 3",
            "price"=>"required | numeric"
        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route("products.edit",$product->id)->withInput()->withErrors($validator);
        }

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();


        if($request->image != ""){

            // Delete Old image 

            if($product->image != ""){
                File::delete(public_path("uploads/products/".$product->image));
            }

            $image = $request->image;
            $ext =  $image->getClientOriginalExtension();
            //  dd($ext);
             $imageName = time().'.'.$ext;

             $image->move(public_path("uploads/products"),$imageName);

             $product->image = $imageName;
             $product->save();
        }

        return redirect()->route("products.index")->with("success","Product Updated successfully");

    } 
    

    // This method will delete a product 
    public function destroy($id){
        $product = Product::findOrFail($id);
        // dd($product);

        

        if($product->image != ""){
            // dd(public_path('uploads/products/'.$product->image));
            File::delete(public_path('uploads/products/'.$product->image));
            // dd(public_path('uploads/products/'.$product->image));

        }

            $product->delete();

        // return redirect()->route("products.index")->with("success","Item Delete Successfully");

        return redirect()->route("products.index")->with("success","Product Deleted successfully");
        

        // return redirect()->route("product.index")->with("error","Item not Found");

        



    } 

}
