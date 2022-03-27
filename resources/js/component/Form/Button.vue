<template>
    <button
        :class="{ 'loading flex-row-reverse': loading }"
        :type="type"
        class="btn btn-primary transition-all duration-200 btn-sm"
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
    loading: {
        type: Boolean,
        default: false,
    },
});
</script>
