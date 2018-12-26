<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TestimonialController@index_page');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile/{name}/edit-profile', 'UsersController@edit_profile');
Route::post('/edit-profile/{name}', 'UsersController@edit_profile_post');
Route::get('/profile/{name}', 'UsersController@profile');
Route::get('/testimonial', 'TestimonialController@index');
Route::get('/kuliner', 'KulinerController@index');
Route::get('/buat-kuliner', 'KulinerController@upload');
Route::post('post-kuliner', 'KulinerController@post_kuliner');
Route::post('/testimonial/{id}/komentar', 'TestimonialController@post_komentar');
Route::get('/buat-testimonial', 'TestimonialController@upload');
Route::post('post-testimonial', 'TestimonialController@post_testimonial');
Route::get('/testimonial/{id}', 'TestimonialController@detail');

Route::get('like/{id}', 'TestimonialController@like');
Route::get('unlike/{id}', 'TestimonialController@unlike');

Route::get('follow/{name}', 'UsersController@follow');
Route::post('unfollow/{name}', 'UsersController@unfollow');

use App\Artwork;

Route::any('/search',function(){
    $q = Input::get ( 'q' );
    $user = Artwork::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
        return view('testimoni.index')->withDetails($user)->withQuery ( $q );
    else return view ('testimoni.index')->withMessage('No Details found. Try to search again !');
});
