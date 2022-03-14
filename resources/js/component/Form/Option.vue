<template>
    <option :value="value" class="bg-base-100">
        <slot />
    </option>
</template>

<script setup>
defineProps(["value"]);
</script>
