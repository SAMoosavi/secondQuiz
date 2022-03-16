<template>
    <my-title @sendShowAnswer="$emit('chengShow')" :show="show" />
    <transition @before-enter="onBeforEnter" @enter="onEnter" @leave="onLeave">
        <div v-if="show" class="overflow-hidden">
            <div v-for="(answer, index) in answers" :key="answer.name">
                <answer
                    :answer="answer"
                    :index="index"
                    :show="index == showIndex"
                    @showThis="chengShowIndex"
                />
            </div>
        </div>
    </transition>
</template>
<script setup>
import MyTitle from "@/Pages/Dashboard/Menu/Answer/Title.vue";
import Answer from "@/Pages/Dashboard/Menu/Answer/Answer.vue";

import { open, close } from "@/functions/Anime";

import { reactive, ref } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";

const props = defineProps(["show"]);
const emits = defineEmits(["chengShow"]);

const showIndex = ref(-1);
function chengShowIndex(index) {
    showIndex.value = index;
}

function onEnter(el, done) {
    open(el, done);
}
function onLeave(el, done) {
    close(el, done);
}

const answers = reactive([
    { name: "Test1" },
    { name: "Test2" },
    { name: "Test3" },
    { name: "Test4" },
]);
</script>
