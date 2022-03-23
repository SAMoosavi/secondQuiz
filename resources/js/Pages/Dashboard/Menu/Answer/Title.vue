<template>
    <my-title @cheng="$emit('sendShowAnswer')" :show="show">
        آزمون هایی که شرکت کردید
    </my-title>
</template>

<script setup>
// Dashboard component
import MyTitle from "@/component/Dashboard/Title.vue";
// Props & Emits
defineEmits(["sendShowAnswer"]);
defineProps(["show"]);
</script>
