<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>BackOffice</title>

    <link rel="shortcut icon" href="{{asset('/storage/imgs/logo.png')}}" type="image/x-icon">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="{{ asset('backoffice/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="admin">
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">
                <img src="/storage/logo.png" width="30" height="30" alt=""> BackOffice
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @if(\Auth::user())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ \Auth::logout() }}">Logout</a>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
        @yield('content')
    </div>
    <script src="{{ asset('backoffice/js/app.js') }}" defer></script>
</body>
</html>