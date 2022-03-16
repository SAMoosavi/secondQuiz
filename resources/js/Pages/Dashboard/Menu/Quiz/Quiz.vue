<template>
    <p
        class="flex items-center justify-between px-4 py-2 transition-all duration-500"
        :class="{ 'bg-primary': show }"
        @click="$emit('showThis', show ? -2 : index)"
    >
        {{ quiz.name }}
        <span>
            <cheng-icone>
                <chevron-up v-if="show" />
                <chevron-down v-else />
            </cheng-icone>
        </span>
    </p>
    <transition @enter="onEnter" @leave="onLeave">
        <div v-if="show" class="bg-primary-focus overflow-hidden">
            <div class="h-12">sss</div>
        </div>
    </transition>
</template>

<script setup>
import ChengIcone from "@/component/Dashboard/ChengIcone.vue";

import ChevronUp from "@/component/Icons/ChevronUp.vue";
import ChevronDown from "@/component/Icons/ChevronDown.vue";

import { open, close } from "@/functions/Anime";

import { ref } from "@vue/reactivity";

defineProps(["quiz", "show", "index"]);
defineEmits(["showThis"]);

function onEnter(el, done) {
    open(el, done);
}
function onLeave(el, done) {
    close(el, done);
}
</script>
