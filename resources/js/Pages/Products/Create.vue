<template>
    <app-layout title="Productos">
        <template #header>
              Productos
        </template>

        <h1 class="mb-8 text-3xl font-bold">
          <Link class="text-sky-400 hover:text-sky-600" :href="route('products')">Productos</Link>
          <span class="text-sky-400 font-medium"> /</span>
          <span class="text-gray-400 font-medium"> Crear </span>
        </h1>
        <!-- <div class="py-12 bg-white rounded-md shadow overflow-hidden"> -->
        <div class="py-12 bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <form @submit.prevent="store">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
              <div class="lg:w-4/5 flex flex-wrap ">
                <text-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2" label="Descripción" />
                <text-input v-model="form.code" :error="form.errors.code" class="pb-8 pr-6 w-full lg:w-1/2" label="Código" />
                <text-input v-model="form.sale_price" :error="form.errors.sale_price" :type="'number'" class="pb-8 pr-6 w-full lg:w-1/2" label="Precio de venta" />
                <text-input v-model="form.wholesale_price" :error="form.errors.wholesale_price" :type="'number'" class="pb-8 pr-6 w-full lg:w-1/2" label="Precio Mayorista" />

              </div>
              <div class="lg:w-1/5">
                <div class="pr-6">
                  <drop-zone @uploadedFile="uploadedFile"/>
                </div>
              </div>
              <select-input v-model="form.tax" :error="form.errors.tax" class="pb-8 pr-6 w-full lg:w-1/3" label="IVA">
                <option :value="10">10%</option>
                <option :value="5">5%</option>
                <option :value="0">0%</option>
              </select-input>
              <select-input v-model="form.category_id" :error="form.errors.category_id" class="pb-8 pr-6 w-full lg:w-1/3" label="Categoría" @change="get_subcategories($event)">
                <option :value="null">---</option>
                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.description }}</option>
              </select-input>
              <select-input v-model="form.subcategory_id" :error="form.errors.subcategory_id" class="pb-8 pr-6 w-full lg:w-1/3" label="Subcategoría">
                <option v-for="sub in subcategories" :key="sub.id" :value="sub.id">{{ sub.description }}</option>
              </select-input>
              <h1 class="mb-4 text-2xl text-center w-full">Stock por Depósito</h1>
              <table class="w-full mb-8">
                <thead>
                  <tr>
                    <th>Depósito</th>
                    <th>Stock</th>
                    <th>Stock crítico</th>
                  </tr>
                </thead>
                <tbody class="border-b border-t">
                  <tr v-for="war in form.warehouses">
                    <td>{{war.name}}</td>
                    <td>
                      <text-input v-model="war.pivot.initial_stock" :type="'number'" />
                    </td>
                    <td>
                      <text-input v-model="war.pivot.critical_stock" :type="'number'" />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <loading-button :loading="form.processing" class="btn-default" type="submit">Crear Producto</loading-button>
            </div>
          </form>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent, toRaw } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import TextInput from '@/Pages/Components/TextInput'
    import LoadingButton from '@/Pages/Components/LoadingButton'
    import SelectInput from '@/Pages/Components/SelectInput'
    import DropZone from '@/Pages/Components/DropZone'
    export default defineComponent({
        props: {
          categories: Array,
          warehouses: Array,
        },
        components: {
          AppLayout,
          LoadingButton,
          TextInput,
          Link,
          SelectInput,
          DropZone
        },
        data() {
          return {
            form: this.$inertia.form({
              description: '',
              code: '',
              sale_price: '',
              wholesale_price: '',
              tax: 10,
              category_id: null,
              subcategory_id: null,
              warehouses: [],
              file: null
            }),
            subcategories: [{'id': null, 'description': '---'}],
          }
        },
        created() {
          this.form.warehouses = this.warehouses;
          this.form.warehouses.forEach(w => {
             w.pivot = {'initial_stock':0, 'critical_stock':0};
          });
        },
        methods: {
          store() {
            console.log(this.form)
            this.form.post(route('products'));
          },
          get_subcategories(event){
            axios.get(route('categories.subcategories', {'category': event.target.value})).then(response => {
                this.subcategories = response.data.subcategories;
                this.subcategories.unshift({'id': null, 'description': '---'});

            })
          },
          uploadedFile(file){
            this.form.file = file;
          }
        }
    })
</script>
