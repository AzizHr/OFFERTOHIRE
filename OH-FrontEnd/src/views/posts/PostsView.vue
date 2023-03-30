<script>
import { onMounted, ref } from "vue";
import Post from "../../components/Post.vue";
import getPosts from "../../composables/getPosts";

export default {
  components: {
    Post,
  },

  setup() {
    const { posts, load } = getPosts();
    const user = ref(null);
    const company = ref(null);

    onMounted(() => {
      // Get the user information from localStorage if available
      const loggedInUser = localStorage.getItem("loggedInUser");
      const loggedInCompany = localStorage.getItem("loggedInCompany");
      if (loggedInUser) {
        user.value = JSON.parse(loggedInUser);
      }
      if (loggedInCompany) {
        user.value = JSON.parse(loggedInCompany);
      }
    });

    load();

    return { posts, user, company };
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
