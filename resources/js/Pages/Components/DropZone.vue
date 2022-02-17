<template>
  <div @dragover.prevent @drop.prevent>
    <label class="form-label">Imágen</label>
    <input type="file" multiple @change="uploadFile" class="hidden" ref="inputFileBtn"/>
    <div @drop="dragFile" class="border-2 rounded border-dashed border-gray-300 bg-gray-100 hover:cursor-pointer" @click="selectFile">
      <img :src="image" v-if="selected">
      <span  v-if="!selected" class="px-5 py-8 flex text-gray-400 text-center">Suelte o presione aquí para agregar una imágen</span>
    </div>
  </div>
</template>

<script>
  import { defineComponent } from 'vue'
  export default defineComponent({
      props: {

      },
      components: {

      },
      data() {
        return {
          File: [],
          image: "/img/default-img.png",
          selected: false
        }
      },
      created() {
      },
      methods: {
        uploadFile(e) {
          this.File = e.target.files;
          this.image = URL.createObjectURL(e.target.files[0]);
          this.selected = true;
        },
        dragFile(e) {
          this.File = e.dataTransfer.files;
          this.image = URL.createObjectURL(e.dataTransfer.files[0]);
          this.selected = true;
        },
        selectFile(){
           let elem = this.$refs.inputFileBtn;
           elem.click();
        }
      }
  })
</script>
