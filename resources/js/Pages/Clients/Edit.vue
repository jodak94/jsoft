<template>
    <app-layout title="Depósitos">
        <template #header>
              Depósitos
        </template>

        <h1 class="mb-8 text-3xl font-bold">
          <Link class="text-sky-400 hover:text-sky-600" :href="route('clients')">Depósitos</Link>
          <span class="text-sky-400 font-medium"> /</span>
          <span class="text-gray-400 font-medium"> Editar </span>
        </h1>
        <div class="default-box">
          <form @submit.prevent="update">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Nombre" />
              <text-input v-model="form.business_name" :error="form.errors.business_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Razón Social" />
              <text-input v-model="form.ruc" :error="form.errors.ruc" class="pb-8 pr-6 w-full lg:w-1/2" label="Ruc" />
              <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Teléfono" />
              <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Dirección" />
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
          client: Object,
        },
        data() {
          return {
            form: this.$inertia.form({
              name: this.client.name,
              business_name: this.client.business_name,
              ruc: this.client.ruc,
              phone: this.client.phone,
              address: this.client.address,
            }),
            showConfirmModal: false
          }
        },
        methods: {
          update() {
            this.form.put(route('clients.update', {'client': this.client.id}));
          },
          destroy(){
            this.showConfirmModal = true;
          },
          deletedConfirmed(){
            this.showConfirmModal = false;
            this.$inertia.delete(route('clients.destroy', {'client': this.client.id}))
          },
          modalClosed(){
            this.showConfirmModal = false;
          }
        }
    })
</script>
