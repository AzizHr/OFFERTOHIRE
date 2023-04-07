<script>
import { onBeforeMount, ref, watch } from "vue";
import Post from "../../components/Post.vue";
import getPosts from "../../composables/getPosts";
import { useAuthStore } from "@/stores/auth";

export default {
  components: {
    Post,
  },

  setup() {
    const { posts, load } = getPosts();
    const authStore = useAuthStore();
    const user = ref(null);

    onBeforeMount(() => {
      user.value = authStore.user;
    });

    load();

    watch(
      () => load(),
      () => {
        getPosts();
      }
    );

    return { posts, user };
  },
};
</script>

<template>
  <div
    v-if="posts.length"
    class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-y-10 md:gap-x-6 gap-x-4 justify-items-center mt-20 md:mx-8 mx-4"
  >
    <Post :posts="posts" />
  </div>
  <div v-else class="text-center mt-20">No Posts available</div>
</template>
