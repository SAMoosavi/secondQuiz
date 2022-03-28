<template>
    <input
        :name="name"
        :value="value"
        class="ring-0 focus:ring-0 focus:ring-offset-0 focus:outline-0 bg-transparent radio-sm text-primary border-primary"
        type="radio"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

<script setup>
defineProps(["value", "name"]);
defineEmits(['update:modelValue'])
</script>

