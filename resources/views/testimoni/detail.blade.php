@extends('layout.master')

@section('content')


<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>

<img src="{{asset('img/testimoni/'. $testi->foto_normal)}}" width="100%">

<div class="container" style="margin-top: 20px;">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-body">

				<h1>{{$testi->judul}}</h1>
				<span>posted by {{$testi->user_name}}</span>
				<p>{{$testi->deskripsi}}</p>
				{{$testi->created_at->diffForHumans()}}
				<p>lokasi: {{$testi->lokasi}}</p>
				{{$likes}} Like
			</div>

			@if(Auth::check())
			
			@if(count($like) > 0)
			<a href="{{url('unlike/'.$like->id)}}">Unlike</a>
			@else
			<a href="{{url('like/'.$testi->id)}}">Like</a>
			@endif
			@else
			@endif

		</div>

		@forelse($komen as $com)
		<div class="panel-default">
			<div class="panel-body nopadding" style="padding: 0px 15px;">

				<div class="col-md-1 col-xs-2 nopadding"> 
					@if($com->foto_user == null)
					<img src="{{asset('img/icon/user.svg')}}" class="img-circle" width="32" style="float: left;" />
					@else
					<img src="{{asset('/img/foto/'.$com->foto_user)}}" class="img-circle" width="32" style="float: left;" />
					@endif
				</div>

				<div class="col-md-11 col-xs-10 nopadding">
					<h4 class="medium nomargin">{{$com->name}}</h4>
					<h6 class="nomargin">{{$com->reply}}</h6>
					<p class="gray">4 hours ago</p>
				</div>

			</div>
			<hr>
		</div>

		@empty
		@endforelse
		@if(Auth::user())
		<form action="{{url('/testimonial/'. $testi->id. '/komentar')}}" method="POST">
			{{ csrf_field()}}

			<textarea name="reply" id="reply" class="form-control" placeholder="Tulis Komentar mu"></textarea><br>
			<input type="submit" class="btn btn-primary pull-right" value="Komentar">
		</form>
	</div>
	@else
	@endif



</div>




@endsection
