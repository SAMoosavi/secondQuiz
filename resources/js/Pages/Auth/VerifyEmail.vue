<template>
    <Head title="تایید ایمیل" />

    <my-auth-card>
        <template #title>تایید ایمیل</template>

        <my-auth-text>
            از ثبت نام شما سپاسگزاریم! قبل از شروع، آیا می توانید آدرس ایمیل خود
            را با کلیک بر روی پیوندی که به تازگی برای شما ایمیل کرده ایم تأیید
            کنید؟ اگر ایمیلی را دریافت نکردید، با کمال میل یک ایمیل دیگر برای
            شما ارسال خواهیم کرد.
        </my-auth-text>

        <form @submit.prevent="submit" novalidate>
            <div class="flex-col items-start justify-end">
                <div class="flex items-center justify-end mt-4">
                    <my-button
                        class="mr-4"
                        :loding="loding"
                        :disabled="form.processing"
                    >
                        ایمیل تایید را دوباره بفرست
                    </my-button>

                    <my-auth-link
                        :href="route('logout')"
                        :method="'post'"
                        as="button"
                    >
                        خروج
                    </my-auth-link>
                </div>
            </div>
        </form>
    </my-auth-card>
</template>

<script setup>
import MyAuthCard from "@/component/Auth/Card.vue";
import MyAuthLink from "@/component/Auth/Link.vue";
import MyAuthText from "@/component/Auth/Text.vue";
import MyButton from "@/component/Form/Button.vue";

import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

const form = useForm();

const loding = ref(false);

function submit() {
    loding.value = true;
    form.post(route("verification.send"));
    setTimeout(() => {
        loding.value = false;
    }, 200);
}
</script>
