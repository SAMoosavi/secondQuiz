<template>
    <div>
        <ol
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 list-decimal"
        >
            <li v-for="(_, key) in options" :key="key" class="mx-3 mt-3">
                <div class="flex items-center gap-1">
                    <my-label :for="`${key}-question-${index}`" :required="true"/>
                    <my-radio v-model="ans.num" :name="index" :value="key" :required="true"/>
                    <my-input :id="`${key}-question-${index}`" v-model.lazy="options[key]" :required="true"/>
                </div>
            </li>
        </ol>
    </div>
</template>

<script setup>
import MyLabel from "@/component/Form/Label.vue";
import MyInput from "@/component/Form/Input.vue";
import MyRadio from "@/component/Form/Radio.vue";

import {reactive} from "@vue/reactivity";
import {watch} from "@vue/runtime-core";

defineProps(['index'])
const emits = defineEmits(['option', 'answer'])
const options = reactive({
    ans1: null,
    ans2: null,
    ans3: null,
    ans4: null,
});
const ans = reactive({
    num: null,
    ans: null,
});

for (const key in options) {
    watch(
        () => options[key],
        (val) => {
            emits("option", options);
            if (key === ans.num) {
                ans.ans = val;
            }
        }
    );
}

watch(
    () => ans.ans,
    (val) => {
        emits("answer", val);
    }
);

watch(
    () => ans.num,
    (val) => {
        ans.ans = options[val];
        emits("answer", ans.ans);
    }
);

</script>

