<template>
    <input
        class="border-1 focus:border input input-bordered outline-0 focus:outline-0 focus:border-primary-focus focus:ring-2 focus:ring-primary focus:ring-opacity-50 w-full"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>

<script setup>
import { ref } from "@vue/reactivity";

defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);
const input = ref();
function focus() {
    input.value.focus();
}
</script>
