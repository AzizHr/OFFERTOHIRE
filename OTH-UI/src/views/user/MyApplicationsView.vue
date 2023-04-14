<script>
import axios from "axios";
import { onMounted, ref } from "vue";

export default {
  setup() {
    const my_applications = ref([]);

    onMounted(() => {
      myApplications();
    });

    const user = JSON.parse(localStorage.getItem("user"));

    async function myApplications() {
      if (user.role == "user") {
        try {
          const response = await axios.get(
            `http://127.0.0.1:8000/api/user/${user.id}/applications`
          );
          my_applications.value = response.data;
          console.log(response.data);
        } catch (error) {
          console.log(error);
        }
      } else if (user.role == "company") {
        try {
          const response = await axios.get(
            `http://127.0.0.1:8000/api/company/${user.id}/applications`
          );
          my_applications.value = response.data.applications;
          console.log(response.data);
        } catch (error) {
          console.log(error);
        }
      }
    }

    return { user, my_applications };
  },
};
</script>

<template>
  <h1
    class="text-gray-900 text-3xl text-center font-bold mt-10"
    v-if="my_applications.length === 0"
  >
    You don't have any applications yet
  </h1>
  <div>
    <div class="relative overflow-x-auto pt-6">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">LETTER</th>
            <th scope="col" class="px-6 py-3">COMPANY NAME</th>
            <th scope="col" class="px-6 py-3">COMPANY EMAIL</th>
            <th scope="col" class="px-6 py-3">CANCEL</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          <tr
            v-for="my_application in my_applications"
            :key="my_application.user_id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <td class="px-6 py-4">{{ my_application.letter }}</td>
            <td class="px-6 py-4">{{ my_application.offer.company.name }}</td>
            <td class="px-6 py-4">{{ my_application.offer.company.email }}</td>
            <td class="px-6 py-4">
              <button class="py-2 px-4 bg-orange-500 text-gray-100 font-bold rounded">
                cancel
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
