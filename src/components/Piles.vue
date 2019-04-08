<template>
  <div class="hello">
    <h1>Piles</h1>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Piles",
  data() {
    return {
      piles: [],
      errors: []
    };
  },
  props: {
    msg: String
  },
  created() {
    axios
      .get(`http://localhost:8080/index.php`)
      .then(response => {
        // JSON responses are automatically parsed.
        this.piles = response.data;
      })
      .catch(e => {
        this.errors.push(e);
      });

    // async / await version (created() becomes async created())
    //
    // try {
    //   const response = await axios.get(`http://jsonplaceholder.typicode.com/posts`)
    //   this.posts = response.data
    // } catch (e) {
    //   this.errors.push(e)
    // }
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
