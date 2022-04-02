<template>
    <div class="grid grid-cols-1">
        <div class="form-control">
            <my-label :required="true" for="question" value="سؤال"/>
            <my-textarea id="question" v-model.lazy="question.question" :required="true"/>
        </div>
    </div>

    <test
        :index="props.index"
        @answer="getAnswer"
        @option="getOption"
    />
</template>

<script setup>
// Form component
import MyLabel from "@/component/Form/Label.vue";
import MyTextarea from "@/component/Form/Textarea.vue";
//Pinia
import {useCreatQuiz} from "@/store/CreatQuiz";
// types
import Test from "../Types/Test.vue";
// Vue function
import {onMounted, onUnmounted, watch} from "vue";
import {reactive} from "@vue/reactivity";
// Props
const props = defineProps(["index"]);
/**************** Pinia ****************/
const CreateQuiz = useCreatQuiz();
// create pinia actions
const {add, remove} = CreateQuiz;
/**************** Properties ****************/
// question object
const question = reactive({
    question: null,
    score: null,
    answer: null,
    type: 'test',
    option: {},
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

