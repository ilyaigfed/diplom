<template>
    <v-card flat class="" style="min-height: 264px; max-height: 264px;">
        <v-subheader v-if="user">На кого бы подписаться?</v-subheader>
        <v-subheader v-else>Наши пользователи</v-subheader>
        <transition name="fade">
            <v-list two-line class="pa-0" v-if="random_profiles">
                <v-list-tile
                        avatar
                        v-for="(profile, i) in random_profiles"
                        @click="$router.push(`/profile/${profile.link}`)"
                        :key="i"
                >
                    <v-list-tile-avatar>
                        <img :src="profile.image ? `/storage/${profile.image}`: '/storage/common/none-avatar.jpg'">
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title v-html="profile.name"></v-list-tile-title>
                        <v-list-tile-sub-title>
                            <span class="mr-1">
                                <v-icon small color="grey">account_circle</v-icon>
                                {{ profile.followers_count }}
                            </span>
                            <span>
                                <v-icon small color="grey">music_note</v-icon>
                                {{ profile.tracks_count }}
                            </span>
                        </v-list-tile-sub-title>
                    </v-list-tile-content>
                    <v-list-tile-action @click.stop v-if="user">
                        <v-btn icon ripple v-if="!profile.is_following" @click="follow(profile.link)">
                            <v-icon color="grey lighten-1">person_add</v-icon>
                        </v-btn>
                        <v-btn icon ripple v-if="profile.is_following" @click="unfollow(profile.link)">
                            <v-icon color="grey lighten-1">person_add_disabled</v-icon>
                        </v-btn>
                    </v-list-tile-action>
                </v-list-tile>
            </v-list>
        </transition>
        <v-flex xs12 class="text-xs-center pt-3" v-if="!random_profiles">
            <v-progress-circular
                    color="amber"
                    indeterminate
            ></v-progress-circular>
        </v-flex>
    </v-card>
</template>

<script>
    export default {
        name: "RandomProfiles",
        data() { return {

        }},
        computed: {
            user() {
                return this.$store.getters.USER;
            },
            random_profiles() {
                return this.$store.getters.RANDOM_PROFILES;
            }
        },
        mounted() {
            this.$store.dispatch('GET_RANDOM_PROFILES');
        },
        destroyed() {
            this.$store.commit('SET_RANDOM_PROFILES', null);
        },
        methods: {
            unfollow(link) {
                this.$store.dispatch('UNFOLLOW', link);
            },
            follow(link) {
                this.$store.dispatch('FOLLOW', link);
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