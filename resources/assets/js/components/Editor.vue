<template>
  <div>
    <div class="merchant-branding">
      <img
        src="https://s3-us-west-2.amazonaws.com/bc-theme-utils/twitter-widget/img/merchant_logo.png"
        alt="Merchant Logo"
      />
    </div>
    <div v-if="success" class="notification is-primary">
      <button class="delete" @click="closeNotifications"></button>
      Successfully saved!
    </div>
    <div v-if="error" class="notification is-danger">
      <button class="delete" @click="closeNotifications"></button>
      Sorry there was an error
    </div>
    <div class="container">
      <h1 class="is-title">
        Your Merchant Twitter Feed
      </h1>
    </div>
    <div class="container">
      <input
          name="store-hash"
          type="hidden"
            v-model="storeHash"
      />
      <div class="field">
        <label for="handle" class="label">Twitter handle</label>
        <div class="control">
          <input
            name="handle"
            class="input"
            v-model="handle"
            placeholder="@username"
           />
        </div>
        <p class="help">
          Please go ahead and enter your Twitter handle.
        </p>
      </div>
      <div class="field">
        <label for="number-posts" class="label">Number of Posts</label>
        <div class="control">
          <div class="select is-fullwidth">
            <select name="number-posts" v-model="howMany">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
        </div>
        <p class="help">
          This allows you to choose the amount of Twitter posts to display to your customers
        </p>
      </div>
      <div class="control">
          <button
          @click="saveWidget"
          :class="{ 'button' : true,  'is-loading' : submitInProgress }"
          :disabled='submitInProgress'
        >
          Save
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ['twitterHandle', 'context', 'numPosts'],
  data: function() {
    return {
      handle: this.twitterHandle,
      storeHash: this.context,
      howMany: this.numPosts,
      submitInProgress: false,
      success: false,
      error: false
    };
  },
  methods: {
    saveWidget: function() {
      this.submitInProgress = true;
      this.success = false;
      this.error = false;
      axios
        .post("/save", {
          twitterHandle: this.handle,
          context: this.storeHash,
          numberPosts: this.howMany,
        })
        .then(
          function(response) {
            this.submitInProgress = false;
            this.success = true;
            window.scrollTo(0, 0);
            console.log(response);
        }.bind(this))
        .catch(function(error) {
          this.submitInProgress = false;
          this.error = true;
          window.scrollTo(0, 0);
          console.log(error);
        }.bind(this));
    },
    closeNotifications: function () {
      this.success = false;
      this.error = false;
    }
  }
};
</script>
