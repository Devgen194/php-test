<?php


namespace App\Contracts;

interface PokemonServiceInterface
{
public function fetchAllPokemons();
public function fetchPokemon($id);
public function updateLocalDatabase(array $pokemons): void;
}
