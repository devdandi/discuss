<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Moto;
use Auth;
use App\Foto;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{
    protected $moto;
    protected $foto;
    protected $stalk;
    
    function __construct(Moto $moto, Foto $foto)
    {
        $this->middleware('auth');
        $this->moto = $moto;
    }
    public function index()
    {
        return view('profile', ['moto' => $this->getMoto(Auth::id()),'foto' => $this->getFoto()]);
    }
    public function stalk($id)
    {
        $this->stalk = $id;
        return view('stalk', ['stalk' => User::stalk($id), 'moto' => $this->getMoto($id),'foto' => $this->AniFoto($id),'id' => $id]);
    }
    public function getMoto($id)
    {
        return $this->moto->where('id_user', $id)->get('moto');
    }
    public function updateProfile(Request $req)
    {
        if($req->moto !== null AND $req->foto === null)
        {
           $check = $this->moto->where('id_user', Auth::id())->count();
           if($check > 0)
           {
                $moto = $this->moto->where('id', Auth::id())->update(['moto' => $req->moto]);
                if($moto)
                {
                    return redirect()->back()->with(['success' => 'Moto berhasil di perbarui !']);
                }else{
                    return redirect()->back()->with(['error' => 'Moto gagal di perbarui !']);
                }
           }else{
               $moto = $this->moto->create([
                   'id_user' => Auth::id(),
                   'moto' => $req->moto
               ]);
               if($moto)
               {
                    return redirect()->back()->with(['success' => 'Moto berhasil di tambah !']);
               }else{
                    return redirect()->back()->with(['success' => 'Moto gagal di tambah !']);
               }
           }
        }else if($req->moto === null AND $req->foto !== null)
        {
            $tujuan = 'image';
            $check = Foto::where('id_user', Auth::id())->count();
            if($check > 0)
            {
                $file = $req->file('foto');
                $enc = Crypt::encryptString($file->getClientOriginalName());
                $name = $enc.".".$file->getClientOriginalExtension();
                
                $foto = Foto::where('id_user', Auth::id())->update(['foto' => $name]);
                $save = $file->move($tujuan, $name);
                if($save)
                {
                    return redirect()->back()->with(['success' => 'Foto berhasil di perbarui !']);
                }else{
                    return redirect()->back()->with(['error' => 'Foto gagal di perbarui !']);
                }
            }else{
                // null
                $file = $req->file('foto');
                $enc = Crypt::encryptString($file->getClientOriginalName());
                $name = $enc.".".$file->getClientOriginalExtension();
                
                $foto = Foto::create([
                    'id_user' => Auth::id(),
                    'foto' => $name
                ]);
                $save = $file->move($tujuan, $name);
                if($save)
                {
                    return redirect()->back()->with(['success' => 'Foto berhasil di Tambah !']);
                }else{
                    return redirect()->back()->with(['error' => 'Foto gagal di Tambah !']);
                }
            }
        }
    }
    public function getFoto()
    {
        return Foto::where('id_user', Auth::id())->get('foto');
    }
    public static function AniFoto($id)
    {
        return Foto::where('id_user', Auth::id())->get('foto');
    }
}
