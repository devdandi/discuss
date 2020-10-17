@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="d-flex justify-content-center mb-2">
        @foreach($foto as $f)
            <img width="200" class="mt-2" src="{{ asset('image') }}/{{$f->foto}}" alt="..." ><br/>

        @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <h1>{{ $stalk->name }}</h1>
            @if($stalk->verif == 1)
                <img class="mb-2 ml-2" width="25" src="https://cdn.worldvectorlogo.com/logos/twitter-verified-badge.svg" alt="">
                <span class="mt-2 ml-1"><i>Verified</i></span>
            @endif
            
        </div> 
        <div class="d-flex justify-content-center mb-2 p-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Kirim Pesan
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pesan.create') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <input type="text" hidden value="{{ $id }}" name="id">
                            <label for="Pesan">Pesan</label>
                            <textarea name="pesan" id="" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

        </div>
        <div class="d-flex justify-content-center mb-2 p-4">
            <i>"{{ $moto[0]->moto }}"</i>
        </div>
       <div class="profile p-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" value="{{ $stalk->email }}" readonly id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Bergabung Tanggal</label>
                <input type="text" class="form-control" value="{{  $stalk->created_at }}" readonly>
            </div>
        </div>
       </div>
</div>

@endsection
