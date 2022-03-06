<template>
    <Head title="ثبت نام" />

    <my-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>
        <template #title>ثبت نام</template>

        <form @submit.prevent="submit" novalidate>
            <div class="form-control">
                <my-label for="name" value="نام" :required="true" />
                <my-input
                    id="name"
                    type="text"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
            </div>

            <div class="mt-4 form-control">
                <my-label for="email" value="ایمیل" :required="true" />
                <my-input
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                />
            </div>

            <div class="mt-4 form-control">
                <my-label for="password" value="رمز ورود" :required="true" />
                <my-input
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div class="mt-4 form-control">
                <my-label
                    for="password_confirmation"
                    value="تایید رمز عبور"
                    :required="true"
                />
                <my-input
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
            </div>
            <div class="flex-col items-start justify-end">
                <div class="flex items-center justify-end mt-4">
                    <my-auth-link :href="route('login')">
                        قبلا ثبت کرده اید؟
                    </my-auth-link>

                    <my-button
                        class="mr-4"
                        :loding="loding"
                        :disabled="form.processing"
                    >
                        ثبت نام
                    </my-button>
                </div>
            </div>
        </form>
    </my-authentication-card>
</template>

<script setup>
import MyAuthenticationCard from "@/component/AuthenticationCard.vue";
import MyAuthLink from "@/component/AuthLink.vue";
import MyButton from "@/component/Button.vue";
import MyInput from "@/component/Input.vue";
import MyLabel from "@/component/Label.vue";

import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";

import {
    validEmail,
    passwordConfirmation,
    password,
} from "@/functions/validations";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});
const loding = ref(false);

function submit() {
    loding.value = true;
    if (
        !form.email ||
        !form.password ||
        !form.name ||
        !form.password ||
        !form.password_confirmation
    ) {
        //
    } else if (form.email && !validEmail(form.email)) {
        //
    } else if (
        !passwordConfirmation(form.password, form.password_confirmation)
    ) {
        //
    } else if (!password(form.password)) {
        //password(form.password) return errors
    } else {
        form.post(route("register"), {
            onFinish: () => form.reset("password", "password_confirmation"),
        });
    }
    setTimeout(() => {
        loding.value = false;
    }, 200);
}
</script>
