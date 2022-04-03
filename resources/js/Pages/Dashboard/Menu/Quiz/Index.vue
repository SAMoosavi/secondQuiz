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
            <div v-if="quizzes === null" class="loading h-16 flex items-center justify-center"></div>
            <template v-else>
                <div v-for="quiz in quizzes" :key="quiz.name">
                    <quiz
                        :index="quiz.uuid"
                        :quiz="quiz"
                        :show="quiz.uuid === showIndex"
                        @showThis="chengShowIndex"
                    />
                </div>
            </template>
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
import {ref} from "@vue/reactivity";
import {onMounted} from "vue";
import {watch} from "@vue/runtime-core";
// Props & Emits
const props = defineProps(["show", "showIndex"]);
defineEmits(["chengShow"]);
// show subtitle
const showIndex = ref(props.showIndex);

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

// quizzes Value
let quizzes = ref(null);

function getQuizzes() {
    axios.get(route('get.teacher.quizzes'))
        .then((result) => {
            console.log(result.data.quizzes)
            quizzes.value = result.data.quizzes;
        })
}

onMounted(getQuizzes)
watch(() => props.showIndex, getQuizzes)
</script>
