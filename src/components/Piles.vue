<template>
  <div class="hello">
    <h1>Piles</h1>
    <div class="piles">
      <div v-for="pile in state.piles" :key="pile.id" class="pile">
        <router-link :to="{ name: 'pile', params: { pileId: pile.id } }">{{
          pile.name
        }}</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import store from "@/store.js";

export default {
  name: "Piles",
  data() {
    return {
      state: store.state,
      errors: []
    };
  },
  props: {
    msg: String
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
