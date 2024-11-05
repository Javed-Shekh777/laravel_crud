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
                <a href="http://localhost:8000/products/create" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if(Session::has("success"))
            <div class="col-md-10 mt-3">
                <div class="alert alert-success">
                {{Session::get("success")}}
                </div>
            </div>
            @endif
            <div class="col-md-10">
 

                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark text-white ">
                        <h3 class="fs-5">Products</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            @if($products->isNotEmpty())
                            @foreach ($products as $product) 
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>
                                        @if ($product->image != "")
                                        <img src="{{asset('/uploads/products/'.$product->image)}}" class="img-fluid" style="height: 50px;width:100px;object-fit:cover" alt="no-image">
                                        @endif 
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->sku}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{\Carbon\Carbon::parse($product->created_at)->format('d M, Y')}}</td>
                                    <td>
                                        <a href="{{route("products.edit",$product->id)}}" class="btn btn-success p-2 mx-2 text-white" >Edit</a>
                                        <a href="#" onclick="deleteProduct({{$product->id}})" class="btn btn-danger p-2 mx-2 text-white">Delete</a>
                                        <form id="delete-product-from-{{$product->id}}" action="{{route("products.delete",$product->id)}}" method="POST">
                                            @csrf
                                            @method("Delete")

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @endif

                        </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


    <script>
        function deleteProduct(id){
            if(confirm("Are you want to delete Product")){
                document.getElementById("delete-product-from-"+id).submit();

            }
        }
    </script>
  </body>
</html>