<template>
    <svg class="max-w-screen-md scale-50" viewBox="0 0 140 140" ref="svg1">
        <g fill="none" fill-rule="evenodd">
            <g
                class="fill-primary-focus"
                fill-opacity=".3"
                transform="translate(0 6)"
            >
                <polygon
                    points="70 0 136.574 48.369 111.145 126.631 28.855 126.631 3.426 48.369"
                ></polygon>
                <polygon
                    points="70 18 119.455 53.931 100.565 112.069 39.435 112.069 20.545 53.931"
                ></polygon>
                <polygon
                    points="70 34.86 101.727 57.911 89.609 95.209 50.391 95.209 38.273 57.911"
                ></polygon>
                <polygon
                    points="70 50.898 84.864 61.697 79.186 79.171 60.814 79.171 55.136 61.697"
                ></polygon>
            </g>
            <polygon
                ref="points1"
                class="stroke-2 stroke-secondary"
                points="70 21.681808119953725 124.80126937331791 58.5240813976525 96.76264922902959 112.40373062668209 36.472649229029585 122.24329650586874 50.19873062668209 67.13905426510166 "
            ></polygon>
        </g>
    </svg>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import anime from "animejs/lib/anime.es.js";

const svg1 = ref();
const points1 = ref();
onMounted(() => {
    anime({
        targets: points1.value,
        points: [
            {
                value: [
                    "70 24 119.574 60.369 100.145 117.631 50.855 101.631 3.426 54.369",
                    "70 41 118.574 59.369 111.145 132.631 60.855 84.631 20.426 60.369",
                ],
            },
            {
                value: "70 6 119.574 60.369 100.145 117.631 39.855 117.631 55.426 68.369",
            },
            {
                value: "70 57 136.574 54.369 89.145 100.631 28.855 132.631 38.426 64.369",
            },
            {
                value: "70 24 119.574 60.369 100.145 117.631 50.855 101.631 3.426 54.369",
            },
        ],
        easing: "easeOutQuad",
        duration: 4000,
        loop: true,
    });
    anime({
        targets: svg1.value,
        rotate: 360,
        easing: "linear",
        duration: 20000,
        loop: true,
    });
});
</script>
