<template>
    <div
        class="absolute w-screen h-screen overflow-hidden bg-scroll bg-gradient-to-br from-base-100 to-base-300 via-base-200 -z-10"
    >
        <div class="invisible sm:visible">
            <my-polygon class="absolute -top-40 -left-96" />
            <my-polygon class="absolute -bottom-40 -right-96" />
        </div>
        <div class="visible sm:invisible">
            <my-polygon class="absolute w-screen h-screen top-1/2 right-1/2" />
            <my-polygon
                class="absolute w-screen h-screen bottom-1/2 left-1/2"
            />
        </div>
    </div>
</template>

<script setup>
import MyPolygon from "@/component/Auth/Polygon.vue";
</script>
