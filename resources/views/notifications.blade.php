@if(count($errors) > 0 )
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
           <i class="fas fa-times-circle"></i>&nbsp{{$error}}
        </div>
    @endforeach
@endif 

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle">&nbsp</i>{{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <i class="fas fa-times-circle"></i>&nbsp{{session('error')}}
    </div>
@endif

@if (session('status'))
<div class="alert alert-success" role="alert">
    <i class="fas fa-check-circle">&nbsp</i>{{ session('status') }}
</div>
@endif