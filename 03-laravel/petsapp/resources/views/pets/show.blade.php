@extends('layouts.app')
@section('title', 'Show Pet')

@section('content')
    @include('layouts.navbar')

    <h1 class="text-5xl pt-40 flex gap-6 items-center text-white font-bold mb-16 pb-4 border-b-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-20">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>

        Show Pet
    </h1>

    <div class="breadcrumbs text-sm text-white">
        <ul>
            <li><a href="{{ url('pets') }}">Pet Module</a></li>
            <li>Show Pet</li>
        </ul>
    </div>

    <ul class="list my-8 bg-base-100 rounded-box shadow-md w-[600px]">
        <li class="list-row mx-auto">
            <div class="avatar">
                <div class="mask mask-squircle cursor-pointer hover:scale-110 transition-transform">
                    <img src="{{ asset('images/' . ($pet->image ?? 'no-photo.jpg')) }}"
                        class="max-w-[230px] max-h-[230px] object-cover" />
                </div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Name</div>
                <div class="text-xs font-semibold opacity-60">{{ $pet->name }}</div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Type</div>
                <div class="text-xs font-semibold opacity-60">{{ $pet->kind }}</div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Breed</div>
                <div class="text-xs font-semibold opacity-60">{{ $pet->breed }}</div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Description</div>
                <div class="text-xs font-semibold opacity-60">{{ $pet->description }}</div>
            </div>
        </li>
        <li class="list-row">
            <div class="flex gap-4 items-center">
                <div class="font-bold w-24">Location</div>
                <div class="text-xs font-semibold opacity-60">{{ $pet->location }}</div>
            </div>
        </li>
    </ul>

@endsection
