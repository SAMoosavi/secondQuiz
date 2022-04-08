<template>
    <my-label class="justify-start gap-2">
        <input
            :name="name"
            :required="required"
            :value="value"
            class="ring-0 focus:ring-0 focus:ring-offset-0 focus:outline-0 bg-transparent radio-sm text-primary border-primary"
            type="radio"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <span class="label-text">{{ txt }}</span>
    </my-label>
</template>

<script setup>
import MyLabel from "@/component/Form/Label.vue";

defineProps(["value", "name", "required", 'txt']);
defineEmits(['update:modelValue'])
</script>

