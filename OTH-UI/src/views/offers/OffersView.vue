<script>
import { ref } from 'vue';
import Offer from "../../components/Offer.vue";
import getOffers from "../../composables/getOffers";
import axios from 'axios';

export default {
  components: {
    Offer,
  },

  setup() {
    const { offers, load } = getOffers();

    const search_input = ref(null);

    async function search() {
      let fr = new FormData();
      fr.append("search", search_input.value);
      axios
        .post(`http://127.0.0.1:8000/api/offers/search`, fr)
        .then((response) => {
          offers.value = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    }

    load();

    return { offers, search_input, search };
  },
};
</script>

<template>
  <div class="bg-gradient-to-r from-indigo-400 py-36">
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
        class="py-3 px-6 font-bold bg-indigo-400 hover:bg-indigo-500 hover:text-gray-150 rounded text-gray-100 border border-gray-100"
      >
        Search
      </button>
    </div>
  </div>
  <div
  v-if="offers.length"
    class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-y-12 gap-x-6 justify-items-center mt-20 md:mx-8 mx-4 pb-20"
  >
    <Offer :offers="offers" />
  </div>
  <div v-else class="text-center my-20">No Offers available</div>
</template>
