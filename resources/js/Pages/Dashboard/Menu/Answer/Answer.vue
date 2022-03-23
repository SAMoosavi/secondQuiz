<template>
    <div @click="$emit('showThis', show ? -2 : index)">
        <sub-title :show="show">
            {{ answer.name }}
            <template #iconShow>
                <chevron-right />
            </template>
            <template #iconNotShow>
                <chevron-left />
            </template>
        </sub-title>
    </div>
</template>

<script setup>
// Dashboard component
import SubTitle from "@/component/Dashboard/SubTitle.vue";
// Icons
import ChevronLeft from "@/component/Icons/ChevronLeft.vue";
import ChevronRight from "@/component/Icons/ChevronRight.vue";
// Props & Emits
defineProps(["answer", "show", "index"]);
defineEmits(["showThis"]);
</script>
