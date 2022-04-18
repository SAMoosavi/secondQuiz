<template>
    <Head title="زمان شروع آزمون" />
    <div
        class="flex items-center justify-center min-h-screen bg-gradient-to-br from-neutral to-neutral-focus"
    >
        <div
            class="flex items-center justify-center w-full p-4 border-transparent rounded bg-base-200 border-1 max-w-7xl"
        >
            <h1 class="mx-2">مدت زمان باقی مانده تا شروع آزمون:</h1>
            <countdown-timer
                :now="now"
                :start="start"
                :time="time"
                @finish="finish"
            />
        </div>
    </div>
    <Link ref="tagA" :href="route('student.quiz', [uuid])" />
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CountdownTimer from "@/component/CountdownTimer";

import { successMessage } from "@/functions/Message";

import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

const props = defineProps(["start", "now", "uuid", "time"]);
let tagA = ref();

function finish() {
    console.log(tagA.value);
    tagA.value.click();
    successMessage("آزمون با شروع شد");
}
</script>
