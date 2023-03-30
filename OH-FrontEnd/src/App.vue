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
  },
};
</script>

<template>
  <Navbar v-if="showNavbar" />
  <RouterView />
</template>
