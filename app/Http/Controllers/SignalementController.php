<?php

namespace App\Http\Controllers;

use App\Models\Signalement;
use Illuminate\Http\Request;

class SignalementController extends Controller
{
    public function index()
    {
        $signalements = Signalement::all();
        return view('signalements.create', compact('signalements'));
    }

    public function create()
    {
        return view('signalements.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'point_id' => 'required|exists:points,id',
    //         'type' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'statut' => 'required|string|in:nouveau,en_cours,terminé',
    //     ]);
    //     Signalement::create($request->all());

    //     return redirect()->route('signalements.index')->with('success', 'Signalement créé avec succès.');
    // }

public function store(Request $request)
{
    $validated = $request->validate([
        'type' => 'required|string|max:255',
        'description' => 'required|string',
        'statut' => 'required|in:nouveau,en_cours,termine',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    $signalement = Signalement::create($validated);

    return redirect()->route('signalements.index')
        ->with('success', 'Signalement créé avec succès');
}


    public function show(Signalement $signalement)
    {
        return view('signalements.show', compact('signalement'));
    }

    public function edit(Signalement $signalement)
    {
        return view('signalements.edit', compact('signalement'));
    }

    public function update(Request $request, Signalement $signalement)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'point_id' => 'required|exists:points,id',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'required|string|in:nouveau,en_cours,terminé',
        ]);

        $signalement->update($request->all());

        return redirect()->route('signalements.index')->with('success', 'Signalement mis à jour avec succès.');
    }

    public function destroy(Signalement $signalement)
    {
        $signalement->delete();

        return redirect()->route('signalements.index')->with('success', 'Signalement supprimé avec succès.');
    }
}