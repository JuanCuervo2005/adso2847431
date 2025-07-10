<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $pets = \App\Models\Pet::query();
        if ($query) {
            $pets = $pets->where('name', 'like', "%$query%")
                ->orWhere('kind', 'like', "%$query%")
                ->orWhere('breed', 'like', "%$query%")
                ->orWhere('location', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%") ;
        }
        $pets = $pets->orderBy('id', 'desc')->paginate(10);
        return view('pets.index', compact('pets', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'kind' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'age' => 'required|integer|min:0',
            'weight' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $pet = new \App\Models\Pet();
        $pet->name = $validated['name'];
        $pet->kind = $validated['kind'];
        $pet->breed = $validated['breed'];
        $pet->description = $validated['description'] ?? '';
        $pet->location = $validated['location'] ?? '';
        $pet->age = $validated['age'];
        $pet->weight = $validated['weight'];
        if ($request->hasFile('photo')) {
            $photo = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'), $photo);
            $pet->image = $photo;
        } else {
            $pet->image = 'no-photo.jpg';
        }
        $pet->save();
        return redirect()->route('pets.index')->with('message', 'Pet created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pet = \App\Models\Pet::findOrFail($id);
        return view('pets.show', compact('pet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pet = \App\Models\Pet::findOrFail($id);
        return view('pets.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'kind' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'age' => 'required|integer|min:0',
            'weight' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $pet = \App\Models\Pet::findOrFail($id);
        $pet->name = $validated['name'];
        $pet->kind = $validated['kind'];
        $pet->breed = $validated['breed'];
        $pet->description = $validated['description'] ?? '';
        $pet->location = $validated['location'] ?? '';
        $pet->age = $validated['age'];
        $pet->weight = $validated['weight'];
        if ($request->hasFile('photo')) {
            $photo = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'), $photo);
            $pet->image = $photo;
        }
        $pet->save();
        return redirect()->route('pets.index')->with('message', 'Pet updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pet = \App\Models\Pet::findOrFail($id);
        $pet->delete();
        return redirect()->route('pets.index')->with('message', 'Pet deleted successfully!');
    }
}
