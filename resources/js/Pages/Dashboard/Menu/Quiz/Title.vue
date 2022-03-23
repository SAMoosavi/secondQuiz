<template>
    <my-title @cheng="$emit('sendShowQuiz')" :show="show">
        آزمون ها ساخته شده
    </my-title>
</template>

<script setup>
// Dashboard component
import MyTitle from "@/component/Dashboard/Title.vue";
// Props & Emits
defineEmits(["sendShowQuiz"]);
defineProps(["show"]);
</script>
