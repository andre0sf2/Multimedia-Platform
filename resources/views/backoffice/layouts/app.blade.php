<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>BackOffice</title>

    <link rel="shortcut icon" href="{{asset('/storage/icons/logo.png')}}" type="image/x-icon">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="{{ asset('backoffice/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="admin">
        @yield('content')
    </div>
    <script src="{{ asset('backoffice/js/app.js') }}" defer></script>
</body>
</html>