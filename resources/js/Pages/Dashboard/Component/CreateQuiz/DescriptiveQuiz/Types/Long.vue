<template>
    <div class="mt-3">
        <my-textarea :disabled="true"></my-textarea>
    </div>
</template>

<script setup>
import MyTextarea from "@/component/Form/Textarea";
import {onMounted} from "vue";

const emits = defineEmits(['option', 'answer'])

onMounted(() => {
    emits('option', null);
    emits('answer', null);
})
</script>

