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
    <div class="alerts" id="app-alerts">
      <alert
        v-for="(value, key) in state.alerts"
        :alert="value"
        :id="key"
        v-bind:key="key"
        @remove-alert="removeAlert"
      ></alert>
    </div>
  </div>
</template>

<script>
import store from "@/store.js";
import alert from "@/components/Alert";
export default {
  components: {
    alert
  },
  data() {
    return {
      state: store.state
    };
  },
  beforeCreate() {
    store.loadAllPiles();
  },
  methods: {
    removeAlert(alertId) {
      store.removeAlert(alertId);
    }
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
