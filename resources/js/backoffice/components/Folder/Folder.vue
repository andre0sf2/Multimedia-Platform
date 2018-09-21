<template>
    <div>
        <input type="file" v-on:change="selectFolder(event);" webkitdirectory mozdirectory msdirectory odirectory directory />
    </div>
</template>

<script>
    export default {
        props: {
            
        },
        name: 'c-folder',
        data() {
            return {
               
            }
        },
        methods: {
            selectFolder(e) {
                for (var i = 0; i < e.target.files.length; i++) {
                    var s = e.target.files[i].name + '\n';
                    s += e.target.files[i].size + ' Bytes\n';
                    s += e.target.files[i].type;
                    alert(s);
                }
            }
        },
        mounted() {
            
        }
    }
</script>