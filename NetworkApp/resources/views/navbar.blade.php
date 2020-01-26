<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
    <!-- Place logo here at some point -->
        <a class="navbar-brand" href="{{ url('home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                <!-- Home page -->
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <!-- Login page -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <!-- Register page -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>  
                <!-- Logout page -->
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>    
            </ul>
        </div>
    </div>
</nav>