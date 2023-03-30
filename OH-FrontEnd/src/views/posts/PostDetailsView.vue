<script>
import getPost from "../../composables/getPost";

export default {
  props: ["id"],
  setup(props) {
    const { post, load } = getPost(props.id);

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
        <button
          class="py-3 px-6 bg-orange-500 hover:bg-orange-600 font-bold text-gray-100 rounded"
        >
          Follow
        </button>
      </div>
    </div>
    <div class="grid mt-20 w-1/3">
      <p class="text-xl">
        {{ post.body }}
      </p>
    </div>
  </div>
</template>
