<template>
    <app-layout title="Categorias">
        <template #header>
              Categorías
        </template>
        <div class="flex items-center justify-between mb-6 text-right">
          <search-filter v-model="form.description" class="mr-4 w-full max-w-md" @reset="reset">
          </search-filter>
          <Link class="btn-default" :href="route('categories.create')">
            <span>Crear</span>
            <span class="hidden md:inline">&nbsp;Categoría</span>
          </Link>
        </div>

        <div class="default-box">
          <table class="w-full whitespace-nowrap">
            <tr class="text-left font-bold">
              <th class="pb-4 pt-6 px-6">
                Descripción
              </th>
            </tr>
            <tr v-for="cat in categories" :key="cat.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
              <td class="border-t">
                <Link class="flex items-center px-6 py-4 focus:text-sky-500" :href="route('categories.edit', {'category': cat.id})">
                  {{ cat.description }}
                </Link>
              </td>
              <td class="w-px border-t">
                <Link class="flex items-center px-4" :href="route('categories.edit', {'category': cat.id})" tabindex="-1">
                  <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                </Link>
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
    import Icon from '@/Pages/Components/Icon'
    import SearchFilter from '@/Pages/Components/SearchFilter'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import mapValues from 'lodash/mapValues'
    import throttle from 'lodash/throttle'
    import pickBy from 'lodash/pickBy'
    export default defineComponent({
        components: {
          AppLayout,
          Link,
          Icon,
          SearchFilter
        },
        props: {
          categories: Object,
          search: '',
        },
        data(){
          return {
            form: {
              description: this.description
            }
          }
        },
        watch: {
          form: {
            deep: true,
            handler: throttle(function () {
              this.$inertia.get(route('categories'), pickBy(this.form), { preserveState: true })
            }, 150),
          },
        },
        methods: {
          reset() {
              this.form = mapValues(this.form, () => null);
          },
      },
    })
</script>
