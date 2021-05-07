<template>
    <v-flex xs3 lg2 class="pa-4">
        <v-card flat>
            <v-img :src="like.image ? '/storage/'+like.image: '/siteimages/blurred-track-ava.jpg'" aspect-ratio="1">
            </v-img>
            <v-card-title class="pt-2 pl-1 pr-1 pb-0">
                <v-flex xs12 class="text-truncate pointer" @click="$router.push(`/tracks/${like.link}`)">{{ like.title }}</v-flex>
                <v-flex xs12 class="text-truncate nickname-in-compilation pointer caption mt-1" @click="$router.push(`/profile/${like.user.link}`)">{{ like.user.name }}</v-flex>
            </v-card-title>
        </v-card>
    </v-flex>
</template>

<script>
    export default {
        name: "Like",
        props: ['like']
    }
</script>

<style scoped>

</style>