<script>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";

export default {
  setup() {
    const followers = ref([]);
    const targetedUser = ref(null);
    const route = useRoute();

    onMounted(() => {
      getUser();
      getUserFollowers();
    });

    async function getUser() {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/users/${route.params.id}`
        );
        targetedUser.value = response.data;
        // console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    }

    async function getUserFollowers() {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/users/follows/29`
        );
        followers.value = response.data[0].followers;
      } catch (error) {
        console.log(error);
      }
    }

    function follow(user_id, followed_by) {
      let fr = new FormData();
      fr.append("user_id", user_id);
      fr.append("followed_by", followed_by);
      axios
        .post("http://127.0.0.1:8000/api/users/follow", fr)
        .then((response) => {
          console.log(response.data);
        });
    }

    return { targetedUser, followers, follow };
  },
};
</script>

<template>
  <div class="grid gap-4 lg:mx-20 mx-4">
    <div class="w-auto rounded-lg shadow-md pb-4">
      <div class="relative h-44 bg-slate-600 rounded-t-lg">
        <div
          class="bg-white rounded-full h-32 w-32 absolute mt-28 ml-6 flex justify-center items-center"
        >
          <div class="bg-red-500 h-28 w-28 rounded-full"></div>
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
            :to="{ name: 'chat', params: { id: targetedUser.id } }"
            class="py-2 px-2 font-bold border border-black rounded"
          >
            Message
          </router-link>
          <button class="py-2 px-4 text-gray-50 bg-blue-500 font-bold rounded">
            Follow
          </button>
        </div>
      </div>
    </div>
    <div class="shadow-md w-auto rounded-lg h-fit grid gap-4 px-2 py-2">
      <h1 class="font-bold">Skills</h1>
      <div
        class="grid lg:grid-cols-8 md:grid-cols-6 grid-cols-3 gap-6 w-fit items-center"
      >
        <div
          v-for="skill in targetedUser.skills"
          :key="skill.id"
          class="py-2 px-2 rounded border border-1 border-gray-400"
        >
          {{ skill.content }}
        </div>
        <!-- <div class="py-2 px-2 rounded border border-1 border-gray-400">CSS</div>
        <div class="py-2 px-2 rounded border border-1 border-gray-400">
          JAVASCRIPT
        </div>
        <div class="py-2 px-2 rounded border border-1 border-gray-400">PHP</div>
        <div class="py-2 px-2 rounded border border-1 border-gray-400">
          HTML
        </div>
        <div class="py-2 px-2 rounded border border-1 border-gray-400">CSS</div>
        <div class="py-2 px-2 rounded border border-1 border-gray-400">
          JAVASCRIPT
        </div>
        <div class="py-2 px-2 rounded border border-1 border-gray-400">PHP</div>
        <div class="py-2 px-2 rounded border border-1 border-gray-400">
          JAVASCRIPT
        </div>
        <div class="py-2 px-2 rounded border border-1 border-gray-400">PHP</div> -->
      </div>
    </div>
  </div>
</template>
