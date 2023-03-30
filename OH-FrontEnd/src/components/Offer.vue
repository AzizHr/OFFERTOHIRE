<script>
export default {
  props: ["offers"],
};
</script>

<template>
  <div
    v-for="offer in offers"
    :key="offer.id"
    class="grid gap-y-8 lg:w-auto md:w-auto h-fit sm:w-auto w-full rounded shadow-md md:px-2 px-3 md:py-2 py-3 hover:bg-gray-100"
  >
    <div class="flex justify-between items-center">
      <div class="flex items-center gap-2">
        <img class="w-12 h-12 rounded-full" :src="offer.user.avatar" alt="" />
        <a href="" class="md:text-base sm:text-sm text-xs">{{
          offer.user.name
        }}</a>
      </div>
      <p class="text-gray-600">2023/02/20</p>
    </div>
    <p class="mx-4">{{ offer.description }}</p>
    <div class="flex justify-between">
      <button
        class="text-gray-500 text-xl flex justify-center items-center"
        @click="like(offer.id, client.id)"
      >
        <lord-icon
          src="https://cdn.lordicon.com/xryjrepg.json"
          trigger="click"
          colors="primary:#e4e4e4"
          style="width: 42px; height: 42px"
        >
        </lord-icon>
        {{ offer.likes_count }}
      </button>
      <button
        class="py-2.5 px-4 rounded bg-orange-500 font-bold text-gray-50 hover:bg-orange-600 hover:text-gray-100"
      >
        Apply Now
      </button>
    </div>
  </div>
</template>
