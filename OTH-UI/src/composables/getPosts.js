import { ref } from "vue";
import axios from "axios";

const getPosts = () => {
  const posts = ref([]);

  const load = async () => {
    try {
      let response = await axios.get("http://127.0.0.1:8000/api/posts");
      posts.value = await response.data;
    } catch (error) {
      console.log(error);
    }
  };

  return { posts, load };
};

export default getPosts;
