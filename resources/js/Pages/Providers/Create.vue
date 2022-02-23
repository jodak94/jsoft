<template>
    <app-layout title="Proveedores">
        <template #header>
              Proveedores
        </template>

        <h1 class="mb-8 text-3xl font-bold">
          <Link class="text-sky-400 hover:text-sky-600" :href="route('providers')">Proveedores</Link>
          <span class="text-sky-400 font-medium"> /</span>
          <span class="text-gray-400 font-medium"> Crear </span>
        </h1>
        <div class="default-box">
          <form @submit.prevent="store">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Nombre" />
              <text-input v-model="form.business_name" :error="form.errors.business_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Razón Social" />
              <text-input v-model="form.ruc" :error="form.errors.ruc" class="pb-8 pr-6 w-full lg:w-1/2" label="Ruc" />
              <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Teléfono" />
              <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Dirección" />
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <loading-button :loading="form.processing" class="btn-default" type="submit">Crear Proveedor</loading-button>
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
        data() {
          return {
            form: this.$inertia.form({
              name: '',
              business_name: '',
              ruc: '',
              phone: '',
              address: '',
            }),
          }
        },
        created() {

        },
        methods: {
          store() {
            this.form.post(route('providers'));
          },
        }
    })
</script>
