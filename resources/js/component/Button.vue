<template>
    <button
        :type="type"
        class="btn btn-primary transition-all duration-200 btn-sm"
        :class="{ 'loading flex-row-reverse': loding }"
    >
        <slot></slot>
    </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
    loding: {
        type: Boolean,
        default: false,
    },
});
</script>
