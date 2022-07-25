<template>
  <button
    type="button"
    class="flex items-center justify-between w-full h-16 p-4 border-b-2 flex-nowrap text-base-content hover:bg-primary-focus/75 focus:bg-primary-focus border-primary hover:text-primary-content/75 focus:text-primary-content"
    :class="{ 'bg-primary': show }"
    @click="$emit('studentId', student.id)"
  >
    <img
      :alt="student.name"
      :src="student.profile_photo_url"
      class="object-cover rounded-full w-14 h-14"
    />
    <div class="hidden text-xl group-hover:block">
      {{ student.name }}
    </div>
  </button>
</template>

<script setup>
defineProps({
  student: {
    type: Object,
  },
  show: {
    type: Boolean,
    default: false,
  },
});
defineEmits(["studentId"]);
</script>
