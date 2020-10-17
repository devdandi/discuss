@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Semua Pesan</h1>
    @foreach($pesan as $p)
        <div class="media">
        <img width="50" src="{{ asset('image') }}/{{ \App\Foto::where('id_user', $p->id_pengirim)->get('foto')[0]->foto }}" class="mr-3" alt="...">
        <div class="media-body">
            <h5 class="mt-0">
            <a href="{{ route('profile.stalk', $p->id_pengirim) }}">{{ \App\User::find($p->id_pengirim)->name }}</a></h5>
                <p onclick="$(this).text('{{ Crypt::decryptString($p->pesan) }}')" id="pesan">Pesan enskripsi: {{ $p->pesan }}</p>

                <p style="color: red">Klik tulisan diluhur</p>
        </div>
        </div>
        <hr>
    @endforeach
</div>

@endsection