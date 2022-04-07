<template>
    <Head title="فراموشی رمز عبور"/>

    <my-auth-card>
        <template #title>فراموشی رمز عبور</template>

        <my-auth-text>
            رمز عبور خود را فراموش کرده اید؟ مشکلی نیست فقط آدرس ایمیل خود را به
            ما بگویید تا ما یک پیوند بازنشانی رمز عبور را برای شما ایمیل می کنیم
            که به شما امکان می دهد رمز جدیدی را انتخاب کنید.
        </my-auth-text>

        <form novalidate @submit.prevent="submit">
            <div class="form-control">
                <my-label :required="true" for="email" value="ایمیل"/>
                <my-input
                    id="email"
                    v-model="form.email"
                    :required="true"
                    autocomplete="email"
                    autofocus
                    type="email"
                />
            </div>
            <div class="items-end justify-end mt-4 mr-auto form-control">
                <my-button :disabled="form.processing" :loading="loading">
                    ارسال ایمیل
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

import {validEmail} from "@/functions/validations";
import {Head, useForm} from "@inertiajs/inertia-vue3";
import {ref} from "@vue/reactivity";
import {errorMessage, successMessage} from "@/functions/Message";
import {requiredMessage} from "@/Consts/Message";

const form = useForm({
    email: "",
});

const loading = ref(false);

function submit() {
    loading.value = true;
    if (!form.email) {
        errorMessage(requiredMessage);
    } else if (!validEmail(form.email)) {
        errorMessage()
    } else {
        form.post(route("password.email"), {
            onSuccess: () => successMessage('ایمیل با موفقیت ارسال شد'),
            onError: errors => {
                for (const error of errors) {
                    errorMessage(error);
                }
            },
        });
    }
    setTimeout(() => {
        loading.value = false;
    }, 200);
}
</script>
