<template>
  <div id="app">
    <header>
      <div id="main-logo">Woodpile</div>
    </header>
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
    </div>
    <router-view v-if="state.loaded" />
    <div id="app-messages">
      <div
        v-for="alert in state.alerts"
        v-bind:key="alert.message"
        class="notice"
        :class="alert.type"
      >
        {{ alert.message }}
      </div>
    </div>
  </div>
</template>

<script>
import store from "@/store.js";
export default {
  data() {
    return {
      state: store.state
    };
  },
  beforeCreate() {
    store.loadAllPiles();
  }
};
</script>

<style lang="scss">
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
#main-logo {
  font-size: 2em;
  font-weight: bold;
  text-transform: uppercase;
}
#nav {
  padding: 30px;
  a {
    font-weight: bold;
    color: #2c3e50;
    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
