<a type="button" class="btn  btn-light position-relative" href="{{ route('cart') }}">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    @if(Session::get('cartCount'))
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ Session::get('cartCount') }}
        </span>
    @endif
</a>