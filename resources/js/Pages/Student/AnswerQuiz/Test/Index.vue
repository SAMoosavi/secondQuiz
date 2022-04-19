<template>
    <my-card :quiz="quiz" @finish="finish" :now="now" :start="start">
        <form novalidate @submit.prevent="submit">
            <div
                v-for="(question, index) in thisQuestions"
                :key="index"
                class="flex flex-col w-full p-1 py-4 my-2"
            >
                <test :question="question"/>
            </div>
            <div>
                <my-button
                    :disabled="form.processing"
                    class="mr-4"
                    type="button"
                    @click="chengSend"
                >
                    ارسال
                </my-button>
            </div>
            <my-modal
                :form="form"
                :loading="loading"
                :counter="counter"
                :answered="answered"
                :send="send"
                @submit="submit"
                @chengSend="chengSend"
            />
        </form>
    </my-card>
</template>

<script setup>
// Form component
import MyButton from "@/component/Form/Button";
// AnswerQuiz component
import MyCard from "@/component/Student/AnswerQuiz/Card";
import MyModal from "@/component/Student/AnswerQuiz/Modal";
// test Component
import Test from "./Test.vue";
// Lodash function
import {shuffle} from "lodash";
// Message functions
import {showError, successMessage} from "@/functions/Message";
// Inertia function
import {useForm} from "@inertiajs/inertia-vue3";
// Pinia
import {useAnswerQuiz} from "@/store/AnswerQuiz";
import {storeToRefs} from "pinia";
// Vue function
import {ref} from "@vue/reactivity";
// Props
const props = defineProps(["quiz", "questions", "now", "start"]);
// create question shuffled
const thisQuestions = shuffle(props.questions);
// form
const form = useForm({
    userId: props.quiz["user_id"],
    answer: null,
});
const send = ref(false);
const loading = ref(false);

const answerQuiz = useAnswerQuiz();
const {clear} = answerQuiz;
const {answered, counter, answer} = storeToRefs(answerQuiz);

function chengSend() {
    setTimeout(() => send.value = !send.value, 100);
}

function submit() {
    loading.value = true;
    form.transform((data) => ({
        ...data,
        answer: answer.value,
    })).post(route("student.answered.test"), {
        onSuccess: () => {
            clear();
            successMessage("پاسخ با موفقیت ثبت شد");
        },
        onError: errors => showError(errors),
    });
    setTimeout(() => loading.value = false, 400);
}

function finish() {
    setTimeout(submit, 100);
}
</script>
