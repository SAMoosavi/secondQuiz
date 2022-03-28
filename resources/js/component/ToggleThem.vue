<template>
    <my-select v-model="them">
        <my-option
            v-for="(them, val) in themes"
            :key="val"
            :value="val"
            :selected="val === them"
        >
            {{ them }}
        </my-option>
    </my-select>
</template>

<script setup>
import MySelect from "@/component/Form/Select.vue";
import MyOption from "@/component/Form/Option.vue";

import { ref } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";

const body = document.querySelector("body");

const them = ref("light");

const themes = {
    light: "حالت روز",
    dark: "حالت شب",
};

if (localStorage.them) {
    if (!themes[localStorage.them]) {
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
