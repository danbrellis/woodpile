<template>
  <div v-if="alert.message" class="alert" :class="alert.type">
    <p>
      <button v-on:click="hideAlert()">Close</button>
      {{ alert.message }}
    </p>
  </div>
</template>

<script>
export default {
  name: "Alert",
  props: {
    alert: {
      type: Object,
      required: true
    },
    id: {
      required: true
    }
  },
  methods: {
    hideAlert() {
      // Tell the parent to clear the message
      this.$emit("remove-alert", this.id);
    }
  },
  mounted() {
    setTimeout(this.hideAlert, 5000);
  }
};
</script>

<style scoped></style>
