<template>
    <p
        class="flex items-center justify-between px-4 py-2 transition-all duration-500 cursor-pointer text-primary-content"
        :class="{ 'bg-primary text-neutral': show }"
    >
        <slot />
        <span>
            <cheng-icone>
                <template v-if="show">
                    <slot name="iconShow" />
                </template>
                <template v-else>
                    <slot name="iconNotShow" />
                </template>
            </cheng-icone>
            <slot name="icon" />
        </span>
    </p>
</template>

<script setup>
import ChengIcone from "@/component/Dashboard/ChengIcone.vue";

defineProps(["show"]);
</script>

<style></style>
