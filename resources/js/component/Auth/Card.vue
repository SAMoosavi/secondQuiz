<template>
    <my-bg-auth />
        <togle class="absolute z-10 top-3 right-3 "/>
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
import MyBgAuth from "@/component/Auth/Bg.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import Togle from "@/component/TogleThem.vue";
</script>
