<template>
    <v-layout>
        <v-flex xs9>
            <div class="pa-3">
                <h1>Это Ваши обновления</h1>
                <p class="subheading pb-2">
                    Следите за своими любимыми артистами и друзьями на Melodys и находите каждый новый трек прямо здесь!
                </p>
                <v-divider></v-divider>
            </div>
            <transition name="fade">
                <div v-if="tracks">
                    <v-list two-line>
                        <v-list-tile
                                v-for="(track, i) in tracks"
                                avatar
                                :to="`/tracks/${track.link}`"
                                :key="i"
                        >
                            <v-list-tile-avatar>
                                <img :src="track.image ? '/storage/'+track.image: '/siteimages/blurred-track-ava.jpg'">
                            </v-list-tile-avatar>

                            <v-list-tile-content>
                                <v-list-tile-title>{{ track.title }}</v-list-tile-title>
                                <v-list-tile-sub-title>Опубликовано {{ date(track.created_at) }}</v-list-tile-sub-title>
                            </v-list-tile-content>
                            <v-list-tile-action-text class="pr-2">
                                <span>{{ track.user.name }}</span>
                            </v-list-tile-action-text>
                            <v-list-tile-avatar>
                                <img :src="track.user.image ? '/storage/'+track.user.image: '/storage/common/none-avatar.jpg'">
                            </v-list-tile-avatar>
                        </v-list-tile>
                    </v-list>
                </div>
            </transition>
            <v-flex xs12 v-if="tracks && tracks.length === 0" class="text-xs-center pa-4">
                <v-icon color="grey lighten-2" size="64px">notification_important</v-icon>
                <p class="grey--text text--lighten-2 headline">
                    Ничего не найдено.
                </p>
            </v-flex>
            <v-flex xs12 class="text-xs-center" v-if="!tracks">
                <v-progress-circular
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
    export default {
        name: "Stream",
        components: {Bottom, RandomProfiles},
        computed: {
            tracks() {
                return this.$store.getters.NOTIFICATIONS;
            }
        },
        mounted() {
            this.$store.dispatch('GET_NOTIFICATIONS');
        },
        destroyed() {
            this.$store.commit('SET_NOTIFICATIONS', null);
        },
        methods: {
            date(date) {
                const a = date.split(' ');
                const d = a[0].split('.');

                console.log(a, d);

                switch (d[1]) {
                    case '01':
                        d[1] = 'января';
                        break;
                    case '02':
                        d[1] = 'февраля';
                        break;
                    case '03':
                        d[1] = 'марта';
                        break;
                    case '04':
                        d[1] = 'апреля';
                        break;
                    case '05':
                        d[1] = 'мая';
                        break;
                    case '06':
                        d[1] = 'июня';
                        break;
                    case '07':
                        d[1] = 'июля';
                        break;
                    case '08':
                        d[1] = 'августа';
                        break;
                    case '09':
                        d[1] = 'сентября';
                        break;
                    case '10':
                        d[1] = 'октября';
                        break;
                    case '11':
                        d[1] = 'ноября';
                        break;
                    case '12':
                        d[1] = 'декабря';
                        break;
                }

                return d[0] + ' ' + d[1] + ' в ' + a[1];
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