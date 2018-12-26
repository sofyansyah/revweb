<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Testimonial;
use App\User;
use App\Komentar;
use App\Kuliner;
use App\Like;
use Auth;
use Image;

class TestimonialController extends Controller
{
	public function index(){

		$testimoni= Testimonial::join('users', 'testimonial.user_id', '=', 'users.id')
		->select('testimonial.*', 'users.name','users.id as user_id','users.foto as foto_user')
		->get();

		return view ('testimoni.index', compact ('testimoni'));
	}

	public function index_page(){

		$testimoni= Testimonial::join('users', 'testimonial.user_id', '=', 'users.id')
		->select('testimonial.*', 'users.name','users.id as user_id','users.foto as foto_user')
		->get();

		$kul = Kuliner::join('users', 'kuliner.user_id', '=', 'users.id')
		->select('kuliner.*', 'users.name','users.id as user_id','users.foto as foto_user')
		->limit(4)
		->get();

		return view ('index', compact ('testimoni','kul'));
	}


	public function upload(){

		$testimoni= Testimonial::join('users', 'testimonial.user_id', '=', 'users.id')
		->get();

		return view ('testimoni.buat-testimonial', compact ('testimoni'));
	}



	public function post_testimonial(Request $r ){

		$testimoni = new Testimonial;
		$testimoni->user_id 		= Auth::user()->id;
		$testimoni->judul 			= $r->judul;
		$testimoni->deskripsi 		= $r->deskripsi;
		$testimoni->lokasi 			= $r->lokasi;
		$testimoni->nama_tempat 	= $r->nama_tempat;
		$testimoni->rating_tempat 	= $r->rate_tempat;
		$testimoni->nama_menu 		= $r->nama_menu;
		$testimoni->rating_menu 	= $r->rate_menu;
		$testimoni->tag 			= $r->tag;

		if($r->hasFile('image')){

			$post1 = $r->file('image');
			$filename = $r->testimoni.'_'.str_random(4) . '.'.pathinfo($r->file('image')->getClientOriginalName(),PATHINFO_EXTENSION);
			Image::make($post1)->save (public_path('img/testimoni/' . $filename));
			$testimoni->foto_normal = $filename;

			$post2 = $r->file('image');
			$filename = $r->testimoni.'_'.str_random(4) . '.'.pathinfo($r->file('image')->getClientOriginalName(),PATHINFO_EXTENSION);
			Image::make($post2)->crop(800,600)->save(public_path('img/testimoni/' . $filename));
			$testimoni->foto_crop = $filename;
			$testimoni->save();
		}

		return redirect('/testimonial');

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

	public function post_komentar(Request $r, $id)
	{
		$testi= Testimonial::where('testimonial.id', $id)
		->join('users', 'testimonial.user_id', '=', 'users.id')
		->select('testimonial.*', 'users.name as user_name','users.id as user_id', 'users.foto as foto_user')
		->first();

		$komen = new Komentar;
		$komen->user_id = Auth::user()->id;
		$komen->testimonial_id= $testi->id;
		$komen->reply= $r->reply;
		$komen->save();

		return redirect()->back()->with('success','Comment anda berhasil');
	}

	public function hapus_komentar($id)
	{
		$komen = Comment::join('users', 'komentar.user_id', '=', 'users.id')
		->where('komentar.id', $id)
		->select('komentar.*','users.name')
		->first();
		$komen->delete();
		return redirect()->back()->with('success','Comment anda berhasil di delete');
	}

	public function like($id)
	{
		$test = Testimonial::where('testimonial.id', $id)->first();
		$like = new Like;
		$like->user_id        = Auth::user()->id;
		$like->testimonial_id  = $test->id;
		$like->save();

		return redirect()->back();
	}
	public function unlike($id)
	{
		$like = Like::findOrFail($id);
		$like->delete();
		return redirect()->back()->with('success','Berhasil UnLike ');
	}

}