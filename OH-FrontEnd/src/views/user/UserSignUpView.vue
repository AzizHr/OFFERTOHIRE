<script>
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
import router from "../../router";

export default {
  setup() {
    const name = ref("");
    const email = ref("");
    const password = ref("");
    const password_confirmation = ref("");

    async function register() {
      let userData = {
        name: name.value,
        email: email.value,
        role: "user",
        password: password.value,
        password_confirmation: password_confirmation.value,
      };
      if (
        userData.name == "" &&
        userData.email == "" &&
        userData.password == "" &&
        userData.password_confirmation == ""
      ) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please Fill in all inputs!",
        });
      }
      axios
        .post("http://127.0.0.1:8000/api/register", userData)
        .then((response) => {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: `${response.data}`,
          });
          router.push("/sign-in");
        });
    }

    return { name, email, password, password_confirmation, register };
  },
};
</script>

<template>
  <div
    class="md:w-1/2 w-auto md:mx-auto mx-4 grid gap-6 mt-16 rounded shadow-md md:py-10 py-4 md:px-6 px-2"
  >
    <h1 class="text-2xl font-bold">Welcome, Create Your Account Now!</h1>
    <div class="flex mx-auto">
      <router-link
        class="py-3 px-16 bg-gray-800 hover:bg-gray-900 font-bold text-gray-100 rounded-tl-md rounded-bl-md"
        to="/user/sign-up"
        >Normal</router-link
      >
      <router-link
        class="py-3 px-16 bg-gray-100 hover:bg-gray-300 font-bold text-gray-800 rounded-tr-md rounded-br-md"
        to="/company/sign-up"
        >Company</router-link
      >
    </div>
    <form @submit.prevent="register()" class="grid gap-4">
      <div class="grid gap-1">
        <label>Name</label>
        <input
          class="py-3 pl-3 rounded border-2 border-gray-800"
          type="text"
          placeholder="Enter your name"
          name="name"
          v-model="name"
        />
      </div>
      <div class="grid gap-1">
        <label>Email</label>
        <input
          class="py-3 pl-3 rounded border-2 border-gray-800"
          type="email"
          placeholder="Enter your email"
          name="email"
          v-model="email"
        />
      </div>
      <div class="grid gap-1">
        <label>Password</label>
        <input
          class="py-3 pl-3 rounded border-2 border-gray-800"
          type="password"
          placeholder="Enter your password"
          name="password"
          v-model="password"
        />
      </div>
      <div class="grid gap-1">
        <label>Confirm Password</label>
        <input
          class="py-3 pl-3 rounded border-2 border-gray-800"
          type="password"
          placeholder="Confirm your password"
          name="password_confirmation"
          v-model="password_confirmation"
        />
      </div>
      <div class="flex justify-between items-center">
        <button
          class="py-3 px-6 bg-gray-800 hover:bg-gray-900 font-bold text-gray-100 rounded"
        >
          Sign up
        </button>
        <span class="text-sm text-gray-700"
          >Already have an account?
          <router-link class="text-orange-500 text-sm" to="/sign-in"
            >Sign In</router-link
          ></span
        >
      </div>
    </form>
  </div>
</template>
