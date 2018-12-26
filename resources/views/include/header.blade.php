
<style type="text/css">
  .navbar-default{
    background-color: #fff!important;
    border:none!important;

  }
  .navbar{
    margin-bottom: 0!important;
  }
</style>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="{{url('/')}}">RIVIW</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li class=""><a href="{{url('/')}}">Home</a></li>
          <li><a href="{{url('/testimonial')}}">Testimonial</a></li>
      <li><a href="{{url('kuliner')}}">Kuliner</a></li>
       @if(Auth::user())
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile<span class="caret"></span></a>
          <ul class="dropdown-menu">
           
            <li><a href="{{url('/profile/'. Auth::user()->name)}}">{{Auth::user()->name}}</a></li>
            <li><a href="{{url('/buat-testimonial')}}">Buat Testimoni</a></li>
            <li><a href="{{url('/buat-kuliner')}}">Buat Kuliner</a></li>
            <li><a href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
        </ul>
      </li>
    
      @else
      <li><a href="{{url('/register')}}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="{{url('/login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      @endif
    </ul>

  
</div>
</div>
</nav>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>