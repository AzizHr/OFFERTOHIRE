<script>
import axios from "axios";
import Swal from "sweetalert2";
import { ref } from "vue";
import router from '../../router';

export default {
  setup() {
    const user = JSON.parse(localStorage.getItem("user"));
    const fr = ref({
      image: "",
      content: "",
      user_id: user.id,
    });

    function onFileChange(event) {
      fr.value.image = event.target.files[0];
    }
    function store() {
      const formData = new FormData();
      formData.append("image", fr.value.image);
      formData.append("content", fr.value.content);
      formData.append("user_id", fr.value.user_id);

      axios
        .post("http://127.0.0.1:8000/api/posts", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          console.log(response.data);
          Swal.fire({
          position: "top-end",
          icon: "success",
          title: 'Posted successfully!',
          showConfirmButton: false,
          timer: 1500,
        });
        router.push("/posts");
        })
        .catch((error) => {
          console.log(error.message);
        });
    }

    return { user , fr, onFileChange, store };
  },
};
</script>

<template>
  <div
    class="md:w-2/3 w-auto md:mx-auto mx-4 grid gap-8 mt-20 rounded shadow-md md:py-10 py-4 md:px-6 px-2 mb-20"
  >
    <h1 class="text-2xl font-bold">Publish a new post</h1>
    <div class="grid gap-4">
      <div class="grid gap-1">
        <label>Image</label>
        <input
          name="image"
          class="py-3 pl-3 rounded border-2 border-orange-500"
          type="file"
          @change="onFileChange"
        />
      </div>
      <div class="grid gap-1">
        <label>Content</label>
        <textarea
          class="py-3 pl-3 rounded border-2 border-orange-500"
          placeholder="What are thinking of..."
          name="content"
          cols="15"
          rows="6"
          v-model="fr.content"
        ></textarea>
      </div>
      <button
        @click="store()"
        class="py-3 px-6 bg-orange-500 hover:bg-orange-600 font-bold text-gray-100 rounded justify-self-start"
      >
        Publish
      </button>
    </div>
  </div>
</template>
