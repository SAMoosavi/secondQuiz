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
        <div v-if="show" class="overflow-hidden border-t bg-primary-focus">
            <sub-title-quiz :show="showSubTitle === 1" @click="chengShow(1)">
                اطلاعات سوال
                <template #icon>
                    <information-circle/>
                </template>
            </sub-title-quiz>
            <sub-title-quiz :show="showSubTitle === 2" @click="chengShow(2)">
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

function chengShow(indexShow) {
    showSubTitle.value = indexShow;
}

function onClick() {
    showSubTitle.value = 0;
    emit('showThis', props.show ? -2 : props.index);
    if (!route().current('teacher.show.quiz', [props.index])) {
        setTimeout(() => Inertia.get(route('teacher.show.quiz', [props.index])), 500)
    }
}
</script>
