import { ref } from "vue";
import axios from "axios";

const getUserMessages = (id) => {
  const userMessages = ref(null);

  const load = async () => {
    try {
      let response = await axios.get("http://127.0.0.1:8000/api/users/messages/" + id);
      userMessages.value = await response.data;
    } catch (error) {
      console.log(error);
    }
  };

  return { userMessages, load };
};

export default getUserMessages;