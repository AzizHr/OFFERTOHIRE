<script>
export default {
  name: "Footer",
};
</script>

<template>
  <footer class="text-gray-50 bg-black pt-6 px-6 mt-20 pb-6">
    <div
      class="md:flex grid md:grid-clos-3 grid-clos-1 justify-between lg:px-28 px-20 md:gap-4 gap-6"
    >
      <div>
        <div>
          <h1 class="text-xl font-bold">
            OFFER-><span class="text-orange-500">HIRE</span>
          </h1>
        </div>
        <p class="mt-2">Hiring & Share Works Platform</p>
      </div>
      <div class="grid gap-6">
        <h1 class="font-bold text-xl">Services</h1>
        <ul class="grid gap-1">
          <li>Free Portfolio</li>
          <li>Get Hired</li>
          <li>Get Inspired</li>
          <li>Find Wanted Profiles</li>
          <li>Hiring</li>
        </ul>
      </div>
      <div class="grid">
        <h1 class="font-bold text-xl">Contact</h1>
        <ul class="grid gap-1">
          <li>offertohire@gmail.com</li>
          <li>+212 6 23 11 10 79</li>
          <li>www.facebookpage.com</li>
        </ul>
      </div>
    </div>
    <hr class="bg-gray-200 mt-6">
    <p class="text-center mt-2 text-sm">2023 offertohire.com      All rights reserved</p>
  </footer>
</template>
