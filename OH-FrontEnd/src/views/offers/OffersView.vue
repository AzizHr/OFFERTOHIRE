<script>
import Offer from "../../components/Offer.vue";
import getOffers from "../../composables/getOffers";

export default {
  components: {
    Offer,
  },

  setup() {
    const { offers, load } = getOffers();

    load();

    return { offers };
  },
};
</script>

<template>
  <div
    class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-y-12 gap-x-6 justify-items-center mt-20 md:mx-8 mx-4"
  >
    <Offer :offers="offers" />
  </div>
</template>

