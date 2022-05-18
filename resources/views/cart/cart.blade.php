@extends('layouts.app')

@section('content')
    <section class="h-100">
      <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-10">
            <div class="d-flex align-items-center mb-4">
              <a href="{{ route('home') }}"><i class="fa fa-chevron-left" aria-hidden="true" ></i></a>
              <h3 class="fw-normal mb-0 text-black" style="margin-left: 15px">Shopping Cart</h3>
            </div>
            @forelse ($items as $item)
              <div class="card rounded-3 mb-4">
                <div class="card-body p-4">
                  <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img
                        src="{{ $item->product_list[0]->product_image_list[0]->src }}"
                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <p class="lead fw-normal mb-2">{{ $item->product_list[0]->product_name }}</p>
                      <p><span class="text-muted">Sku: </span>{{ $item->product_list[0]->sku }} 
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button class="btn btn-link px-2">
                        <i class="fa fa-minus"></i>
                      </button>
      
                      <input id="form1" min="0" name="quantity" value="{{$item->quantity}}" type="number"
                        class="form-control form-control-sm" disabled/>
      
                      <button class="btn btn-link px-2">
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h5 class="mb-0">RM{{ $item->product_list[0]->regular_price }}</h5>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <form action="{{ route('cart.removeItem') }}" method="post">
                        @csrf
                        <input type="hidden" name="cart_id" id="cart_id" value="{{ $item->id }}">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash fa-lg"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @empty
              <div class="container mt-2 mb-2">
                  <div class="d-flex justify-content-center">
                      <h4>There are no items in this cart</h4>
                  </div>
              </div>
            @endforelse
    
            {{-- <div class="container mt-4 mb-2">
              <div class="d-flex justify-content-center">
                {{ $items->links() }}
              </div>
            </div> --}}

          @if($items->count() != 0)
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <h3>Total: RM{{ $total_price }}</h3>
                  <form action="{{ route('order.submit') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success btn-block btn-lg">Submit Order</button>
                  </form>
                </div>

              </div>
            </div>
          @endif
          </div>
        </div>
      </div>
    </section>

@endsection
