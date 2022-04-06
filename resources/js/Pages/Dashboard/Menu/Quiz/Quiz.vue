<!--suppress ALL -->
<template>
    <div @click="onClick">
        <sub-title :show="show">
            {{ quiz.name }}
            <template #iconShow>
                <chevron-up/>
            </template>
            <template #iconNotShow>
                <chevron-down/>
            </template>
        </sub-title>
    </div>

    <transition @enter="onEnter" @leave="onLeave">
        <div v-if="show" class="overflow-hidden border-t bg-base-300 text-base-content">
            <sub-title-quiz :show="showSubTitle === 1" @click="onClickInformation()">
                اطلاعات سوال
                <template #icon>
                    <information-circle/>
                </template>
            </sub-title-quiz>
            <sub-title-quiz :show="showSubTitle === 2" @click="onClickEdit">
                ویرایش سوال
                <template #icon>
                    <pencil-alt/>
                </template>
            </sub-title-quiz>
            <sub-title-quiz :show="showSubTitle === 3" @click="chengShow(3)">
                پاسخ های ارسالی
                <template #iconShow>
                    <chevron-right/>
                </template>
                <template #iconNotShow>
                    <chevron-left/>
                </template>
            </sub-title-quiz>
        </div>
    </transition>
</template>

<script setup>
// Dashboard component
import SubTitle from "@/component/Dashboard/SubTitle.vue";
import SubTitleQuiz from "@/component/Dashboard/SubTitleQuiz.vue";
// Icons
import ChevronUp from "@/component/Icons/ChevronUp.vue";
import ChevronDown from "@/component/Icons/ChevronDown.vue";
import ChevronLeft from "@/component/Icons/ChevronLeft.vue";
import ChevronRight from "@/component/Icons/ChevronRight.vue";
import InformationCircle from "@/component/Icons/InformationCircle.vue";
import PencilAlt from "@/component/Icons/PencilAlt.vue";
// functions Anime
import {close, open} from "@/functions/Anime";
// Inertia functions
// vue functions
import {ref} from "@vue/reactivity";
import {Inertia} from "@inertiajs/inertia";
import {onMounted} from "vue";
// Props & Emits
const props = defineProps(["quiz", "show", "index"]);
const emit = defineEmits(["showThis"]);

// functions of transition
function onEnter(el, done) {
    open(el, done);
}

function onLeave(el, done) {
    close(el, done);
}

// show subtitle
const showSubTitle = ref(0);

function checkRoute() {
    if (route().current('teacher.information.quiz', [props.index])) {
        chengShow(1);
    } else if (route().current('teacher.edit.quiz', [props.index])) {
        chengShow(2);
    }
}

onMounted(() => {
    checkRoute();
})

let myRoute = route().current()
setInterval(() => {
    if (myRoute !== route().current()) {
        myRoute = route().current();
        checkRoute();
    }
}, 400)


function chengShow(indexShow) {
    showSubTitle.value = indexShow;
}

function onClick() {
    showSubTitle.value = 0;
    emit('showThis', props.show ? -2 : props.index);
}

function onClickInformation() {
    chengShow(1);
    if (!route().current('teacher.information.quiz', [props.index])) {
        setTimeout(() => Inertia.get(route('teacher.information.quiz', [props.index])), 500)
    }
}

function onClickEdit() {
    chengShow(2);
    if (!route().current('teacher.edit.quiz', [props.index])) {
        setTimeout(() => Inertia.get(route('teacher.edit.quiz', [props.index])), 500)
    }
}
</script>
