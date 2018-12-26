   @extends ('layout.master')

   @section('css_styles')
   <style type="text/css">
   	p{
   		font-size: 16px;
   		margin: 5px 0;
   	}
   </style>

   @endsection
   @section ('content')

   <div class="container">
      <div class="col-md-8 col-md-offset-2">
         <form action="{{url('edit-profile/'. $users->id)}}" method="POST" style="text-align: left!important;" enctype="multipart/form-data">
           {{csrf_field()}}
           <div class="form-group">
             <label for="focusedInput">Foto</label>
             <input class="form-control" type="file" name="photo" value="{{$users->foto}}">
          </div>
           <div class="form-group">
             <label for="focusedInput">Job</label>
             <input class="form-control" type="text" name="job" placeholder="{{$users->pekerjaan}}">
          </div>

          <div class="form-group">
             <label for="focusedInput">Bio</label>
             <input class="form-control" type="text" name="bio" placeholder="{{$users->bio}}">
          </div>

          <div class="form-group">
             <label for="focusedInput">Kota Tinggal</label>
             <input class="form-control" type="text" name="kota" placeholder="{{$users->kota_tinggal}}">
          </div>

          <button class="btn btn-default" type="submit">Save</button>
       </form>
    </div>

 </div>

 @endsection