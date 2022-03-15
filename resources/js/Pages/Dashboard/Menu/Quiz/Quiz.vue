<template>
    <p
        class="flex justify-between items-center px-4 py-2"
        :class="{ 'bg-primary': show }"
        @click="$emit('showThis', show ? -1 : index)"
    >
        {{ quiz.name }}
        <span>
            <cheng-icone>
                <chevron-up v-if="show" />
                <chevron-down v-else />
            </cheng-icone>
        </span>
    </p>
    <div v-if="show" class="h-12 bg-primary-focus"></div>
</template>

<script setup>
import ChengIcone from "@/component/Dashboard/ChengIcone.vue";

import ChevronUp from "@/component/Icons/ChevronUp.vue";
import ChevronDown from "@/component/Icons/ChevronDown.vue";

import { ref } from "@vue/reactivity";

defineProps(["quiz", "show", "index"]);
defineEmits(["showThis"]);
</script>
