<template>
    <bg-auth />
    <div
        class="flex flex-col items-center justify-center min-h-screen bg-transparent"
    >
        <div>
            <jet-authentication-card-logo />
        </div>

        <div class="w-full m-4 sm:max-w-md card bg-base-300">
            <div class="card-body">
                <h2
                    class="self-center text-center card-title text-primary-focus"
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
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
</script>
