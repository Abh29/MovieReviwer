<script setup>
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
    message: {
        type: String,
        default: 'default string value',
    },
}
);


function handleClick() {
    console.log("clicked");
    $('#search-form').submit();
}

const form = useForm({
    search_query: '',
    remember: false,
});

const submit = () => {
    form.post(route('movies.search'));
};


</script>

<template>
    <div v-show="message">
        <div>
            <div class="p-2 py-6 ">
                <form id="search-form" @submit.prevent="submit">
                    <div class=" items-center justify-between flex rounded-full-100 p-2 mb-5">

                        <input  class="w-full rounded-full py-4 pl-4 text-gray-700 bg-gray-100
                                leading-tight focus:outline-none focus:shadow-outline lg:text-sm text-xs"
                                type="text" placeholder="Search" name="search_query">

                        <div class="bg-gray-400 p-2 hover:bg-orange-400 cursor-pointer mx-2 rounded-full" @click="submit">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>

input,
button {
    color: #fff;
    font-family: Nunito;
    padding: 0;
    margin: 0;
    border: 0;
    background-color: transparent;
}

form {
    height: 96px;
}

input[type="text"] {
    width: 90%;
    height: 96px;
    font-size: 40px;
    line-height: 1;
}

button {
    position: relative;
    display: block;
    width: 84px;
    height: 96px;
    cursor: pointer;
}

button span {
    position: absolute;
    top: 68px;
    left: 43px;
    display: block;
    width: 45px;
    height: 15px;
    background-color: transparent;
    border-radius: 10px;
    transform: rotateZ(52deg);
    transition: 0.5s ease all;
}

button span:before,
button span:after {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 45px;
    height: 15px;
    background-color: #fff;
    border-radius: 10px;
    transform: rotateZ(0);
    transition: 0.5s ease all;
}




</style>
