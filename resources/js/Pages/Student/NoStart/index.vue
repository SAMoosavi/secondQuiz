<template>
    <Head title="زمان شروع آزمون"><title>زمان شروع آزمون</title></Head>
    <div class="min-h-screen bg-gradient-to-br from-neutral to-neutral-focus flex items-center justify-center">
        <div class="bg-base-200 border-transparent border-1 rounded w-full p-4 max-w-7xl">
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

import {successMessage} from "@/functions/Message";

import {Head, Link} from "@inertiajs/inertia-vue3";
import {ref} from "@vue/reactivity";

const props = defineProps(["start", "now", "uuid", "time"]);
let tagA = ref();

function finish(){
    console.log(tagA.value);
    tagA.value.click();
    successMessage("آزمون با شروع شد");
}
</script>
