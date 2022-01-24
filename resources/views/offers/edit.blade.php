<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <!-- nav -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

      <li class="nav-item active">
        <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }} <span class="sr-only">(current)</span></a>
      </li>
      @endforeach
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li> -->


      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li> -->
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
        <div class="flex-center position-ref full-height">
            <!-- @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif -->



<!-- form -->
            <div class="content">
                <div class="title m-b-md">
                  {{__('messages.Add your offer')}} 
                </div>
         @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
               {{Session::get('success')}} 
                </div>
                @endif
                        <br>
                <form method='POST' action="{{route('offers.store')}}" enctype="multipart/form-data">
                @csrf
                <!-- <input name="_token" value="{{csrf_token()}}"> -->
                <div class="form-group">
                        <label for="exampleInputEmail1">اختر الصوره</label>
                        <input type="file" class="form-control" name='photo' >
                        @error('photo')
                        <small id="emailHelp" class="form-text  text-danger"> {{$message}} </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                        <input type="text" class="form-control" name='name_ar' placeholder="{{__('messages.Offer Name ar')}}">
                        @error('name_ar')
                        <small id="emailHelp" class="form-text  text-danger"> {{$message}} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                        <input type="text" class="form-control" name='name_en' placeholder="{{__('messages.Offer Name en')}}">
                        @error('name-en')
                        <small id="emailHelp" class="form-text  text-danger"> {{$message}} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> {{__('messages.Offer Price')}}</label>
                        <input type="text" class="form-control" name='price' placeholder="{{__('messages.Offer Price')}}">
                        @error('price')
                        <small id="emailHelp" class="form-text  text-danger"> {{$message}} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer details ar')}} </label>
                        <input type="text" class="form-control" name='details_ar' placeholder="{{__('messages.Offer details ar')}}">
                        @error('details_ar')
                        <small id="emailHelp" class="form-text text-danger"> {{$message}} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer details en')}} </label>
                        <input type="text" class="form-control" name='details_en' placeholder="{{__('messages.Offer details en')}}">
                        @error('details_en')
                        <small id="emailHelp" class="form-text text-danger"> {{$message}} </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>
             
            </div>
        </div>
    </body>
</html>
