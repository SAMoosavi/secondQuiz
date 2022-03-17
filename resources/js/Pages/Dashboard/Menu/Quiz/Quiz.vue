<template>
    <div @click="$emit('showThis', show ? -2 : index)">
        <sub-title :show="show">
            {{ quiz.name }}
            <template #iconShow>
                <chevron-up />
            </template>
            <template #iconNotShow>
                <chevron-down />
            </template>
        </sub-title>
    </div>
    <transition @enter="onEnter" @leave="onLeave">
        <div v-if="show" class="overflow-hidden bg-primary-focus">
            <div class="h-12">sss</div>
        </div>
    </transition>
</template>

<script setup>
import SubTitle from "@/component/Dashboard/SubTitle.vue";

import ChevronUp from "@/component/Icons/ChevronUp.vue";
import ChevronDown from "@/component/Icons/ChevronDown.vue";

import { open, close } from "@/functions/Anime";

defineProps(["quiz", "show", "index"]);
defineEmits(["showThis"]);

function onEnter(el, done) {
    open(el, done);
}
function onLeave(el, done) {
    close(el, done);
}
</script>
