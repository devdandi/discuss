<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Foto;
use Auth;
use App\Postingan;
use App\Http\Controllers\ProfileController;
use App\LikePostingan;
use App\Komentar;

class HomeController extends Controller
{
    protected $postingan;
    protected $profile;
    protected $like;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Postingan $postingan, ProfileController $profile, LikePostingan $like)
    {
        $this->middleware('auth');
        $this->postingan = $postingan;
        $this->profile = $profile;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['postingan' => $this->postingan->orderBy('created_at','DESC')->get()]);
    } 
    public function updatePostingan(Request $req)
    {
        if($req->postingan !== null AND $req->foto === null)
        {
            $pos = Postingan::create([
                'id_user' => Auth::id(),
                'postingan' => $req->postingan
            ]);
            if($pos)
            {
                return redirect()->back()->with(['success' => 'Mantap !! Dagoan review barudak !']);
            }else{
                return redirect()->back()->with(['error' => 'Gagal anjing ! !']);

            }
        }else if($req->postingan === null AND $req->foto !== null)
        {
            
        }
    }
    public function postingan_like(Request $req)
    {
        $check = LikePostingan::where('id_postingan', $req->id_postingan)->where('id_user', $req->id_user)->count();
        if($check > 0)
        {
            return false;
        }else{
            $like = LikePostingan::create([
                    'id_postingan' => $req->id_postingan,
                    'id_user' => $req->id_user
            ]);
            if($like)
            {
                return true;
            }
        }
    }
    public function postingan_komentar(Request $req)
    {
        $komen = Komentar::create([
            'id_postingan' => $req->id_postingan,
            'id_user' => $req->user,
            'komentar' => $req->msg
        ]);
        if($komen)
        {
            return true;
        }
    }
}
