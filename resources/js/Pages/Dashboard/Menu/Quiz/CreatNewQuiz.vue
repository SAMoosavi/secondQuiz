<template>
    <div @click="$emit('showThis', -2)">
        <p
            class="flex justify-between items-center px-4 py-2"
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
