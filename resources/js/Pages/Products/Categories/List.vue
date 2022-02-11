<template>
    <app-layout title="Categorias">
        <template #header>
              Categorías
        </template>
        <div class="flex items-center justify-between mb-6 text-right">
          <!-- <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
            <label class="block text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="form-select mt-1 w-full">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </search-filter> -->
          <Link class="btn-default" :href="route('categories.create')">
            <span>Crear</span>
            <span class="hidden md:inline">&nbsp;Categoría</span>
          </Link>
        </div>

        <div class="bg-white rounded-md shadow overflow-x-auto">
          <table class="w-full whitespace-nowrap">
            <tr class="text-left font-bold">
              <th class="pb-4 pt-6 px-6">
                <!-- Categorías -->

              </th>
            </tr>
            <tr v-for="cat in categories" :key="cat.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
              <td class="border-t">
                <!-- <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/contacts/${contact.id}/edit`"> -->
                  {{ cat.description }}
                <!-- </Link> -->
              </td>
              <td class="w-px border-t">
                <!-- <Link class="flex items-center px-4" :href="`/contacts/${contact.id}/edit`" tabindex="-1"> -->
                +++
                  <!-- <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" /> -->
                <!-- </Link> -->
              </td>
            </tr>
            <tr v-if="categories.length === 0">
              <td class="px-6 py-4 border-t" colspan="4">No se encontraron datos.</td>
            </tr>
          </table>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    // import Icon from '@/Shared/Icon'
    import AppLayout from '@/Layouts/AppLayout.vue'
    export default defineComponent({
        components: {
          AppLayout,
          Link,
          // Icon
        },
        props: {
          categories: Object,
        },
        created() {
          console.log(this.categories)
          console.log(this.categories.data)
          console.log("List Categories Components")
        },
        watch(){
          categories: {
            console.log("watch")
            console.log(this.categories)
            console.log(this.categories.data)
          }
        }
    })
</script>
