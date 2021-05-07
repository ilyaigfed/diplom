<template>
    <v-layout column justify-start>
        <v-flex class="text-xs-center pt-5" v-if="!playlist">
            <v-progress-circular
                    :size="50"
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <transition name="fade">
            <BigPlaylistHeader v-if="playlist"></BigPlaylistHeader>
        </transition>
        <transition name="fade">
            <v-layout row v-if="playlist">
                <v-flex xs9>
                    <BigPlaylistLeftSide></BigPlaylistLeftSide>
                </v-flex>
                <v-divider vertical></v-divider>
                <v-flex xs3>
                    <BigPlaylistRightSide></BigPlaylistRightSide>
                </v-flex>
            </v-layout>
        </transition>
    </v-layout>
</template>

<script>
    import BigPlaylistHeader from "./big_playlist/BigPlaylistHeader";
    import BigPlaylistLeftSide from "./big_playlist/BigPlaylistLeftSide";
    import BigPlaylistRightSide from "./big_playlist/BigPlaylistRightSide";
    export default {
        name: "BigPlaylist",
        components: {BigPlaylistRightSide, BigPlaylistLeftSide, BigPlaylistHeader},
        data() { return {
            snackbar: false
        }},
        computed: {
            playlist() {
                return this.$store.getters.PLAYLIST;
            },
            user() {
                return this.$store.getters.USER;
            }
        },
        mounted() {
            this.$store.dispatch('GET_PLAYLIST', this.$route.params.link);
        },
        destroyed() {
            this.$store.commit('SET_PLAYLIST', null);
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
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>