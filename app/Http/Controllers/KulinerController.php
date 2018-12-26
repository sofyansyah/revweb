<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Kuliner;
use App\Komentar;
use App\Like;
use Auth;
use Image;

class KulinerController extends Controller
{
    public function index(){

		$kul = Kuliner::join('users', 'kuliner.user_id', '=', 'users.id')
		->select('kuliner.*', 'users.name','users.id as user_id','users.foto as foto_user')
		->get();

		return view ('kuliner.index', compact ('kul'));
	}
	public function upload(){

		$kul = Kuliner::join('users', 'kuliner.user_id', '=', 'users.id')
		->get();

		return view ('kuliner.buat-kuliner', compact ('kul'));
	}

	

	public function post_kuliner (Request $r ){

		$kul = new Kuliner;
		$kul->user_id 			= Auth::user()->id;
		$kul->nama_kuliner		= $r->nama;
		$kul->deskripsi 		= $r->deskripsi;
		$kul->lokasi 			= $r->lokasi;


		if($r->hasFile('image')){

			$post1 = $r->file('image');
			$filename = $r->kul.'_'.str_random(4) . '.'.pathinfo($r->file('image')->getClientOriginalName(),PATHINFO_EXTENSION);
			Image::make($post1)->save (public_path('img/kuliner/' . $filename));
			$kul->cover_normal = $filename;

			$post2 = $r->file('image');
			$filename = $r->kul.'_'.str_random(4) . '.'.pathinfo($r->file('image')->getClientOriginalName(),PATHINFO_EXTENSION);
			Image::make($post2)->crop(600,400)->save(public_path('img/kuliner/' . $filename));
			$kul->cover_crop = $filename;
			$kul->save();
		}

		return redirect('/kuliner');

	}

	public function detail($id){

		$testi= Testimonial::where('testimonial.id', $id)
		->join('users', 'testimonial.user_id', '=', 'users.id')
		->select('testimonial.*', 'users.name as user_name','users.id as user_id', 'users.foto as foto_user')
		->first();

		$komen = Komentar::where('testimonial.id', $testi->id)
		->join('testimonial','komentar.testimonial_id','=','testimonial.id')
		->join('users','komentar.user_id','=','users.id')
		->select('komentar.id as komentar_id','komentar.user_id as komentar_user','komentar.reply','testimonial.id as testimonial_id', 'testimonial.created_at as date', 'users.name', 'users.foto as foto_user')
		->get();

		$likes = DB::table('likes')->where('testimonial_id', '=', $testi->id)->count();

		if (Auth::check()){
			$like = Like::where('user_id',Auth::user()->id)->where('testimonial_id',$testi->id)->first();

		}	

		return view ('testimoni.detail', compact ('testi', 'komen', 'likes','like'));
	}
}
