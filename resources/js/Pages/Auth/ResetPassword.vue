<template>
    <Head title="بازیابی رمز عبور" />

    <my-authentication-card>
        <template #title>بازیابی رمز عبور</template>

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

            <div class="items-end justify-end mt-4 mr-auto form-control">
                <my-button :loding="loding" :disabled="form.processing">
                    بازیابی رمز عبور
                </my-button>
            </div>
        </form>
    </my-authentication-card>
</template>

<script setup>
import MyAuthenticationCard from "@/component/AuthenticationCard.vue";
import MyButton from "@/component/Button.vue";
import MyLabel from "@/component/Label.vue";
import MyInput from "@/component/Input.vue";

import { validEmail, passwordConfirmation } from "@/functions/validations";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

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

const loding = ref(false);

function submit() {
    loding.value = true;
    if (!form.email || !form.password || !form.password_confirmation) {
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
        form.post(route("password.update"), {
            onFinish: () => form.reset("password", "password_confirmation"),
        });
    }
    setTimeout(() => {
        loding.value = false;
    }, 200);
}
</script>
