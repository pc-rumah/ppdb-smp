<div class="col-lg-4">
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
</div>
<div class="col-lg-4">
    @if ($errors->any())
        <div class="div div-danger">
            <ul>
                @foreach ($errors->all() as $error)
                @endforeach
            </ul>
        </div>
    @endif
</div>
