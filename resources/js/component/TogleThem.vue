<template>
    <select
        v-model="them"
        class="select select-primary bg-transparent focus:select-primary text-primary ring-0 outline-0 focus:ring-0 focus:outline-0"
    >
        <option v-for="(txt, val) in thems" :key="val" :value="val">
            {{ txt }}
        </option>
    </select>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";

const body = document.querySelector("body");

const them = ref("light");

const thems = {
    light: "حالت روز",
    dark: "حالت شب",
};

if (localStorage.them) {
    if (!thems[localStorage.them]) {
        localStorage.setItem("them", "light");
    }
    body.setAttribute("data-theme", localStorage.them);
    them.value = localStorage.them;
} else {
    localStorage.setItem("them", "light");
}

watch(them, (val) => {
    localStorage.setItem("them", val);
    body.setAttribute("data-theme", val);
});
</script>
