<template>
    <div v-if="route().current('create.quiz')" @click="$emit('showThis', -1)">
        <sub-title :show="show">
            ساخت آزمون جدید
            <template #icon>
                <plus/>
            </template>
        </sub-title>
    </div>

    <Link v-else :href="route('create.quiz')" @click="$emit('showThis', -1)">
        <sub-title :show="show">
            ساخت آزمون جدید
            <template #icon>
                <plus/>
            </template>
        </sub-title>
    </Link>
</template>

<script setup>
// Dashboard component
import SubTitle from "@/component/Dashboard/SubTitle.vue";
// Icons
import Plus from "@/component/Icons/Plus.vue";
// Inertia functions
import {Link} from "@inertiajs/inertia-vue3";
// Props & Emits
defineProps(["show"]);
defineEmits(["showThis"]);
</script>
