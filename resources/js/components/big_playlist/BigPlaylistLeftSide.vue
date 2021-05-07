<template>
    <v-layout column>
        <v-flex xs12>
            <v-layout>
                <BigPlaylistPanel></BigPlaylistPanel>
            </v-layout>
        </v-flex>
        <v-flex xs12>
            <v-layout>
                <v-flex xs12>
                    <v-subheader>Дата релиза</v-subheader>
                    <p class="pl-3">{{ date }}</p>
                </v-flex>
            </v-layout>
        </v-flex>
        <v-flex xs12 v-if="playlist.description">
            <v-subheader>Описание</v-subheader>
            <p class="pl-3" style="word-wrap: break-word;">{{ playlist.description }}</p>
        </v-flex>
        <v-flex xs12>
            <v-layout wrap row>
                <v-subheader>Треки</v-subheader>
                <v-flex xs12>
                    <Track :key="i" :track="track" v-for="(track, i) in playlist.tracks" :i="i" :tracks="playlist.tracks"></Track>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    import BigPlaylistPanel from "./BigPlaylistPanel";
    import Track from "../profile/publications/tracks/Track";
    export default {
        name: "BigPlaylistLeftSide",
        components: {Track, BigPlaylistPanel},
        computed: {
            playlist() {
                return this.$store.getters.PLAYLIST;
            },
            date() {
                if(this.playlist) {
                    const d = this.playlist.release_date.split('-');

                    switch (d[1]) {
                        case '01': d[1] = 'января';
                            break;
                        case '02': d[1] = 'февраля';
                            break;
                        case '03': d[1] = 'марта';
                            break;
                        case '04': d[1] = 'апреля';
                            break;
                        case '05': d[1] = 'мая';
                            break;
                        case '06': d[1] = 'июня';
                            break;
                        case '07': d[1] = 'июля';
                            break;
                        case '08': d[1] = 'августа';
                            break;
                        case '09': d[1] = 'сентября';
                            break;
                        case '10': d[1] = 'октября';
                            break;
                        case '11': d[1] = 'ноября';
                            break;
                        case '12': d[1] = 'декабря';
                            break;
                    }

                    return d[2] + ' ' + d[1] + ' ' + d[0];
                }
            }
        }
    }
</script>

<style scoped>

</style>