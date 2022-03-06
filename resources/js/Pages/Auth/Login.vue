<template>
    <Head title="ورود" />

    <my-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>
        <template #title>ورود</template>

        <form @submit.prevent="submit" novalidate>
            <div class="form-control">
                <my-label for="email" value="ایمیل" :required="true" />
                <my-input
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="email"
                />
            </div>

            <div class="mt-4 form-control">
                <my-label for="password" value="رمز ورود" :required="true" />
                <my-input
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
            </div>

            <div class="block mt-4 form-control">
                <my-checkbox
                    txt="من را به خاطر بسپار"
                    v-model="form.remember"
                />
            </div>
            <div class="card-actions flex-col items-start justify-end">
                <div class="flex items-center justify-end mt-4 mr-auto">
                    <my-auth-link :href="route('register')">
                        ساخت حساب جدید
                    </my-auth-link>
                    <my-button
                        class="mr-4"
                        :loding="loding"
                        :disabled="form.processing"
                    >
                        ورود
                    </my-button>
                </div>
                <div class="form-control">
                    <my-auth-link :href="route('password.request')">
                        فراموشی رمز عبور!
                    </my-auth-link>
                </div>
            </div>
        </form>
    </my-authentication-card>
</template>

<script setup>
import MyAuthenticationCard from "@/component/AuthenticationCard.vue";
import MyAuthLink from "@/component/AuthLink.vue";
import MyLabel from "@/component/Label.vue";
import MyCheckbox from "@/component/Checkbox.vue";
import MyInput from "@/component/Input.vue";
import MyButton from "@/component/Button.vue";

import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

import { ref } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const loding = ref(false);

function validEmail(email) {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
}

function submit() {
    let valid = true;
    loding.value = true;
    if (!form.email || !form.password) {
        valid = false;
    }
    if (form.email && !validEmail(form.email)) {
        valid = false;
    }
    if (valid) {
        form.transform((data) => ({
            ...data,
            remember: form.remember ? "on" : "",
        })).post(route("login"), {
            onFinish: () => form.reset("password"),
        });
    }
    setTimeout(() => {
        loding.value = false;
    }, 200);
}
</script>
