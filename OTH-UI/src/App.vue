<script>
export default {
  computed: {
    showNavbar() {
      return (
        this.$route.name !== "usersignup" &&
        this.$route.name !== "companysignup" &&
        this.$route.name !== "signin" &&
        this.$route.name !== "notfound"
      );
    },

    showFooter() {
      return (
        this.$route.name !== "usersignup" &&
        this.$route.name !== "companysignup" &&
        this.$route.name !== "signin" &&
        this.$route.name !== "notfound" &&
        this.$route.name !== "portfolio"
      );
    },
  },
};
</script>

<template>
  <Navbar v-if="showNavbar" />
  <RouterView />
  <Footer v-if="showFooter" />
</template>
