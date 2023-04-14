<script>
import axios from "axios";
import { ref } from "vue";
import { useRoute } from "vue-router";

export default {
  setup() {
    const route = useRoute();
    const user = JSON.parse(localStorage.getItem("user"));
    const offer_id = ref(route.params.id);
    const fr = ref({
      letter: "",
      offer_id: offer_id,
      user_id: user.id,
    });

    function apply() {
      const formData = new FormData();
      formData.append("letter", fr.value.letter);
      formData.append("offer_id", fr.value.offer_id);
      formData.append("user_id", fr.value.user_id);

      axios
        .post("http://127.0.0.1:8000/api/apply", formData)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.message);
        });
    }

    return { user, fr, apply };
  },
};
</script>

<template>
  <div
    class="md:w-2/3 w-auto md:mx-auto mx-4 grid gap-8 mt-20 rounded shadow-md md:py-10 py-4 md:px-6 px-2"
  >
    <h1 class="text-2xl font-bold">Submit an application to this offer</h1>
    <div class="grid gap-4">
      <div class="grid gap-1">
        <label>Letter</label>
        <textarea
          class="py-3 pl-3 rounded border-2 border-orange-500"
          placeholder="Add a letter for this offer"
          name="letter"
          cols="15"
          rows="6"
          v-model="fr.letter"
        ></textarea>
      </div>
      <button
        @click="apply()"
        class="py-3 px-6 bg-orange-500 hover:bg-orange-600 font-bold text-gray-100 rounded justify-self-start"
      >
        Apply
      </button>
    </div>
  </div>
</template>
