<template>
    <div @click="$emit('showThis', -1)">
        <p
            class="flex items-center justify-between px-4 py-2 transition-all duration-200 delay-100"
            :class="{ 'bg-primary': show }"
        >
            ساخت آزمون جدید
            <span>
                <plus />
            </span>
        </p>
    </div>
</template>

<script setup>
import Plus from "@/component/Icons/Plus.vue";

defineProps(["show"]);
defineEmits(["showThis"]);
</script>
