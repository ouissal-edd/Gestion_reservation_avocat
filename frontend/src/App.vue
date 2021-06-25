<template>
  <headerApp />
  <router-view />
</template>
<script>
import headerApp from "@/components/global/headerApp.vue";

export default {
  name: "App",
  components: {
    headerApp,
  },
};
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #999999;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #999999;
    text-decoration: none;

    &.router-link-exact-active {
      color: #60c1ad;
    }
  }
}
</style>
