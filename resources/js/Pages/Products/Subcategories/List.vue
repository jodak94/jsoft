<template>
    <app-layout title="Subategorias">
        <template #header>
              Subategorías
        </template>

        <div>
          <div class="flex items-center justify-between mb-6">
            <!-- <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
              <label class="block text-gray-700">Trashed:</label>
              <select v-model="form.trashed" class="form-select mt-1 w-full">
                <option :value="null" />
                <option value="with">With Trashed</option>
                <option value="only">Only Trashed</option>
              </select>
            </search-filter> -->
            <Link class="btn-indigo" :href="route('subcategories.create')">
              <span>Crear</span>
              <span class="hidden md:inline">&nbsp;Contact</span>
            </Link>
          </div>
          <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
              <tr class="text-left font-bold">
                <th class="pb-4 pt-6 px-6">Name</th>
                <th class="pb-4 pt-6 px-6">Organization</th>
                <th class="pb-4 pt-6 px-6">City</th>
                <th class="pb-4 pt-6 px-6" colspan="2">Phone</th>
              </tr>
              <tr v-for="contact in contacts.data" :key="contact.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                <td class="border-t">
                  <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/contacts/${contact.id}/edit`">
                    {{ contact.name }}
                    <icon v-if="contact.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
                  </Link>
                </td>
                <td class="border-t">
                  <Link class="flex items-center px-6 py-4" :href="`/contacts/${contact.id}/edit`" tabindex="-1">
                    <div v-if="contact.organization">
                      {{ contact.organization.name }}
                    </div>
                  </Link>
                </td>
                <td class="border-t">
                  <Link class="flex items-center px-6 py-4" :href="`/contacts/${contact.id}/edit`" tabindex="-1">
                    {{ contact.city }}
                  </Link>
                </td>
                <td class="border-t">
                  <Link class="flex items-center px-6 py-4" :href="`/contacts/${contact.id}/edit`" tabindex="-1">
                    {{ contact.phone }}
                  </Link>
                </td>
                <td class="w-px border-t">
                  <Link class="flex items-center px-4" :href="`/contacts/${contact.id}/edit`" tabindex="-1">
                    <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                  </Link>
                </td>
              </tr>
              <tr v-if="contacts.data.length === 0">
                <td class="px-6 py-4 border-t" colspan="4">No contacts found.</td>
              </tr>
            </table>
          </div>
          <pagination class="mt-6" :links="contacts.links" />
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    export default defineComponent({
        components: {
          AppLayout,
        },
        created() {
          console.log("List Subcategories Components")
        }
    })
</script>
