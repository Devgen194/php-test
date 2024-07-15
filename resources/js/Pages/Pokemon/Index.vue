<template>
  <div>
    <Head title="Pokedex" />
    <h1 class="mb-8 text-3xl font-bold text-yellow-600">Pokedex</h1>

    <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset"/>

    <div class="bg-white rounded-md shadow overflow-x-auto mt-6">
      <table class="w-full whitespace-nowrap">
        <thead>
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Pokemon Name</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="pokemon in pokemons.data" :key="pokemon.name" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <!-- Use InertiaLink to handle navigation -->
            <Link :href="'/pokemon/' + extractIdFromUrl(pokemon.url)" class="flex items-center px-6 py-4 focus:text-indigo-500 cursor-pointer">
              {{ pokemon.name }}
            </Link>
          </td>
        </tr>
        <tr v-if="pokemons.data.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No Pokemon found.</td>
        </tr>
        </tbody>
      </table>
    </div>

    <Pagination :links="pokemons.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Shared/Layout.vue'
import SearchFilter from '@/Shared/SearchFilter.vue'
import Pagination from '@/Shared/Pagination.vue'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'

export default {
  components: {
  Link,
    SearchFilter,
    Head,
    Pagination,
  },
  layout: Layout,
  props: {
    filters: Object,
    pokemons: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search || '',
        per_page: this.filters.per_page || 10,
      },
    };
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        console.log('Search:', this.form.search); // Debugging line
        this.$inertia.get('/', pickBy(this.form), { preserveState: true });
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },
    extractIdFromUrl(url) {
      // Extracts ID from URL like 'https://pokeapi.co/api/v2/pokemon/201/'
      const parts = url.split('/');
      return parts[parts.length - 2];
    },
  },
};
</script>


