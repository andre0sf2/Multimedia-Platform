<template>
    <div class="thumb">
        <a class="img-box" :href="'/movies/'+movieName">
            <img class="imgPoster rounded" :src="poster" width="200px" height="300px" alt="POSTER" srcset="">
            <div class="middle">
                <div class="p-2 shadow rounded bg-success text-white border">Ver Filme</div>
            </div>
        </a>
    </div>
</template>
<script>
    export default {
        props: {
            movieName: {
                type: String,
                required: true
            }
        },
        name: 'thumb-component',
        data() {
            return {
                poster: null
            }
        },
        methods: {
        },
        mounted() {
            const url = 'http://www.omdbapi.com/?apikey=1a4f2172&type=movie&t='+this.movieName;
            fetch(url).then(response => response.json()).then(data => {
                console.log(data);
                this.poster = data.Poster;
            });
        }
    }
</script>
<style scoped>

    .thumb{
        border: 2px solid black;
        border-radius: 0.25rem;
        border-color: #343a40;
    }

    .img-box:hover .imgPoster {
        opacity: 0.3;
    }

    .img-box:hover .middle {
        opacity: 1;
    }
    .imgPoster{
        opacity: 1;
        display: block;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

</style>
