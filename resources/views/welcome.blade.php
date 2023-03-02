<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>halaman lelang</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">LELANG SITE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
     
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div class="form-inline my-0 my-lg-0">
  <div class="col-4"></div>
  <div class="col-4 text-center">
    <button id="btn" onclick="login_link(this)" class="btn btn-primary  btn-lg">Login </button>
  </div>
  <div class="col-4"></div>
</div>
  </div>
</nav>


<div class="row pt-5">
  <div class="col text-center">
    <h2> WELLCOME TO WELLBID </h2>
  </div>
</div>

<div class="row">
  <div class="col p-5">
    <div id="carouselExampleControls" class="carousel slide container" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="img-fluid" src="{{url('image/poster1.jpg')}}" alt="First slide">
        </div>
      </div>
     </div>
    </div>
  </div>
</div>


<div class="card pt-6">
  <div class="card-header">
    GALERI LELANG
  </div>
<div class="row">
  <div class="col-4">
  <img class="img-thumbnail" src="{{url('image/uang kertas.jpeg')}}" alt="Third slide">

  </div>
  <div class="col-4 text-center">
  <img class="img-thumbnail" src="{{url('image/Rolls-Royce.jpeg')}}" alt="Third slide">

  </div>
  <div class="col-4">
  <img class="img-thumbnail" src="{{url('image/jordan.jpeg')}}" alt="Third slide">

  </div>
</div>

<div class="card pt-5">
  <div class="card-header">
    Lelang segera berakhir
  </div>
  <div class="card-body">
  <div class="card-group">
  <div class="card">
    <img class="card-img-top" src="{{url('image/iwatch.jpeg')}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Rp.15,000,000.00</h5>
      <p class="card-text">Apple Watch yang dilengkapi dengan strap berwarna putih polos</p>
      <p class="card-text"><small class="text-muted">Last updated 1 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="{{url('image/vasbunga.jpeg')}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Rp. 45,000,000.00</h5>
      <p class="card-text">Vas bunga dengan warna silver dan motif bunga memberi kesan elegan</p>
      <p class="card-text"><small class="text-muted">Last updated 1 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="{{url('image/Converse.png')}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Rp.15,000,000.00</h5>
      <p class="card-text">Converse Run Star Hike. Size 39.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>
  </div>
</div>

<script>
  function login_link(){
    

    window.location.href = "{{url('/login')}}";
  }
</script>
</body>
</html>