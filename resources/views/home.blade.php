@extends('layouts.app')

@section('content')
    @forelse ($products as $product)
        <div class="container mt-2 mb-2">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="{{ isset($product->product_image_list[0]->src) ? $product->product_image_list[0]->src : '' }}"></div>
                        <div class="col-md-6 mt-1">
                            <h5> {{ $product->product_name }} </h5>
                            @if($product->in_stock)
                                <span class="badge bg-success">In stock</span>
                            @else
                                <span class="badge bg-danger">Out of stock</span>
                            @endif
                            <div class="mt-1 mb-1 spec-1"><span>SKU: {{ $product->sku }}</span></div>
                            <div class="mt-1 mb-1 spec-1"><span>Description: <br>{!! $product->description !!}</span></div>
                        </div>
                        <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="mr-1">RM {{ $product->regular_price }}</h4>
                            </div>
                            <form action="{{route('product.addToCart')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="d-flex flex-column mt-4">
                                    <div class="d-flex flex-column mt-4">
                                        <button class="btn btn-primary btn-sm" type="submit" @if(!$product->in_stock) disabled @else @endif>Add to Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
      <div class="container mt-2 mb-2">
          <div class="d-flex justify-content-center">
              <h4>No products available yet</h4>
          </div>
      </div>
    @endforelse
    <div class="container mt-4 mb-2">
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>

@endsection
