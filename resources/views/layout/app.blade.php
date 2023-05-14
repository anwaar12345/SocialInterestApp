<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>SocialServiceApp</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        
        <div class="container mt-5">
        
        <nav class="navbar navbar-expand-sm bg-light">
        <div class="container-fluid">
                <ul class="navbar-nav">  
                @if (Route::has('login'))
                    @auth
                    <li class="nav-item"> 
                        <a class="nav-link" href="{{ url('/home') }}" >Home</a>   
                   </li>
                    @else
                    @if(request()->route()->getName() != 'login')    
                    <li class="nav-item" id="login">
                    <a  class="nav-link" href="{{ route('login') }}" >Log in</a>
                    </li>
                    <li class="nav-item">
                    <button  class="nav-link" id="logout">Log out</button>
                    </li>
                    @endif
                    
                    
                    @if (Route::has('register'))
                    <li class="nav-item" id="register">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                    @endif
                    @endauth
                @endif

            </ul>
            </div>
        </div>
        </nav>        
        @yield('content')
        </div>
    </body>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</html>
