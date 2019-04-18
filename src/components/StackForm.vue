<template>
  <form id="addStack" @submit.prevent="formSubmit">
    <div>
      <label>Species <input v-model="species" type="text"/></label>
    </div>
    <div>
      <label
        >Date Felled
        <datepicker v-model="dateFelled" :format="customFormatter"></datepicker
      ></label>
    </div>
    <div>
      <label
        >Date Stacked
        <datepicker v-model="dateStacked" :format="customFormatter"></datepicker
      ></label>
    </div>
    <div>
      <label>Stack Width (ft) <input v-model="width" type="number"/></label>
    </div>
    <div>
      <label>Stack Height (ft) <input v-model="height" type="number"/></label>
    </div>
    <div>
      <label>Stack Depth (ft) <input v-model="depth" type="number"/></label>
    </div>
    <div>
      <label
        >Stack Volume (cu ft) <input v-model="volume" type="number" disabled
      /></label>
    </div>
    <div>
      <label>Split? <input type="checkbox" v-model="isSplit"/></label>
    </div>
    <div>
      <label
        >Ready to Burn? <input type="checkbox" v-model="isBurnable"
      /></label>
    </div>
    <input type="submit" value="Submit" :disabled="loading" />
    <div v-if="loading">Loading...</div>
  </form>
</template>

<script>
import axios from "axios";
import Datepicker from "vuejs-datepicker";
import moment from "moment";
import store from "../store.js";

export default {
  name: "StackForm",
  components: {
    Datepicker
  },
  data() {
    return {
      state: store.state,
      errors: [],
      loading: false,
      species: null,
      dateFelled: null,
      dateStacked: new Date(),
      width: null,
      height: null,
      depth: null,
      isSplit: false,
      isBurnable: false
    };
  },
  props: {
    pile: {
      required: true
    }
  },
  computed: {
    volume: function() {
      return this.width * this.height * this.depth;
    }
  },
  methods: {
    customFormatter(date) {
      return moment(date).format("MMM D, YYYY");
    },
    formSubmit() {
      this.loading = true;
      this.validateForm().then(() => {
        this.dataSubmit();
      });
    },
    validateForm() {
      return new Promise(resolve => {
        if (!this.species) this.species = "Unknown";
        if (!this.width) this.width = 1;
        if (!this.height) this.height = 1;
        if (!this.depth) this.depth = 1;

        resolve();
      });
    },
    dataSubmit() {
      const vm = this;
      axios
        .post("/api/stack", {
          pileId: this.pile.id,
          species: this.species,
          dateFelled: this.dateFelled,
          dateStacked: this.dateStacked,
          width: this.width,
          height: this.height,
          depth: this.depth,
          isSplit: this.isSplit,
          isBurnable: this.isBurnable
        })
        .then(response => {
          // JSON responses are automatically parsed.
          console.log(response);

          //get most up-to-date pile for store
          store.addPileById(response.data.stack.pile.id).then(() => {
            vm.loading = false;

            //show success message
            store.addAlert("Stack added!", "success");

            //route back to pile of respective stack
            this.$router.push({
              name: "pile",
              params: { pileId: this.pile.id }
            });
          });
        })
        .catch(e => {
          this.loading = false;
          console.log(e);
          this.errors.push(e);
        });
    }
  }
};
</script>

<style scoped>
label > div {
  display: inline-block;
}
</style>
