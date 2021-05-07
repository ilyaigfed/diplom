<template>
    <v-flex xs12>
        <v-flex xs12 class="text-xs-center" v-if="!liked">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
        <v-flex xs12 v-if="liked && liked.length === 0" class="text-xs-center pa-4">
            <v-icon color="grey lighten-2" size="64px">favorite</v-icon>
            <p class="grey--text text--lighten-2 headline">
                Ничего не найдено.
            </p>
        </v-flex>
        <transition name="fade">
            <v-layout row wrap v-if="liked && liked.length > 0">
                <Like
                        v-for="(like, i) in liked"
                        :key="i"
                        :like="like"
                ></Like>
            </v-layout>
        </transition>
    </v-flex>
</template>

<script>
    import Like from "./liked/Like";
    export default {
        name: "Liked",
        components: {Like},
        computed: {
            liked() {
                return this.$store.getters.PROFILE_LIKED;
            }
        },
        mounted() {
            this.$store.dispatch('GET_PROFILE_LIKED', this.$route.params.link);
        },
        destroyed() {
            this.$store.commit('SET_PROFILE_LIKED', null);
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