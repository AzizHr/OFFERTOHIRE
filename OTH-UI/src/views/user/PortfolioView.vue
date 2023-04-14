<script>
import axios from "axios";
import { useRoute } from "vue-router";
import { computed, onMounted, ref, watch } from "vue";
import router from "../../router";

export default {
  setup() {
    const targetedUser = ref({});
    const route = useRoute();

    const user_id = computed(() => route.params.id);

    onMounted(() => {
      getUser();
    });

    async function getUser() {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/users/${user_id.value}`
        );
        targetedUser.value = response.data;
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    }

    const user = JSON.parse(localStorage.getItem("user"));

    watch(
      () => route.params.id,
      () => {
        getUser();
      }
    );

    return { user_id, getUser, targetedUser, user };
  },
};
</script>

<template>
  <div
    class="grid md:grid-cols-2 grid-cols-1 lg:mx-16 md:mx-10 mx-4 items-center mt-10 gap-6"
  >
    <div class="grid h-fit md:gap-10 gap-6 md:items-center justify-center">
      <span class="uppercase text-2xl">hello I'm a</span>
      <span class="lg:text-5xl md:text-4xl text-2xl"
        >UI & UX <span class="text-orange-500">Designer</span></span
      >
      <router-link
        :to="{ name: 'profile', params: { id: user.id } }"
        class="w-fit font-bold text-gray-50 bg-orange-400 py-3 px-5 rounded"
      >
        Contact Me
      </router-link>
    </div>
    <div class=" ">
      <img class="w-full rounded-lg h-full" src="../../assets/man-face.webp" alt="" />
    </div>
  </div>

  <div class="md:my-28 my-20 md:mx-24 mx-4 grid h-fit md:gap-8 gap-6 w-fit">
    <span class="">LET ME INTRODUCE MYSELF</span>
    <span class="md:text-4xl text-2xl font-bold text-orange-400">About me</span>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse illo eveniet
      repudiandae alias ab?
    </p>
    <div class="flex justify-end gap-4">
      <router-link
        :to="{ name: 'profile', params: { id: user.id } }"
        class="bg-orange-400 py-2.5 px-4 rounded font-bold text-gray-50"
      >
        Hire Me
      </router-link>
      <button
        class="bg-gray-50 border border-2 border-black py-2.5 px-4 rounded font-bold text-black"
      >
        Download CV
      </button>
    </div>
  </div>
</template>
