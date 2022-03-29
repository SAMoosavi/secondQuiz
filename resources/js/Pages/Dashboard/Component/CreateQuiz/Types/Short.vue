<template>
    <div class="mt-3 w-full md:w-1/2 lg:w-1/3">
        <my-input :disabled="true"/>
    </div>
</template>

<script setup>
import MyInput from "@/component/Form/Input";
import {onMounted} from "vue";

const emits = defineEmits(['option', 'answer'])

onMounted(() => {
    emits('option', null);
    emits('answer', null);
})
</script>

