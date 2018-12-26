<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Testimonial;
use App\Follower;
use Auth;
use Image;

class UsersController extends Controller
{
	public function profile ($name){

		$users = User::whereName($name)->first();

		$testimoni = Testimonial::join('users', 'testimonial.user_id', '=', 'users.id')
		->select('testimonial.*', 'users.name','users.id as user_id')
		->get();


		return view ('profile', compact('users', 'testimoni'));

	}

	public function edit_profile($name)
	{
		$users = User::whereName($name)
		->first();
		return view('edit-profile',compact('users'));
	}


	public function edit_profile_post(Request $r, $id)
	{

		$user = User::findOrFail($id);
		$user->bio = $r->bio;
		$user->pekerjaan = $r->job;
		$user->kota_tinggal = $r->kota;

		$extfile        = $r->file('photo')->getClientOriginalExtension();

		if(($extfile == 'svg') || ($extfile == 'jpg') || ($extfile == 'jpeg') || ($extfile == 'png') ){
			if($r->hasFile('photo')){

			$post1 = $r->file('photo');
			$filename = $r->testimoni.'_'.str_random(4) . '.'.pathinfo($r->file('photo')->getClientOriginalName(),PATHINFO_EXTENSION);
			Image::make($post1)->save (public_path('img/foto/' . $filename));
			$user->foto = $filename; 
		}
		else{
			return redirect()->back()->with('error', 'Format yang anda masukan bukan gambar');
		}

		$user->save();

		return redirect('profile/'. $user->name)->with('success','Berhasil edit profile anda');
	}
}

public function follow($id)
 {
  $user = User::where('id', $id)->first();
  if(Auth::check()){
  if (Follower::where('user_id',Auth::user()->id)->where('follow_user',$id)->count() == 0) {
      $foll = new Follower;
      $foll->user_id    = Auth::user()->id;
      $foll->follow_user  = $user->id;
      $foll->status       = '0';
      $foll->save();

      return response()->json(['message' => 'success follow board'], 200);
}
}
}
public function unfollow($id)
{

  if (Follower::where('user_id',Auth::user()->id)->where('follow_user',$id)->count() > 0) {
      Follower::where('user_id',Auth::user()->id)->where('follow_user',$id)->delete();
      return response()->json(['message' => 'success unfollow user'], 200);
    }


}



}
