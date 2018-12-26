   @extends ('layout.master')

   @section('css_styles')
   <style type="text/css">
   	.panel-default{
   		border-color: #fff!important;
   	}
      .post-meta{
         display: none;
      }
   </style>

   @endsection
   @section ('content')

@php
   if(Auth::check()){
   $follow = DB::table('follower')->where('user_id',Auth::user()->id)->where('follow_user',$users->id)->first();
}
@endphp

   <div class="container">
   	<div class="row">

   		<div class="col-md-3">
   			<div class="panel panel-default">
   				<div class="panel-body text-center">
   					<img src="{{asset('/img/foto/'. $users->foto)}}" width="150" class="img-circle"  />
   					<h3>{{$users->name}}</h3>
   					<p>{{$users->pekerjaan}}</p>
   					<p>{{$users->kota_tinggal}}</p>
   					<p>{{$users->bio}}</p>
                  @if(Auth::check())
                  @if(count($follow) > 0)
                  <li class="nopadding"><a href="{{url('unfollow/'.$follow->id)}}" class="btn btn-success">Following</a></li>
                  @else
                  <li class="nopadding"><a href="{{url('follow/'.$users->id)}}" class="btn btn-info">Follow</a></li>
                  @endif
                  @else
                  @endif

               </div>
            </div>
         </div>


         <div class="col-md-9">
            @include('include.testimonial')

         </div>
      </div>

   </div>

   @endsection