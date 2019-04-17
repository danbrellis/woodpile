<template>
  <div class="hello">
    <h1>
      Add New Stack<span v-if="Object.keys(pile).length">
        to {{ pile.name }}</span
      >
    </h1>
    <StackForm :pile="pile"></StackForm>
  </div>
</template>

<script>
import StackForm from "../components/StackForm";
import store from "@/store.js";

export default {
  components: {
    StackForm
  },
  name: "AddStack",
  data() {
    return {
      state: store.state,
      pile: {},
      errors: []
    };
  },
  props: {
    pileId: {
      required: true
    }
  },
  created() {
    let pileId = Number(this.$route.params.pileId);
    store.setActivePile(pileId).then(() => {
      this.pile = store.getActivePile();
    });
  }
};
</script>

<style scoped></style>
