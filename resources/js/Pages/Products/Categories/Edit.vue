<template>
    <app-layout title="Categorías">
        <template #header>
              Categorías
        </template>

        <h1 class="mb-8 text-3xl font-bold">
          <Link class="text-sky-400 hover:text-sky-600" :href="route('categories')">Categorías</Link>
          <span class="text-sky-400 font-medium"> /</span>
          <span class="text-gray-400 font-medium"> Editar </span>
        </h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
          <form @submit.prevent="update">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <text-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2" label="Descripción" />
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <loading-button :loading="form.processing" class="btn-default" type="submit">Actualizar Categoría</loading-button>
            </div>
          </form>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import TextInput from '@/Pages/Components/TextInput'
    import LoadingButton from '@/Pages/Components/LoadingButton'
    export default defineComponent({
        components: {
          AppLayout,
          LoadingButton,
          TextInput,
          Link
        },
        props: {
          category: Object,
        },
        data() {
          return {
            form: this.$inertia.form({
              description: this.category.description,
            }),
          }
        },
        created() {
        },
        methods: {
          update() {
            this.form.put(route('categories.update', {'category': this.category.id}));
          },
        }
    })
</script>
