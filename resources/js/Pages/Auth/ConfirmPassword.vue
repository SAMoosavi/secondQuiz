<template>
    <Head title="منطقه امن"/>
    <my-auth-card>
        <template #title>منطقه امن</template>
        <my-auth-text>
            این یک منطقه امن برنامه است. لطفاً قبل از ادامه رمز عبور خود را
            تأیید کنید.
        </my-auth-text>

        <form novalidate @submit.prevent="submit">
            <div class="form-control">
                <my-label :required="true" for="password" value="رمز عبور"/>
                <my-input
                    id="password"
                    v-model="form.password"
                    autocomplete="current-password"
                    autofocus
                    required
                    type="password"
                />
            </div>

            <div class="items-end justify-end mt-4 mr-auto form-control">
                <my-button :disabled="form.processing" :loading="loading">
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

import {Head, useForm} from "@inertiajs/inertia-vue3";
import {ref} from "@vue/reactivity";
import {errorMessage, successMessage} from "@/functions/Message";
import {requiredMessage} from "@/Consts/Message";

const form = useForm({
    password: "",
});

const loading = ref(false);

function submit() {
    loading.value = true;
    if (!form.password) {
        errorMessage(requiredMessage)
    } else {
        form.post(route("password.confirm"), {
            onSuccess: () => successMessage('تایید شد'),
            onError: errors => {
                for (const error of errors) {
                    errorMessage(error);
                }
            },
            onFinish: () => form.reset(),
        });
    }
    setTimeout(() => {
        loading.value = false;
    }, 200);
}
</script>
