<template>
    <select
        :name="name"
        :id="id"
        @input="$emit('update:modelValue', $event.target.value)"
        :required="required"
        class="bg-transparent select select-primary focus:select-primary text-primary ring-0 outline-0 focus:ring-0 focus:outline-0"
    >
        <slot />
    </select>
</template>

<script setup>
defineProps(["name", "id", "required"]);
defineEmits(["update:modelValue"]);
</script>
