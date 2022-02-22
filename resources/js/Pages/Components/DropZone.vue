<template>
  <div @dragover.prevent @drop.prevent>
      <label class="form-label">Imágen
        <span v-if="this.image" class="float-right hover:cursor-pointer" @click="deleteImage">
          <icon name="x-circle" class="block w-6 h-6 text-gray-400 ml-2" />
        </span>
      </label>
      <input type="file" multiple @change="uploadFile" class="hidden" ref="inputFileBtn"/>
    <div @drop="dragFile" class="border-2 rounded border-dashed border-gray-300 bg-gray-100 hover:cursor-pointer" @click="selectFile">
      <img class="w-full" :src="image" v-if="selected">
      <span v-if="!selected" class="px-5 py-8 flex text-gray-400 text-center">Suelte o presione aquí para agregar una imágen</span>
    </div>
  </div>
</template>

<script>
  import { defineComponent } from 'vue'
  import Icon from '@/Pages/Components/Icon'
  export default defineComponent({
      props: {
        file: null,
      },
      components: {
        Icon
      },
      data() {
        return {
          File: [],
          image: null,
          selected: false,
        }
      },
      emits: [
        "uploadedFile"
      ],
      created() {
        if(this.file != null){
          this.selected = true;
          this.image = this.file;
        }
      },
      methods: {
        uploadFile(e) {
          this.image = URL.createObjectURL(e.target.files[0]);
          this.selected = true;
          this.$emit('uploadedFile', e.target.files[0])
        },
        dragFile(e) {
          this.image = URL.createObjectURL(e.dataTransfer.files[0]);
          this.selected = true;
          this.$emit('uploadedFile', e.dataTransfer.files[0])
        },
        selectFile(){
           let elem = this.$refs.inputFileBtn;
           elem.click();
        },
        deleteImage(){
          this.image = null;
          this.selected = false;
          this.$emit('uploadedFile', null)

        }
      }
  })
</script>
