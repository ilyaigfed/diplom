<template>
    <v-flex xs12>
        <RandomProfiles></RandomProfiles>
        <v-divider></v-divider>
        <Bottom></Bottom>
    </v-flex>
</template>

<script>
    import RandomProfiles from "../common/RandomProfiles";
    import Bottom from "../common/Bottom";
    export default {
        name: "BigTrackRightSide",
        components: {Bottom, RandomProfiles}
    }
</script>

<style scoped>

</style>