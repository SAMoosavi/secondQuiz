<template>
    <div
        @click="
            showSubTitle = 0;
            $emit('showThis', show ? -2 : index);
        "
    >
        <sub-title :show="show">
            {{ quiz.name }}
            <template #iconShow>
                <chevron-up />
            </template>
            <template #iconNotShow>
                <chevron-down />
            </template>
        </sub-title>
    </div>
    <transition @enter="onEnter" @leave="onLeave">
        <div v-if="show" class="overflow-hidden border-t bg-primary-focus">
            <sub-title-quiz @click="chengShow(1)" :show="showSubTitle == 1">
                اطلاعات سوال
                <template #icon>
                    <information-circle />
                </template>
            </sub-title-quiz>
            <sub-title-quiz @click="chengShow(2)" :show="showSubTitle == 2">
                ویرایش سوال
                <template #icon>
                    <pencil-alt />
                </template>
            </sub-title-quiz>
            <sub-title-quiz @click="chengShow(3)" :show="showSubTitle == 3">
                پاسخ های ارسالی
                <template #iconShow>
                    <chevron-right />
                </template>
                <template #iconNotShow>
                    <chevron-left />
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
import { open, close } from "@/functions/Anime";
// vue functions
import { ref } from "@vue/reactivity";
// Props & Emits
defineProps(["quiz", "show", "index"]);
defineEmits(["showThis"]);
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
</script>
