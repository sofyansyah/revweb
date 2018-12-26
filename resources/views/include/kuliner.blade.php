<style type="text/css">

	.checked {
		color: orange;
	}
	.panel{
		border: none;
		box-shadow: none;
	}
</style>
<link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">

@forelse ($kul as $test)
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-body">
			<img src="{{asset('/img/kuliner/'. $test->cover_crop)}}" width="100%" />

			<a href="{{url('/testimonial/'. $test->id)}}"><h4 class="post-title">
				{{$test->judul}}</h4></a>
				<div class="col-md-12" style="padding: 0; margin-bottom: 10px;">
					<span class="pull-right">{{$test->created_at->diffForHumans()}}</span>		
					
				</div>
				<br>
				<p class="post-subtitle">
					{{ str_limit($test->deskripsi, 100) }}
				</p>
				<p class="post-meta">
					<a href="#"><img src="{{asset('/img/foto/' .$test->foto_user)}}" width="40" class="img-circle"> {{$test->name}}</a>
				</p>
			</div>
		</div>


	</div>
	@empty
	@endforelse


