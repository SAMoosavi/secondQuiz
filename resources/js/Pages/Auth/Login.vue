<template>
    <Head title="ورود" />

    <my-auth-card>

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
            <div class="flex-col items-start justify-end card-actions">
                <div
                    class="flex-row items-center justify-end mt-4 mr-auto form-control"
                >
                    <my-auth-link :href="route('register')">
                        ساخت حساب جدید
                    </my-auth-link>
                    <my-button
                        class="mr-4"
                        :loading="loading"
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
    </my-auth-card>
</template>

<script setup>
import MyAuthCard from "@/component/Auth/Card.vue";
import MyAuthLink from "@/component/Auth/Link.vue";
import MyCheckbox from "@/component/Form/Checkbox.vue";
import MyButton from "@/component/Form/Button.vue";
import MyLabel from "@/component/Form/Label.vue";
import MyInput from "@/component/Form/Input.vue";

import { validEmail } from "@/functions/validations";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const loading = ref(false);

function submit() {
    loading.value = true;
    if (!form.email || !form.password) {
        //
    } else if (form.email && !validEmail(form.email)) {
        //
    } else {
        form.transform((data) => ({
            ...data,
            remember: form.remember ? "on" : "",
        })).post(route("login"), {
            onFinish: () => form.reset("password"),
        });
    }
    setTimeout(() => {
        loading.value = false;
    }, 200);
}
</script>
