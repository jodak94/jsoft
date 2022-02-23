<template>
    <aside class="flex flex-col bg-white shadow py-6 w-full sm:w-1/6 lg:w-1/8 lg:pl-4">
        <jet-nav-link :href="route(link.route)" :active="route().current(link.route)" v-for="link in sideBarLinks" >
          <span class="ml-2">
              {{ link.name }}
          </span>
        </jet-nav-link>
    </aside>
</template>

<script>
    import JetNavLink from '@/Jetstream/NavLink.vue'
    export default {
        components: {
          JetNavLink,
        },
        computed: {
            sideBarLinks() {
                return [
                    { name: 'Escritorio', route: 'dashboard'},
                    { name: 'Productos', route: 'products'},
                    { name: 'Clientes', route: 'clients'},
                    // { name: 'Editar Perfil', route: 'profile.show'},
                    { name: 'Depósitos', route: 'warehouses'},
                    { name: 'Categorías', route: 'categories'},
                    { name: 'Subcategorías', route: 'subcategories'},
                ]
            }
        }
    }
</script>
