<template>
    <div>
        <ol
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 list-decimal"
        >
            <li v-for="(_, key) in options" :key="key" class="mx-3 mt-3">
                <div class="flex items-center gap-1">
                    <my-label :for="`${key}-question-${index}`" :required="true"/>
                    <my-radio v-model="ans.num" :checked="ans.num === key" :name="index" :required="true" :value="key"/>
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
import {onMounted} from "vue";

const props = defineProps(['index', 'answer', 'option'])
const emits = defineEmits(['option', 'answer'])

let options = reactive({
    ans1: null,
    ans2: null,
    ans3: null,
    ans4: null,
});
const ans = reactive({
    num: 'ans',
    ans: props.answer,
});
onMounted(() => {
    let option = JSON.parse(props.option);
    if (props.option) {
        for (const key in options) {
            options[key] = option[key];
            if (ans.ans === options[key]) {
                ans.num = key;
            }
        }
    }
})
for (const key in options) {
    watch(
        () => options[key],
        (val) => {
            emits("option", JSON.stringify(options));
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

