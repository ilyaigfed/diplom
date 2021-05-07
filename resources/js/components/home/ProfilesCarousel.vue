<template>
    <v-layout row wrap>
        <v-flex xs6>
            <v-list two-line>
                <v-list-tile
                        :key="i"
                        avatar
                        :to="`/profile/${profile.link}`"
                        v-for="(profile, i) in profiles"
                        v-if="i < 5"
                >
                    <v-list-tile-avatar>
                        <img :src="profile.image ? '/storage/'+profile.image: '/storage/common/none-avatar.jpg'">
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title v-html="profile.name"></v-list-tile-title>
                        <v-list-tile-sub-title>
                            <span class="mr-1">
                                <v-icon small color="grey">account_circle</v-icon>
                                {{ profile.followers_count }}
                            </span>
                        </v-list-tile-sub-title>
                    </v-list-tile-content>
                    <v-list-tile-action>
                        <span class="grey--text">{{ i+1 }}</span>
                    </v-list-tile-action>
                </v-list-tile>
            </v-list>
        </v-flex>
        <v-flex xs6>
            <v-list two-line>
                <v-list-tile
                        :key="i"
                        avatar
                        :to="`/profile/${profile.link}`"
                        v-for="(profile, i) in profiles"
                        v-if="i > 4"
                >
                    <v-list-tile-avatar>
                        <img :src="profile.image ? '/storage/'+profile.image: '/storage/common/none-avatar.jpg'">
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title v-html="profile.name"></v-list-tile-title>
                        <v-list-tile-sub-title>
                            <span class="mr-1">
                                <v-icon small color="grey">account_circle</v-icon>
                                {{ profile.followers_count }}
                            </span>
                        </v-list-tile-sub-title>
                    </v-list-tile-content>
                    <v-list-tile-action>
                        <span class="grey--text">{{ i+1 }}</span>
                    </v-list-tile-action>
                </v-list-tile>
            </v-list>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProfilesCarousel",
        props: ['profiles'],
        data() { return {

        }}
    }
</script>

<style scoped>

</style>