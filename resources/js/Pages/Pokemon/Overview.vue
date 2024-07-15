<template>
  <div class="container mx-auto p-4">
    <Link href="/" class="text-blue-500 hover:underline mb-4 block">Back to Main Page</Link>
    <div v-if="pokemon" class="flex items-center mb-4">
      <img :src="pokemon.sprites.front_default" :alt="pokemon.name" class="w-32 h-32 mr-4">
      <div>
        <h1 class="text-3xl font-bold">{{ pokemon.name }}</h1>
        <p class="text-gray-600">{{ pokemon.species.name }}</p>
      </div>
    </div>
    <div v-if="pokemon" class="mb-4">
      <h2 class="text-2xl font-bold">Details</h2>
      <p><strong>Height:</strong> {{ pokemon.height }}</p>
      <p><strong>Weight:</strong> {{ pokemon.weight }}</p>
    </div>
    <div v-if="pokemon">
      <h2 class="text-2xl font-bold">Abilities</h2>
      <ul class="list-disc pl-5">
        <li v-for="ability in pokemon.abilities" :key="ability.ability.name">
          {{ ability.ability.name }}
        </li>
      </ul>
    </div>
    <div v-else>
      <p>Loading...</p>
    </div>
  </div>
</template>

<script>

import { Head, Link } from '@inertiajs/vue3'

export default {
  components: {
    Head,
    Link,
  },
  props: {
    pokemon: Object,
  },
};
</script>

