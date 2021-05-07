<template>
    <v-flex xs12 class="pa-4">
        <v-layout row wrap>
            <v-flex xs8>
                <template v-if="user">
                    <v-btn small class="grey--text" v-if="!playlist.liked" @click="like">
                        <v-icon color="grey" small left>favorite</v-icon>
                        Мне нравится
                    </v-btn>
                    <v-btn small color="orange" class="white--text" v-else @click="deleteLike">
                        <v-icon color="white" small left>favorite</v-icon>
                        Мне нравится
                    </v-btn>
                </template>
                <v-btn small class="grey--text" @click="reply">
                    <v-icon color="grey" small left>reply</v-icon>
                    Поделиться
                </v-btn>
                <template v-if="user">
                    <v-menu offset-y>
                        <template v-slot:activator="{ on }">
                            <v-btn
                                    small
                                    class="grey--text"
                                    v-on="on"
                            >
                                Дополнительно
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-tile @click="">
                                <v-list-tile-title>Редактировать</v-list-tile-title>
                            </v-list-tile>
                            <v-list-tile @click="">
                                <v-list-tile-title>Удалить</v-list-tile-title>
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                </template>
            </v-flex>
            <v-flex xs4>
                <v-layout align-center justify-end fill-height>
                    <span class="caption grey--text mr-2">
                        <v-icon small color="grey">favorite</v-icon>
                        {{ playlist.likes_count }}
                    </span>
                    <span class="caption grey--text">
                        <v-icon small color="grey">music_note</v-icon>
                        {{ playlist.tracks.length }}
                    </span>
                </v-layout>
            </v-flex>
            <v-flex xs12>

            </v-flex>
        </v-layout>
        <v-snackbar v-model="snackbar" color="green">
            Ссылка на трек скопирована в буфер обмена.
            <v-btn
                    dark
                    fab
                    icon
                    @click="snackbar = false"
            >
                <v-icon>close</v-icon>
            </v-btn>
        </v-snackbar>
    </v-flex>
</template>

<script>
    export default {
        name: "BigPlaylistPanel",
        data() { return {
            snackbar: false
        }},
        computed: {
            user() {
                return this.$store.getters.USER;
            },
            playlist() {
                return this.$store.getters.PLAYLIST;
            }
        },
        methods: {
            reply() {
                let tmp   = document.createElement('INPUT'),
                    focus = document.activeElement;

                tmp.value = window.location.href;

                document.body.appendChild(tmp);
                tmp.select();
                document.execCommand('copy');
                document.body.removeChild(tmp);
                focus.focus();
                this.snackbar = true;
            },
            like() {
                this.$store.dispatch('LIKE_PLAYLIST', this.$route.params.link);
            },
            deleteLike() {
                this.$store.dispatch('DELETE_PLAYLIST_LIKE', this.$route.params.link);
            }
        }
    }
</script>

<style scoped>

</style>