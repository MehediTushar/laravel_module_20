@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mt-4 row justify-content-center">
        <div class="col-md-8">
        </div>
        <div class="col-md-4">
            <a href="{{route('products.index')}}" class="btn btn-success float-end"><i class="fa-solid fa-circle-arrow-left"></i> View All Products</a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="color:rgb(164, 158, 158); text-align:center; padding:10px; border:1px dotted #CCC">
                <h1>Product Details</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered mb-2"  width="100%" cellpadding="0" cellspacing="5">
                    <tr >
                        <td style="width:25%" ><img src="{{ asset('img/product_img') . '/' . $product->image }}"
                            width="250px" class="img-fluid rounded border border-3" alt="image"></td>
                        <td style="width:75%">
                            <table class="table table-bordered" border="1" width="100%" cellpadding="0"
                            cellspacing="5">
                                <tr  style="border-bottom:1px solid #CCC;top-padding:10px">
                                    <td  style="border-bottom:1px solid #CCC;top-padding:10px">
                                        <h4 style="font-weight: bold">{{ $product->name}}</h4>
                                    </td>
                                    <th class="" style="text-align:left">Product Price </th>
                                    <td class="">{{ $product->price}}</td>
                                </tr>
                                <tr  style="border-bottom:1px solid #CCC;top-padding:10px">
                                    <td  class=""><b>Product Stock:</b> {{$product->stock}}</td>
                                    <th class="" style="text-align:left">Product Description</th>
                                    <td class="">{{ $product->description}}</td>
                                </tr>
                               
                            </table>
                        </td>
                    </tr>                              
                </table>
            </div>
        </div>
    </div>
    
    </div>
@endsection