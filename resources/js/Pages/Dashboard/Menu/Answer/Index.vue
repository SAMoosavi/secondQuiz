<template>
    <my-title
        @sendShowAnswer="
            () => {
                showIndex = -2;
                $emit('chengShow');
            }
        "
        :show="show"
    />
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
// Call Dashboard Menu Answer
import MyTitle from "@/Pages/Dashboard/Menu/Answer/Title.vue";
import Answer from "@/Pages/Dashboard/Menu/Answer/Answer.vue";
// functions Anime
import { open, close } from "@/functions/Anime";
// vue functions
import { reactive, ref } from "@vue/reactivity";
// Props & Emits
defineProps(["show"]);
defineEmits(["chengShow"]);
// show subtitle
const showIndex = ref(-1);
function chengShowIndex(index) {
    showIndex.value = index;
}
// functions of transition
function onEnter(el, done) {
    open(el, done);
}
function onLeave(el, done) {
    close(el, done);
}
// Test Value
const answers = reactive([
    { name: "مورد1" },
    { name: "مورد2" },
    { name: "مورد3" },
    { name: "مورد4" },
]);
</script>
