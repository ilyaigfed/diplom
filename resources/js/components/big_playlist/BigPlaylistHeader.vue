<template>
    <v-flex style="max-height: 253px;">
        <v-layout class="pa-4" id="bp-bg">
            <v-flex xs2>
                <v-img
                        :src="playlist.image ? '/storage/'+playlist.image: '/storage/common/none-avatar.jpg'"
                        aspect-ratio="1"
                        class="grey lighten-2"
                >
                </v-img>
            </v-flex>
            <v-flex xs8 class="pt-3 pl-4">
                <v-layout column>
                    <v-flex xs12 class="pb-2">
                        <span class="black grey--text body-1 pr-2 pl-2 pt-1 pb-1" style="cursor: pointer;" @click="$router.push(`/profile/${playlist.user.link}`)">{{ playlist.user.name}}</span>
                    </v-flex>
                    <v-flex xs12>
                        <span class="black white--text headline pr-2 pl-2 pt-1 pb-1">{{ playlist.title }}</span>
                    </v-flex>
                    <v-flex xs12 class="pt-2">
                        <v-btn color="orange" fab @click="play">
                            <v-icon color="white" large>play_arrow</v-icon>
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
        <img :src="playlist.image ? '/storage/'+playlist.image: '/storage/common/none-avatar.jpg'" id="pad" v-show="false">
    </v-flex>
</template>

<script>
    import FastAverageColor from 'fast-average-color';

    export default {
        name: "BigPlaylistHeader",
        computed: {
            playlist() {
                return this.$store.getters.PLAYLIST;
            }
        },
        mounted() {
            const img = document.getElementById('pad');

            img.onload = function() {
                const fac = new FastAverageColor(),
                    bp_bg = document.getElementById('bp-bg'),
                    color = fac.getColor(img);

                bp_bg.style.background = color.rgba;
            };
        },
        methods: {
            play() {
                this.$store.commit('SET_PLAYING_TRACK', { tracks: this.playlist.tracks, current: 0 });
            }
        }
    }
</script>

<style scoped>

</style>