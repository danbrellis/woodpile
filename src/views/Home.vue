<template>
  <div class="home">
    <Piles msg="Welcome to Your Vue.js App" />
  </div>
</template>

<script>
// @ is an alias to /src
import Piles from "@/components/Piles.vue";

export default {
  name: "home",
  components: {
    Piles
  }
};
</script>
