<template>
    <div class="min-h-screen bg-gradient-to-br from-neutral to-neutral-focus flex items-center justify-center">
        <div class="bg-base-200 border-transparent border-1 rounded w-full p-4 max-w-7xl">
            <div class="gap-2 grid md:grid-cols-3">
                <h3 class="flex justify-between md:justify-start md:block">
                    نام آزمون: <span>
                            {{ quiz.name }}
                    </span>
                </h3>
                <h3 class="md:text-left order-2 md:order-3 flex justify-between md:justify-start md:block">
                    نمره آزمون: <span class="mr-auto md:mr-0">
                            {{ quiz.score }}
                    </span>
                </h3>
                <h3 class="col-span-1 md:text-center order-3 md:order-2 md:block flex justify-between md:justify-start">
                    مدت باقی مانده تا پایان آزمون: <span class="mr-auto md:mr-0">
                            <countdown-timer
                                :now="now"
                                :start="start"
                                :time="quiz.time"
                                @finish="submit"
                            />
                    </span>
                </h3>
            </div>
            <form novalidate @submit.prevent="submit">
                <div
                    v-for="(question, index) in thisQuestions"
                    :key="index"
                    class="flex flex-col w-full p-1 py-4 my-2"
                >
                    <component
                        :is="components[question.type]"
                        :question="question"
                    />
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
                <transition
                    enter-active-class="transition duration-200 ease-out"
                    enter-from-class="transform opacity-0 scale-50"
                    enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-200 ease-in"
                    leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform opacity-0 scale-50"
                >
                    <div
                        v-if="send"
                        class="absolute top-0 right-0 flex items-center justify-center w-screen h-screen px-8 py-4"
                    >
                        <div
                            class="p-8 bg-primary/60 border border-primary-focus rounded-md"
                        >
                            <p class="mb-4 text-justify">
                                آیا از ارسال جواب خود مطمعن هستید؟ <br /> {{
                                    counter - answered === 0
                                        ? "شما به تمامی سوالات پاسخ داده اید."
                                        : `شمااز ${counter} به ${answered} سوال پاسخ داده اید`
                                }}
                            </p>
                            <div class="flex justify-center items-center gap-4">
                                <my-button
                                    :disabled="form.processing"
                                    :loading="loading"
                                    class="btn-info"
                                    @click="submit"
                                >
                                    ارسال
                                </my-button>
                                <my-button
                                    class="btn-error"
                                    type="button"
                                    @click="chengSend"
                                >
                                    کنسل
                                </my-button>
                            </div>
                        </div>
                    </div>
                </transition>
            </form>
        </div>
    </div>
</template>

<script setup>
// Form component
import MyButton from "@/component/Form/Button";
// CountdownTimer component
import CountdownTimer from "@/component/CountdownTimer";
// Types
import Long from "./Types/Long.vue";
import Short from "./Types/Short.vue";
import Test from "./Types/Test.vue";
// Lodash function
import {shuffle} from "lodash";
// Message functions
import {errorMessage, successMessage} from "@/functions/Message";
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
// components of Type
const components = {
    "long": Long,
    "short": Short,
    "test": Test,
};
// form
const form = useForm({userId: props.quiz["user_id"], answer: null});
const send = ref(false);
const loading = ref(false);

const answerQuiz = useAnswerQuiz();
const {clear} = answerQuiz;
const {answered, counter, answer} = storeToRefs(answerQuiz);

function chengSend(){
    setTimeout(() => send.value = !send.value, 100);
}

function submit(){
    loading.value = true;
    form.answer = answer.value;
    form.post(route("student.answered"), {
        onSuccess: () => {
            clear();
            successMessage("پاسخ با موفقیت ثبت شد");
        },
        onError: errors => {
            for (const error of errors){
                errorMessage(error);
            }
        },
    });
    setTimeout(() => loading.value = false, 400);
}
</script>
