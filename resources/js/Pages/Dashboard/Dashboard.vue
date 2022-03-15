<template>
    <app-layout title="Dashboard">
        <div
            class="fixed inset-0 right-0 z-20 w-1/5 overflow-y-auto bg-base-200 top-16 text-base-content"
        >
            <quiz-index />

            <div class="sticky top-0">
                آزمون ها شرکت کرده
                <span>sss</span>
            </div>
        </div>
        <div
            class="fixed inset-0 left-0 z-10 w-auto overflow-y-auto bg-neutral top-16"
        >
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-xl sm:rounded-lg"
                ></div>
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import QuizIndex from "@/Pages/Dashboard/Menu/Quiz/Index.vue";
</script>
