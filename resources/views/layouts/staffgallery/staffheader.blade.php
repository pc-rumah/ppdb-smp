<header class="navbar bg-base-100 fixed top-0 z-50 shadow-md">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="{{ route('home') }}#hero">Home</a></li>
                <li><a href="{{ route('home') }}#about">About</a></li>
                <li><a href="{{ route('home') }}#staff">Staff & Teachers</a></li>
                <li><a href="{{ route('home') }}#gallery">Gallery</a></li>
                <li><a href="{{ route('home') }}#registration">Registration</a></li>
                <li><a href="{{ route('home') }}#events">Events</a></li>
                <li><a href="{{ route('home') }}#contact">Contact</a></li>

            </ul>
        </div>
        <a class="btn btn-ghost text-xl">
            <img src="https://placehold.co/200x60?text=School+Logo" alt="School Logo" class="h-10">
        </a>
    </div>
    <div class="navbar-end hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="{{ route('home') }}#hero">Home</a></li>
            <li><a href="{{ route('home') }}#about">About</a></li>
            <li><a href="{{ route('home') }}#staff">Staff & Teachers</a></li>
            <li><a href="{{ route('home') }}#gallery">Gallery</a></li>
            <li><a href="{{ route('home') }}#registration">Registration</a></li>
            <li><a href="{{ route('home') }}#events">Events</a></li>
            <li><a href="{{ route('home') }}#contact">Contact</a></li>
        </ul>
    </div>
</header>
