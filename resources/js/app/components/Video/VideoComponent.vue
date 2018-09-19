<template>
    <div class="">
        <div class="container mx-auto my-4">
            <h1 class="py-2">{{name}}</h1>
            <div class="d-flex">
                <div class="col-md-3">
                    <img :src="movieDetails.Poster" class="w-100 border border-dark rounded" alt="Poster">
                </div>
                <div class="col-md-9 text-lg-left">
                    <p class="py-2"><strong class="text-xl-left">Ano:</strong> {{movieDetails.Year}}</p>
                    <p class="py-2"><strong class="text-xl-left">Género:</strong> {{movieDetails.Genre}}</p>
                    <p class="py-2"><strong class="text-xl-left">Descrição:</strong> {{movieDetails.Plot}}</p>
                </div>
            </div>
        </div>
        <video id="video" controls controlsList="nodownload" preload="metadata">
            <source :src="videoSrc" type="video/mp4">
            <track v-for="(s, i) in subSrc" :key="i" :id="'sub-track'+i" kind="captions">
        </video>
    </div>
</template>

<script>
    import VTTConverter from 'srt-webvtt';

    export default {
        props: {
            videoSrc: {
                type: String,
                required: true
            },
            subSrc:{
                type: Array,
            },
            name: {
                type: String,
                required: true
            }
        },
        name: 'video-component',
        data() {
            return {
                movieDetails: []
            }
        },
        methods: {
            openFile: function (file) {
                let text;
                var rawFile = new XMLHttpRequest();
                rawFile.open("GET", file, false);
                rawFile.onreadystatechange = function ()
                {
                    if(rawFile.readyState === 4)
                    {
                        if(rawFile.status === 200 || rawFile.status == 0)
                        {
                            text = rawFile.responseText;
                        }
                    }
                }
                rawFile.send(null);
                //console.log(text);
                return text;
            }
        },
        mounted() {
            const self = this;
            const url = 'http://www.omdbapi.com/?apikey=1a4f2172&plot=full&type=movie&t='+this.name;

            fetch(url).then(response => response.json()).then(data => {
                console.log(data)
                self.movieDetails = data;
            });

            this.subSrc.forEach((sub, i) => {
                let blob = new Blob([this.openFile(sub)]);
                const vttConverter = new VTTConverter(blob); // the constructor accepts a parameer of SRT subtitle blob/file object

                let name = sub.split("/");
    
                vttConverter.getURL().then(function(url) { // Its a valid url that can be used further
                    var track = document.getElementById('sub-track'+i); // Track element (which is child of a video element)
                    var video = document.getElementById('video'); // Main video element
                    track.src = url; // Set the converted URL to track's source
                    track.label = name[name.length - 1];
                    video.textTracks[0].mode = 'showing'; // Start showing subtitle to your track
                })
                .catch(function(err) {
                    console.error(err);
                })
            });
        }
    }
</script>
<style scoped>
    video::cue {
        background-color: transparent;
    }
</style>
