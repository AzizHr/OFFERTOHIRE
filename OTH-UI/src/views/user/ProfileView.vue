<script>
import axios from "axios";
import { useRoute } from "vue-router";
import { computed, onMounted, ref, watch } from "vue";
import router from '../../router';

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

    function follow(user_id, follower_id) {
      if (!localStorage.getItem("token")) {
        route.push("/sign-in");
      }
      let fr = new FormData();
      fr.append("user_id", user_id);
      fr.append("follower_id", follower_id);
      axios.post("http://127.0.0.1:8000/api/follow", fr).then((response) => {
        console.log(response.data);
      });
    }

    watch(
      () => route.params.id,
      () => {
        getUser();
      }
    );

    watch(
      () => targetedUser.followers,
      () => {
        getUser();
      }
    );

    watch(
      () => targetedUser.value,
      () => {
        getUser();
      }
    );

    return { user_id, getUser, targetedUser, user, follow };
  },
};
</script>

<template>
  <div class="flex lg:mx-4 md:mx-2">
    <div class="grid w-4/5 gap-4 lg:mx-8 mx-4">
      <div class="w-auto rounded-lg shadow-md pb-4">
        <div class="relative h-44 bg-slate-600 rounded-t-lg">
          <div
            class="bg-white rounded-full h-32 w-32 absolute mt-28 ml-6 flex justify-center items-center"
          >
            <img class="h-28 w-28 rounded-full" :src="'../../src/assets/users/' + targetedUser.avatar" />
          </div>
        </div>
        <div class="grid mt-20 gap-4 ml-10">
          <h1 class="font-bold">{{ targetedUser.name }}</h1>
          <div class="flex gap-6">
            <h1>{{ targetedUser.email }}</h1>
            <h1>Web Designer</h1>
          </div>
          <div class="flex gap-4">
            <router-link
              :to="{ name: 'chat', params: { id: user_id } }"
              class="py-2 px-2 font-bold border border-black rounded"
              v-if="
                targetedUser.followers &&
                targetedUser.followers.some((f) => f.follower_id === user.id)
              "
            >
              Message
            </router-link>
            <button
              v-if="
                targetedUser.followers &&
                targetedUser.followers.some((f) => f.follower_id === user.id)
              "
              @click="follow(targetedUser.id, user.id)"
              class="py-2 px-4 text-gray-50 bg-blue-500 font-bold rounded"
            >
              Following
            </button>
            <button
            v-else-if="targetedUser.id !== user.id"
              @click="follow(targetedUser.id, user.id)"
              class="py-2 px-4 text-gray-50 bg-blue-500 font-bold rounded"
            >
              Follow
            </button>
          </div>
        </div>
      </div>
      <div class="shadow-md w-auto rounded-lg h-fit grid gap-4 px-2 py-2 mb-10">
        <h1 class="font-bold">Skills</h1>
        <div v-if="targetedUser.skills && targetedUser.skills.length === 0">
          You have no skills yet
        </div>
        <div
          class="grid lg:grid-cols-8 md:grid-cols-6 grid-cols-3 gap-6 w-fit items-center"
        >
          <div
            v-for="skill in targetedUser.skills"
            :key="skill.id"
            class="py-2 px-2 w-fit rounded border border-1 border-gray-400"
          >
            {{ skill.content }}
          </div>
        </div>
      </div>
    </div>

    <div
      class="grid gap-2 shadow-lg border border-2 border-gray-300 rounded py-1 md:py-4 md:px-4 md:w-fit w-auto h-fit"
    >
      <div
        v-for="follower in targetedUser.followers"
        :key="follower.user_id"
        class="flex gap-2 lg:justify-stretch justify-center h-fit"
      >
        <img
          class="md:w-10 md:h-10 w-8 h-8 rounded-full"
          :src="'../../src/assets/users/' + follower.follower.avatar"
          alt=""
        />
        <router-link
          class="lg:flex hidden"
          :to="{ name: 'profile', params: { id: follower.follower.id } }"
          >{{ follower.follower.name }}</router-link
        >
      </div>
      <div v-if="targetedUser.followers && targetedUser.followers.length === 0">
        No followers
      </div>
    </div>
  </div>
</template>
