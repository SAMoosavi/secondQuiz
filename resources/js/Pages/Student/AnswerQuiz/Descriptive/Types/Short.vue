<template>
    <div>
        <h4>سؤال <span>(نمره:{{ question.score }})</span></h4>
        <p>
            {{ question.question }}
        </p>
        <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/4">
            <my-input v-model="answer"/>
        </div>
    </div>
</template>

<script setup>
// Form component
import MyInput from "@/component/Form/Input";
// Pinia
import {useAnswerQuiz} from "@/store/AnswerQuiz";
// Vue function
import {ref} from "@vue/reactivity";
import {onMounted, watch} from "@vue/runtime-core";
// Props
const props = defineProps(['question']);
// Pinia
const AnswerQuiz = useAnswerQuiz();
const {setAnswer, addCounter} = AnswerQuiz;
// Id question
const Id = props.question.id;
// answer question
const answer = ref();
// onMounted
onMounted(() => {
    addCounter();
    if (localStorage.getItem(Id)) {
        answer.value = localStorage.getItem(Id);
    }
});
// Watch
watch(answer, (v) => setAnswer(Id, v))
</script>

