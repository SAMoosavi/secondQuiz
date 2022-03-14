<template>
    <label
        class="text-sm font-medium justify-start text-base-content label cursor-pointer after:text-error after:mr-0.5 after:text-opacity-0 after:content-['*']"
        :class="{
            'after:text-opacity-100': required,
        }"
    >
        <template v-if="value">{{ value }}</template>
        <template v-else><slot></slot></template>
    </label>
</template>

<script setup>
defineProps(["value", "required"]);
</script>
