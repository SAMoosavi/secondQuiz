<template>
    <div>
        <Head :title="title"/>

        <div class="min-h-screen bg-gradient-to-br from-base-100 to-base-300">
            <nav class="sticky top-0 flex flex-col items-center justify-center bg-neutral">
                <!-- sm and over -->
                <div
                    class="hidden h-16 sm:justify-between max-w-screen-2xl sm:navbar"
                >
                    <!-- NavLink -->
                    <div class="flex gap-2 text-base-100">
                        <my-nav-link
                            :active="!route().current('profile.show')"
                            :href="route('dashboard')"
                        >
                            داشبورد
                        </my-nav-link>
                        <my-nav-link
                            :active="route().current('profile.show')"
                            :href="route('profile.show')"
                        >
                            پروفایل
                        </my-nav-link>
                    </div>
                    <!-- Logo -->
                    <div class="flex items-center gap-2 shrink-0">
                        <Link :href="route('dashboard')">
                            <my-application-mark
                                class="block w-auto h-9 text-neutral-content"
                            />
                        </Link>
                        <toggle-them/>
                    </div>

                    <!-- User -->
                    <div class="flex gap-4 text-base-100">
                        <div class="flex flex-col">
                            <p>
                                {{ $page.props.user.name }}
                            </p>
                            <p class="opacity-50">
                                {{ $page.props.user.email }}
                            </p>
                        </div>
                        <img
                            :alt="$page.props.user.name"
                            :src="$page.props.user.profile_photo_url"
                            class="object-cover w-8 h-8 rounded-full"
                        />
                        <form @submit.prevent="logout">
                            <button class="flex gap-3" type="submit">
                                خروج
                                <span class="rotate-180">
                                    <svg
                                        class="w-6 h-6 stroke-current stroke-2"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        /></svg
                                    ></span>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- base -->
                <div
                    class="grid items-center w-full h-16 grid-cols-3 sm:hidden"
                >
                    <!-- Logo -->

                    <div class="flex col-start-2 justify-self-center">
                        <Link :href="route('dashboard')">
                            <my-application-mark
                                class="block w-auto h-9 text-neutral-content"
                            />
                        </Link>
                    </div>

                    <!-- Hamburger -->
                    <div class="flex items-center mr-auto sm:hidden">
                        <button
                            class="ml-2 btn btn-primary btn-outline"
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                        >
                            <svg
                                class="w-6 h-6 stroke-current stroke-2"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <transition
                                    enter-active-class="transition duration-100 origin-center"
                                    enter-from-class="transform -rotate-90"
                                    enter-to-class="transform rotate-0"
                                    leave-active-class="transition duration-100 origin-center"
                                    leave-from-class="transform rotate-0"
                                    leave-to-class="transform rotate-90"
                                    mode="out-in"
                                >
                                    <path
                                        v-if="showingNavigationDropdown"
                                        key="close"
                                        d="M6 18L18 6M6 6l12 12"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                    <path
                                        v-else
                                        key="open"
                                        d="M4 6h16M4 12h16M4 18h16"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </transition>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Responsive Navigation Menu -->
                <div
                    v-if="showingNavigationDropdown"
                    class="items-center w-full border-t border-primary sm:hidden"
                >
                    <!-- profile and logOut -->
                    <div class="flex justify-between px-2 text-base-100">
                        <!-- Profile -->
                        <div class="flex items-center gap-2">
                            <img
                                :alt="$page.props.user.name"
                                :src="$page.props.user.profile_photo_url"
                                class="object-cover w-8 h-8 rounded-full"
                            />
                            <div class="flex flex-col">
                                <p>
                                    {{ $page.props.user.name }}
                                </p>
                                <p class="opacity-50">
                                    {{ $page.props.user.email }}
                                </p>
                            </div>
                        </div>
                        <!-- LogOut -->
                        <form
                            class="flex items-center"
                            @submit.prevent="logout"
                        >
                            <button class="flex gap-3" type="submit">
                                خروج
                                <span class="rotate-180">
                                    <svg
                                        class="w-6 h-6 stroke-current stroke-2"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        /></svg
                                    ></span>
                            </button>
                        </form>
                    </div>

                    <!-- NavLink -->
                    <div class="flex flex-col text-base-100">
                        <my-nav-link
                            :active="route().current('dashboard')"
                            :href="route('dashboard')"
                        >
                            داشبورد
                        </my-nav-link>
                        <my-nav-link
                            :active="route().current('profile.show')"
                            :href="route('profile.show')"
                        >
                            پروفایل
                        </my-nav-link>
                    </div>
                    <toggle-them class="w-full"/>
                </div>
            </nav>
            <!-- Page Content -->
            <main>

                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script setup>
import MyNavLink from "@/component/Navbar/Link.vue";
import ToggleThem from "@/component/ToggleThem.vue";
import MyApplicationMark from "@/component/Logo/ApplicationMark.vue"

import {Head, Link, useForm} from "@inertiajs/inertia-vue3";

import {ref} from "@vue/reactivity";

defineProps(["title"]);

const showingNavigationDropdown = ref(false);

function logout() {
    useForm({}).post(route("logout"));
}
</script>
