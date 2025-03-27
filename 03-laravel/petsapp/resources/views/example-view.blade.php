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
                                        <img src="{{ $pet->photo }}" alt="{{ $pet->name }}"/>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{{ $pet->name }}</div>
                                    @if ($pet->kind == 'Dog')
                                        <div class="badge badge-sm badge-soft badge-success">{{ $pet->kind }}</div>
                                    @else
                                        <div class="badge badge-sm badge-soft badge-error">{{ $pet->kind }}</div>
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
                            <button class="btn btn-sm btn-outline btn-accent" onclick="showPetDetails({{ json_encode($pet) }})">
                                Actions
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
                <button class="btn" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
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
