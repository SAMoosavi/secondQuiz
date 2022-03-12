<template>
    <div class="flex justify-center w-full">
        <form @submit.prevent="send" class="w-full md:w-1/2" novalidate>
            <!-- Profile Photo -->
            <div class="form-control">
                <!-- Profile Photo File Input -->
                <input
                    type="file"
                    class="hidden"
                    ref="photo"
                    @change="updatePhotoPreview"
                />

                <my-label for="photo" value="تصویر" />
                <div class="flex items-center justify-between">
                    <!-- Current Profile Photo -->
                    <div class="mt-2 avatar" v-if="!photoPreview">
                        <div class="w-24 overflow-hidden rounded-full">
                            <img
                                :src="user.profile_photo_url"
                                :alt="user.name"
                            />
                        </div>
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2 avatar" v-if="photoPreview">
                        <span
                            class="block h-20 bg-center bg-no-repeat bg-cover rounded-full"
                            :style="
                                'background-image: url(\'' +
                                photoPreview +
                                '\');'
                            "
                        >
                        </span>
                    </div>
                    <div>
                        <my-button
                            class="mt-2 ml-2 btn-secondary"
                            type="button"
                            @click.prevent="selectNewPhoto"
                        >
                            انتخاب تصویر جدید
                        </my-button>

                        <my-button
                            type="button"
                            class="mt-2 btn-secondary"
                            @click.prevent="deletePhoto"
                            v-if="user.profile_photo_path"
                        >
                            حذف تصویر
                        </my-button>
                    </div>
                </div>
            </div>

            <!-- Name -->
            <div class="form-control">
                <my-label for="name" value="نام" :required="true" />
                <my-input
                    id="name"
                    type="text"
                    v-model="form.name"
                    autocomplete="name"
                />
            </div>

            <!-- Email -->
            <div class="form-control">
                <my-label for="email" value="ایمیل" :required="true" />
                <my-input
                    id="email"
                    type="email"
                    v-model="form.email"
                    autocomplete="email"
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

import { validEmail } from "@/functions/validations";

import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

const props = defineProps(["user"]);

const form = useForm({
    _method: "PUT",
    name: props.user.name,
    email: props.user.email,
    photo: null,
});

const photoPreview = ref();
const loding = ref(false);
function send() {
    loding.value = true;
    if (photo.value) {
        form.photo = photo.value.files[0];
    }
    if (!form.name || !form.email) {
        //
    } else if (!validEmail(form.email)) {
        //
    } else {
        form.post(route("user-profile-information.update"), {
            errorBag: "updateProfileInformation",
            preserveScroll: true,
            onSuccess: () => clearPhotoFileInput(),
        });
    }
    setTimeout(() => {
        loding.value = false;
    }, 200);
}

const photo = ref();
function selectNewPhoto() {
    photo.value.click();
}

function updatePhotoPreview() {
    const Photo = photo.value.files[0];

    if (!Photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(Photo);
}

function deletePhoto() {
    useForm({}).delete(route("current-user-photo.destroy"), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
}

function clearPhotoFileInput() {
    if (photo.value) {
        photo.value = null;
    }
}
</script>
