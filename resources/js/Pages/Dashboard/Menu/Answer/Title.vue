<template>
    <my-title @cheng="$emit('sendShowAnswer')" :show="show">
        آزمون هایی که شرکت کردید
    </my-title>
</template>

<script setup>
import MyTitle from "@/component/Dashboard/Title.vue";

defineEmits(["sendShowAnswer"]);
defineProps(["show"]);
</script>
