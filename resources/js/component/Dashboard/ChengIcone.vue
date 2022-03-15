<template>
    <transition
        enter-active-class="transition duration-100 origin-center"
        enter-from-class="transform -rotate-90"
        enter-to-class="transform rotate-0"
        leave-active-class="transition duration-100 origin-center"
        leave-from-class="transform rotate-0"
        leave-to-class="transform rotate-90"
        mode="out-in"
    >
        <slot />
    </transition>
</template>

