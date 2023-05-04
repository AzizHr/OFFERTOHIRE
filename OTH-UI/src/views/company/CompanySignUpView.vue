<script>
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
import router from "../../router";

export default {
  setup() {
    const data = ref({
      name: "",
      avatar: "",
      email: "",
      password: "",
      password_confirmation: "",
    });

    function onFileChange(event) {
      data.value.avatar = event.target.files[0];
    }

    async function register() {
      if (
        data.value.name == "" &&
        data.value.avatar == "" &&
        data.value.email == "" &&
        data.value.password == "" &&
        data.value.password_confirmation == ""
      ) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Please fill all inputs!",
        });
      }
      let fr = new FormData();
      fr.append("name", data.value.name);
      fr.append("avatar", data.value.avatar);
      fr.append("email", data.value.email);
      fr.append("role", "company");
      fr.append("password", data.value.password);
      fr.append("password_confirmation", data.value.password_confirmation);
      axios.post("http://127.0.0.1:8000/api/register", fr).then((response) => {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: 'Account created successfully!',
          showConfirmButton: false,
          timer: 2000,
        });
        router.push("/sign-in");
        // console.log(response.data);
      });
    }

    return {
      data,
      onFileChange,
      register,
    };
  },
};
</script>

<template>
  <div
    class="md:w-2/3 w-auto md:mx-auto mx-4 grid gap-6 mt-16 rounded shadow-md md:py-10 py-4 md:px-6 px-2"
  >
    <h1 class="text-2xl font-bold">Welcome, Create Your Account Now!</h1>
    <div class="flex mx-auto">
      <router-link
        class="py-3 px-16 bg-gray-100 hover:bg-gray-300 font-bold text-gray-800 rounded-tl-md rounded-bl-md"
        to="/user/sign-up"
        >Normal</router-link
      >
      <router-link
        class="py-3 px-16 bg-gray-800 hover:bg-gray-900 font-bold text-gray-100 rounded-tr-md rounded-br-md"
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
          v-model="data.name"
        />
      </div>
      <div class="grid gap-1">
        <label>Image</label>
        <input
          name="avatar"
          class="py-3 pl-3 rounded border-2 border-orange-500"
          type="file"
          @change="onFileChange"
        />
      </div>
      <div class="grid gap-1">
        <label>Email</label>
        <input
          class="py-3 pl-3 rounded border-2 border-gray-800"
          type="email"
          placeholder="Enter your email"
          name="email"
          v-model="data.email"
        />
      </div>
      <div class="grid gap-1">
        <label>Password</label>
        <input
          class="py-3 pl-3 rounded border-2 border-gray-800"
          type="password"
          placeholder="Enter your password"
          name="password"
          v-model="data.password"
        />
      </div>
      <div class="grid gap-1">
        <label>Confirm Password</label>
        <input
          class="py-3 pl-3 rounded border-2 border-gray-800"
          type="password"
          placeholder="Confirm your password"
          name="password_confirmation"
          v-model="data.password_confirmation"
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
