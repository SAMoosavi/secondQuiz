<template>
  <div
    class="fixed right-1/4 lg:right-[20%] z-10 w-[5.5rem] hover:w-1/4 hover:lg:w-1/5 group overflow-y-auto top-16 text-base-content bg-base-300 flex transition-all duration-300 min-h-screen overflow-x-hidden"
  >
    <Student
      v-for="student in students"
      :key="student.id"
      :student="student"
      @studentId="getStudent"
    />
  </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { ref } from "@vue/reactivity";
import { onMounted, watch } from "@vue/runtime-core";
import Student from "./Student.vue";

const props = defineProps(["uuid"]);

let students = ref(null);

function getStudents() {
  axios.get(route("get.students", [props.uuid])).then((result) => {
    students.value = result.data.students;
  });
}

function getStudent(id) {
    console.log(id);
  //   Inertia.get(route("", { student: id, quiz: props.uuid }));
}
onMounted(getStudents);
watch(
  () => props.showIndex,
  () => {
    getStudents();
    // chengShowIndex(props.showIndex);
  }
);
</script>
