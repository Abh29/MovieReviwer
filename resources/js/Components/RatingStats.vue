<template>
<div class="flex flex-wrap justify-center">

    <div class="py-5">
        <span class="rating-num"> {{median}} </span>
        <div class="rating-users">
            <i class="icon-user"></i> {{ratings.total}} total
        </div>
    </div>

    <div class="w-full flex flex-wrap">
        <div class="five histo-rate">
        <span class="histo-star">
          <i class="active icon-star"></i> 5 </span>
            <span class="bar-block">
          <span id="bar-five" class="bar" :style="fiveStars">
            <span>{{ratings[5]}}</span>&nbsp;
          </span>
        </span>
        </div>

        <div class="four histo-rate">
        <span class="histo-star">
          <i class="active icon-star"></i> 4 </span>
            <span class="bar-block">
          <span id="bar-four" class="bar" :style="fourStars">
            <span>{{ratings[4]}}</span>&nbsp;
          </span>
        </span>
        </div>

        <div class="three histo-rate">
        <span class="histo-star">
          <i class="active icon-star"></i> 3 </span>
            <span class="bar-block">
          <span id="bar-three" class="bar" :style="threeStars">
            <span>{{ratings[3]}}</span>&nbsp;
          </span>
        </span>
        </div>

        <div class="two histo-rate">
        <span class="histo-star">
          <i class="active icon-star"></i> 2 </span>
            <span class="bar-block">
          <span id="bar-two" class="bar" :style="twoStars">
            <span>{{ratings[2]}}</span>&nbsp;
          </span>
        </span>
        </div>

        <div class="one histo-rate">
        <span class="histo-star">
          <i class="active icon-star"></i> 1 </span>
            <span class="bar-block">
          <span id="bar-one" class="bar" :style="oneStar">
            <span>{{ratings[1]}}</span>&nbsp;
          </span>
        </span>
        </div>
    </div>
</div>
</template>

<script setup>
import {computed} from "vue";


const props = defineProps({
    ratings: {
        type: Object,
        required: true
    }
});

const fiveStars = computed(() => {
    if (props.ratings.total == 0) return 0;
    return "width: " + props.ratings[5] * 100 / props.ratings.total + "%;"
});
const fourStars = computed(() => {
    if (props.ratings.total == 0) return 0;
    return "width: " + props.ratings[4] * 100 / props.ratings.total + "%;"
});
const threeStars = computed(() => {
    if (props.ratings.total == 0) return 0;
    return "width: " + props.ratings[3] * 100 / props.ratings.total + "%;"
});
const twoStars = computed(() => {
    if (props.ratings.total == 0) return 0;
    return "width: " + props.ratings[2] * 100 / props.ratings.total + "%;"
});
const oneStar = computed(() => {
    if (props.ratings.total == 0) return 0;
    return "width: " + props.ratings[1] * 100 / props.ratings.total + "%;"
});
const median = computed(() => {
    if (props.ratings.total == 0) return 0;
   return Number(props.ratings.sum / props.ratings.total).toFixed(1);
});




</script>

<style scoped>

.rating-num {
    color: #333333;
    font-size: 72px;
    font-weight: 100;
    line-height: 1em;
}

.rating-stars .active {
    color: #737373;
}

.rating-users {
    font-size: 14px;
}

.histo {
    float: left;
    width: 50%;
    font-size: 13px;
}

.histo-star {
    display: inline-flex;
    float: left;
    padding: 3px;

}

.histo-rate {
    margin-bottom: 5px;
    width: 100%;
    display: inline-flex;
    clear: both;
}

.bar-block {
    margin-left: 5px;
    color: black;
    display: block;
    float: left;
    width: 75%;
    position: relative;
}

.bar {
    padding: 4px;
    display: block;
}

#bar-five {
    width: 0;
    background-color: #9FC05A;
}

#bar-four {
    width: 0;
    background-color: #ADD633;
}

#bar-three {
    width: 0;
    background-color: #FFD834;
}

#bar-two {
    width: 0;
    background-color: #FFB234;
}

#bar-one {
    width: 0;
    background-color: #FF8B5A;
}


</style>
