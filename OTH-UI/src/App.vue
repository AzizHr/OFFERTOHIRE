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
        this.$route.name !== "portfolio" &&
        this.$route.name !== "admin.users" &&
        this.$route.name !== "admin.posts" &&
        this.$route.name !== "admin.offers" &&
        this.$route.name !== "myapplications"
      );
    },
  },
};
</script>

<template>
<div class="min-h-screen flex flex-col">
  <Navbar v-if="showNavbar" />
  <RouterView />
  <Footer class="mt-auto" v-if="showFooter" />
</div>
</template>
