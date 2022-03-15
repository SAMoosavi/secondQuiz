<template>
    <my-title @cheng="chengShowQuiz" :show="showQuiz">آزمون ها ساخته شده</my-title>
</template>

<script setup>
import MyTitle from '@/component/Dashboard/Title.vue';
import { ref } from "@vue/reactivity";

const showQuiz = ref(true);

const emits = defineEmits(["sendShowQuiz"]);

function chengShowQuiz() {
    emits("sendShowQuiz", showQuiz.value);
    showQuiz.value = !showQuiz.value;
}
</script>

<style></style>
