<template>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
        <template v-slot:activator="{ on }">
            <v-btn icon v-on="on">
                <v-icon>search</v-icon>
            </v-btn>
        </template>
        <v-card>
            <v-toolbar dark>
                <v-btn icon dark @click="close">
                    <v-icon>close</v-icon>
                </v-btn>
                <v-toolbar-title>Поиск</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-container>
                <v-layout row wrap justify-center>
                    <v-flex xs6>
                        <v-layout column>
                            <v-flex xs12>
                                <v-text-field
                                        label="Найти..."
                                        solo
                                        @input="search"
                                        v-model="q"
                                ></v-text-field>
                            </v-flex>
                            <transition name="fade">
                                <v-flex xs12 v-if="results">
                                    <v-flex xs12 v-if="results.tracks.length > 0">
                                        <v-subheader>Треки</v-subheader>
                                        <v-layout row wrap>
                                            <v-flex xs4 v-for="(t, i) in results.tracks" :key="i">
                                                <v-layout fill-height align-center justify-center>
                                                    <v-flex xs12 class="pa-4">
                                                        <v-card flat>
                                                            <v-img :src="t.image ? '/storage/'+t.image: '/siteimages/blurred-track-ava.jpg'" aspect-ratio="1">
                                                            </v-img>
                                                            <v-card-title class="pt-2 pl-1 pr-1 pb-0">
                                                                <v-flex xs12 class="text-truncate pointer" @click="redirect(`/tracks/${t.link}`)">{{ t.title }}</v-flex>
                                                                <v-flex xs12 class="text-truncate nickname-in-compilation pointer caption mt-1" @click="redirect(`/profile/${t.user.link}`)">{{ t.user.name }}</v-flex>
                                                            </v-card-title>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <v-flex xs12 v-if="results.profiles.length > 0">
                                        <v-subheader>Пользователи</v-subheader>
                                        <v-layout row wrap>
                                            <v-flex xs4 v-for="(t, i) in results.profiles" :key="i">
                                                <v-layout fill-height align-center justify-center>
                                                    <v-flex xs12 class="pa-4">
                                                        <v-card flat>
                                                            <v-img :src="t.image ? '/storage/'+t.image: '/storage/common/none-avatar.jpg'" aspect-ratio="1">
                                                            </v-img>
                                                            <v-card-title class="pt-2 pl-1 pr-1 pb-0">
                                                                <v-flex xs12 class="text-truncate pointer" @click="redirect(`/profile/${t.link}`)">{{ t.name }}</v-flex>
                                                            </v-card-title>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <v-flex xs12 v-if="results.playlists.length > 0">
                                        <v-subheader>Плейлисты & Альбомы</v-subheader>
                                        <v-layout row wrap>
                                            <v-flex xs4 v-for="(t, i) in results.playlists" :key="i">
                                                <v-layout fill-height align-center justify-center>
                                                    <v-flex xs12 class="pa-4">
                                                        <v-card flat>
                                                            <v-img :src="t.image ? '/storage/'+t.image: '/siteimages/blurred-track-ava.jpg'" aspect-ratio="1">
                                                            </v-img>
                                                            <v-card-title class="pt-2 pl-1 pr-1 pb-0">
                                                                <v-flex xs12 class="text-truncate pointer" @click="redirect(`/tracks/${t.link}`)">{{ t.title }}</v-flex>
                                                                <v-flex xs12 class="text-truncate nickname-in-compilation pointer caption mt-1" @click="redirect(`/profile/${t.user.link}`)">{{ t.user.name }}</v-flex>
                                                            </v-card-title>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                </v-flex>
                            </transition>
                            <v-flex xs12 v-if="!results" class="text-xs-center pa-4">
                                <v-icon color="grey lighten-2" size="64px">search</v-icon>
                                <p class="grey--text text--lighten-2 headline">
                                    Ничего не найдено.
                                </p>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "Search",
        data() { return {
            dialog: false,
            q: null
        }},
        watch: {
            q(_new) {
                if(_new === '') {
                    this.$store.commit('SET_SEARCH', null);
                }
            }
        },
        computed: {
            results() {
                return this.$store.getters.SEARCH;
            }
        },
        methods: {
            search: _.debounce(function(e) {
                this.$store.dispatch('DO_SEARCH', this.q);
            }, 300),
            redirect(link) {
                this.close();
                this.$router.push(link);
            },
            close() {
                this.q = null;
                this.dialog = false;
                this.$store.commit('SET_SEARCH', null);
            }
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