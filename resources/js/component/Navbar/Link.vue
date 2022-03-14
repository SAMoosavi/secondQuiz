<template>
    <Link
        :href="href"
        class="hidden btn sm:inline-flex"
        :class="{ 'btn-primary btn-disabled': active }"
    >
        <slot />
    </Link>
    <Link
        :href="href"
        class="block p-2 sm:hidden"
        :class="{ 'bg-primary-focus border-l-8 border-primary ': active }"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps(["href", "active"]);
</script>
