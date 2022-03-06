<template>
    <label
        class="block text-sm font-medium after:text-error after:mr-0.5 after:text-opacity-0 after:content-['*']"
        :class="{
            'after:text-opacity-100': required,
        }"
    >
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </label>
</template>

<script setup>
defineProps(["value", "required"]);
</script>
