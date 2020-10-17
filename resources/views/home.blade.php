@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3 d-none d-md-block">
        Member ({{ \App\User::count() }})
        <ul class="list-group">
        <li class="list-group-item">
        <img width="25" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTAesXcODPqgrVVGk7V9ovYUao5IPFgE9d1Qg&usqp=CAU" alt=""><a href="#">Bot</a>
        <img class="mb-1 ml-2" width="15" src="https://cdn.worldvectorlogo.com/logos/twitter-verified-badge.svg" alt="">
            </li>
                @foreach(\App\User::all() as $user)
                    <li class="list-group-item">
                        <img class="rounded" width="25"  src="{{asset('image')}}/{{\App\Foto::where('id_user', $user->id)->get()[0]->foto}}" alt=""><a class="ml-2" href="{{ route('profile.stalk', $user->id) }}">{{$user->name}} @if(Auth::user()->verif == 1)  <img class="mb-1 ml-2" width="15" src="https://cdn.worldvectorlogo.com/logos/twitter-verified-badge.svg" alt=""> @endif</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <p>
    <a class="d-block d-sm-none ml-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Member ({{ \App\User::count() }})
    </a>
    
    </p>
    <div class="collapse" id="collapseExample">
    
    <ul class="list-group">

                @foreach(\App\User::all() as $user)
                    <li class="list-group-item">
                        <img class="rounded" width="25"  src="{{asset('image')}}/{{\App\Foto::where('id_user', $user->id)->get()[0]->foto}}" alt=""><a class="ml-2" href="">{{$user->name}} </a>
                    </li>

                @endforeach
            </ul>
    </div>
        <div class="col-md-9">
        @if($msg = session('success'))
    <div class="alert alert-success" role="alert">
        {{ $msg }}
    </div>
    @elseif($msg = session('error'))
    <div class="alert alert-danger" role="alert">
        {{ $msg}}
    </div>
    @endif
        <form action="{{ route('postingan.update') }}" enctype="multipart/form-data" method="POST">
        @csrf
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Diskusi</label>
                <textarea class="form-control" id="postingan" name="postingan" placeholder="Tulis diskusi" id="exampleFormControlTextarea1" rows="3"></textarea>
                <button id="posting" class="btn btn-primary mt-1">Posting</button>
                <input type="file" disabled name="foto" id="foto" accept="image/png, image/jpeg">
            </div>
        </form>
        <hr>
        Postingan terbaru
        @foreach($postingan as $pos)
            <div class="card mb-3 " id="dasas">
            <div class="media mt-2">
                <img width="100" src="{{asset('image')}}/{{App\Foto::myfoto($pos->id_user)}}" class="align-self-start mr-3 rounded ml-1" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0"><a href="{{ route('profile.stalk', $pos->id_user) }}">{{ \App\User::find($pos->id_user)->name }}</a></h5>
                        <small>{{ $pos->created_at }}</small>
                        <p>{{ $pos->postingan }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-around">
                    @if(\App\LikePostingan::where('id_user',Auth::id())->where('id_postingan', $pos->id)->count() > 0)
                     <a href="#" style="color: red">Disukai ( {{ \App\LikePostingan::where('id_user',Auth::id())->where('id_postingan', $pos->id)->count() }} )</a>

                    @else
                        <a onclick="liked(this, `{{ $pos->id }}`)" id="liked" href="#">Suka ( {{ \App\LikePostingan::where('id_user',Auth::id())->where('id_postingan', $pos->id)->count() }} )</a>
                    @endif
                    <a href="#" id="komentar">Komentar ( {{ \App\Komentar::where('id_postingan', $pos->id)->count() }} )</a>
                    <a href="#">Share</a>
                </div>
                    <ul id="acas" class="list-group list-group-flush">
                    Komentar terbaru
                       @foreach(\App\Komentar::where('id_postingan', $pos->id)->get() as $komentar)
                       <li class="list-group-item" id="dasdaaS">
                                <img width="30" src="{{asset('image')}}/{{App\Foto::myfoto($pos->id_user)}}" alt="...">
                                <span class="ml-2"><a href="{{ route('profile.stalk', $pos->id_user) }}">{{ \App\User::find($komentar->id_user)->name }}</a></span>  <span>{{ $komentar->komentar }}</span>
                        </li>
                       @endforeach
                        
                    </ul>
                    <div class="row p-2">
                            <div class="col-md-12">
                                <input onchange="comment(this,`{{ $pos->id }}`,`{{ Auth::id() }}`)" type="text" name="ketik_komens" id="ketik_komens" class="form-control">
                            </div>
                        </div>
                </div>
                @endforeach
            </div>
        </div>
</div>

<script>
    $(document).ready( () => {
        $('#komentar').on('click', (e) => {
            e.preventDefault()
            $('.comment').html(``)
        })
        
    })

    function close_comment(el)
    {
        $('.comment').empty()
    }
    function liked(el, id)
    {
        var datas = {
            _token: "{{ csrf_token() }}",
            id_postingan: id,
            id_user: "{{ Auth::id() }}"
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('postingan.like') }}",
            data: datas,
            success: function(data)
            {
                // console.log(data)
                $('#liked').text('Disukai').css('color','red')
            }
        })
    }

    function comment(el, id, user)
    {
        $.ajax({
            type: "POST",
            url: "{{ route('postingan.komentar') }}",
            data: {
                _token: "{{ csrf_token() }}",
                id_postingan: id,
                user: user,
                msg: $(el).val()
            },
            success: (data) => {
                var con = $('.container')

                if(data == true)
                {
                    window.location.href="{{ route('home') }}"
                }
                
            }
        })
    }

    
</script> 
@endsection
