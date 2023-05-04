<script>
import axios from "axios";
import { ref } from "vue";
import Swal from 'sweetalert2';
import router from '../../router';
export default {
  setup() {
    const user = JSON.parse(localStorage.getItem("user"));

    const content = ref(null);

    function newSkill() {
      let fr = new FormData();
      fr.append("content", content.value);
      fr.append("user_id", user.id);
      axios
        .post("http://127.0.0.1:8000/api/skills/new", fr)
        .then((response) => {
          console.log(response.data);
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "New skill added!",
            showConfirmButton: false,
            timer: 1500,
          });
          router.push("/");
        });
    }

    return { user, content, newSkill };
  },
};
</script>

<template>
  <div
    class="md:w-2/3 w-auto md:mx-auto mx-4 grid gap-8 mt-20 rounded shadow-md md:py-10 py-4 md:px-6 px-2 mb-20"
  >
    <h1 class="text-2xl font-bold">Add a new skill</h1>
    <form @submit.prevent="newSkill()" class="grid gap-4">
      <div class="grid gap-1">
        <label>Skill</label>
        <input
          name="content"
          class="py-3 pl-3 rounded border-2 border-orange-500"
          type="text"
          placeholder="Add a skill"
          v-model="content"
        />
      </div>
      <button
        class="py-3 px-6 bg-orange-500 hover:bg-orange-600 font-bold text-gray-100 rounded justify-self-start"
      >
        Add
      </button>
    </form>
  </div>
</template>
