<template>
    <transition-group
        enter-active-class="transition duration-500 ease-out"
        enter-from-class="transform opacity-0 -translate-x-1/3"
        enter-to-class="transform translate-x-0 opacity-100"
        leave-active-class="transition duration-500 ease-in"
        leave-from-class="transform translate-x-0 opacity-100"
        leave-to-class="transform opacity-0 translate-x-1/4"
        move-class="transition transform-all duration-200"
        tag="div"
    >
        <questions v-if="showTop" :showChildren="showChildrenTop" :type="type"/>
        <template v-if="showIn" :key="index">
            <div>
                <div class="w-full flex flex-col md:flex-row items-center justify-between py-4 my-2">
                    <div class="w-full ml-3">
                        <create-question-descriptive v-if="type === 'descriptive'" :index="index"/>
                        <create-question-test v-else :index="index"/>
                    </div>
                    <div
                        class="flex md:flex-col gap-3 z-10"
                    >
                        <my-button type="button" @click="addQuestion">
                            <icon-add/>
                        </my-button>
                        <my-button type="button" @click="removeQuestion">
                            <icon-remove/>
                        </my-button>
                    </div>
                </div>
            </div>
            <div class="w-full flex items-center justify-center mb-2">
                <div class="w-full md:w-2/3 border-b-2 border-primary opacity-25"></div>
            </div>
        </template>
        <questions v-if="showBottom" :showChildren="showChildrenBottom" :type="type"/>
    </transition-group>
</template>

<script setup>
/**************** Imports ****************/
// Form component
import MyButton from "@/component/Form/Button.vue";
// Icons
import IconRemove from "@/component/Icons/Remove.vue";
import IconAdd from "@/component/Icons/Add.vue";
// Create Quiz component
import CreateQuestionDescriptive from "./DescriptiveQuiz/CreateQuestion.vue";
import CreateQuestionTest from "./TestQuiz/CreateQuestion.vue";
//Pinia
import {useCreatQuiz} from "@/store/CreatQuiz";
import {storeToRefs} from "pinia/dist/pinia";
//Vue functions
import {ref} from "@vue/reactivity";
import {watch} from "@vue/runtime-core";
//Props
const props = defineProps(['showChildren', 'type']);
/**************** Const ****************/
// Index
const index = new Date().getTime();
/**************** Pinia ****************/
const CreateQuiz = useCreatQuiz();
// Create pinia states
const {content} = storeToRefs(CreateQuiz);
/**************** Properties ****************/
// Show Top,In,Bottom
const showTop = ref(false);
const showIn = ref(true);
const showBottom = ref(false);
// Show Children Bottom,Top
const showChildrenTop = ref(0);
const showChildrenBottom = ref(0);

/**************** Functions ****************/
// addQuestion function
function addQuestion() {
    if (!showBottom.value) {
        showBottom.value = true;
    } else {
        showChildrenBottom.value = showChildrenBottom.value + 1;
    }
}

// Watch For addQuestion
/*
 اگر خانه‌ی بالا ساخته نشده بود آن را می سازد
 در غیر این صورت مقدار ارسالی را تغییر می دهد تا به فرزند ارسال شود
 که او بسازد اگر او هم بالا را ساخته بود
 دوباره به فرزند و این روند ادامه دارد
*/
/*
*If showTop is false, set true.
*Otherwise change showChildrenTop and send it to Top to create a question component,
*and do so until one of the showTops is set correctly.
*/

watch(
    () => props.showChildren,
    (newVal) => {
        if (!showTop.value) {
            showTop.value = true;
        } else {
            showChildrenTop.value = newVal;
        }
    }
);

// removeQuestion function
function removeQuestion() {
    if (content.value > 1) {
        setTimeout(() => {
            showIn.value = false;
        }, 200);
    } else {
        console.error('can not remove')
    }
}
</script>


