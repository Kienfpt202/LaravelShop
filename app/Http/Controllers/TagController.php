<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tags.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        Tag::create($validatedData);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', ['tag' => $tag]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update($validatedData);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        

        return redirect()->route('categories.index')
            ->with('success', 'Tag đã được xóa thành công.');
    }
}
