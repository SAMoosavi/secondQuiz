<template>
    <!--Has Icon-->
    <div v-if="icon" class="flex">
        <button
            :disabled="disabled"
            class="btn btn-primary rounded-l-none"
            @click="click"
        >
            <slot/>
        </button>
        <input
            :id="id"
            ref="input"
            :class="classInput"
            :disabled="disabled"
            :value="modelValue"
            class="rounded-r-none"
            type="text"
            @input="$emit('update:modelValue', $event.target.value)"
        >
    </div>
    <!--Hasn't Icon-->
    <input
        v-else
        :id="id"
        ref="input"
        :class="classInput"
        :disabled="disabled"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

<script setup>
// Vue function
import {ref} from "@vue/reactivity";
// Props & Emits
defineProps(["modelValue", "icon", "id", "disabled"]);
defineEmits(["update:modelValue"]);
// Class Input
const classInput = `w-full bg-transparent border-1 focus:border border-primary input input-bordered outline-0 focus:outline-0 focus:border-primary-focus focus:ring-2 focus:ring-primary focus:ring-opacity-50`
// Input ref
const input = ref();

// click function
function click() {
    input.value.click();
}
</script>
