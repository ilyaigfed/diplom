<template>
    <swiper :options="swiper_option">
        <swiper-slide v-for="(t, i) in tracks" :key="i">
            <v-card flat>
                <v-img :src="t.image ? '/storage/'+t.image: '/siteimages/blurred-track-ava.jpg'" aspect-ratio="1">
                </v-img>
                <v-card-title class="pt-2 pl-1 pr-1 pb-0">
                    <v-flex xs12 class="text-truncate pointer" @click="$router.push(`/tracks/${t.link}`)">{{ t.title }}</v-flex>
                    <v-flex xs12 class="text-truncate nickname-in-compilation pointer caption mt-1" @click="$router.push(`/profile/${t.user.link}`)">{{ t.user.name }}</v-flex>
                </v-card-title>
            </v-card>
        </swiper-slide>
        <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div>
        <div class="swiper-button-next swiper-button-white" slot="button-next"></div>
    </swiper>
</template>

<script>
    export default {
        name: "TracksCarousel",
        props: ['tracks'],
        data() { return {
            swiper_option: {
                slidesPerView: 4,
                spaceBetween: 20,
                slidesPerGroup: 4,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            }
        }}
    }
</script>

<style scoped>

</style>