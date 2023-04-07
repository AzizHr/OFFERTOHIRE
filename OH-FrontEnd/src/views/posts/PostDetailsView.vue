<script>
import getPost from "../../composables/getPost";
import axios from "axios";
import { onBeforeMount, onMounted, ref } from "vue";

export default {
  props: ["id"],
  setup(props) {
    const { post, load } = getPost(props.id);
    // const followers = ref([]);

    // onBeforeMount(() => {
    //   getUserFollowers();
    // });

    // async function getUserFollowers() {
    //   try {
    //     const response = await axios.get(
    //       `http://127.0.0.1:8000/api/users/follows/29`
    //     );
    //     followers.value = response.data[0].followers;
    //   } catch (error) {
    //     console.log(error);
    //   }
    // }

    // function follow(user_id, followed_by) {
    //   let fr = new FormData();
    //   fr.append("user_id", user_id);
    //   fr.append("followed_by", followed_by);
    //   axios
    //     .post("http://127.0.0.1:8000/api/users/follow", fr)
    //     .then((response) => {
    //       console.log(response.data);
    //     });
    // }

    load();

    return { post };
  },
};
</script>

<template>
  <div class="flex gap-10 px-20 mt-6">
    <div class="grid gap-2 w-1/2">
      <p class="text-sm text-gray-600">2023/05/01</p>
      <img class="rounded w-full" :src="post.image" alt="" />
      <div class="flex justify-between">
        <div class="flex items-center gap-2">
          <img class="w-12 h-12 rounded-full" :src="post.user.avatar" alt="" />
          <p>{{ post.user.name }}</p>
        </div>
        <router-link
          :to="{ name: 'profile', params: { id: post.user.id } }"
          class="py-3 px-6 bg-orange-500 hover:bg-orange-600 font-bold text-gray-100 rounded"
        >
          Profile
        </router-link>
      </div>
    </div>
    <div class="grid mt-20 w-1/3">
      <p class="text-xl">
        {{ post.body }}
      </p>
    </div>
  </div>
</template>
