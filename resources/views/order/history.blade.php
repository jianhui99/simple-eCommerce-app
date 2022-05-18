@extends('layouts.app')

@section('content')
<section class="h-100">
    <div class="container h-100 py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-10">
          <div class="d-flex align-items-center mb-4">
            <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true" ></i></a>
            <h3 class="fw-normal mb-0 text-black" style="margin-left: 15px">Order History</h3>
          </div>
          @forelse ($items as $item)
            <div class="card rounded-3 mb-4">
              <div class="card-body p-4">
                <div class="row d-flex justify-content-between align-items-center">
                  <div class="col-md-2 col-lg-2 col-xl-2">
                    <img
                      src="{{ $item->order_product_list['product_info']->product_image_list[0]->src }}"
                      class="img-fluid rounded-3" alt="Cotton T-shirt">
                  </div>
                  <div class="col-md-3 col-lg-4 col-xl-4">
                    <p class="lead fw-normal mb-2">{{ $item->order_product_list['product_info']->product_name }}</p>
                    <p><span class="text-muted">Sku: </span>{{ $item->order_product_list['product_info']->sku }} 
                  </div>
                  <div class="col-md-3 col-lg-1 col-xl-1 offset-lg-1">
                    <span class="mb-0">RM{{ $item->order_product_list['product_info']->regular_price }}</span>
                  </div>
                  <div class="col-md-3 col-lg-1 col-xl-1 d-flex">
                    x<span>{{$item->order_product_list['qty']}}</span>
                  </div>
                  <div class="col-md-3 col-lg-1 col-xl-1 offset-lg-1">
                    <span class="badge bg-{{ \App\Models\Order::$code_to_color[$item->order_status] }}">{{ \App\Models\Order::$code_to_status[$item->order_status] }}</span>
                  </div>
                  <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                    <form action="{{ route('cart.removeItem') }}" method="post">
                      @csrf
                      <input type="hidden" name="cart_id" id="cart_id" value="{{ $item->id }}">
                      @if($item->order_status == 1)
                        <button type="submit" class="btn btn-success" disabled><i class="fa fa-check fa-lg"></i></button>
                      @else 
                        <button type="submit" class="btn btn-danger"><i class="fa fa-close fa-lg"></i></button>
                      @endif
                    </form>
                  </div>
                </div>
              </div>
            </div>
            @empty
            <div class="container mt-2 mb-2">
                <div class="d-flex justify-content-center">
                    <h4>There are no order history yet.</h4>
                </div>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </section>
  
  <div class="container mt-4 mb-2">
      <div class="d-flex justify-content-center">
        {{ $items->links() }}
      </div>
  </div>
@endsection
