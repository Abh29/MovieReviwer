<script setup>
import { Head, Link } from '@inertiajs/vue3';
import TestComponent from "@/Components/TestComponent.vue";
import SearchInput from "@/Components/SearchInput.vue";
import MovieGallery from "@/Components/MovieGallery.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
        <!--  main -->
        <div class="main relative sm:justify-center min-h-screen bg-center bg-app selection:bg-red-500 selection:text-white">
            <!--        navbar-->
            <div class="flex row h-20 pb-6 w-full p-6">
                <!--auth links -->
                <div class="flex-1 float-right pr-1 text-end">
                    <div v-if="canLogin" >
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="font-semibold text-gray-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Dashboard</Link
                        >

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="font-semibold text-gray-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Log in</Link
                            >

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="ms-4 font-semibold text-gray-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Register</Link
                            >
                        </template>
                    </div>
                </div>
            </div>

            <!--  search input -->
            <div class="flex justify-center">
                <search-input message="something"></search-input>
            </div>


            <!--        movie cards-->
            <div class="block">
                <movie-gallery></movie-gallery>
            </div>

        </div>

    <Head title="Welcome" />

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
