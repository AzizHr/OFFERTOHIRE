<script>
import axios from 'axios';
import getOffers from "../../composables/getOffers";
import Swal from 'sweetalert2';

export default {
  setup() {
    const { offers, load } = getOffers();

    function remove(offer_id) {
      // if (!localStorage.getItem("token")) {
      //   router.push("/sign-in");
      // }
      axios
        .delete(`http://127.0.0.1:8000/api/offers/${offer_id}`)
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `${response.data}`,
            showConfirmButton: false,
            timer: 2000,
          });
          load();
          // console.log(response.data);
        });
    }

    load();

    return { offers, remove };
  },
};
</script>

<template>
  <h1
    class="text-gray-900 text-3xl text-center font-bold mt-10"
    v-if="offers.length === 0"
  >
    There is no offers
  </h1>
  <div>
    <div class="relative overflow-x-auto pt-6">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">ID</th>
            <th scope="col" class="px-6 py-3">IMAGE</th>
            <th scope="col" class="px-6 py-3">CONTENT</th>
            <th scope="col" class="px-6 py-3">CREATEB BY</th>
            <th scope="col" class="px-6 py-3">DELETE</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          <tr
            v-for="offer in offers"
            :key="offer.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <td class="px-6 py-4">{{ offer.id }}</td>
            <td class="px-6 py-4">
              <img
                class="h-24 w-24"
                :src="`../src/assets/offers/${offer.image}`"
                alt=""
              />
            </td>
            <td class="px-6 py-4">{{ offer.content }}</td>
            <td class="px-6 py-4">{{ offer.company.name }}</td>
            <td class="px-6 py-4">
              <button
                @click="remove(offer.id)"
                class="py-2 px-4 bg-red-500 text-gray-100 font-bold rounded"
              >
                delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
