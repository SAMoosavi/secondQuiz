<template>
    <my-title @sendShowQuiz="sendShowQuiz" />
    <div ref="quizDiv" class="overflow-hidden">
        <creat-new-quiz :show="-2 == showIndex" @showThis="chengShowIndex" />
        <div v-for="(quiz, index) in quizs" :key="quiz.name">
            <quiz
                :quiz="quiz"
                :index="index"
                :show="index == showIndex"
                @showThis="chengShowIndex"
            />
        </div>
    </div>
</template>

<script setup>
import MyTitle from "@/Pages/Dashboard/Menu/Quiz/Title.vue";
import Quiz from "@/Pages/Dashboard/Menu/Quiz/Quiz.vue";
import CreatNewQuiz from "@/Pages/Dashboard/Menu/Quiz/CreatNewQuiz.vue";

import anime from "animejs/lib/anime.es.js";

import { reactive, ref } from "@vue/reactivity";

let quizDivHeight = 0;
const showQuiz = ref(true);
const quizDiv = ref();

const showIndex = ref(-1);
function chengShowIndex(index) {
    showIndex.value = index;
}
function sendShowQuiz() {
    quizDivHeight = quizDiv.value.clientHeight
        ? quizDiv.value.clientHeight
        : quizDivHeight;

    showQuiz.value = !showQuiz.value;
    if (!showQuiz.value) {
        close(quizDiv.value);
    } else {
        open(quizDiv.value, quizDivHeight);
    }
}
function close(el) {
    anime({
        targets: el,
        height: 0,
        duration: 500,
    });
}
function open(el, quizDivHeight) {
    anime({
        targets: el,
        height: quizDivHeight,
        ease: "linner",
        duration: 500,
    });
}

const quizs = reactive([
    { name: "Test1" },
    { name: "Test2" },
    { name: "Test3" },
    { name: "Test4" },
]);
</script>
