@if (session('success'))
        <div class="alert alert-success mr-auto  m-4 " style="width: 20%;opacity: 60%;   position: fixed;
    z-index: 5000;
    bottom: 400px;
    left: 10px;
    width: 300px;" role="alert">
            {{ session('success') }}
        </div>
@endif

@if (session('test'))
<div class="alert alert-primary" role="alert">
    This is a primary alert—check it out!
</div>
<div class="alert alert-secondary" role="alert">
    This is a secondary alert—check it out!
</div>

<div class="alert alert-danger" role="alert">
    This is a danger alert—check it out!
</div>
<div class="alert alert-warning" role="alert">
    This is a warning alert—check it out!
</div>
<div class="alert alert-info" role="alert">
    This is a info alert—check it out!
</div>
<div class="alert alert-light" role="alert">
    This is a light alert—check it out!
</div>
<div class="alert alert-dark" role="alert">
    This is a dark alert—check it out!
</div>
    @endif
