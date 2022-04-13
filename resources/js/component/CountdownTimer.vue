<template>
    <span v-if="showtime.seconds != null" class="countdown">
        <span :style="`--value:${showtime.seconds};`"></span>:
        <span :style="`--value:${showtime.minutes};`"></span>:
        <span :style="`--value:${showtime.hours};`"></span>
    </span>
</template>

<script setup>
import {reactive} from "@vue/reactivity";

const props = defineProps(["time", "start", "now"]);
const emit = defineEmits(["finish"]);

let time = props.time;
time = time.split(":");
time = time[0] * 60 * 60 + time[1] * 60 + +time[2];
let dispute = props.now * 1000 - new Date().getTime();

const start = props.start * 1000;

const showtime = reactive({
    seconds: null,
    minutes: null,
    hours: null,
});

function toTwoNumber(num) {
    return num > 9 ? num : `0${num}`;
}

let timeEnd = null;
let timer = setInterval(() => {
    let now = new Date().getTime() + dispute;
    let lastTime = (now - start) / 1000;

    timeEnd = time - lastTime;
    if (timeEnd > 0) {
        showtime.seconds = toTwoNumber(Math.floor(timeEnd % 60));
        timeEnd /= 60;
        showtime.minutes = toTwoNumber(Math.floor(timeEnd % 60));
        timeEnd /= 60;
        showtime.hours = toTwoNumber(Math.floor(timeEnd % 60));
    } else {
        timeEnd.seconds = "00";
        timeEnd.minutes = "00";
        timeEnd.hours = "00";
    }
    if (time - lastTime < 2) {
        clearInterval(timer);
        showtime.seconds = "00";
        emit("finish");
    }
}, 1000);
</script>
