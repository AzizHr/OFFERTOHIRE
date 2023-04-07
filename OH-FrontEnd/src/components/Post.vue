<script>
import { onBeforeMount, ref } from "vue";
import axios from "axios";
import router from "../router";
import { useAuthStore } from "@/stores/auth";
export default {
  props: ["posts"],

  setup() {
    const authStore = useAuthStore();
    const user = ref(null);

    onBeforeMount(() => {
      user.value = authStore.user;
    });

    // onMounted(() => {
    //   const loggedInUser = localStorage.getItem("loggedInUser");
    //   const loggedInCompany = localStorage.getItem("loggedInCompany");
    //   if (loggedInUser) {
    //     client.value = JSON.parse(loggedInUser);
    //   } else if (loggedInCompany) {
    //     client.value = JSON.parse(loggedInCompany);
    //   }
    // });

    function like(post_id, user_id) {
      let fr = new FormData();
      fr.append("post_id", post_id);
      fr.append("user_id", user_id);
      axios
        .post("http://127.0.0.1:8000/api/posts/like", fr)
        .then((response) => {
          console.log(response.data);
          router.push("/posts");
        });
    }

    return { like };
  },
};
</script>

<template>
  <div
    v-for="post in posts"
    :key="post.id"
    class="grid gap-y-2 md:w-auto sm:w-auth w-full"
  >
    <router-link :to="{ name: 'postdetails', params: { id: post.id } }"
      ><img class="rounded" :src="post.image" alt=""
    /></router-link>
    <div class="flex justify-between items-center">
      <div class="flex items-center gap-4">
        <img class="w-8 h-8 rounded-full" :src="post.user.avatar" alt="" />
        <p>{{ post.user.name }}</p>
      </div>
      <button
        class="text-gray-500 text-xl flex justify-center items-center"
        @click="like(post.id, 100)"
      >
        {{ post.likes_count }}

        <lord-icon
          v-if="post.likes.some((like) => like.user.id === 100)"
          src="https://cdn.lordicon.com/xryjrepg.json"
          trigger="click"
          colors="primary:#e83a30"
          style="width: 42px; height: 42px"
        ></lord-icon>
        <lord-icon
          v-else
          src="https://cdn.lordicon.com/xryjrepg.json"
          trigger="click"
          colors="primary:#e4e4e4"
          style="width: 42px; height: 42px"
        >
        </lord-icon>
      </button>
    </div>
  </div>
</template>
