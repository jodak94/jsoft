<template>
  <div class="flex items-center">
    <div class="flex w-full bg-white rounded shadow">
      <jet-input class="w-full" autocomplete="off" type="text" name="search" placeholder="Buscar…" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
    </div>
    <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-sky-500 text-sm" type="button" @click="$emit('reset')">Limpiar</button>
  </div>
</template>

<script>
import JetInput from '@/Jetstream/Input.vue'
export default {
  components: {
    JetInput,
  },
  props: {
    modelValue: String,
    maxWidth: {
      type: Number,
      default: 300,
    },
  },
  emits: ['update:modelValue', 'reset'],
}
</script>
