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
@if(Session::has('error'))
<div class="alert alert-danger">
{{Session::get('error')}}
</div>

@endif
@if(Session::has('success'))
<div class="alert alert-success">
{{Session::get('success')}}

</div>

@endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">{{__('messages.Offer Name')}}</th>
      <th scope="col">{{__('messages.Offer Price')}}</th>
      <th scope="col">{{__('messages.Offer Details')}}</th>
       <th scope="col">{{__('messages.photo')}}</th>

      <th scope="col">{{__('messages.operation')}}</th>
    </tr>
  </thead>
  <tbody>
    @foreach($offers as $offer)
    <tr>
      <th scope="row">{{$offer -> id}}</th>
      <th scope="row">{{$offer -> name}}</th>
      <th scope="row">{{$offer -> price}}</th>
      <th scope="row">{{$offer -> details}}</th>
      <th scope="row"><img style="height: 100px;width: 100px" src="{{ asset('images/offers/'.$offer->photo)}}"></th>
      <th> 
      <a href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-success">{{__('messages.update')}}</a>
      <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-danger">{{__('messages.delete')}}</a>
      </th>
  
    </tr>
   @endforeach
  </tbody>
</table>
    </body>
</html>
