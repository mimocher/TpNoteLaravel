<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::latest()->paginate(10);
        return view('participants.index', ['participants' => $participants]);
    }

    public function create()
    {
        return view('participants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:20',
        ]);

        Participant::create($validated);

        return redirect()->route('participants.index')->with('success', 'Participant créé avec succès');
    }

    public function show(Participant $participant)
    {
        $participant->load('events');
        return view('participants.show', ['participant' => $participant]);
    }

    public function edit(Participant $participant)
    {
        return view('participants.edit', ['participant' => $participant]);
    }

    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,' . $participant->id,
            'phone' => 'required|string|max:20',
        ]);

        $participant->update($validated);

        return redirect()->route('participants.index')->with('success', 'Participant modifié avec succès');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index')->with('success', 'Participant supprimé avec succès');
    }
}