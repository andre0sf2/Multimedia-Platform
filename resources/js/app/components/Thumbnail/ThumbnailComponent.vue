<template>
    <div>
        <a :href="'/movies/'+details.name">
            <img src="https://picsum.photos/200/300" alt="" srcset="">
        </a>
    </div>
</template>
<script>
    export default {
        props: {
            details: {
                type: Object,
                required: true
            }
        },
        name: 'thumb-component',
        data() {
            return {
                
            }
        },
        methods: {
        },
        mounted() {
            console.log(this.details);
        }
    }
</script>