<template>
    <my-title @cheng="$emit('sendShowQuiz')" :show="show">
        آزمون ها ساخته شده
    </my-title>
</template>

<script setup>
import MyTitle from "@/component/Dashboard/Title.vue";

defineEmits(["sendShowQuiz"]);
defineProps(["show"]);
</script>
