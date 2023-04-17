<script>
import axios from "axios";
import Swal from "sweetalert2";
import { onMounted, ref } from "vue";

export default {
  setup() {
    const users = ref([]);

    onMounted(() => {
      getAllUsers();
    });

    async function getAllUsers() {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/users`);
        users.value = response.data;
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    }

    function remove(user_id) {
      // if (!localStorage.getItem("token")) {
      //   router.push("/sign-in");
      // }
      axios
        .delete(`http://127.0.0.1:8000/api/users/remove/${user_id}`)
        .then((response) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `${response.data}`,
            showConfirmButton: false,
            timer: 2000,
          });
          getAllUsers();
          // console.log(response.data);
        });
    }

    return { users, remove };
  },
};
</script>

<template>
  <h1
    class="text-gray-900 text-3xl text-center font-bold mt-10"
    v-if="users.length === 0"
  >
    There is no users
  </h1>
  <div>
    <div class="relative overflow-x-auto pt-6">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">ID</th>
            <th scope="col" class="px-6 py-3">AVATAR</th>
            <th scope="col" class="px-6 py-3">NAME</th>
            <th scope="col" class="px-6 py-3">Email</th>
            <th scope="col" class="px-6 py-3">ROLE</th>
            <th scope="col" class="px-6 py-3">DELETE</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          <tr
            v-for="user in users"
            :key="user.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <td class="px-6 py-4">{{ user.id }}</td>
            <td class="px-6 py-4">
              <img
                class="h-24 w-24"
                :src="`../src/assets/users/${user.avatar}`"
                alt=""
              />
            </td>
            <td class="px-6 py-4">{{ user.name }}</td>
            <td class="px-6 py-4">{{ user.email }}</td>
            <td class="px-6 py-4">{{ user.role }}</td>
            <td class="px-6 py-4">
              <button
                @click="remove(user.id)"
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
