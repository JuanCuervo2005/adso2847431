<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('fullname', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('document', 'like', "%$search%")
                  ->orWhere('role', 'like', "%$search%")
                  ;
            });
        }
        $users = $query->paginate(10)->appends(['search' => $request->search]);
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'document'  => ['required', 'numeric', 'unique:'.User::class],
            'fullname'  => ['required', 'string'],
            'gender'    => ['required'],
            'birthdate' => ['required', 'date'],
            'phone'     => ['required'],
            'photo'     => ['required'],
            'email'     => ['required', 'lowercase', 'email', 'unique:'.User::class],
            'password'  => ['required', 'confirmed'],
        ]);

        if($validated) {
            //dd($request->all());
            if($request->hasFile('photo')) {
                $photo = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }

            $user = new User;
            $user->document  = $request -> document;
            $user->fullname  = $request -> fullname;
            $user->gender    = $request -> gender;
            $user->birthdate = $request -> birthdate;
            $user->photo     = $photo;
            $user->phone     = $request -> phone;
            $user->email     = $request -> email;
            $user->password  = bcrypt($request->password);

            if ($user->save()) {
                return redirect('users')->with('message', 'The user: '.$user->fullname.' was successfully added!');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //dd($user->toArray());
        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'document'  => ['required', 'numeric', 'unique:users,document,' . $user->id],
            'fullname'  => ['required', 'string'],
            'gender'    => ['required'],
            'birthdate' => ['required', 'date'],
            'phone'     => ['required'],
            'email'     => ['required', 'lowercase', 'email', 'unique:users,email,' . $user->id],
            'photo'     => ['nullable'],
            'password'  => ['nullable', 'confirmed'],
        ]);

        if($request->hasFile('photo')) {
            $photo = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'), $photo);
            $user->photo = $photo;
        }

        $user->document  = $request->document;
        $user->fullname  = $request->fullname;
        $user->gender    = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->phone     = $request->phone;
        $user->email     = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($user->save()) {
            return redirect('users')->with('message', 'The user: '.$user->fullname.' was successfully updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('users')->with('message', 'The user: '.$user->fullname.' was successfully deleted!');
    }
}
