<template>
    <div @click="onClick">
        <sub-title :show="show">
            ساخت آزمون جدید
            <template #icon>
                <plus/>
            </template>
        </sub-title>
    </div>
</template>

<script setup>
// Dashboard component
import SubTitle from "@/component/Dashboard/SubTitle.vue";
// Icons
import Plus from "@/component/Icons/Plus.vue";
// Inertia functions
import {Inertia} from "@inertiajs/inertia";
// Props & Emits
defineProps(["show"]);
const emit = defineEmits(["showThis"]);

function onClick() {
    emit('showThis', -1);
    if (!route().current('create.quiz')) {
        setTimeout(() => Inertia.get(route('create.quiz')), 500)
    }
}
</script>
