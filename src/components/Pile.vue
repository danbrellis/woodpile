<template>
  <div class="hello">
    <h1>{{ pile.name }}</h1>
    <router-link
      v-if="Object.entries(pile).length"
      :to="{ name: 'addStack', params: { pileId: pile.id } }"
      >Add stack</router-link
    >
    <div class="stacks" v-if="pile.stacks && pile.stacks.length">
      <div v-for="stack in pile.stacks" v-bind:key="stack.id">
        {{ stack.species }}<br />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Pile",
  data() {
    return {
      errors: []
    };
  },
  props: {
    pile: {
      type: Object,
      required: true
    }
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
