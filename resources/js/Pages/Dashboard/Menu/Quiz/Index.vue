<template>
    <my-title
        @sendShowQuiz="
            () => {
                showIndex = -2;
                $emit('chengShow');
            }
        "
        :show="show"
    />
    <transition @before-enter="onBeforEnter" @enter="onEnter" @leave="onLeave">
        <div v-if="show" class="overflow-hidden">
            <creat-new-quiz
                :show="-1 == showIndex"
                @showThis="chengShowIndex"
            />
            <div v-for="(quiz, index) in quizs" :key="quiz.name">
                <quiz
                    :quiz="quiz"
                    :index="index"
                    :show="index == showIndex"
                    @showThis="chengShowIndex"
                />
            </div>
        </div>
    </transition>
</template>

<script setup>
import MyTitle from "@/Pages/Dashboard/Menu/Quiz/Title.vue";
import Quiz from "@/Pages/Dashboard/Menu/Quiz/Quiz.vue";
import CreatNewQuiz from "@/Pages/Dashboard/Menu/Quiz/CreatNewQuiz.vue";

import { open, close } from "@/functions/Anime";

import { reactive, ref } from "@vue/reactivity";

defineProps(["show"]);
defineEmits(["chengShow"]);

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

const quizs = reactive([
    { name: "Test1" },
    { name: "Test2" },
    { name: "Test3" },
    { name: "Test4" },
]);
</script>
