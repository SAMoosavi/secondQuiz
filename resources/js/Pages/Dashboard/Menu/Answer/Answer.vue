<template>
    <p
        class="flex items-center justify-between px-4 py-2 transition-all duration-500"
        :class="{ 'bg-primary': show }"
        @click="$emit('showThis', show ? -2 : index)"
    >
        {{ answer.name }}
        <span>
            <cheng-icone>
                <chevron-left v-if="show" />
                <chevron-right v-else />
            </cheng-icone>
        </span>
    </p>
</template>

<script setup>
import ChengIcone from "@/component/Dashboard/ChengIcone.vue";

// import ChevronLeft from "@/component/Icons/ChevronLeft.vue";
// import ChevronRight from "@/component/Icons/ChevronRight.vue";

import { ref } from "@vue/reactivity";

defineProps(["answer", "show", "index"]);
defineEmits(["showThis"]);
</script>
