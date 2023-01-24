<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Projects | Admin</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css' integrity='sha512-HHsOC+h3najWR7OKiGZtfhFIEzg5VRIPde0kB0bG2QRidTQqf+sbfcxCTB16AcFB93xMjnBIKE29/MjdzXE+qw==' crossorigin='anonymous'/>
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

    {{-- CKEDITOR --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

</head>

<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-1 @guest
                    guest-header
                @endguest logo d-flex align-items-center
                justify-content-center">
                        <div class="logo-img">
                            <img src="https://cdn-icons-png.flaticon.com/512/852/852438.png?w=826&t=st=1674050215~exp=1674050815~hmac=6728d33507a2cef0eb8c122623209f7fd4196d4ae71b369b3582d0e521c31c0b" alt="logo-boolean">
                        </div>
                </div>
                <div class="col-11 header-style ">
                    @include('admin.partials.header')
                </div>
            </div>
        </div>
    <div class="container-fluid">
        <div class="row">
            @auth
            <div class="col-1 aside">
                @include('admin.partials.aside')
            </div>
            @endauth
            <div class="col @auth col-11  @endauth  main">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
