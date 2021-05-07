<template>
    <transition name="fade">
        <v-footer
                app
                height="auto"
        >
            <v-layout row wrap justify-center v-if="playing_track">
                <v-flex xs12 lg8>
                    <v-layout row wrap justify-center>
                        <v-flex xs2>
                            <v-layout align-center fill-height>
                                <v-btn icon @click="prev">
                                    <v-icon>skip_previous</v-icon>
                                </v-btn>
                                <v-btn icon v-if="!track.playing()" @click="track.play()">
                                    <v-icon>play_arrow</v-icon>
                                </v-btn>
                                <v-btn icon v-else @click="track.pause()">
                                    <v-icon>pause</v-icon>
                                </v-btn>
                                <v-btn icon @click="next">
                                    <v-icon>skip_next</v-icon>
                                </v-btn>
                            </v-layout>
                        </v-flex>
                        <v-flex xs5>
                            <v-layout row wrap>
                                <v-flex xs10>
                                    <v-slider color="orange" v-model="seek" :max="track.duration()" :step="1">

                                    </v-slider>
                                </v-flex>
                                <v-flex xs2>
                                    <v-layout align-center fill-height justify-center>
                                        <span class="grey--text">{{ track.duration() | minutes }}</span>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                        <v-flex xs3 class="pl-3">
                            <v-layout row wrap fill-height align-center>
                                <v-list-tile
                                        avatar
                                >
                                    <v-list-tile-avatar>
                                        <img :src="tracks[current].image ? '/storage/' + tracks[current].image: '/siteimages/blurred-track-ava.jpg'">
                                    </v-list-tile-avatar>

                                    <v-list-tile-content>
                                        <v-list-tile-title class="pointer">{{ tracks[current].title }}</v-list-tile-title>
                                        <v-list-tile-sub-title class="grey--text caption pointer">{{ tracks[current].user.name }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                            </v-layout>
                        </v-flex>
                        <v-flex xs2>

                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-footer>
    </transition>
</template>

<script>
    import {Howl, Howler} from 'howler';
    export default {
        name: "Player",
        data() { return {
            track: null,
            tracks: null,
            current: null,
            seek: 0,
            seek2: null
        }},
        computed: {
            playing_track() {
                console.log('aaa', this.$store.getters.PLAYING_TRACK);
                return this.$store.getters.PLAYING_TRACK;
            }
        },
        watch: {
            playing_track(value) {
                console.log(value);
                this.tracks = value.tracks;
                this.current = value.current;

                if(this.track) {
                    this.track.stop();
                }

                this.track = new Howl({
                    src: '/storage/' + this.tracks[this.current].file,
                    html5: true,
                    onload: () => {
                        this.getSeek();
                    }

                });

                this.track.play();
            },
            track(value, old_value) {
                //this.getSeek();
            },
            tracks(value, old_value) {
                // if(this.track) {
                //     this.track.stop();
                // }
                //
                // this.track = new Howl({
                //     src: '/storage/' + value[this.current].file,
                //     html5: true
                // });
                //
                // this.track.play();
            },
            current(value) {
                console.log(value);
            },
            seek2() {
                console.log(this.seek2);
            }
        },
        mounted() {

        },
        methods: {
            next() {
                this.track.stop();

                if(this.current === this.tracks.length - 1) {
                    this.current = 0;
                } else {
                    this.current += 1;
                }

                this.track = new Howl({
                    src: '/storage/' + this.tracks[this.current].file,
                    html5: true,
                    onload: () => {
                        this.getSeek();
                    }
                });

                this.track.play();
            },
            prev() {
                this.track.stop();

                if(this.current === 0) {
                    this.current = this.tracks.length - 1;
                } else {
                    this.current -= 1;
                }

                this.track = new Howl({
                    src: '/storage/' + this.tracks[this.current].file,
                    html5: true,
                    onload: () => {
                        this.getSeek();
                    }

                });

                this.track.play();
            },
            getSeek() {
                setInterval(() => {
                    this.seek = this.track.seek();
                }, 100);
            },
            setSeek(x) {
                this.track.seek(x);
            }
        }

    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0;
    }
</style>