<script></script>

<template>
  <div
    class="md:w-1/2 w-auto md:mx-auto mx-4 grid gap-8 mt-20 rounded shadow-md md:py-10 py-4 md:px-6 px-2"
  >
    <h1 class="text-2xl font-bold">Publish a new offer</h1>
    <form class="grid gap-4">
      <div class="grid gap-1">
        <label>Image</label>
        <input
          name="image"
          class="py-3 pl-3 rounded border-2 border-orange-500"
          type="file"
        />
      </div>
      <div class="grid gap-1">
        <label>Body</label>
        <textarea
          class="py-3 pl-3 rounded border-2 border-orange-500"
          placeholder="What are thinking of..."
          name="body"
          cols="15"
          rows="6"
        ></textarea>
      </div>
      <button
        class="py-3 px-6 bg-orange-500 hover:bg-orange-600 font-bold text-gray-100 rounded justify-self-start"
      >
        Publish
      </button>
    </form>
  </div>
</template>
