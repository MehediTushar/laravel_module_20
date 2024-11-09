<!-- resources/views/products/create.blade.php -->

@extends('layouts.app')
@section('style')
<style>
      <style>
        body {
            display: flex;
            flex-direction: column;
            margin-top: 1%;
            justify-content: center;
            align-items: center;
        }
 
        #rowAdder {
            margin-left: 17px;
        }
    </style>
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="p-2 bg-light text-dark">
            <h3 class="text-center">Create New Product</h3>
         </div>
    </div>
    <form class="row g-3" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-3 form-floating">
            <input type="text" class="form-control product_input" name="product_id" id="product_id" value="{{ old('product_id') }}" required>
            <label for="product_id" > <span style="font-weight: bold; font-size: 16px;">Product ID</span><span style="color: red; font-weight: bold; font-size: 16px;">*</span></label>
            <div class="invalid-feedback error_msg product_id_err">Product ID is required!</div>
        </div>
        <div class="col-md-3 form-floating">
            <input type="text" class="form-control product_input" name="name" id="name" value="{{ old('name') }}" required>
            <label for="name" > <span style="font-weight: bold; font-size: 16px;">Name</span><span style="color: red; font-weight: bold; font-size: 16px;">*</span></label>
            <div class="invalid-feedback error_msg name_err">Name is required!</div>
        </div>
        <div class="col-md-3 form-floating">
            <input type="number" class="form-control product_input" name="price" id="price" step="0.01" value="{{ old('price') }}" required>
            <label for="price" > <span style="font-weight: bold; font-size: 16px;">Price</span><span style="color: red; font-weight: bold; font-size: 16px;">*</span></label>
            <div class="invalid-feedback error_msg price_err">Price is required!</div>
        </div>

        <div class="col-md-3 form-floating">
            <input type="number" class="form-control product_input" name="stock" id="stock" value="{{ old('stock') }} " >
            <label for="stock" > <span style="font-weight: bold; font-size: 16px;">Stock</span></label>
            <div class="invalid-feedback error_msg stock_err"></div>
        </div>

        <div class="col-md-3 form-floating">
            <input type="file" class="form-control product_input" name="image" id="image" value="{{ old('image') }}" accept="image/png,image/jpg,image/jpeg">
            <label for="image" > <span style="font-weight: bold; font-size: 16px;">Image</span></label>
            <div class="invalid-feedback error_msg image_err"></div>
        </div>
        
        <div class="col-md-6 form-floating">
            <textarea name="description" class="form-control product_input" id="description">{{ old('description') }}</textarea>
            <label for="description" > <span style="font-weight: bold; font-size: 16px;">Description</span></label>
            <div class="invalid-feedback error_msg description_err"></div>
        </div>
        <div class="d-grid col-12 mx-auto justify-content-md-center">
            <button type="submit" class="w-100 btn btn-success">Create Product</button>
        </div>
    </form>
</div>

  
@endsection
