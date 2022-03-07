<template>
    <bg-auth />
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-transparent"
    >
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md card bg-base-300 m-4">
            <div class="card-body">
                <h2
                    class="card-title text-center text-primary-focus self-center"
                >
                    <slot name="title" />
                </h2>

                <slot />
            </div>
        </div>
    </div>
</template>
<script setup>
import BgAuth from "@/component/BgAuth.vue";
</script>
