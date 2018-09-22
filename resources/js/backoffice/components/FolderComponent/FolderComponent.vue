<template>
    <div>
        <h2>Selecionar este caminho?: {{path}}</h2>
        <div class="row">
            <div v-for="(folder, i) in folders" :key="i"  class="col-md-2 text-center">
                <div v-if="folder.name !== '..'">
                    <img v-on:click="getFolders(folder.path)" :src="imgSrc" alt="Image Folder" class="pointer" height="70px" width="70px" srcset="">
                    <p v-on:click="getFolders(folder.path)" class="pointer">{{folder.name}}</p>
                </div>
                <div v-else>
                    <img v-on:click="getFolders(folder.path)" src="/storage/icons/back.png" alt="Image Folder" class="pointer" height="70px" width="70px" srcset="">
                    <p v-on:click="getFolders(folder.path)" class="pointer">Back</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'c-folder',
        props: {
            imgSrc: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                folders: [],
                path: ''
            }
        },
        methods: {
            getFolders: function(path){
                const self = this;
                axios.post('/api/folders', {path: path}).then(function (response) {
                    console.log(response.data);
                    self.path = response.data.path;
                    self.folders = response.data.folders;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            selectPath(){
                const self = this;  

                console.log(path);
            }
        },
        mounted() {
            this.getFolders('');
        }
    }
</script>
<style scoped>
    .pointer{
         cursor: pointer;
    }
</style>
