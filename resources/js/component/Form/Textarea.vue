<template>
   <textarea
       :id="id"
       v-model="modelValue"
       :disabled="disabled"
       class="w-full bg-transparent border-1 focus:border border-primary textarea outline-0 focus:outline-0 focus:border-primary-focus focus:ring-2 focus:ring-primary focus:ring-opacity-50"
       :rows="rows?rows:1"
       @input="$emit('update:modelValue', $event.target.value)"
       :required="required"
   ></textarea>

</template>

<script setup>
defineProps(["modelValue", "id", "disabled",'required','rows']);
defineEmits(["update:modelValue"]);
</script>

