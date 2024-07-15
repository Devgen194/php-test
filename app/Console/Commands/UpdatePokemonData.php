<?php

namespace App\Console\Commands;

use App\Services\PokemonService;
use Illuminate\Console\Command;

class UpdatePokemonData extends Command
{
    protected $signature = 'pokemon:update';
    protected $description = 'Update Pokémon data from external API';
    protected $pokemonService;

    public function __construct(PokemonService $pokemonService)
    {
        parent::__construct();
        $this->pokemonService = $pokemonService;
    }

    public function handle()
    {
        $this->pokemonService->fetchAllPokemons();
        $this->info('Pokémon data updated successfully.');
    }
}
