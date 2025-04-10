<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1 class="text-4xl text-center mv-4">{{$title}}</h1>
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Breed</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                    <tr class="hover:bg-base-300">
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-12 w-12">
                                        <img src="{{ $pet->photo }}" alt="{{ $pet->name }}" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{{ $pet->name }}</div>
                                    @if ($pet->kind == 'Dog')
                                        <div class="badge badge-sm badge-success">{{ $pet->kind }}</div>
                                    @else
                                        <div class="badge badge-sm badge-error">{{ $pet->kind }}</div>
                                    @endif
                                    <div class="text-sm opacity-50">{{ $pet->kind }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-outline badge-sm badge-accent">{{ $pet->breed }}</span>
                        </td>
                        <td>{{ $pet->location }}</td>
                        <th>
                            <button onclick='showPetDetails(@json($pet))'
                                class="btn btn-sm btn-outline btn-accent tooltip" data-tip="Ver detalles">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.2-5.2M16 10.5a5.5 5.5 0 1 0-11 0 5.5 5.5 0 0 0 11 0z" />
                                </svg>
                            </button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Breed</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- MODAL -->
    <div id="petModal" class="modal">
        <div class="modal-box w-96">
            <h2 id="petName" class="text-2xl font-bold"></h2>
            <img id="petPhoto" src="" alt="Foto del animal" class="w-32 h-32 rounded-full mx-auto object-cover">
            <p id="petKind"></p>
            <p id="petWeight"></p>
            <p id="petAge"></p>
            <p id="petBreed"></p>
            <p id="petLocation"></p>
            <p id="petDescription"></p>
            <div class="modal-action">
                <button class="btn" onclick="closeModal()">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        function showPetDetails(pet) {
            document.getElementById("petName").textContent = pet.name;
            document.getElementById("petPhoto").src = pet.photo;
            document.getElementById("petKind").textContent = `Tipo: ${pet.kind}`;
            document.getElementById("petWeight").textContent = `Peso: ${pet.weight} kg`;
            document.getElementById("petAge").textContent = `Edad: ${pet.age} años`;
            document.getElementById("petBreed").textContent = `Raza: ${pet.breed}`;
            document.getElementById("petLocation").textContent = `Ubicación: ${pet.location}`;
            document.getElementById("petDescription").textContent = `Descripción: ${pet.description}`;
            document.getElementById("petModal").classList.add("modal-open");
        }

        function closeModal() {
            document.getElementById("petModal").classList.remove("modal-open");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>

</html>
