<template>
    <!--Has Icon-->
    <div v-if="icon" class="flex">
        <button
            :disabled="disabled"
            class="rounded-l-none btn btn-primary"
            @click="click"
        >
            <slot />
        </button>
        <input
            :id="id"
            ref="input"
            :class="classInput"
            :disabled="disabled"
            :required="required"
            :value="modelValue"
            class="rounded-r-none"
            :type="type"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </div>
    <!--Hasn't Icon-->
    <input
        v-else
        :id="id"
        ref="input"
        :class="classInput"
        :type="type"
        :disabled="disabled"
        :required="required"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

<script setup>
// Vue function
import { ref } from "@vue/reactivity";
// Props & Emits
defineProps(["modelValue", "icon", "id", "disabled", "required", "type"]);
defineEmits(["update:modelValue"]);
// Class Input
const classInput = `w-full bg-transparent border-1 focus:border border-primary input input-bordered outline-0 focus:outline-0 focus:border-primary-focus focus:ring-2 focus:ring-primary focus:ring-opacity-50`;
// Input ref
const input = ref();

// click function
function click() {
    input.value.click();
}
</script>
