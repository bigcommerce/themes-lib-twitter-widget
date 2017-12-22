<template>
  <div class="save-bar">
    <button
      @click="resetForm"
      class="button button-secondary"
    >
      Cancel
    </button>
    <button
      @click="saveWidget"
      :class="{ 'button button-primary' : true, 'is-loading' : internalSubmitInProgress}"
      :disabled="internalSubmitInProgress"
    >
      <span v-if="internalSubmitInProgress">Saving...</span>
      <span v-if="!internalSubmitInProgress">Save</span>
    </button>
  </div>
</template>

<script>
  import axios from "axios";

  export default {
    props: ['handle', 'storeHash', 'numPosts'],
    data: function() {
      return {
        internalSubmitInProgress: false
      }
    },
    methods: {
      saveWidget: function() {
        this.internalSubmitInProgress = true;
        axios.post("/save", {
          twitterHandle: this.handle,
          context: this.storeHash,
          numberPosts: this.numPosts,
        })
        .then(
          function(response) {
            this.internalSubmitInProgress = false;
            window.scrollTo(0, 0);
            this.$emit('onWidgetSaved', [this.handle, this.numPosts]);
        }.bind(this))
        .catch(function(error) {
          this.internalSubmitInProgress = false;
          this.$emit('onWidgetSaved', false);
          window.scrollTo(0, 0);
        }.bind(this));
      },
      resetForm: function() {
        this.$emit('formReset');
      }
    }
  }
</script>
