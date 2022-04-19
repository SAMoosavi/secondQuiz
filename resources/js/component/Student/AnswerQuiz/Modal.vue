<template>
    <transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="transform opacity-0 scale-50"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform opacity-0 scale-50"
    >
        <div
            v-if="send"
            class="absolute top-0 right-0 flex items-center justify-center w-screen h-screen px-8 py-4"
        >
            <div
                class="p-8 bg-primary/60 border border-primary-focus rounded-md"
            >
                <p class="mb-4 text-justify">
                    آیا از ارسال جواب خود مطمعن هستید؟ <br/> {{
                        counter - answered === 0
                            ? "شما به تمامی سوالات پاسخ داده اید."
                            : `شمااز ${counter} به ${answered} سوال پاسخ داده اید`
                    }}
                </p>
                <div class="flex justify-center items-center gap-4">
                    <my-button
                        :disabled="form.processing"
                        :loading="loading"
                        class="btn-info"
                        @click="$emit('submit')"
                    >
                        ارسال
                    </my-button>
                    <my-button
                        class="btn-error"
                        type="button"
                        @click="$emit('chengSend')"
                    >
                        لغو
                    </my-button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import MyButton from '@/component/Form/Button'

defineProps(['form', 'loading', 'counter', 'answered', 'send']);
defineEmits(['submit', 'chengSend'])
</script>

<style scoped>

</style>
