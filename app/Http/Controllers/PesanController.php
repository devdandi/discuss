<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Pesan;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;

class PesanController extends Controller
{
    public function index(Request $req)
    {
        $pesan = Pesan::create([
                'id_pengirim' => Auth::id(),
                'id_penerima' => $req->id,
                'pesan' => Crypt::encryptString($req->pesan)
        ]);
        if($pesan)
        {
            return redirect()->back()->with(['success'=> 'Mantap !']);
        }else{
            return redirect()->back()->with(['error'=> 'Anjing gagal !']);
        }
    }
    public function read()
    {
        return view('msg',['pesan' => Pesan::where('id_penerima', Auth::id())->get()]);
    }
}
