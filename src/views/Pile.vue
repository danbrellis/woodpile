<template>
  <div class="home">
    <Pile :pile="state.piles[state.activePile]" />
  </div>
</template>

<script>
// @ is an alias to /src
import Pile from "@/components/Pile.vue";
import store from "@/store.js";

export default {
  name: "pile",
  data() {
    return {
      state: store.state,
      pile: {}
    };
  },
  components: {
    Pile
  },
  created() {
    let pileId = Number(this.$route.params.pileId);
    store.setActivePile(pileId);
  }
};
</script>
