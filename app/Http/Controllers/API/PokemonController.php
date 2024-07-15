<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\PokemonServiceInterface;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PokemonController extends Controller
{
    protected $pokemonService;

    public function __construct(PokemonServiceInterface $pokemonService)
    {
        $this->pokemonService = $pokemonService;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $query = Pokemon::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $pokemons = $query->paginate($perPage)->withQueryString();

        return Inertia::render('Pokemon/Index', [
            'pokemons' => $pokemons,
            'filters' => $request->only(['search', 'per_page']),
        ]);
    }


    public function show($id)
    {
        try {
            $pokemon = $this->pokemonService->fetchPokemon($id);

            if (!$pokemon) {
                return redirect()->back()->with('error', 'Pokemon not found.');
            }

            return Inertia::render('Pokemon/Overview', [
                'pokemon' => $pokemon,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch Pokemon details.');
        }
    }



}
