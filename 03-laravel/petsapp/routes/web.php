<?php


use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Models\User as User;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
});

Route::get('show/users', function () {
    $users = App\Models\User::all();
    //dd($users->toArray());
    return view('users-factory')->with('users', $users);
});

route::get('hello', function () {
    return "<h1>Hello Laravel</h1>";
})->name('hello');

Route::get('show/pets', function () {
    $pets = App\Models\Pet::all();
    //var_dump($pets->toArray());
    dd($pets->toArray());
});


Route::get('challenge/users', function () {
    $users = App\Models\User::limit(20)->get(['id', 'fullname', 'birthdate', 'created_at']);
    $users = $users->map(function ($user) {
        $user->age = Carbon::parse($user->birthdate)->age;
        $user->created_at_formatted = Carbon::parse($user->created_at)->format('d-m-Y H:i:s');
        return $user;
    });

    $tableHtml = '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Usuarios</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container my-5">
            <h2>Lista de Usuarios</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre Completo</th>
                        <th>Edad</th>
                        <th>Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($users as $user) {
        $tableHtml .= '<tr>
                         <td>' . $user->id . '</td>
                         <td>' . $user->fullname . '</td>
                         <td>' . $user->age . ' años</td>
                         <td>' . $user->created_at_formatted . '</td>
                       </tr>';
    }
    $tableHtml .= '</tbody>
                </table>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>';
    return response($tableHtml)->header('Content-Type', 'text/html');
});


Route::get('view/blade', function () {
    $title = "Examples Blade";
    $pets = App\Models\Pet::all();

    return view('example-view')
        ->with('title', $title)
        ->with('pets', $pets);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
