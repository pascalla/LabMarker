<div class="container">
  @if (\Session::has('success'))
      <div class="alert alert-success mt-5">
          <ul>
              <li>{!! \Session::get('success') !!}</li>
          </ul>
      </div>
  @endif

  @if (\Session::has('error'))
      <div class="alert alert-danger mt-5">
          <ul>
              <li>{!! \Session::get('error') !!}</li>
          </ul>
      </div>
  @endif


  @if ($errors->any())
    <div class="alert alert-danger mt-5">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
</div>
