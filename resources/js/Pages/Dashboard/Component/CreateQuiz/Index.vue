<template>
    <form novalidate @submit.prevent="submit">
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
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
                    autocomplete="name"
                    required
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
        </div>
        <!-- Create Questions -->
        <section class="mt-6 col-span-full">
            <div>
                <questions/>
            </div>
            <div class="flex items-center justify-start gap-2">
                <my-button
                    :disabled="loading"
                    :loading="loading"
                    class="mr-4"
                >
                    ساخت آزمون
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
import Clock from "@/component/Icons/Clock";
import Calendar from "@/component/Icons/Calendar";
// Form component
import MyLabel from "@/component/Form/Label.vue";
import MyInput from "@/component/Form/Input.vue";
import MyButton from "@/component/Form/Button.vue";
// Persian datetime picker
import PersianDatetimePicker from "vue3-persian-datetime-picker";
// Create Quiz component
import Questions from "./Questions.vue";
// Pinia
import {storeToRefs} from 'pinia'
import {useCreatQuiz} from "@/store/CreatQuiz";
// Inertia functions
import {useForm} from "@inertiajs/inertia-vue3";
// Vue functions
import {ref} from "@vue/reactivity";

/**************** Const ****************/
// Color for Persian datetime picker
const color = "#1fb10b";
/**************** Pinia ****************/
const CreateQuiz = useCreatQuiz()
// create pinia states
const {content, questions} = storeToRefs(CreateQuiz);
// create pinia actions
const {add} = CreateQuiz
/**************** Properties ****************/
//Create form object
const form = useForm({
    name: null,
    start: null,
    end: null,
    time: null,
    type: 'descriptive',
    questions: {},
});
// Loading
const loading = ref(false);

/**************** Functions ****************/
// Submit functions
function submit() {
    loading.value = true;
    form.questions = questions.value;
    console.log(form)
    setTimeout(() => (loading.value = false), 200)
}
</script>

