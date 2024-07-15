<?php

namespace App\Services;

use App\Contracts\PokemonServiceInterface;
use App\Models\Pokemon;
use App\Traits\MakesApiRequests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * @method getRequest(string $string)
 */
class PokemonService implements PokemonServiceInterface
{
    use MakesApiRequests;

    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.Pokedex_api.Api');
    }



    public function fetchAllPokemons()
    {
        try {
            return Cache::remember('pokemons', now()->addHours(12), function () {
                $data = $this->getRequest($this->baseUrl . '/pokemon?offset=200&limit=200');

                if ($data !== null && isset($data['results'])) {
                    $this->updateLocalDatabase($data['results']);
                    return $data['results'];
                }

                throw new \Exception('API request failed');
            });
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Failed to fetch all pokemons: ' . $e->getMessage());

            // Fallback to database if cache is empty
            $pokemons = Cache::get('pokemons', Pokemon::all()->toArray());
            Log::info('Fetched data from local database', ['data' => $pokemons]);

            return $pokemons;
        }
    }


    public function fetchPokemon($id)
    {
        return Cache::remember("pokemon_{$id}", now()->addHours(12), function () use ($id) {
            return $this->getRequest($this->baseUrl . "/pokemon/{$id}");
        });
    }

    public function updateLocalDatabase(array $pokemons): void
    {
        foreach ($pokemons as $pokemon) {
            Pokemon::updateOrCreate(
                ['name' => $pokemon['name']],
                ['url' => $pokemon['url']]
            );
        }
    }
}
