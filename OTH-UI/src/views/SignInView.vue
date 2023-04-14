<script>
import axios from "axios";
import { reactive } from "vue";
import { useRouter } from 'vue-router';

export default {
  setup() {

    const router = useRouter();

    const form = reactive({
      email: "",
      password: "",
    });

    const login = async () => {
      try {
        const response = await axios.post(
          "http://127.0.0.1:8000/api/login",
          form
        );
        localStorage.setItem("token", response.data.access_token);
        localStorage.setItem("user", JSON.stringify(response.data.user));
        console.log(response.data.user);
        router.push('/')
      } catch (error) {
        console.error(error);
      }
    };

    return { form, login };
  },
};
</script>

<template>
  <div
    class="md:w-2/3 w-auto md:mx-auto mx-4 grid gap-8 mt-32 rounded shadow-md md:py-10 py-4 md:px-6 px-2"
  >
    <h1 class="text-2xl font-bold">Welcome Back Brother!</h1>
    <form @submit.prevent="login()" class="grid gap-4">
      <div class="grid gap-1">
        <label>Email</label>
        <input
          class="py-3 pl-3 rounded border-2 border-orange-500"
          type="email"
          placeholder="Enter your email"
          v-model="form.email"
        />
      </div>
      <div class="grid gap-1">
        <label>Password</label>
        <input
          class="py-3 pl-3 rounded border-2 border-orange-500"
          type="password"
          placeholder="Enter your password"
          v-model="form.password"
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
          <router-link class="text-orange-500 text-sm" to="user/sign-up"
            >Sign Up</router-link
          ></span
        >
      </div>
    </form>
  </div>
</template>
