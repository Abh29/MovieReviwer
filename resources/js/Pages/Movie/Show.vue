<script setup>
import { Head, Link} from '@inertiajs/vue3';
import {computed} from "vue";
import {ref} from "vue";
import {onMounted} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import RatingStats from "@/Components/RatingStats.vue";
import StarRating from "@/Components/StarRating.vue";


const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    movie: {
        type: Object,
        required: true,
    },
    rated: {
        type: Number,
        default: 0,
    },
    ratings: {
        type: Object,
        required: true,
    }
});

// set the title for the movie
const name = computed(() => {
    if (props.name == "")  return props.movie.alternative_name;
    let out = props.movie.name;
    if (props.movie.alternative_name) {
        out += ' ( ' + props.movie.alternative_name + ' )';
    }
    return out;
});

// set the movie genres
const genres = computed(() => {
    try {
      return JSON.parse(props.movie.genres);
   } catch (e) {
       return [{'name':"generic"}];
   }
});


// set the movie poster image
const poster = computed(() => {
    let out = "";
    try {
        out =   JSON.parse(props.movie.poster).previewUrl;
    } catch (e) {
        out = "https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg";
    }
    return out;
});


// set the banner background image
const movie_banner = ref(null);

onMounted(() => {
    let v = "url(https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg)";
    movie_banner._value.style.setProperty('--bgBanner', v);
});


// set the avatars
const avatars = computed(() => {
   try {
       return JSON.parse(props.movie.persons);
   } catch (e) {
       return [];
   }
});

</script>

<template>
    <Head :title="name" />

    <app-layout :can-register="canRegister" :can-login="canLogin">

        <div class="movie-card">
            <div class="container">
                <a href="#"><img :src="poster" alt="cover" class="cover"/></a>
                <div class="hero" id="movie_banner" ref="movie_banner">
                    <div class="details">
                        <div class="title1 text-white text-4xl"> {{name}} <span> {{ movie.rating_mpaa }} </span></div>
                        <div class="text-gray-100 text-2xl"> {{ movie.type }} <span class="pl-6"> {{movie.year}}</span></div>
                    </div> <!-- end details -->
                </div> <!-- end hero -->
                <div class="description flex">
                    <div class="column1">
                        <div class="grid grid-cols-2">
                            <span class="tag" v-for="genre in genres"> {{genre.name}} </span>
                        </div>
                        <div class="py-6">
                            <rating-stats :ratings="ratings"></rating-stats>
                        </div>
                    </div> <!-- end column1 -->
                    <div class="column2">
                        <div>
                            <p>{{movie.description}}</p>
                        </div>
                        <div class="avatars flex flex-wrap py-6 justify-center">
                            <div v-for="avatar in avatars.slice(0, 10)">
                                <a class="text-gray-900">
                                    <img :src="avatar.photo" :alt="avatar.name"/>
                                    <span>{{avatar.name}}</span>
                                </a>
                            </div>
                        </div> <!-- end avatars -->
                        <div class="text-5xl flex flex-wrap justify-center" v-if="$page.props.auth.user">
                            <h1>rate this {{movie.type}} : </h1>
                            <star-rating :rated="rated" :id="movie.id"></star-rating>
                        </div> <!-- end ratings -->
                    </div> <!-- end column2 -->
                </div> <!-- end description -->
            </div> <!-- end container -->
        </div> <!-- end movie-card -->
    </app-layout>

</template>

<style>

@import url(https://fonts.googleapis.com/css?family=Lato:400,300,700);
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);


a {
    text-decoration: none;
    color: #5C7FB8
}

a:hover {
    text-decoration: underline;
}

.movie-card {
    font: 14px/22px "Lato", Arial, sans-serif;
    color: #A9A8A3;
}

.container {
    margin: 0 auto;
    width: 92vw;
    background: #F0F0ED;
    border-radius: 5px;
    position: relative;
    min-height: 90vh;
}

.hero {
    height: 342px;
    margin:0;
    position: relative;
    overflow: hidden;
    z-index:1;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;

}

.hero:before {
    content:'';
    width:100%; height:100%;
    position:absolute;
    overflow: hidden;
    top:0; left:0;
    background:red;
    z-index:-1;
    background: var(--bgBanner, red);
    //background: url("https://akket.com/wp-content/uploads/2020/04/KinoPoisk-HD-Besplatnaya-podpiska-Filmy-Serialy-6.jpg");
    transform: skewY(-2.2deg);
    transform-origin:0 0;
    -webkit-backface-visibility: hidden;

}

.cover {
    position: absolute;
    top: 160px;
    left: 40px;
    z-index: 2;
    width: 190px;
    height: 280px;
}

.details {

    padding: 190px 0 0 280px;


    .title1 {

        position: relative;

        span {
            margin-left: 12px;
            background: #C4AF3D;
            border-radius: 5px;
            color: #544C21;
            font-size: 16px;
            padding: 5px 4px;
            text-transform: uppercase;
        }
    }

    .title2 {
        font-size: 23px;
        font-weight: 400;
        margin-bottom: 15px;
    }


    .likes {
        margin-left: 24px;
    }


    .likes:before {
        content: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/icon_like.png");
        position: relative;
        top: 2px;
        padding-right: 7px;
    }

}

.description {
    font-size: 16px;
    line-height: 26px;
    color: #B1B0AC;

}

.column1 {
    padding-left: 50px;
    padding-top: 120px;
    width: 20%;
    float: left;
    text-align: center;
}

.tag {
    background: white;
    border-radius: 10px;
    padding: 3px 8px;
    font-size: 14px;
    margin: 4px;
    line-height: 35px;
    cursor: pointer;
}

.tag:hover {
    background: #ddd;
}

.column2 {
    padding-left: 41px;
    padding-top: 30px;
    margin-left: 20px;
    width: 70%;
    float: left;
}

.avatars {
    margin-top: 23px;

    img {
        cursor: pointer;
        width: 150px;
        padding: 5px 2px;
        border-radius: 20px;
    }

    img:hover {
        opacity: 0.6;
    }

    a:hover {
        text-decoration: none;
    }
}


a[data-tooltip] {
    position: relative;
}
a[data-tooltip]::before,
a[data-tooltip]::after {
    position: absolute;
    display: none;
    opacity: 0.85;
}
a[data-tooltip]::before {
    /*
     * using data-tooltip instead of title so we
     * don't have the real tooltip overlapping
     */
    content: attr(data-tooltip);
    background: #000;
    color: #fff;
    font-size: 13px;
    padding: 5px;
    border-radius: 5px;
    /* we don't want the text to wrap */
    white-space: nowrap;
    text-decoration: none;
}
a[data-tooltip]::after {
    width: 0;
    height: 0;
    border: 6px solid transparent;
    content: '';
}

a[data-tooltip]:hover::before,
a[data-tooltip]:hover::after {
    display: block;
}

/** positioning **/

/* top tooltip */
a[data-tooltip][data-placement="top"]::before {
    bottom: 100%;
    left: 0;
    margin-bottom: 40px;
}
a[data-tooltip][data-placement="top"]::after {
    border-top-color: #000;
    border-bottom: none;
    bottom: 50px;
    left: 20px;
    margin-bottom: 4px;
}






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
