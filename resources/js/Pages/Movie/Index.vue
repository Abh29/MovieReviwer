<script setup>
import { Head, Link } from '@inertiajs/vue3';
import TestComponent from "@/Components/TestComponent.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import SearchInput from "@/Components/SearchInput.vue";
import MovieGallery from "@/Components/MovieGallery.vue";
import {computed} from "vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    movies : {
        type: Array,
        required: true,
    },
    csrf: {
        type: String,
        required: true,
    }
});


</script>

<template>
    <Head title="Welcome" />


    <app-layout :can-login="canLogin" :can-register="canRegister">

            <!--  search input -->
            <div class="flex justify-center">
                <search-input :csrf="csrf"></search-input>
            </div>

            <!--        movie cards-->
            <div class="block">
                <movie-gallery :movies="movies" ></movie-gallery>
            </div>

    </app-layout>

    <!--  main -->

</template>

<style>

.bg-app {
    --tw-bg-opacity: 1;
    background-color: rgb(17 24 39 / var(--tw-bg-opacity));
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(230,212,25,0.2)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .bg-app {
        --tw-bg-opacity: 1;
        background-color: rgb(17 24 39 / var(--tw-bg-opacity));
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(230,212,25,0.2)'/%3E%3C/svg%3E");
    }
}
</style>
