<template>
    <form novalidate @submit.prevent="submit">
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2">
            <!--Name-->
            <div class="form-control">
                <my-label
                    :required="true"
                    for="name"
                    value="نام آزمون"
                />
                <my-input
                    id="name"
                    v-model="form.name"
                    :required="true"
                    autocomplete="name"
                    type="text"
                />
            </div>
            <!--Start-->
            <div class="form-control">
                <my-label for="start" value="زمان شروع"/>
                <my-input
                    id="start"
                    v-model="form.start"
                    :icon="true"
                >
                    <calendar/>
                </my-input>
                <persian-datetime-picker
                    v-model="form.start"
                    :color="color"
                    :min="new Date()"
                    custom-input="#start"
                    type="datetime"
                />
            </div>
            <!--End-->
            <div class="form-control">
                <my-label
                    :required="!!form.start"
                    for="end"
                    value="زمان پایان"
                />
                <my-input
                    id="end"
                    v-model="form.end"
                    :disabled="!form.start"
                    :icon="true"
                    :required="!!form.start"
                >
                    <calendar/>
                </my-input>
                <persian-datetime-picker
                    v-model="form.end"
                    :color="color"
                    :disabled="!form.start"
                    :min="form.start"
                    custom-input="#end"
                    type="datetime"
                />
            </div>
            <!--Time-->
            <div class="form-control">
                <my-label
                    :required="true"
                    for="time"
                    value="مدت زمان آزمون"
                />
                <my-input
                    id="time"
                    v-model="form.time"
                    :icon="true"
                    :required="true"
                >
                    <clock/>
                </my-input>
                <persian-datetime-picker
                    v-model="form.time"
                    :color="color"
                    :max="form.start - form.end"
                    custom-input="#time"
                    type="time"
                />
            </div>
            <!--Score-->
            <div class="form-control">
                <my-label
                    :required="form.type === 'test'"
                    for="score"
                    value="نمره آزمون"
                />
                <my-input
                    id="score"
                    v-model.number="form.score"
                    :disabled="form.type !== 'test'"
                    :required="form.type === 'test'"
                    autocomplete="score"
                    type="text"
                />
            </div>
            <!--ScoreN-->
            <div v-if="form.type === 'test'" class="form-control">
                <my-label
                    :required="true"
                    for="scoreN"
                    value="نمره منفی آزمون"
                />
                <my-input
                    id="scoreN"
                    v-model.number="form.scoreN"
                    :required="!!form.start"
                    autocomplete="scoreN"
                    type="text"
                />
            </div>
        </div>
        <!-- Create Questions -->
        <section class="mt-6 col-span-full">
            <div>
                <Questions v-for="(question,index) in form.questions" :key="index" :question="question"
                           :type="form.type"/>
            </div>
            <div class="flex items-center justify-start gap-2 transition transform-all duration-500">
                <my-button
                    :disabled="loading"
                    :loading="loading"
                    class="mr-4"
                >
                    ویرایش آزمون
                </my-button>
                <div>
                    <p class="text-gray-800 dark:text-gray-300">
                        آزمون دارای
                        <span>{{ content }}</span>
                        سؤال است
                    </p>
                </div>
            </div>
        </section>
    </form>
</template>

<script setup>
// Icons
import Clock from "@/component/Icons/Clock.vue";
import Calendar from "@/component/Icons/Calendar.vue";
// Form component
import MyLabel from "@/component/Form/Label.vue";
import MyInput from "@/component/Form/Input.vue";
import MyButton from "@/component/Form/Button.vue";
//Edit Component
import Questions from "./Questions.vue";
// Persian datetime picker
import PersianDatetimePicker from "vue3-persian-datetime-picker";
// Const
import {requiredAnsMessage, requiredMessage, scoreMessage, scoreNMessage} from "@/Consts/Message";
import {color} from "@/Consts/property"
// Inertia functions
import {useForm} from "@inertiajs/inertia-vue3";

// validation functions
import {required, requiredAns, score, scoreN} from "@/functions/validations";
// Pinia
import {useEditQuiz} from "@/store/EditQuiz";
import {storeToRefs} from "pinia";
// Vue functions
import {ref} from "@vue/reactivity";
import {onUnmounted, watch} from "@vue/runtime-core";
import {errorMessage, successMessage} from "@/functions/Message";


// Props
const props = defineProps(['myProps']);
/**************** Pinia ****************/
const editQuiz = useEditQuiz()
// create pinia states
const {content, questions, scoreQuiz, deleted} = storeToRefs(editQuiz);
// create pinia actions
const {clean} = editQuiz
/**************** Properties ****************/
const form = useForm({
    id: props.myProps.quiz.id,
    name: props.myProps.quiz.name,
    start: props.myProps.quiz.start,
    end: props.myProps.quiz.end,
    time: props.myProps.quiz.time,
    score: props.myProps.quiz.score,
    scoreN: props.myProps.quiz.scoreN,
    type: props.myProps.quiz.type,
    questions: props.myProps.quiz.questions,
    deleted: [],
})

const loading = ref(false);

/**************** Functions ****************/

// watch
watch(scoreQuiz, (value) => form.score = value);
watch(() => form.type, () => form.score = null);
// onUnmounted
onUnmounted(() => clean())

// Submit functions
function submit() {
    loading.value = true;
    if (!required()) {
        errorMessage(requiredMessage);
    } else if (!requiredAns(form.questions)) {
        errorMessage(requiredAnsMessage);
    } else if (score(form.score)) {
        errorMessage(scoreMessage)
    } else if (scoreN(form.scoreN, form.type)) {
        errorMessage(scoreNMessage)
    } else {
        form.questions = questions.value;
        form.deleted = deleted.value;
        form.put(route('edit.quiz', [props.myProps.quiz.uuid]), {
            onSuccess: () => {
                successMessage('آزمون با موفقیت ویرایش شد');
                // clean();
            },
            onError: errors => {
                for (const error of errors) {
                    errorMessage(error);
                }
            },
        })
    }
    setTimeout(() => (loading.value = false), 200)
}
</script>

