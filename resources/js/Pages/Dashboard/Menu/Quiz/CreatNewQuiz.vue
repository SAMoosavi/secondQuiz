<template>
    <div @click="$emit('showThis', -1)">
        <sub-title :show="show">
            ساخت آزمون جدید
            <template #icon>
                <plus />
            </template>
        </sub-title>
    </div>
</template>

<script setup>
// Dashboard component
import SubTitle from "@/component/Dashboard/SubTitle.vue";
// Icons
import Plus from "@/component/Icons/Plus.vue";
// Props & Emits
defineProps(["show"]);
defineEmits(["showThis"]);
</script>
