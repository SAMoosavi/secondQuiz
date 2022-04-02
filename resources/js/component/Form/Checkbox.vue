<template>
    <my-label class="justify-start gap-2">
        <input
            v-model="proxyChecked"
            :required="required"
            :value="value"
            class="checkbox ring-0 focus:ring-0 focus:ring-offset-0 focus:outline-0 checkbox-md checkbox-primary"
            type="checkbox"
        />
        <span class="label-text">{{ txt }}</span>
    </my-label>
</template>

<script setup>
import MyLabel from "@/component/Form/Label.vue";
import {ref, watch} from "@vue/runtime-core";

const emit = defineEmits(["update:modelValue"]);

defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {default: null},
    txt: {type: String},
    required: {
        type: Boolean,
        default: false,
    }
});
const proxyChecked = ref();
watch(proxyChecked, (val) => {
    console.log(val);
    emit("update:modelValue", val);
});
</script>
