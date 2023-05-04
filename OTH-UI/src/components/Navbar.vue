<script>
import { useRouter } from "vue-router";
export default {
  name: "Navbar",

  setup() {
    const router = useRouter();
    const token = localStorage.getItem("token");
    const user = JSON.parse(localStorage.getItem("user"));
    const toggle = () => {
      document.getElementById("menu").classList.toggle("hidden");
    };

    const logout = () => {
      localStorage.clear();
      router.push("/sign-in");
    };

    return {
      toggle,
      token,
      user,
      logout,
    };
  },
};
</script>

<template>
  <nav v-if="!token" class="flex justify-between py-6 justify-center">
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
    v-if="token && user.role == 'user'"
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
        <router-link :to="{ name: 'profile', params: { id: user.id } }"
          >Profile</router-link
        >
      </li>
      <li>
        <!-- <router-link :to="{ name: 'portfolio', params: { id: user.id } }"
          >Portfolio</router-link
        > -->
        <a href="/my-applications">My applications</a>
      </li>
      <li>
        <a href="/posts/new">New Post</a>
      </li>
      <li>
        <a href="/skills/new">New Skill</a>
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

  <nav
    v-if="token && user.role == 'company'"
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
        <router-link :to="{ name: 'profile', params: { id: user.id } }"
          >Profile</router-link
        >
      </li>
      <li>
        <a href="/posts/new">New Post</a>
      </li>
      <li>
        <a href="/offers/new">New Offer</a>
      </li>
      <li>
        <a href="/offers">Offers</a>
      </li>
      <li>
        <a href="/posts">Posts</a>
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

  <nav
    v-if="token && user.role == 'admin'"
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
        <a href="/admin/users">Users</a>
      </li>
      <li>
        <a href="/admin/offers">Offers</a>
      </li>
      <li>
        <a href="/admin/posts">Posts</a>
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
