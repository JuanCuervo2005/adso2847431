@extends('layouts.app')
@section('title', 'Pets Module')

@section('content')
    @include('layouts.navbar')
    <!-- Authentication -->
    <h1 class="text 3xl pt-30 flex gap-2 items-center text-white font-bold mb-10 pb-2 border-b-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-12">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
        </svg>
        Pets Module
    </h1>
    <ul class="menu gap-1 mb-8 sm:menu-horizontal bg-base-200 rounded-box">
        <li>
            <a href="{{ url('pets/create') }}" class="btn btn-sm sm:btn-md btn-success btn-outline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Add Pet
            </a>
        </li>
        <li class="flex items-center" style="height:2.5rem;">
            <form method="GET" action="{{ url('pets') }}" id="searchForm" class="flex items-center h-full">
                <input class="py-2 px-3 align-middle border border-black focus:outline-none focus:border-gray-700" type="search" name="search" id="searchInput" placeholder="Search..." value="{{ request('search') }}" autocomplete="off" style="min-width:8rem;max-width:14rem;width:100%;" />
            </form>
        </li>
    </ul>
    <div class="overflow-x-auto my-2 rounded-box bg-base-100">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Breed</th>
            <th>Description</th>
            <th>Location</th>
            <th>Weight (kg)</th>
            <th>Actions</th>
                </tr>
            </thead>
            <tbody id="petsTableBody">
                @if ($pets->count() === 0)
                    <tr>
                        <td colspan="6" class="text-center font-bold">No pets found</td>
                    </tr>
                @else
                    @foreach ($pets as $pet)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle h-12 w-12">
                                            @if($pet->image && $pet->image !== 'no-photo.jpg')
                                                <img src="{{ asset('images/' . $pet->image) }}" alt="Photo" />
                                            @else
                                                <span class="italic text-gray-400">No image</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ $pet->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $pet->kind }}</td>
                            <td>{{ $pet->breed }}</td>
                            <td>{{ $pet->description }}</td>
                            <td>{{ $pet->location }}</td>
                            <td>{{ $pet->weight }}</td>
                            <td>
                                <a class="btn btn-outline btn-square btn-neutral btn-xs" href="{{ url('pets/' . $pet->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </a>
                                <a class="btn btn-outline btn-square btn-warning btn-xs" href="{{ url('pets/' . $pet->id . '/edit') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <button type="button" class="btn btn-outline btn-square btn-error btn-xs btn-delete" data-pet-id="{{ $pet->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{ $pets->links('layouts.paginator') }}

    <dialog id="message" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Congratulations!</h3>
            <p id="text-message" class="py-4">Lorem ipsum dolor</p>
        </div>
    </dialog>

    <dialog id="confirm" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Are you sure? !</h3>
            <p class="py-4" id="text-confirm">Are you sure you want to delete this pet?</p>
            <div class="flex gap-2">
                <form method="dialog">
                <button class="btn btn-sm">Cancel</button>
                </form>
                <form id="deletePetForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-error btn-accept">Accept</button>
                </form>
            </div>
        </div>
    </dialog>

@endsection

@section('js')
    <script>
        const message = document.querySelector('#message')
        const textMessage = document.querySelector('#text-message')
        @if (session('message'))
            textMessage.textContent = "{{ session('message') }}"
            message.showModal()
        @endif
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let searchTimeout;
        if (searchInput && searchForm) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                let tableBody = document.getElementById('petsTableBody');
                if (tableBody) {
                    tableBody.innerHTML = `<tr><td colspan='7' class='text-center'><span class='loading loading-spinner loading-xl'></span></td></tr>`;
                }
                searchTimeout = setTimeout(() => {
                    setTimeout(() => {
                        searchForm.submit();
                    }, 400);
                }, 400);
            });
        }

        // Modal confirm delete
        const confirmModal = document.getElementById('confirm');
        let petIdToDelete = null;
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                petIdToDelete = this.getAttribute('data-pet-id');
                // Set the form action dynamically
                document.getElementById('deletePetForm').action = `/pets/${petIdToDelete}`;
                confirmModal.showModal();
            });
        });
    </script>
@endsection
