<template>
    <app-layout title="Categorías">
        <template #header>
              Subcategorías
        </template>

        <h1 class="mb-8 text-3xl font-bold">
          <Link class="text-sky-400 hover:text-sky-600" :href="route('categories')">Subcategorías</Link>
          <span class="text-sky-400 font-medium"> /</span>
          <span class="text-gray-400 font-medium"> Editar </span>
        </h1>
        <div class="default-box">
          <form @submit.prevent="update">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <text-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2" label="Descripción" />
              <select-input v-model="form.category_id" :error="form.errors.category_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Categoría">
                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.description }}</option>
              </select-input>
            </div>
            <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
              <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Eliminar</button>
              <loading-button :loading="form.processing" class="flex btn-default ml-auto" type="submit">Actualizar Subcategoría</loading-button>
            </div>
          </form>
        </div>
        <delete-modal :openModal="showConfirmModal" @deletedConfirmed="deletedConfirmed" @modalClosed="modalClosed"/>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import TextInput from '@/Pages/Components/TextInput'
    import LoadingButton from '@/Pages/Components/LoadingButton'
    import DeleteModal from '@/Pages/Components/DeleteModal'
    import SelectInput from '@/Pages/Components/SelectInput'
    export default defineComponent({
        components: {
          AppLayout,
          LoadingButton,
          TextInput,
          Link,
          DeleteModal,
          SelectInput
        },
        props: {
          categories: Array,
          subcategory: Object,
        },
        data() {
          return {
            form: this.$inertia.form({
              description: this.subcategory.description,
              category_id: this.subcategory.category_id,
            }),
            showConfirmModal: false
          }
        },
        methods: {
          update() {
            this.form.put(route('subcategories.update', {'subcategory': this.subcategory.id}));
          },
          destroy(){
            this.showConfirmModal = true;
          },
          deletedConfirmed(){
            this.showConfirmModal = false;
            this.$inertia.delete(route('subcategories.destroy', {'subcategory': this.subcategory.id}))
          },
          modalClosed(){
            this.showConfirmModal = false;
          }
        }
    })
</script>
