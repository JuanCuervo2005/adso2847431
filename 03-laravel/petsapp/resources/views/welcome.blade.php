@extends('layouts.app')
@section('title', 'Welcome Pets App')

@section('content')
    <div class="card bg-base-100 w-96 shadow-sm">
        <figure>
            <img src="{{ asset('storage/profile_images/welcome.png')}}" alt="Shoes" />
        </figure>
        <div class="card-body">
            <h2 class="card-title">Welcome PetsApp</h2>
            <p>At PetsApp, find your perfect furry companion. Adopt rescued pets, change lives, and give animals the loving
                homes they truly deserve.</p>
            <div class="card-actions justify-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn bg-cyan-800 text-white rounded-full w[-140px]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M10.5 3A1.501 1.501 0 0 0 9 4.5h6A1.5 1.5 0 0 0 13.5 3h-3Zm-2.693.178A3 3 0 0 1 10.5 1.5h3a3 3 0 0 1 2.694 1.678c.497.042.992.092 1.486.15 1.497.173 2.57 1.46 2.57 2.929V19.5a3 3 0 0 1-3 3H6.75a3 3 0 0 1-3-3V6.257c0-1.47 1.073-2.756 2.57-2.93.493-.057.989-.107 1.487-.15Z"
                                clip-rule="evenodd" />
                        </svg>

                        dashboard
                    </a>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="btn bg-cyan-800 text-white rounded-full w[-140px]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn bg-cyan-800 text-white rounded-full w[-140px]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                clip-rule="evenodd" />
                        </svg>

                        Register
                    </a>
                @endguest
            </div>
        </div>
    </div>
@endsection