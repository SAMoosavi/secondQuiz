<template>
    <Link
        :method="method"
        :href="href"
        class="link opacity-50 hover:opacity-100 underline-offset-4 decoration-dashed hover:decoration-solid focus:decoration-solid transition-all duration-300 focus:outline-0"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    href: String,
    method: {
        method: String,
        default: "get",
    },
});
</script>

<style></style>
