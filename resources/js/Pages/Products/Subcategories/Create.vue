<template>
    <app-layout title="Subcategorías">
        <template #header>
              Subcategorías
        </template>

        <h1 class="mb-8 text-3xl font-bold">
          <Link class="text-sky-400 hover:text-sky-600" :href="route('subcategories')">Subcategorías</Link>
          <span class="text-sky-400 font-medium"> /</span>
          <span class="text-gray-400 font-medium"> Crear </span>
        </h1>
        <div class="default-box">
          <form @submit.prevent="store">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <text-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2" label="Descripción" />
              <select-input v-model="form.category_id" :error="form.errors.category_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Categoría">
                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.description }}</option>
              </select-input>
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <loading-button :loading="form.processing" class="btn-default" type="submit">Crear Subategoría</loading-button>
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
    import SelectInput from '@/Pages/Components/SelectInput'
    export default defineComponent({
        props: {
          categories: Array,
        },
        components: {
          AppLayout,
          LoadingButton,
          TextInput,
          Link,
          SelectInput
        },
        data() {
          return {
            form: this.$inertia.form({
              description: '',
              category_id: null,
            }),
          }
        },
        created() {

        },
        methods: {
          store() {
            this.form.post(route('subcategories'));
          },
        }
    })
</script>
