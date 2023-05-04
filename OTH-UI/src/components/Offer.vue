<script>
import axios from "axios";
import router from '../router';
export default {
  props: ["offers"],
  setup() {
    const user = JSON.parse(localStorage.getItem("user"));

    function like(offer_id, user_id) {
      if (!localStorage.getItem("token")) {
        router.push("/sign-in");
      }
      let fr = new FormData();
      fr.append("offer_id", offer_id);
      fr.append("user_id", user_id);
      axios
        .post("http://127.0.0.1:8000/api/offers/like", fr)
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
    v-for="offer in offers"
    :key="offer.id"
    class="grid gap-y-8 lg:w-auto md:w-auto h-fit sm:w-auto w-full rounded shadow-md md:px-2 px-3 md:py-2 py-3 hover:bg-gray-100"
  >
    <div class="flex justify-between items-center">
      <div class="flex items-center gap-2">
        <img
          class="w-12 h-12 rounded-full"
          :src="'../src/assets/users/' + offer.company.avatar"
          alt=""
        />
        <a href="" class="md:text-base sm:text-sm text-xs">{{
          offer.company.name
        }}</a>
      </div>
      <p class="text-gray-600">2023/02/20</p>
    </div>
    <p class="mx-4">{{ offer.content }}</p>
    <div class="flex justify-between">
      <button
        class="text-gray-500 text-xl flex justify-center items-center"
        @click="like(offer.id, user.id)"
      >
        {{ offer.likes_count }}

        <lord-icon
          v-if="offer.likes.some((like) => like.user.id === user.id)"
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
      <router-link
        v-if="user.role === 'user'"
        :to="{ name: 'newapplication', params: { id: offer.id } }"
        class="py-2.5 px-4 rounded bg-orange-500 font-bold text-gray-50 hover:bg-orange-600 hover:text-gray-100"
      >
        Apply Now
      </router-link>
    </div>
  </div>
</template>
