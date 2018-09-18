<template>
    <div>
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
            }
        },
        name: 'video-component',
        data() {
            return {
                subs: []
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
            this.subSrc.forEach((sub, i) => {
                let blob = new Blob([this.openFile(sub)]);
                const vttConverter = new VTTConverter(blob); // the constructor accepts a parameer of SRT subtitle blob/file object

                let name = sub.split("/");
    
                vttConverter.getURL().then(function(url) { // Its a valid url that can be used further
                    var track = document.getElementById('sub-track'+i); // Track element (which is child of a video element)
                    var video = document.getElementById('video'); // Main video element
                    track.src = url; // Set the converted URL to track's source
                    track.label = name[name.length - 1];
                    console.log(track.track);
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
