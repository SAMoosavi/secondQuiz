<template>
    <div class="sticky top-0 bg-base-100">
        <p
            class="flex justify-between items-center px-4 py-2"
            @click="$emit('cheng', show)"
        >
            <slot />
            <span>
                <cheng-icone>
                    <chevron-up v-if="show" />
                    <chevron-down v-else />
                </cheng-icone>
            </span>
        </p>
    </div>
</template>

<script setup>
import ChevronUp from "@/component/Icons/ChevronUp.vue";
import ChevronDown from "@/component/Icons/ChevronDown.vue";

import ChengIcone from "@/component/Dashboard/ChengIcone.vue";

defineProps(["show"]);
defineEmits(["cheng"]);
</script>

<style></style>
