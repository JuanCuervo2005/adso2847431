@extends('layouts.app')
@section('title', 'Create User')

@section('content')
    @include('layouts.navbar')

    <h1 class="text-5xl pt-40 flex gap-6 items-center text-white font-bold mb-16 pb-4 border-b-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-20">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>

        Show User
    </h1>



    <div class="breadcrumbs text-sm text-white">
        <ul>
            <li><a href="{{ url('users') }}">User Module</a></li>
            <li>Show User</li>
        </ul>
    </div>

    <ul class="list my-8 bg-base-100 rounded-box shadow-md w-[600px]">
        <li class="list-row mx-auto">
            <div class="avatar">
                <div id="upload" class="mask mask-squircle cursor-pointer hover:scale-110 transition-transform">
                    <img id="preview" src="{{ asset('images/' . $user->photo) }}"
                        class="max-w-[230px] max-h-[230px] object-cover" />
                </div>
            </div>
        </li>
        <li class="list-row">

            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Document</div>
                <div class="text-xs font-semibold opacity-60">{{ $user->document }}</div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Full Name</div>
                <div class="text-xs font-semibold opacity-60">{{ $user->fullname }}</div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Gender</div>
                <div class="text-xs font-semibold opacity-60">{{ $user->gender }}</div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Birthdate</div>
                <div class="text-xs font-semibold opacity-60">{{ $user->birthdate }}</div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Phone</div>
                <div class="text-xs font-semibold opacity-60">{{ $user->phone }}</div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Email</div>
                <div class="text-xs font-semibold opacity-60">{{ $user->email }}</div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Role</div>
                <div class="text-xs font-semibold opacity-60">{{ $user->role }}</div>
            </div>
        </li>
    </ul>


@endsection
