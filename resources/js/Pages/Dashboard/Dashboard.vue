<template>
    <app-layout :title="props.title">
        <div
            class="fixed inset-0 right-0 w-1/4 lg:w-1/5 overflow-y-auto bg-base-200 top-16 text-base-content"
        >
            <quiz-index :show="showQuiz" :showIndex="showIndex" @chengShow="showQuiz = !showQuiz"/>

            <answer-index :show="!showQuiz" :showIndex="showIndex" @chengShow="showQuiz = !showQuiz"/>
        </div>
        <div
            class="fixed inset-y-0 left-0 overflow-y-auto bg-base-100 top-16 w-3/4 lg:w-4/5 overflow-hidden"
        >
            <div class=" sm:p-6 lg:p-8 pb-0">
                <component :is="components[props.component]" :props="props.myProps"/>
            </div>
        </div>
    </app-layout>
</template>

<script setup>
// Layouts
import AppLayout from "@/Layouts/AppLayout.vue";
// Call Menus
import QuizIndex from "@/Pages/Dashboard/Menu/Quiz/Index.vue";
import AnswerIndex from "@/Pages/Dashboard/Menu/Answer/Index.vue";
// components in main
import CreateQuiz from "@/Pages/Dashboard/Component/CreateQuiz/Index.vue"
// vue functions
import {ref} from "@vue/reactivity";
// Props
const props = defineProps({
    title: {
        type: String,
        default: "ساخت آزمون جدید",
    },
    showQuiz: {
        type: Boolean,
        default: true,
    },
    showIndex: {
        type: Number,
        default: -1,
    },
    component: {
        type: String,
        default: 'create-quiz',
    },
    myProps: {
        type: Object,
        default: {},
    }
})
// show Quiz Or Answer
const showQuiz = ref(props.showQuiz);

const components = {
    'create-quiz': CreateQuiz,
}
</script>
