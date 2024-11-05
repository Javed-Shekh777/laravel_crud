<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple a Crud in Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
     
    <div class="bg-dark">
        <h2 class="py-2 text-white text-center">Laravel Crud</h2>
    </div>

   
    <div class="container ">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="http://localhost:8000/products" class="btn btn-dark">Back</a>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
 

                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark text-white ">
                        <h3 class="fs-5">Edit Product</h3>
                    </div>
                    <form enctype="multipart/form-data" action={{route('products.update',$product->id)}} method="post" >
                        @method('put')
                        
                        @csrf
                        <div class="card-body">
                            <div class="mb-2">
                                <label for="form-label fw-2">Name</label>
                                <input type="text" value="{{old('name',$product->name)}}" name="name" class="@error('name') is-invalid @enderror       form-control " placeholder="name">
                                @error('name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="form-label">Sku</label>
                                <input type="text" value="{{old('sku',$product->sku)}}" name="sku" class="@error('sku') is-invalid @enderror form-control  " placeholder="Enter name">
                                @error('sku')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-2">
                                <label for="form-label">Price</label>
                                <input type="text" value="{{old('price',$product->price)}}" name="price" class="@error('price') is-invalid @enderror form-control " placeholder="Enter price">
                                @error('price')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                        
                            <div class="mb-2">
                                <label for="form-label">Description</label>
                                <textarea type="text"  name="description" class="form-control resize-0 " placeholder="Enter Description">{{old("description",$product->description)}}</textarea>
                            </div>
    
                            <div class="mb-2">
                                <label for="form-label">Image</label>
                                <input type="file" name="image" class="form-control  " placeholder="name">
                                @if ($product->image != "")
                                <div class="my-2 text-center d-flex align-items-center justify-content-center">
                                    <img src="{{asset('/uploads/products/'.$product->image)}}" class="img-fluid w-50 d-block text-center rounded-5" style="object-fit:cover" alt="no-image">    
                                </div>                                
                                @endif    
                            </div>
    
                            <div class="d-grid">
                                <button class="btn btn-primary text-white">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</html>