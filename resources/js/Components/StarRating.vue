<template>
<div>
    <fieldset class="rating">
        <input type="radio" id="star5" name="rating" value="5" @click="updateRating(5)" :checked="rated == 5"/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
        <input type="radio" id="star4" name="rating" value="4" @click="updateRating(4)" :checked="rated == 4"/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
        <input type="radio" id="star3" name="rating" value="3" @click="updateRating(3)" :checked="rated == 3"/><label class = "full" for="star3" title="Meh - 3 stars"></label>
        <input type="radio" id="star2" name="rating" value="2" @click="updateRating(2)" :checked="rated == 2"/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
        <input type="radio" id="star1" name="rating" value="1" @click="updateRating(1)" :checked="rated == 1"/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    </fieldset>
</div>
</template>

<script setup>
import axios from "axios";

const props = defineProps({
    rated: {
        type: Number,
        default: 0,
    },
    id: {
        type: Number,
        required: true,
    }
});


function updateRating(num) {
    axios.post(route('movies.rate'), {'id': props.id, 'rating': num})
        .then(function (response) {
            console.log(response);
        }).catch(function (error) {
            console.log("error", error);
    });
}

</script>

<style scoped>


fieldset, label { margin: 0; padding: 0; }

/****** Style Star Rating Widget *****/

.rating {
    border: none;
    float: left;
}

.rating > input { display: none; }
.rating > label:before {
    margin: 5px;
    margin-top: 0;
    font-size: 1em;
    font-family: FontAwesome;
    display: inline-block;
    content: "\f005";
}

.rating > .half:before {
    content: "\f089";
    position: absolute;
}

.rating > label {
    color: #ddd;
    float: right;
}

/***** CSS Magic to Highlight Stars on Hover *****/
.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700} /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  }


</style>
