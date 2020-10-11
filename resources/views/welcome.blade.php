<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Word Of Gamming</title>

        <!-- Fonts -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

                <nav class="navbar navbar-expand-lg  navbar-dark bg-primary">
                    <div class="container">
                    <a class="navbar-brand" style="font-family: Arial Black, Helvetica, sans-serif" href="#"><img src="{{ url('images/logo.png') }}" alt="" width="150"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @if (Route::has('login'))
                        <ul class="navbar-nav ml-auto">
                            @auth
                            <li class="nav-item"> 
                                <a class="nav-link" href="{{ url('/home') }}">Home</a>
                            </li>
                            @else
                            <li class="nav-item mr-3">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                            @endif
                            @endauth
                        </ul>
                        @endif
                    </div>
                </div>
                  </nav>

        
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ url('carousel/1.jpg') }}" class="d-block w-100" alt="..." width="100">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ url('carousel/2.jpg') }}" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ url('carousel/3.jpg') }}" class="d-block w-100" alt="...">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>

                  <footer class="bg-primary">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3">
                                <h4>About Us</h4>
                            </div>
                            <div class="col-lg-3">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero dignissimos officiis nisi sapiente, numquam blanditiis modi suscipit reprehenderit quia, perferendis molestiae asperiores repudiandae. Corrupti rerum aperiam placeat aliquid ipsa blanditiis.</p>
                            </div>
                            <div class="col-lg-3">
                                <h4>Usefull Links</h4>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </div>
                  </footer>
                {{-- <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> --}}
            </div>
        </div>
    </body>
</html>
