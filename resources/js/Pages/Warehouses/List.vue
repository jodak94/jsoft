<template>
    <app-layout title="Productos">
        <template #header>
              Depósitos
        </template>

        <div>
          Lista de Depósitos
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
          console.log("List Warehouses Components")
        }
    })
</script>
