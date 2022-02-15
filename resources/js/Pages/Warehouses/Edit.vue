<template>
    <app-layout title="Depósitos">
        <template #header>
              Depósitos
        </template>

        <h1 class="mb-8 text-3xl font-bold">
          <Link class="text-sky-400 hover:text-sky-600" :href="route('warehouses')">Depósitos</Link>
          <span class="text-sky-400 font-medium"> /</span>
          <span class="text-gray-400 font-medium"> Editar </span>
        </h1>
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
          <form @submit.prevent="update">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Nombre" />
              <text-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2" label="Descripción" />
            </div>
            <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
              <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Eliminar</button>
              <loading-button :loading="form.processing" class="flex btn-default ml-auto" type="submit">Actualizar Depósito</loading-button>
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
    export default defineComponent({
        components: {
          AppLayout,
          LoadingButton,
          TextInput,
          Link,
          DeleteModal
        },
        props: {
          warehouse: Object,
        },
        data() {
          return {
            form: this.$inertia.form({
              description: this.warehouse.description,
              name: this.warehouse.name,
            }),
            showConfirmModal: false
          }
        },
        methods: {
          update() {
            this.form.put(route('warehouses.update', {'warehouse': this.warehouse.id}));
          },
          destroy(){
            this.showConfirmModal = true;
          },
          deletedConfirmed(){
            this.showConfirmModal = false;
            this.$inertia.delete(route('warehouses.destroy', {'warehouse': this.warehouse.id}))
          },
          modalClosed(){
            this.showConfirmModal = false;
          }
        }
    })
</script>
