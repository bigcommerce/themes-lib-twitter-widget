<template>
  <div class="control">
    <button
      @click="saveWidget"
      :class="{ 'button' : true, 'is-loading' : internalSubmitInProgress}"
      :disabled="internalSubmitInProgress"
    >
      Save
    </button>
  </div>
</template>

<script>
  import axios from "axios";

  export default {
    props: ['handle', 'storeHash', 'howMany'],
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
          numberPosts: this.howMany,
        })
        .then(
          function(response) {
            this.internalSubmitInProgress = false;
            window.scrollTo(0, 0);
            this.$emit('widget-saved', true);
        }.bind(this))
        .catch(function(error) {
          this.internalSubmitInProgress = false;
          this.$emit('widget-saved', false);
          window.scrollTo(0, 0);
        }.bind(this));
      }
    }
  }
</script>
