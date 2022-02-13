<template>
  <jet-confirmation-modal :show="showConfirmModal" @close="closeModal()">
      <template #title>
          Eliminar registro
      </template>

      <template #content>
          Está seguro que quiere eliminar el registro?
      </template>

      <template #footer>
          <jet-secondary-button @click.native="closeModal()">
              Cancelar
          </jet-secondary-button>
          <jet-danger-button class="ml-2" @click.native="destroy">
              Eliminar Registro
          </jet-danger-button>
      </template>
  </jet-confirmation-modal>
</template>
<script>
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    export default {
        components: {
          JetDangerButton,
          JetSecondaryButton,
          JetConfirmationModal
        },
        props: {
          openModal: Boolean,
        },
        data() {
          return {
            showConfirmModal: false,
          }
        },
        emits: [
          "deletedConfirmed", "modalClosed"
        ],
        watch: {
          openModal: function(val){
              this.showConfirmModal = val;
          }
        },
        methods: {
          destroy() {
            this.$emit('deletedConfirmed');
          },
          closeModal(){
            this.$emit('modalClosed');
          }
        }
    }
</script>
