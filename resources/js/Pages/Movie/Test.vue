<script setup>
import { Head } from '@inertiajs/vue3';
import '@/Components/TestComponent.vue'
import TestComponent from "@/Components/TestComponent.vue";

defineProps({
    movies: {
        type: Object,
    },
    users: {
        type: Array,
    }
});

</script>

<template>
    <div>
        this is a test page rendered using inertia !!!

<!--        {{movies.movie1}}-->
<!--        {{users}}-->

<!--        <TestComponent :message="movies.movie2" ></TestComponent>-->
        <TestComponent></TestComponent>

    </div>
</template>
