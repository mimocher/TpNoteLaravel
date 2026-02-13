<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index()
    {
        $speakers = Speaker::latest()->paginate(10);
        return view('speakers.index', ['speakers' => $speakers]);
    }

    public function create()
    {
        return view('speakers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'email' => 'required|email|unique:speakers,email',
        ]);

        Speaker::create($validated);

        return redirect()->route('speakers.index')->with('success', 'Intervenant créé avec succès');
    }

    public function show(Speaker $speaker)
    {
        $speaker->load('events');
        return view('speakers.show', ['speaker' => $speaker]);
    }

    public function edit(Speaker $speaker)
    {
        return view('speakers.edit', ['speaker' => $speaker]);
    }

    public function update(Request $request, Speaker $speaker)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'email' => 'required|email|unique:speakers,email,' . $speaker->id,
        ]);

        $speaker->update($validated);

        return redirect()->route('speakers.index')->with('success', 'Intervenant modifié avec succès');
    }

    public function destroy(Speaker $speaker)
    {
        $speaker->delete();
        return redirect()->route('speakers.index')->with('success', 'Intervenant supprimé avec succès');
    }
}