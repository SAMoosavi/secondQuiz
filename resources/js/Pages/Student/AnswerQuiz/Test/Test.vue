<template>
    <div>
        <h4>
            سؤال
        </h4>
        <p>
            {{ question.question }}
        </p>
        <div class="flex flex-col md:flex-row md:justify-between gap-2">
            <my-radio
                v-model="answer"
                :checked="answer === null"
                :name="Id"
                txt="بدون پاسخ"
                value="0.00"
                @click="clean"
            />
            <my-radio
                v-for="(option,key) in thisOption"
                :key="key"
                v-model="answer"
                :checked="option === answer"
                :name="Id"
                :txt="option"
                :value="option"
            />
        </div>
    </div>
</template>

<script setup>
// Form component
import MyRadio from "@/component/Form/Radio";
// Pinia
import {useAnswerQuiz} from "@/store/AnswerQuiz";
// Vue function
import {ref} from "@vue/reactivity";
import {onMounted, watch} from "@vue/runtime-core";
import {shuffle} from "lodash";
// Props
const props = defineProps(["question"]);
// shuffled option
let objectOption = JSON.parse(props.question.option);
const thisOption = shuffle(objectOption);
// Pinia
const AnswerQuiz = useAnswerQuiz();
const {setAnswer, addCounter} = AnswerQuiz;
// Id question
const Id = props.question.id;
// answer question
const answer = ref(null);
// onMounted
onMounted(() => {
    addCounter();
    if (localStorage.getItem(Id)){
        answer.value = localStorage.getItem(Id);
    }
});
// Watch
watch(answer, (v) => {
    if (v === "0.00") answer.value = null;
    setAnswer(Id, v);
});

function clean(){
    answer.value = null;
}
</script>
