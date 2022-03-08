<template>
    <Head title="منطقه امن" />
    <my-authentication-card>
        <template #title>منطقه امن</template>
        <div class="mb-4 text-sm text-justify text-primary-content">
            این یک منطقه امن برنامه است. لطفاً قبل از ادامه رمز عبور خود را
            تأیید کنید.
        </div>

        <form @submit.prevent="submit" novalidate>
            <div class="form-control">
                <my-label for="password" value="رمز عبور" :required="true" />
                <my-input
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
            </div>

            <div class="items-end justify-end mt-4 mr-auto form-control">
                <my-button :loding="loding" :disabled="form.processing">
                    تایید
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

import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

const form = useForm({
    password: "",
});

const loding = ref(false);

function submit() {
    loding.value = true;
    if (!form.password) {
        //
    } else {
        form.post(route("password.confirml"), {
            onFinish: () => form.reset(),
        });
    }
    setTimeout(() => {
        loding.value = false;
    }, 200);
}
</script>
