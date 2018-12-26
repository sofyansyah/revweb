@extends('layouts.upload-layout')


@section('content')

<style>

	#image-preview, #image-previews {
		width: 100%;
		height: 400px;
		position: relative;
		overflow: hidden;
		background-color: #ffffff;
		color: #ecf0f1;
	}
	#image-preview input, #image-previews input {
		line-height: 200px;
		font-size: 200px;
		position: absolute;
		opacity: 0;
		z-index: 10;
	}
	#image-preview label, #image-previews label {
		position: absolute;
		z-index: 5;
		opacity: 0.8;
		cursor: pointer;
		background-color: #bdc3c7;
		width: 200px;
		height: 50px;
		font-size: 20px;
		line-height: 50px;
		text-transform: uppercase;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		margin: auto;
		text-align: center;
	}
	.panel-primary{
		border: none;
	}

</style>

<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.uploadPreview.js')}}" type="text/javascript"></script>


<script type="text/javascript">
	$(document).ready(function() {
		$.uploadPreview({
			input_field: "#image-uploads",
			preview_box: "#image-previews",
			label_field: "#image-labels"
		});
	});
	$(document).ready(function() {
		$.uploadPreview({
			input_field: "#image-upload",
			preview_box: "#image-preview",
			label_field: "#image-label"
		});
	});
</script>

<div class="container">
	<div class="stepwizard" style="display: none;">
		<div class="stepwizard-row setup-panel">
			<div class="stepwizard-step col-md-12"> 
				<a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
				<p>Artboard</p>
			</div>
		</div>
	</div>

	<form role="form" action="{{url('post-kuliner')}}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="panel panel-primary setup-content" id="step-1" style=" margin-top: 20px;">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Tulis Testimoni</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div id="image-previews">
						<label for="image-uploads" id="image-labels">Choose File</label>
						<input type="file" name="image" id="image-uploads" />
					</div>
				</div>
				<div class="form-group">
					<input placeholder="Title" name="nama" type="text" class="form-control">
				</div>
				<div class="form-group">
					<textarea placeholder="Deskripsi" name="deskripsi" type="text" class="form-control"></textarea> 
				</div>
				<div class="form-group">
					<input placeholder="Lokasi" name="lokasi" type="text" class="form-control">
				</div>
				
				<button class="btn btn-primary nextBtn pull-right" type="submit">Upload</button>
			</div>
		</div>
		</form>
		</div>




		@endsection
