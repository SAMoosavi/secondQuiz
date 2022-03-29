<template>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 md:justify-between md:items-center gap-2">
        <div class="form-control md:col-span-3 lg:col-span-4">
            <my-label :required="true" for="question" value="سؤال"/>
            <my-textarea id="question" v-model.lazy="question.question"/>
        </div>
        <div class="md:col-span-3 lg:col-span-1 grid md:grid-cols-3 gap-2">
            <div class="form-control md:col-span-1">
                <my-label :required="true" for="score" value="نمره سؤال"/>
                <my-input id="score" v-model.lazy.number="question.score"/>
            </div>
            <div class="form-control md:col-span-2">
                <my-label :for="`type-question-${index}`" :required="true" value="نوع سؤال"/>
                <my-select :id="`type-question-${index}`" v-model="question.type">
                    <my-option v-for="(txt,key) in options" :key="key" :selected="question.type === key" :value="key">
                        {{ txt }}
                    </my-option>
                </my-select>
            </div>
        </div>
    </div>
    <transition
        enter-active-class="transition duration-500 ease-out"
        enter-from-class="transform opacity-0 -translate-x-1/3"
        enter-to-class="transform translate-x-0 opacity-100"
        leave-active-class="transition duration-500 ease-in"
        leave-from-class="transform translate-x-0 opacity-100"
        leave-to-class="transform opacity-0 translate-x-1/4"
        mode="out-in"
    >
        <component
            :is="types[question.type]"
            :key="question.type"
            :index="props.index"
            @answer="getAnswer"
            @option="getOption"
        />
    </transition>
</template>

<script setup>
// Form component
import MyLabel from "@/component/Form/Label.vue";
import MyInput from "@/component/Form/Input.vue";
import MySelect from "@/component/Form/Select.vue";
import MyOption from "@/component/Form/Option.vue";
import MyTextarea from "@/component/Form/Textarea.vue";
//Pinia
import {useCreatQuiz} from "@/store/CreatQuiz";
// types
import Long from "./Types/Long.vue";
import Test from "./Types/Test.vue";
import Short from "./Types/Short.vue";

// Vue function
import {onMounted, watch} from "vue";
import {reactive} from "@vue/reactivity";
// Props
const props = defineProps(["index"]);
/**************** Pinia ****************/
const CreateQuiz = useCreatQuiz();
// create pinia actions
const {add} = CreateQuiz;
/**************** Properties ****************/
// question object
const question = reactive({
    question: null,
    score: null,
    answer: null,
    type: 'long',
    option: {},
});
// onMounted
onMounted(() => add(props.index, question))
// types
const types = {
    'long': Long,
    'short': Short,
    'test': Test,
}
// Option types
const options = {
    'long': 'پاسخ طولانی',
    'short': 'پاسخ کوتاه',
    'test': 'پاسخ تستی',
}

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
// watch type
watch(
    () => question.type,
    () => add(props.index, question)
);
// watch score
watch(
    () => question.score,
    () => add(props.index, question)
);
</script>

