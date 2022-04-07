<template>
    <Head title="ورود"/>

    <my-auth-card>

        <template #title>ورود</template>

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
                    autocomplete="current-password"
                    required
                    type="password"
                />
            </div>

            <div class="block mt-4 form-control">
                <my-checkbox
                    v-model="form.remember"
                    txt="من را به خاطر بسپار"
                />
            </div>
            <div class="flex-col items-start justify-end card-actions">
                <div
                    class="flex-row items-center justify-end mt-4 mr-auto form-control"
                >
                    <my-auth-link :href="route('register')">
                        ساخت حساب جدید
                    </my-auth-link>
                    <my-button
                        :disabled="form.processing"
                        :loading="loading"
                        class="mr-4"
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
    </my-auth-card>
</template>

<script setup>
import MyAuthCard from "@/component/Auth/Card.vue";
import MyAuthLink from "@/component/Auth/Link.vue";
import MyCheckbox from "@/component/Form/Checkbox.vue";
import MyButton from "@/component/Form/Button.vue";
import MyLabel from "@/component/Form/Label.vue";
import MyInput from "@/component/Form/Input.vue";

import {validEmail} from "@/functions/validations";
import {Head, useForm} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import {errorMessage, successMessage} from "@/functions/Message";
import {emailMessage, requiredMessage} from "@/Consts/Message";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const loading = ref(false);

function submit() {
    loading.value = true;
    if (!form.email || !form.password) {
        errorMessage(requiredMessage)
    } else if (!validEmail(form.email)) {
        errorMessage(emailMessage)
    } else {
        form.transform((data) => ({
            ...data,
            remember: form.remember ? "on" : "",
        })).post(route("login"), {
            onSuccess: () => successMessage('با موفقیت وارد شدید'),
            onError: errors => {
                for (const error of errors) {
                    errorMessage(error);
                }
            },
            onFinish: () => form.reset("password"),
        });
    }
    setTimeout(() => {
        loading.value = false;
    }, 200);
}
</script>
