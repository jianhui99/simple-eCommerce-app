<li class="nav-item">
    <a class="nav-link" href="{{ route('cart') }}">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        @if(Session::get('cartCount'))
            <span class='badge bg-danger' id='lblCartCount'> {{ Session::get('cartCount') }} </span>
        @endif
    </a>
</li>