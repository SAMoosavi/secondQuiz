<template>
    <div class="grid grid-cols-1">
        <div class="form-control">
            <my-label :required="true" for="question" value="سؤال"/>
            <my-textarea id="question" v-model.lazy="question.question" :required="true"/>
        </div>
    </div>

    <test
        :answer="question.answer"
        :index="props.index"
        :option="question.option"
        @answer="getAnswer"
        @option="getOption"
    />


</template>

<script setup>
// Form component
import MyLabel from "@/component/Form/Label.vue";
import MyTextarea from "@/component/Form/Textarea.vue";
//Pinia
import {useEditQuiz} from "@/store/EditQuiz";
// types
import Test from "../Types/Test.vue";
// Vue function
import {onMounted, onUnmounted, watch} from "vue";
import {reactive} from "@vue/reactivity";
// Props
const props = defineProps(["index", 'question']);
/**************** Pinia ****************/
const EditQuiz = useEditQuiz();
// create pinia actions
const {add, remove} = EditQuiz;
/**************** Properties ****************/
// question object
const question = reactive({
    id: props.question.id,
    question: props.question.question,
    score: props.question.score,
    answer: props.question.answer,
    type: props.question.type ? props.question.type : 'test',
    option: props.question.option,
});
// onMounted
onMounted(() => add(props.index, question))

/**************** Functions ****************/
// getOption
function getOption(val) {
    question.option = val;
    add(props.index, question);
}

// getAnswer
function getAnswer(val) {
    question.answer = val;
    add(props.index, question);
}

// watch question
watch(
    () => question.question,
    () => add(props.index, question)
);
// onUnmounted
onUnmounted(() => remove(props.index))
</script>

