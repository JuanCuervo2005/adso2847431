@extends('layouts.app')
@section('title', 'Login - PetsApp')
@section('content')
    <form method="POST" action="{{ route('login') }}"></form>
    <fieldset class="fieldset w-xs bg-base-200 border border-base-300 p-4 rounded-box">
        <h1 class="text-2xl text-center flex justify-center items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                    d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                    clip-rule="evenodd" />
            </svg>

            Login
        </h1>
        <label class="fieldset-label">Email</label>
        <input type="email" class="input" placeholder="Email" />

        <label class="fieldset-label">Password</label>
        <input type="password" class="input" placeholder="Password" />

        <button class="btn btn-neutral mt-4 rounded-full text-white bg-cyan-800">Login</button>
    </fieldset>
@endsection