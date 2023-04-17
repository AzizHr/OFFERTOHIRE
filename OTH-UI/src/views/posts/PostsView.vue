<script>
import { ref, watch } from "vue";
import Post from "../../components/Post.vue";
import getPosts from "../../composables/getPosts";
import axios from 'axios';

export default {
  components: {
    Post,
  },

  setup() {
    const { posts, load } = getPosts();

    const user = JSON.parse(localStorage.getItem("user"));
    const search_input = ref(null);

    async function search() {
      let fr = new FormData();
      fr.append("search", search_input.value);
      axios
        .post(`http://127.0.0.1:8000/api/posts/search`, fr)
        .then((response) => {
          posts.value = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    }

    load();

    watch(
      () => load(),
      () => {
        getPosts();
      }
    );

    return { posts, user, search_input, search };
  },
};
</script>

<template>
  <div class="bg-gradient-to-r from-orange-400 py-36">
    <div
      class="flex justify-center mx-auto justify-self-center w-full gap-6 mt-40"
    >
      <input
        class="pl-3 py-3 px-4 w-1/2 border-2 border-gray-100 rounded"
        type="text"
        name="search"
        v-model="search_input"
        placeholder="search..."
      />
      <button
        @click="search()"
        class="py-3 px-6 font-bold bg-orange-400 hover:bg-orange-500 hover:text-gray-150 rounded text-gray-100 border border-gray-100"
      >
        Search
      </button>
    </div>
  </div>
  <div
    v-if="posts.length"
    class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-y-10 md:gap-x-6 gap-x-4 justify-items-center mt-20 md:mx-8 mx-4"
  >
    <Post :posts="posts" />
  </div>
  <div v-else class="text-center mt-20">No Posts available</div>
</template>
