import { ref } from "vue";
import axios from "axios";

const getOffers = () => {
  const offers = ref([]);

  const load = async () => {
    try {
      let response = await axios.get("http://127.0.0.1:8000/api/offers");
      offers.value = await response.data;
    } catch (error) {
      console.log(error);
    }
  };

  return { offers, load };
};

export default getOffers;
