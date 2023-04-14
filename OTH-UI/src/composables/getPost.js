import { ref } from "vue";
import axios from "axios";

const getPost = (id) => {
  const post = ref(null);

  const load = async () => {
    try {
      let response = await axios.get("http://127.0.0.1:8000/api/posts/" + id);
      post.value = await response.data;
    } catch (error) {
      console.log(error);
    }
  };

  return { post, load };
};

export default getPost;