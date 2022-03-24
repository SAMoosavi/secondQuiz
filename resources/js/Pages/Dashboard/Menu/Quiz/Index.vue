<template>
    <my-title
        :show="show"
        @sendShowQuiz="
            () => {
                showIndex = -2;
                $emit('chengShow');
            }
        "
    />
    <transition @enter="onEnter" @leave="onLeave">
        <div v-if="show" class="overflow-hidden">
            <creat-new-quiz
                :show="-1 === showIndex"
                @showThis="chengShowIndex"
            />
            <div v-for="(quiz, index) in quizs" :key="quiz.name">
                <quiz
                    :index="index"
                    :quiz="quiz"
                    :show="index === showIndex"
                    @showThis="chengShowIndex"
                />
            </div>
        </div>
    </transition>
</template>

<script setup>
// Call Dashboard Menu Quiz
import MyTitle from "@/Pages/Dashboard/Menu/Quiz/Title.vue";
import Quiz from "@/Pages/Dashboard/Menu/Quiz/Quiz.vue";
import CreatNewQuiz from "@/Pages/Dashboard/Menu/Quiz/CreatNewQuiz.vue";
// functions Anime
import {close, open} from "@/functions/Anime";
// vue functions
import {reactive, ref} from "@vue/reactivity";
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
const quizs = reactive([
    {name: "مورد1"},
    {name: "مورد2"},
    {name: "مورد3"},
    {name: "مورد4"},
]);
</script>
