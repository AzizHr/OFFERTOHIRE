<script>
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
import router from "../router";

export default {
  setup() {
    const email = ref("");
    const password = ref("");

    const user = ref(null);

    async function auth() {
      if (email.value == "" && password.value == "") {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please Fill in all inputs!",
        });
      } else {
        let fr = new FormData();
        fr.append("email", email.value);
        fr.append("password", password.value);
        axios
          .post("http://127.0.0.1:8000/api/login", fr)
          .then((response) => {
            if (response.data.role == "user") {
              user.value = response.data;
              // useAuthStore.setUser(user);
              router.push("/posts");
            } else if (response.data.role == "company") {
              user.value = response.data;
              // useAuthStore.setUser(user);
              router.push("/offers");
            } else if (response.data.role == "admin") {
              user.value = response.data;
              // useAuthStore.setUser(user);
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Email or Password incorrect!",
              });
            }
          })
          .catch(() => {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Email or Password incorrect!",
            });
          });
      }
    }

    return { email, password, auth, user };
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
          @click="auth()"
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
