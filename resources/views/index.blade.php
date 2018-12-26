@extends('layout.index')
@section('css_styles')

<style type="text/css">
  .big-banner{

    background-image: url('img/cover3.jpg'); background-repeat: no-repeat;background-size: 100%;"
    padding: 100px;

  }
  .navbar{
    margin-bottom: 0!important;
  }
  header{
   height: 100%;

 }
 .site-heading h2{
  color: #fff;
  font-size: 50px;
}

@media screen and (min-width: 768px){
  .jumbotron {
    padding-top: 150px!important;
    padding-bottom: 150px;
  }
}
</style>

@endsection

@section('content') 
<!-- Page Header -->
<header class="jumbotron big-banner">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="site-heading">
          <h2>Cari Tempat Nongkrong <br>Yang Cozy?</h2><br>
          <div class="input-group" style="height: 50px;">
            <span class="input-group-addon" style="background-color: #ff6655; border: none; color: #fff; font-size: 20px;">Cari</span>
            <input id="msg" type="text" class="form-control" name="msg" placeholder="Makanan/ Restoran" style="height: 50px; font-size: 20px;">
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Main Content -->
<div class="container">

  <div class="col-md-10 col-md-offset-1";">
  <!--   <h1><b>Stay Up to Date</b></h1>
    <h3>Lorem ipsum sir dolo amet</h3> -->
    @forelse ($kul as $k)

    <div class="col-md-6 col-xs-6" style="padding: 2px;">
    <img src="{{asset('/img/kuliner/'. $k->cover_crop)}}" width="100%" />
    </div>



    @empty
    @endif
  </div>
</div>
<br>
<div class="container">

 <div class="col-md-10 col-md-offset-1" style="padding: 0;">
   <h1 class="text-center"><b>Komentar Pengunjung</b></h1>
   <h3 class="text-center">Lorem ipsum sir dolo amet</h3>
   @include ('include.testimonial')
 </div>
</div>

<!-- Footer -->




@endsection
