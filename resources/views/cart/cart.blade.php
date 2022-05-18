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
                          src="{{ $item->product_list['product_info']->product_image_list[0]->src }}"
                          class="img-fluid rounded-3" alt="Cotton T-shirt">
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-3">
                        <p class="lead fw-normal mb-2">{{ $item->product_list['product_info']->product_name }}</p>
                        <p><span class="text-muted">Sku: </span>{{ $item->product_list['product_info']->sku }} 
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                          <i class="fa fa-minus"></i>
                        </button>
        
                        <input id="form1" min="0" name="quantity" value="1" type="number"
                          class="form-control form-control-sm" />
        
                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h5 class="mb-0">RM{{ $item->product_list['product_info']->regular_price }}</h5>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href="" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>
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
              <div class="card">
                <div class="card-body">
                  <button type="submit" class="btn btn-success btn-block btn-lg pull-right">Submit Order</button>
                </div>
              </div>
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
