<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\volt;
use App\Models\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');

Route::get('show/users',function(){
    $users = User::all();
    //dd($users->toArray());
    return view('users-factory')->with('users', $users);
});

Route::get('challenge/users',function(){
    $users = User::limit(20)->get();
    
    $code = "<table style='border-collapse: collapse; margin: 2rem auto; font-family: Arial'>
        <tr>
            <th style='background: gray; color: white; padding: 0.4rem'>Full Name</th>
            <th style='background: gray; color: white; padding: 0.4rem'>Age</th>
            <th style='background: gray; color: white; padding: 0.4rem'>Created At</th>
        </tr>";
    $count = 0;
    foreach($users as $user){
        $code .= ($user->id%2 == 0) ? "<tr style='background: #ddd'>":"</tr>";
        $code .=        "<td style='border: 1px solid gray; padding: 0.4rem'>".$user->fullname."</td>";
        $code .=        "<td style='border: 1px solid gray; padding: 0.4rem'>".Carbon\Carbon::parse($user->birthdate)->age." year old</td>";
        $code .=        "<td style='border: 1px solid gray; padding: 0.4rem'>".$user->created_at->diffForHumans()."</td>";
        $code .=    "</tr>";
    }
    return $code . "<table>";
});

Route::get('view/blade',function(){
    $title = "Example Blade";
    $pets = App\Models\Pet::whereIn('kind',['dog','cat'])->get();
    return view('example-view')
    ->with('title', $title)
    ->with('pets', $pets);
});

Route::get('Hello', function(){
    return "<h1>Hello Laravel</h1>";
})->Name('hello');

Route::get('show/pet/{id}', function(){
    $pet = App\Models\Pet::find(request()->id);
    return view('show-pet')->with('pet', $pet);
});



// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/dashboard', function(Request $request){

    if (Auth::user()->role=='Admin') {
        return view('dashboard-admin');
    } else if (Auth::user()->role=='Customer') {
        return view('dashboard-customer');
    } else {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back()->with('error','Role no exist!');
    }

})->middleware(['auth','verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';