<template>
    <div class="min-h-screen bg-gradient-to-br from-neutral to-neutral-focus flex items-center justify-center">
        <div class="bg-base-200 border-transparent border-1 rounded w-full p-4 max-w-7xl">
            <div class="gap-2 grid md:grid-cols-3">
                <h3 class="flex justify-between md:justify-start md:block">
                    نام آزمون:
                    <span> {{ quiz.name }} </span>
                </h3>
                <h3 class="md:text-left order-2 md:order-3 flex justify-between md:justify-start md:block">
                    <span>
                        نمره آزمون:
                        <span class="mr-auto md:mr-0"> {{ quiz.score }} </span>
                    </span>
                    <template v-if="quiz.type === 'test'">
                        <span class="hidden md:inline">/</span>
                        <span>
                            نمره منفی:
                             <span class="mr-auto md:mr-0"> {{ quiz.scoreN }} </span>
                        </span>
                    </template>
                </h3>
                <h3 class="col-span-1 md:text-center order-3 md:order-2 md:block flex justify-between md:justify-start">
                    مدت باقی مانده تا پایان آزمون:
                    <span class="mr-auto md:mr-0">
                        <countdown-timer
                            :now="now"
                            :start="start"
                            :time="quiz.time"
                            @finish="$emit('finish')"
                        />
                </span>
                </h3>
            </div>
            <slot/>
        </div>
    </div>

</template>
<script setup>
// CountdownTimer component
import CountdownTimer from "@/component/CountdownTimer";
// Vue function
import {ref} from "@vue/reactivity";

defineProps({
    quiz: {
        type: Object,
    },
    now: {
        type: Number,
    },
    start: {
        type: Number,
    },
})

defineEmits(['finish'])
</script>
