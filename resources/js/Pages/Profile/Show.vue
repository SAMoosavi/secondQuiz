<template>
    <app-layout title="پزوفایل">
        <div>
            <div
                class="py-10 mx-auto overflow-hidden max-w-7xl sm:px-6 lg:px-8"
            >
                <div class="justify-center mb-4 bg-transparent tabs tabs-boxed">
                    <button
                        class="tab"
                        :class="{
                            'tab-active':
                                isComponent ==
                                'update-profile-information-form',
                        }"
                        @click="chengTab('update-profile-information-form')"
                    >
                        مشخصات
                    </button>
                    <button
                        class="tab"
                        :class="{
                            'tab-active': isComponent == 'update-password-form',
                        }"
                        @click="chengTab('update-password-form')"
                    >
                        تغییر رمز عبور
                    </button>
                </div>
                <transition
                    enter-active-class="transition duration-700"
                    enter-from-class="transform opacity-0 -translate-x-96"
                    enter-to-class="transform translate-x-0 opacity-100"
                    leave-active-class="transition duration-700"
                    leave-from-class="transform translate-x-0 opacity-100"
                    leave-to-class="transform opacity-0 translate-x-96"
                    mode="out-in"
                >
                    <component
                        :is="comp[isComponent]"
                        :user="$page.props.user"
                        :key="isComponent"
                    />
                </transition>
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import { ref } from "@vue/reactivity";

const isComponent = ref("update-password-form");
const comp = {
    "update-password-form": UpdatePasswordForm,
    "update-profile-information-form": UpdateProfileInformationForm,
};
function chengTab(tab) {
    isComponent.value = tab;
}
</script>
