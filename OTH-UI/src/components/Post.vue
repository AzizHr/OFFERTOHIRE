<script>
import axios from "axios";
import router from "../router";
export default {
  props: ["posts"],

  setup() {
    let user = {};
    if (localStorage.getItem("user")) {
      user = JSON.parse(localStorage.getItem("user"));
    }

    function like(post_id, user_id) {
      if (!localStorage.getItem("token")) {
        router.push("/sign-in");
      }
      let fr = new FormData();
      fr.append("post_id", post_id);
      fr.append("user_id", user_id);
      axios
        .post("http://127.0.0.1:8000/api/posts/like", fr)
        .then((response) => {
          console.log(response.data);
          router.go()
        });
    }

    return { user, like };
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
      ><img class="rounded" :src="'../src/assets/posts/' + post.image" alt=""
    /></router-link>
    <div class="flex justify-between items-center">
      <div class="flex items-center gap-4">
        <router-link :to="{ name: 'profile', params: { id: post.user.id } }">
          <img
            class="w-8 h-8 rounded-full"
            :src="'../src/assets/users/' + post.user.avatar"
            alt=""
          />
        </router-link>
        <router-link :to="{ name: 'profile', params: { id: post.user.id } }">
          <p>{{ post.user.name }}</p>
        </router-link>
      </div>
      <button
        class="text-gray-500 text-xl flex justify-center items-center"
        @click="like(post.id, user.id)"
      >
        {{ post.likes_count }}

        <lord-icon
          v-if="post.likes.some((like) => like.user.id === user.id)"
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
