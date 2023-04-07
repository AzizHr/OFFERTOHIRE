<script>
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
import router from "../router";
import { useAuthStore } from "@/stores/auth";

export default {
  setup() {
    const email = ref("");
    const password = ref("");

    async function auth() {
      let userData = {
        email: email.value,
        password: password.value,
      };
      if (userData.email == "" && userData.password == "") {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please Fill in all inputs!",
        });
      } else {
        axios
          .post("http://127.0.0.1:8000/api/login", userData)
          .then((response) => {
            console.log(response.data);
            const authStore = useAuthStore();
            authStore.setUser(response.data);
            router.push("/posts");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    }

    return { email, password, auth };
  },
};
</script>

<template>
  <div
    class="md:w-1/2 w-auto md:mx-auto mx-4 grid gap-8 mt-32 rounded shadow-md md:py-10 py-4 md:px-6 px-2"
  >
    <h1 class="text-2xl font-bold">Welcome Back Brother!</h1>
    <form @submit.prevent="auth()" class="grid gap-4">
      <div class="grid gap-1">
        <label>Email</label>
        <input
          class="py-3 pl-3 rounded border-2 border-orange-500"
          type="email"
          placeholder="Enter your email"
          v-model="email"
        />
      </div>
      <div class="grid gap-1">
        <label>Password</label>
        <input
          class="py-3 pl-3 rounded border-2 border-orange-500"
          type="password"
          placeholder="Enter your password"
          v-model="password"
        />
      </div>
      <div class="flex gap-2">
        <input type="checkbox" />
        <span class="text-xs text-gray-600">Show Password</span>
      </div>
      <div class="flex justify-between items-center">
        <button
          class="py-3 px-6 bg-orange-500 hover:bg-orange-600 font-bold text-gray-100 rounded"
        >
          Sign in
        </button>
        <span class="text-sm text-gray-700"
          >No account?
          <router-link class="text-orange-500 text-sm" to="/sign-up"
            >Sign Up</router-link
          ></span
        >
      </div>
    </form>
  </div>
</template>
