<template>
    <div>
        <h4>سؤال <span>(نمره:{{ question.score }})</span></h4>
        <p>
            {{ question.question }}
        </p>
        <div class="w-full">
            <my-textarea v-model="answer" rows="4" />
        </div>
    </div>
</template>

<script setup>
// Form component
import MyTextarea from "@/component/Form/Textarea";
// Pinia
import {useAnswerQuiz} from "@/store/AnswerQuiz";
// Vue function
import {ref} from "@vue/reactivity";
import {onMounted, watch} from "@vue/runtime-core";
// Props
const props = defineProps(["question"]);
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
    if (localStorage.getItem(Id)){
        answer.value = localStorage.getItem(Id);
    }
});
// Watch
watch(answer, (v) => setAnswer(Id, v));
</script>

