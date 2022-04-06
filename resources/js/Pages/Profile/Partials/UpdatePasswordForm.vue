<template>
    <div class="flex justify-center w-full">
        <form class="w-full md:w-1/2" novalidate @submit.prevent="send">
            <div class="form-control">
                <my-label
                    :required="true"
                    for="current_password"
                    value="رمز عبور فعلی"
                />
                <my-input
                    id="current_password"
                    ref="current_password"
                    v-model="form.current_password"
                    autocomplete="current-password"
                    type="password"
                />
            </div>

            <div class="form-control">
                <my-label
                    :required="true"
                    for="password"
                    value="رمز عبور جدید"
                />
                <my-input
                    id="password"
                    ref="password"
                    v-model="form.password"
                    autocomplete="new-password"
                    type="password"
                />
            </div>

            <div class="form-control">
                <my-label
                    :required="true"
                    for="password_confirmation"
                    value="تکرار رمز عبور جدید"
                />
                <my-input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                    type="password"
                />
            </div>
            <div class="mt-2 form-control">
                <my-button :disabled="form.processing" :loding="loding">
                    ذخیره
                </my-button>
            </div>
        </form>
    </div>
</template>

<script setup>
import MyButton from "@/component/Form/Button.vue";
import MyInput from "@/component/Form/Input.vue";
import MyLabel from "@/component/Form/Label.vue";

import {password as validationsPassword, passwordConfirmation,} from "@/functions/validations";

import {useForm} from "@inertiajs/inertia-vue3";
import {ref} from "@vue/reactivity";
import {errorMessage, successMessage} from "@/functions/Message";

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
            onSuccess: () => {
                form.reset()
                successMessage('رمز با موفقیت ویرایش شد')
            },
            onError: errors => {
                for (const error of errors) {
                    errorMessage(error);
                }
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
