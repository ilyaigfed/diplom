<template>
    <v-flex xs3 lg2 class="pa-4">
        <v-card flat>
            <v-img :src="follower.image ? '/storage/'+follower.image: '/storage/common/none-avatar.jpg'" aspect-ratio="1">
            </v-img>
            <v-card-title class="pt-2 pl-1 pr-1 pb-0">
                <v-flex xs12 class="text-truncate pointer" @click="$router.push(`/profile/${follower.link}`)">{{ follower.name }}</v-flex>
            </v-card-title>
        </v-card>
    </v-flex>
</template>

<script>
    export default {
        name: "Follower",
        props: ['follower']
    }
</script>

<style scoped>

</style>