<template>
  <div class="flex">
    <input
      type="text"
      v-model="search"
      placeholder="Search..."
      class="border rounded p-2 w-full"
    />
    <button @click="$emit('reset')" class="ml-2 bg-red-500 text-white p-2 rounded">Reset</button>
  </div>
</template>

<script>
export default {
  props: {
    modelValue: String,
  },
  computed: {
    search: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit('update:modelValue', value);
      },
    },
  },
}
</script>
