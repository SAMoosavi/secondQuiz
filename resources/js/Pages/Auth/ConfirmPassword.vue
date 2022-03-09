<template>
    <Head title="منطقه امن" />
    <my-auth-card>
        <template #title>منطقه امن</template>
        <my-auth-text>
            این یک منطقه امن برنامه است. لطفاً قبل از ادامه رمز عبور خود را
            تأیید کنید.
        </my-auth-text>

        <form @submit.prevent="submit" novalidate>
            <div class="form-control">
                <my-label for="password" value="رمز عبور" :required="true" />
                <my-input
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
            </div>

            <div class="items-end justify-end mt-4 mr-auto form-control">
                <my-button :loding="loding" :disabled="form.processing">
                    تایید
                </my-button>
            </div>
        </form>
    </my-auth-card>
</template>

<script setup>
import MyAuthCard from "@/component/Auth/Card.vue";
import MyAuthText from "@/component/Auth/Text.vue";
import MyButton from "@/component/Form/Button.vue";
import MyLabel from "@/component/Form/Label.vue";
import MyInput from "@/component/Form/Input.vue";

import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

const form = useForm({
    password: "",
});

const loding = ref(false);

function submit() {
    loding.value = true;
    if (!form.password) {
        //
    } else {
        form.post(route("password.confirml"), {
            onFinish: () => form.reset(),
        });
    }
    setTimeout(() => {
        loding.value = false;
    }, 200);
}
</script>
