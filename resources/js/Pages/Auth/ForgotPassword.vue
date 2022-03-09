<template>
    <Head title="فراموشی رمز عبور" />

    <my-auth-card>
        <template #title>فراموشی رمز عبور</template>

        <my-auth-text>
            رمز عبور خود را فراموش کرده اید؟ مشکلی نیست فقط آدرس ایمیل خود را به
            ما بگویید تا ما یک پیوند بازنشانی رمز عبور را برای شما ایمیل می کنیم
            که به شما امکان می دهد رمز جدیدی را انتخاب کنید.
        </my-auth-text>

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
            <div class="items-end justify-end mt-4 mr-auto form-control">
                <my-button :loding="loding" :disabled="form.processing">
                    ارسال ایمیل
                </my-button>
            </div>
        </form>
    </my-auth-card>
</template>

<script setup>
import MyAuthCard from "@/component/Auth/Card.vue";
import MyAuthText from "@/component/Auth/Text.vue";
import MyButton from "@/component/Button.vue";
import MyLabel from "@/component/Label.vue";
import MyInput from "@/component/Input.vue";

import { validEmail } from "@/functions/validations";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

const form = useForm({
    email: "",
});

const loding = ref(false);

function submit() {
    loding.value = true;
    if (!form.email || !validEmail(form.email)) {
        //
    } else {
        form.post(route("password.email"));
    }
    setTimeout(() => {
        loding.value = false;
    }, 200);
}
</script>
