@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="card">
    @if($msg = session('success'))
    <div class="alert alert-success" role="alert">
        {{ $msg }}
    </div>
    @elseif($msg = session('error'))
    <div class="alert alert-danger" role="alert">
        {{ $msg}}
    </div>
    @endif
        <div class="d-flex justify-content-center mb-2 mt-2">
        @foreach($foto as $f)
            <img width="200" src="{{ asset('image') }}/{{$f->foto}}" alt="..." class="rounded"><br/>

        @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <h1>{{ Auth::user()->name }}</h1>
            @if(Auth::user()->verif == 1)
                <img class="mb-2 ml-2" width="25" src="https://cdn.worldvectorlogo.com/logos/twitter-verified-badge.svg" alt="">
                <span class="mt-2 ml-1"><i>Verified</i></span>
            @endif
        </div> 
        <div class="d-flex justify-content-center mb-2 p-4">
            @foreach($moto as $m)
                <i>"{{ $m->moto }}"</i>
            @endforeach
        </div>
       <div class="profile p-2">
        <form method="post" enctype="multipart/form-data" action="{{ route('profile.update') }}">
        @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Bergabung Tanggal</label>
                <input type="text" class="form-control" value="{{ Auth::user()->created_at }}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Moto</label>
                <textarea name="moto" id="moto" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Foto</label>
                <input type="file" id="foto" name="foto">
            </div>
            <button  id="d" type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
       </div>
</div>
<script>
$(document).ready( () => {
    $('#moto').on('change', () => {
        if($('#moto').val() !== '')
        {
            $('#foto').attr('hidden','')
        }else{
            $('#foto').removeAttr('hidden','')
        }
    })
    $('#foto').on('change', () => {
        if($('#foto').val() !== '')
        {
            $('#moto').attr('hidden','')
        }else{
            $('#moto').removeAttr('hidden','')
        }
    })
})
</script>
@endsection
