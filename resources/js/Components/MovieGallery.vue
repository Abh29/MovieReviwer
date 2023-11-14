<template>

    <div class="flex flex-wrap p-6 justify-between">
        <div class="basis-[32%] bg-gray-200 my-2" v-for="movie in movies">
            <movie-card
                :id="movie.id"
                :movie="movie"
            ></movie-card>
        </div>
    </div>

</template>

<script setup>
import MovieCard from "@/Components/MovieCard.vue";

defineProps({
    movies : {
        type: Array,
    }

});

</script>

<style scoped>

</style>
