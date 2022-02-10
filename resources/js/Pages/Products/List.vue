<template>
    <app-layout title="Productos">
        <template #header>
              Productos
        </template>

        <div>
          Lista de Productos
        </div>
    </app-layout>
</template>

<script>
    export default defineComponent({
        created() {
          console.log("List Products Components")
        }
    })
</script>
