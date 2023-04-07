<script>
import router from "../router";
import { useAuthStore } from "@/stores/auth";
import axios from "axios";
import { onBeforeMount, ref } from "vue";

export default {
  name: "Navbar",

  setup() {
    const authStore = useAuthStore();
    const user = ref(null);

    onBeforeMount(() => {
      user.value = authStore.user;
    });

    const toggle = () => {
      document.getElementById("menu").classList.toggle("hidden");
    };

    function logout() {
      authStore.clearUser();
      // router.push("/sign-in");
      // axios
      //   .post("http://127.0.0.1:8000/api/logout")
      //   .then(() => {
      //     authStore.clearUser();
      //     router.push("/sign-in");
      //   })
      //   .catch((error) => {
      //     console.log(error);
      //   });
    }

    return { toggle, user, logout };
  },
};
</script>

<template>
  <nav v-if="!user" class="flex justify-between py-6 justify-center">
    <div class="flex justify-center">
      <h1 class="font-bold text-xl pl-4 h-fit">OFFER->HIRE</h1>
    </div>
    <ul
      class="lg:flex items-center grid hidden gap-8 lg:mt-0 lg:py-0 py-6 mt-10 md:mx-0"
      id="menu"
    >
      <li>
        <a href="/">Home</a>
      </li>
      <li>
        <a href="/about-us">About Us</a>
      </li>
      <li>
        <a href="/contact-us">Contact Us</a>
      </li>
      <li>
        <a href="/offers">Offers</a>
      </li>
      <li>
        <a href="/posts">Posts</a>
      </li>
    </ul>
    <ul class="flex gap-4 justify-center pr-4">
      <a class="flex lg:hidden" href="" id="open" @click.prevent="toggle">
        <i class="fa-solid fa-bars md:mt-4 mt-0"></i>
      </a>
      <li>
        <a
          href="/sign-in"
          class="py-3 px-4 bg-blue-300 rounded font-bold md:flex hidden"
          >Sign in</a
        >
        <a href="/sign-in" class="md:hidden flex"
          ><i class="fa-solid fa-right-to-bracket fa-beat-fade"></i
        ></a>
      </li>
      <li>
        <a
          href="/user/sign-up"
          class="py-3 px-4 text-gray-100 bg-gray-800 rounded font-bold md:flex hidden"
          >Sign Up for Free</a
        >
        <a href="/user/sign-up" class="md:hidden flex"
          ><i class="fa-solid fa-user-plus fa-beat-fade"></i
        ></a>
      </li>
    </ul>
  </nav>

  <nav
    v-if="user && user.role == 'user'"
    class="flex justify-between py-6 justify-center"
  >
    <div class="flex justify-center">
      <h1 class="font-bold text-xl pl-4 md:pt-2 h-fit">OFFER->HIRE</h1>
    </div>
    <ul
      class="lg:flex items-center grid hidden gap-8 lg:mt-0 lg:py-0 py-6 mt-10 md:mx-0"
      id="menu"
    >
      <li>
        <a href="/profile">Profile</a>
      </li>
      <li>
        <a href="/portfolio">Portfolio</a>
      </li>
      <li>
        <a href="/posts/new">New Post</a>
      </li>
      <li>
        <a href="/posts">Posts</a>
      </li>
      <li>
        <a href="/offers">Offers</a>
      </li>
    </ul>
    <ul class="flex gap-4 justify-center pr-4">
      <li class="md:mt-2.5">
        <span>{{ user.name }}</span>
      </li>
      <a class="flex lg:hidden" href="" id="open" @click.prevent="toggle">
        <i class="fa-solid fa-bars md:mt-4 mt-1.5"></i>
      </a>
      <li>
        <button
          @click="logout()"
          class="py-2.5 px-4 bg-blue-300 rounded font-bold md:flex hidden"
        >
          Logout
        </button>
        <button @click="logout()" class="md:hidden flex">
          <i class="fa-solid fa-right-to-bracket fa-beat-fade mt-1.5"></i>
        </button>
      </li>
    </ul>
  </nav>
</template>
