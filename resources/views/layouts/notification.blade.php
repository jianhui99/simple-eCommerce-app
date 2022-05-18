@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success: </strong> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    {{ Session::forget('success') }}
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed: </strong> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    {{ Session::forget('error') }}
@endif


@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible show fade" role="alert" id="alert">
            <strong>Failed: </strong> {{ $error }}
            <button type="button" class="close close-alert" data-dismiss="alert" aria-label="Close" onclick="closeAlert()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
@endif


