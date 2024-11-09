<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
   
<div class="container">
    
    <div class="row justify-content-center">
        <h1 class="text-center pt-2">All Products</h1>
        <form action="" method="GET">
            @csrf

               
                <div class="col-md-6 col-sm-12 pt-2">
                    <div class="input-group">
                        <input type="text" name="search_text" value="{{ request()->get('search_text') }}"
                            class="form-control"  placeholder="Search by Product ID or Description">
                            <div class="input-group-append">
                                <button class="btn btn-secondary me-2" name="submit_btn" type="submit" value="search">
                                    <i class="fa fa-search"></i> Search
                                </button>          
                                    <a href='{{ request()->url('/products') }}'
                                        class="btn btn-xs btn-primary me-2 refresh_btn"><i
                                            class="fa fa-refresh"></i>
                                        Refresh</a> 
                                        <a href="{{ route('products.create') }}"  class="btn btn-xs btn-outline-primary me-2 " name="create_new" 
                                        type="button">
                                        <i class="fa-solid fa-plus"></i> Create New
                                    </a>
                                        
                            </a>  
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 pt-2">                  
                            <a href="{{ route('products.index', ['sort_by' => 'name', 'sort_direction' => request('sort_direction') === 'asc' ? 'desc' : 'asc']) }}">
                                Sort by Name
                            </a> |
                            <a href="{{ route('products.index', ['sort_by' => 'price', 'sort_direction' => request('sort_direction') === 'asc' ? 'desc' : 'asc']) }}">
                                Sort by Price
                            </a>
                        </div>
                    </div>
                </div>   
            
        
            </div>
        </form>
        </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered border-primary" style="width:100%">
            <thead class="pdoduct_thead">
                <tr>

                    <th style="white-space: nowrap;">Sl.</th>
                    <th style="white-space: nowrap;">Product ID</th>
                    <th style="white-space: nowrap;">Name</th>
                    <th style="white-space: nowrap;">Price</th>
                    <th style="white-space: nowrap;">Stock</th>
                    <th style="white-space: nowrap;">Description</th>
                    <th style="white-space: nowrap;">Image</th>
                    <th style="white-space: nowrap;">Action</th>
                                   
                </tr>
            </thead>  
            <tbody class="product_tbody">
                @foreach($products as $index=>$val)
                <td>{{ $index + $products->firstItem() }}</td>
                <td>{{ $val->product_id }}</td>
                <td>{{ $val->name }}</td>
                <td>{{ $val->price }}</td>
                <td>{{ $val->stock }}</td>
                {{-- <td>{{ $val->description }}</td> --}}
                <td>{{ \Illuminate\Support\Str::limit($val->description, 20, '...') }}</td>
                <td style="width:20%" ><img src="{{ asset('img/product_img') . '/' . $val->image }}"
                    width="100px" class="img-fluid rounded border border-3" alt="product photo"></td>
                <td >
                    <a href="{{ route('products.show', $val->id) }}" class="btn btn-xs btn-outline-primary ">View</a>
                    <a href="{{ route('products.edit', $val->id) }}" class="btn btn-xs btn-outline-info ">Edit</a>
                    <form action="{{ route('products.destroy', $val->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-xs btn-outline-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tbody>
            @endforeach
        </table>
        {{ $products->links() }}

    </div>
</div>
   
@endsection
