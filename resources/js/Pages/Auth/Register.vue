<template>
    <Head title="ثبت نام"/>

    <my-auth-card>
        <template #title>ثبت نام</template>

        <form novalidate @submit.prevent="submit">
            <div class="form-control">
                <my-label :required="true" for="name" value="نام"/>
                <my-input
                    id="name"
                    v-model="form.name"
                    autocomplete="name"
                    autofocus
                    required
                    type="text"
                />
            </div>

            <div class="mt-4 form-control">
                <my-label :required="true" for="email" value="ایمیل"/>
                <my-input
                    id="email"
                    v-model="form.email"
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
            <div class="flex-col items-start justify-end">
                <div class="flex items-center justify-end mt-4">
                    <my-auth-link :href="route('login')">
                        قبلا ثبت کرده اید؟
                    </my-auth-link>

                    <my-button
                        :disabled="form.processing"
                        :loading="loading"
                        class="mr-4"
                    >
                        ثبت نام
                    </my-button>
                </div>
            </div>
        </form>
    </my-auth-card>
</template>

<script setup>
import MyAuthCard from "@/component/Auth/Card.vue";
import MyAuthLink from "@/component/Auth/Link.vue";
import MyButton from "@/component/Form/Button.vue";
import MyInput from "@/component/Form/Input.vue";
import MyLabel from "@/component/Form/Label.vue";

import {
    validEmail,
    passwordConfirmation,
    password, password as validationsPassword,
} from "@/functions/validations";
import {Head, useForm} from "@inertiajs/inertia-vue3";
import {ref} from "@vue/reactivity";
import {errorMessage, successMessage} from "@/functions/Message";
import {confirmPasswordMessage, emailMessage, requiredMessage} from "@/Consts/Message";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});
const loading = ref(false);

function submit() {
    loading.value = true;
    if (
        !form.email ||
        !form.password ||
        !form.name ||
        !form.password ||
        !form.password_confirmation
    ) {
        errorMessage(requiredMessage)
    } else if (!validEmail(form.email)) {
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
        form.post(route("register"), {
            onSuccess: () => successMessage('با موفقیت ثبت نام شدید'),
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
