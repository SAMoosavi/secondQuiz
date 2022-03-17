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
import SubTitle from "@/component/Dashboard/SubTitle.vue";

import Plus from "@/component/Icons/Plus.vue";

defineProps(["show"]);
defineEmits(["showThis"]);
</script>
