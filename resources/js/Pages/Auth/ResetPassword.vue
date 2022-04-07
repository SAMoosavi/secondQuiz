<template>
    <Head title="بازیابی رمز عبور"/>

    <my-auth-card>
        <template #title>بازیابی رمز عبور</template>

        <form novalidate @submit.prevent="submit">
            <div class="form-control">
                <my-label :required="true" for="email" value="ایمیل"/>
                <my-input
                    id="email"
                    v-model="form.email"
                    autocomplete="email"
                    autofocus
                    required
                    type="email"
                />
            </div>

            <div class="mt-4 form-control">
                <my-label :required="true" for="password" value="رمز ورود"/>
                <my-input
                    id="password"
                    v-model="form.password"
                    autocomplete="new-password"
                    required
                    type="password"
                />
            </div>

            <div class="mt-4 form-control">
                <my-label
                    :required="true"
                    for="password_confirmation"
                    value="تایید رمز عبور"
                />
                <my-input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                    required
                    type="password"
                />
            </div>

            <div class="items-end justify-end mt-4 mr-auto form-control">
                <my-button :disabled="form.processing" :loading="loading">
                    بازیابی رمز عبور
                </my-button>
            </div>
        </form>
    </my-auth-card>
</template>

<script setup>
import MyAuthCard from "@/component/Auth/Card.vue";
import MyButton from "@/component/Form/Button.vue";
import MyLabel from "@/component/Form/Label.vue";
import MyInput from "@/component/Form/Input.vue";

import {validEmail, passwordConfirmation, password, password as validationsPassword} from "@/functions/validations";
import {Head, useForm} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import {errorMessage, successMessage} from "@/functions/Message";
import {confirmPasswordMessage, emailMessage, requiredMessage} from "@/Consts/Message";

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const loading = ref(false);

function submit() {
    loading.value = true;
    if (!form.email || !form.password || !form.password_confirmation) {
        errorMessage(requiredMessage)
    } else if ( !validEmail(form.email)) {
        errorMessage(emailMessage)
    } else if (
        !passwordConfirmation(form.password, form.password_confirmation)
    ) {
        errorMessage(confirmPasswordMessage)
    } else if (!password(form.password)) {
        const errors = validationsPassword(form.password)
        for (const key in errors) {
            errorMessage(errors[key])
        }
    } else {
        form.post(route("password.update"), {
            onSuccess: () => successMessage('رمز با موفقیت تغییر کرد'),
            onError: errors => {
                for (const error of errors) {
                    errorMessage(error);
                }
            },
            onFinish: () => form.reset("password", "password_confirmation"),
        });
    }
    setTimeout(() => {
        loading.value = false;
    }, 200);
}
</script>
