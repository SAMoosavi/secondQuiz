<template>
    <div class="flex justify-center w-full">
        <form @submit.prevent="send" class="w-full md:w-1/2" novalidate>
            <div class="form-control">
                <my-label
                    for="current_password"
                    value="رمز عبور فعلی"
                    :required="true"
                />
                <my-input
                    id="current_password"
                    type="password"
                    v-model="form.current_password"
                    ref="current_password"
                    autocomplete="current-password"
                />
            </div>

            <div class="form-control">
                <my-label
                    for="password"
                    value="رمز عبور جدید"
                    :required="true"
                />
                <my-input
                    id="password"
                    type="password"
                    v-model="form.password"
                    ref="password"
                    autocomplete="new-password"
                />
            </div>

            <div class="form-control">
                <my-label
                    for="password_confirmation"
                    value="تکرار رمز عبور جدید"
                    :required="true"
                />
                <my-input
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                />
            </div>
            <div class="mt-2 form-control">
                <my-button :loding="loding" :disabled="form.processing">
                    ذخیره
                </my-button>
            </div>
        </form>
    </div>
</template>

<script setup>
import myButton from "@/component/Form/Button.vue";
import myInput from "@/component/Form/Input.vue";
import myLabel from "@/component/Form/Label.vue";

import {
    passwordConfirmation,
    password as validationsPassword,
} from "@/functions/validations";

import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const password = ref();
const current_password = ref();
const loding = ref(false);
function send() {
    loding.value = true;
    if (
        !form.current_password ||
        !form.password ||
        !form.password_confirmation
    ) {
        //
    } else if (!validationsPassword(form.password)) {
        //password(form.password) return errors
    } else if (
        !passwordConfirmation(form.password, form.password_confirmation)
    ) {
        //
    } else {
        form.put(route("user-password.update"), {
            onSuccess: () => form.reset(),
            onError: () => {
                if (form.errors.password) {
                    form.reset("password", "password_confirmation");
                    password.value.focus();
                }

                if (form.errors.current_password) {
                    form.reset("current_password");
                    current_password.value.focus();
                }
            },
        });
    }
    setTimeout(() => {
        loding.value = false;
    }, 200);
}
</script>
