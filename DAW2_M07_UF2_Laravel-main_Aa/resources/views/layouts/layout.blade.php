<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PELICULAS - @yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #8AAEE0; overflow-x: hidden;">
    <!-- header -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #395886;">
        <img src="img/StucomLogo.svg" width="150" height="30" alt="Logo">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item pt-2">
                    <p style="color: black;"><b>Activity 2 UF2. Films | Activity 2 UF3. Actors</b></p>
                </li>
            </ul>
        </div>
    </nav>

    <!-- content -->
    @yield('content')
    @section('content')
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- footer -->
    <footer  style="background-color: #395886; margin-top: auto">
        <div class="pt-3 pb-1">
            <div class="pl-5">
                <h5>Project information</h5>
                <p>Alumn: Aakriti Guerrero  |  Course: DAW2  |  Activity: Activity 2 UF2. Films  |  Deadline: 20/12/2023</p>
                <p>Alumn: Aakriti Guerrero  |  Course: DAW2  |  Activity: Activity 2 UF3. Actors  |  Deadline: 20/12/2023</p>
            </div>
            <div class="pl-5">
                <h5>Usefuls links</h5>
                <ul class="list-unstyled">
                    <li><a href="https://getbootstrap.com/" style="color: #212529;">Boostrap</a>  |  <a href="https://laravel.com/" style="color: #212529;">Laravel</a></li>
                    <li><a href="https://stucom.alexiaclassroom.com/pluginfile.php/103363/mod_resource/content/1/Apuntes%20DAW2M07UF2NF2_LaravelBlade.pdf" style="color: #212529;">Apuntes DAW2M07UF2NF2_LaravelBlade.pdf</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>