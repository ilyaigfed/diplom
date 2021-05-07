<template>
    <v-layout>
        <v-flex xs9 class="pb-5">
            <transition name="fade">
                <v-layout column v-if="newest_tracks && top_ten && disco && classic && heavy">
                    <v-flex xs12 v-if="newest_tracks">
                        <h1 class="pl-3 pt-3">Новейшее</h1>
                        <v-subheader>Самые новые треки, загруженные на Melodys</v-subheader>
                        <div class="pl-3 pr-3">
                            <TracksCarousel :tracks="newest_tracks"></TracksCarousel>
                        </div>
                    </v-flex>
                    <v-flex xs12 v-if="top_ten" class="mt-5">
                        <h1 class="pl-3 pt-3">Популярные профили</h1>
                        <v-subheader>Топ-10 самых популярных профилей на Melodys</v-subheader>
                        <ProfilesCarousel :profiles="top_ten"></ProfilesCarousel>
                    </v-flex>
                    <v-flex xs12 v-if="disco" class="mt-5">
                        <h1 class="pl-3 pt-3">Танцы</h1>
                        <v-subheader>Популярные танцевальные плейлисты на Melodys</v-subheader>
                        <div class="pl-3 pr-3">
                            <PlaylistsCarousel :playlists="disco"></PlaylistsCarousel>
                        </div>
                    </v-flex>
                    <v-flex xs12 v-if="classic" class="mt-5">
                        <h1 class="pl-3 pt-3">Классика</h1>
                        <v-subheader>Популярные плейлисты классической музыки на Melodys</v-subheader>
                        <div class="pl-3 pr-3">
                            <PlaylistsCarousel :playlists="classic"></PlaylistsCarousel>
                        </div>
                    </v-flex>
                    <v-flex xs12 v-if="heavy" class="mt-5">
                        <h1 class="pl-3 pt-3">Рок & Метал</h1>
                        <v-subheader>Популярные плейлисты для рокеров и металистов на Melodys</v-subheader>
                        <div class="pl-3 pr-3">
                            <PlaylistsCarousel :playlists="heavy"></PlaylistsCarousel>
                        </div>
                    </v-flex>
                </v-layout>
            </transition>
            <v-flex class="text-xs-center pt-5" v-if="!newest_tracks || !top_ten || !disco || !classic || !heavy">
                <v-progress-circular
                        :size="50"
                        color="amber"
                        indeterminate
                ></v-progress-circular>
            </v-flex>
        </v-flex>
        <v-divider vertical></v-divider>
        <v-flex xs3>
            <RandomProfiles></RandomProfiles>
            <v-divider></v-divider>
            <Bottom></Bottom>
        </v-flex>
    </v-layout>
</template>

<script>
    import RandomProfiles from "./common/RandomProfiles";
    import Bottom from "./common/Bottom";
    import TracksCarousel from "./home/TracksCarousel";
    import ProfilesCarousel from "./home/ProfilesCarousel";
    import PlaylistsCarousel from "./home/PlaylistsCarousel";
    export default {
        name: "Home",
        components: {PlaylistsCarousel, ProfilesCarousel, TracksCarousel, Bottom, RandomProfiles},
        computed: {
            newest_tracks() {
                return this.$store.getters.NEWEST_TRACKS;
            },
            top_ten() {
                return this.$store.getters.TOP_TEN;
            },
            disco() {
                return this.$store.getters.DISCO;
            },
            classic() {
                return this.$store.getters.CLASSIC;
            },
            heavy() {
                return this.$store.getters.HEAVY;
            }
        },
        mounted() {
            this.$store.dispatch('GET_NEWEST_TRACKS');
            this.$store.dispatch('GET_TOP_TEN');
            this.$store.dispatch('GET_DISCO');
            this.$store.dispatch('GET_CLASSIC');
            this.$store.dispatch('GET_HEAVY');
        },
        destroyed() {
            this.$store.commit('SET_NEWEST_TRACKS', null);
            this.$store.commit('SET_TOP_TEN', null);
            this.$store.commit('SET_DISCO', null);
            this.$store.commit('SET_CLASSIC', null);
            this.$store.commit('SET_HEAVY', null);
        }
    }
</script>

<style scoped>
    .fade-enter-active {
        transition: opacity 0.5s ease-in-out;
    }

    .fade-enter-to {
        opacity: 1;
    }

    .fade-enter {
        opacity: 0;
    }
</style>