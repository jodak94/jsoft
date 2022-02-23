<template>
    <app-layout title="Productos">
        <template #header>
              Productos
        </template>
        <div class="flex items-center justify-between mb-6 text-right">
          <search-filter v-model="form.searchFilter" class="mr-4 w-full max-w-md" @reset="reset">
          </search-filter>
          <Link class="btn-default" :href="route('products.create')">
            <span>Crear</span>
            <span class="hidden md:inline">&nbsp;Producto</span>
          </Link>
        </div>

        <div class="default-box">
          <table class="w-full whitespace-nowrap">
            <tr class="text-left font-bold">
              <th class="pb-4 pt-6 px-6">
                Descripción
              </th>
              <th class="pb-4 pt-6 px-6">
                Código
              </th>
              <th class="pb-4 pt-6 px-6">
                Precio de venta
              </th>
              <th class="pb-4 pt-6 px-6">
                Stock Total
              </th>
              <th class="pb-4 pt-6 px-6">
                Categoría
              </th>
              <th class="pb-4 pt-6 px-6">
                Subcategoría
              </th>
            </tr>
            <tr v-for="product in products" :key="product.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
              <td class="border-t">
                <Link class="flex items-center px-6 py-4 focus:text-sky-500" :href="route('products.edit', {'product': product.id})">
                  {{ product.description }}
                </Link>
              </td>
              <td class="border-t">
                <Link class="flex items-center px-6 py-4 focus:text-sky-500" :href="route('products.edit', {'product': product.id})">
                  {{ product.code }}
                </Link>
              </td>
              <td class="border-t">
                <Link class="flex items-center px-6 py-4 focus:text-sky-500" :href="route('products.edit', {'product': product.id})">
                  {{ product.sale_price }}
                </Link>
              </td>
              <td class="border-t">
                <span class="flex items-center px-6 py-4 focus:text-sky-500 hover:cursor-pointer" @click="getWarehousesData(product.id)">
                  {{ product.total_stock }}
                  <icon name="document-search" class="block w-6 h-6 text-gray-400 ml-2" />
                </span>
              </td>
              <td class="border-t">
                <Link class="flex items-center px-6 py-4 focus:text-sky-500" :href="route('products.edit', {'product': product.id})">
                  {{ product.category_desc }}
                </Link>
              </td>
              <td class="border-t">
                <Link class="flex items-center px-6 py-4 focus:text-sky-500" :href="route('products.edit', {'product': product.id})">
                  {{ product.subcategory_desc }}
                </Link>
              </td>
              <td class="w-px border-t">
                <Link class="flex items-center px-4" :href="route('products.edit', {'product': product.id})" tabindex="-1">
                  <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                </Link>
              </td>
            </tr>
            <tr v-if="products.length === 0">
              <td class="px-6 py-4 border-t" colspan="6">No se encontraron datos.</td>
            </tr>
          </table>
        </div>
        <jet-dialog-modal :show="showDetailsModal">
            <template #title>
                Stock por depósito
            </template>
            <template #content>
              <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                  <th class="pb-4 pt-6 px-6">
                    Depósito
                  </th>
                  <th class="pb-4 pt-6 px-6">
                    Stock
                  </th>
                </tr>
                <tr v-for="warehouse in warehouses" :key="warehouse.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                  <td class="border-t ">
                    <span class="flex items-center px-6 py-4">
                      {{ warehouse.name }}
                    </span>
                  </td>
                  <td class="border-t">
                    <span class="flex items-center px-6 py-4">
                      {{ warehouse.pivot.stock }}
                    </span>
                  </td>
                </tr>
              </table>
            </template>

            <template #footer>
                <button class="btn-default" @click.native="showDetailsModal = false">
                    Aceptar
                </button>
            </template>
        </jet-dialog-modal>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Icon from '@/Pages/Components/Icon'
    import SearchFilter from '@/Pages/Components/SearchFilter'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import mapValues from 'lodash/mapValues'
    import throttle from 'lodash/throttle'
    import pickBy from 'lodash/pickBy'
    import JetDialogModal from '@/Jetstream/DialogModal'
    export default defineComponent({
        components: {
          AppLayout,
          Link,
          Icon,
          SearchFilter,
          JetDialogModal
        },
        props: {
          products: Object,
          search: '',
        },
        data(){
          return {
            form: {
              searchFilter: this.searchFilter
            },
            showDetailsModal: false,
            warehouses: [],
          }
        },
        created(){
          console.log(this.products)
        },
        watch: {
          form: {
            deep: true,
            handler: throttle(function () {
              this.$inertia.get(route('products'), pickBy(this.form), { preserveState: true })
            }, 150),
          },
        },
        methods: {
          reset() {
              this.form = mapValues(this.form, () => null);
          },
          getWarehousesData(id){
            axios.get(route('products.warehouses_data', {'product': id})).then(response => {
                this.warehouses = response.data.warehouses;
                this.showDetailsModal = true;
            })
          }
      },
    })
</script>
