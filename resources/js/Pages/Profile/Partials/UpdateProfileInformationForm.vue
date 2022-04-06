<template>
    <div class="flex justify-center w-full">
        <form class="w-full md:w-1/2" novalidate @submit.prevent="send">
            <!-- Profile Photo -->
            <div class="form-control">
                <!-- Profile Photo File Input -->
                <input
                    ref="photo"
                    class="hidden"
                    type="file"
                    @change="updatePhotoPreview"
                />

                <my-label for="photo" value="تصویر"/>
                <div class="flex items-center justify-between">
                    <!-- Current Profile Photo -->
                    <div v-if="!photoPreview" class="mt-2 avatar">
                        <div class="w-24 overflow-hidden rounded-full">
                            <img
                                :alt="user.name"
                                :src="user.profile_photo_url"
                            />
                        </div>
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div v-if="photoPreview" class="mt-2 avatar">
                        <span
                            :style="
                                'background-image: url(\'' +
                                photoPreview +
                                '\');'
                            "
                            class="block h-20 bg-center bg-no-repeat bg-cover rounded-full"
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
                            v-if="user.profile_photo_path"
                            class="mt-2 btn-secondary"
                            type="button"
                            @click.prevent="deletePhoto"
                        >
                            حذف تصویر
                        </my-button>
                    </div>
                </div>
            </div>

            <!-- Name -->
            <div class="form-control">
                <my-label :required="true" for="name" value="نام"/>
                <my-input
                    id="name"
                    v-model="form.name"
                    autocomplete="name"
                    type="text"
                />
            </div>

            <!-- Email -->
            <div class="form-control">
                <my-label :required="true" for="email" value="ایمیل"/>
                <my-input
                    id="email"
                    v-model="form.email"
                    autocomplete="email"
                    type="email"
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
import MyLabel from "@/component/Form/Label.vue";

import {validEmail} from "@/functions/validations";

import {useForm} from "@inertiajs/inertia-vue3";
import {ref} from "@vue/reactivity";
import {errorMessage, successMessage} from "@/functions/Message";

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
            onSuccess: () => {
                successMessage('پروفایل با موفقیت ویرایش شد')
                clearPhotoFileInput()
            },
            onError: errors => {
                for (const error of errors) {
                    errorMessage(error);
                }
            }
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
