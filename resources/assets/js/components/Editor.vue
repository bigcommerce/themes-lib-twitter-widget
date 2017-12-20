<template>
  <div>
    <notifications
      v-bind:error="error"
      v-bind:success="success"
      v-on:close-notifications="closeNotifications"
    >
    </notifications>
    <h2 class="section-title">Twitter Settings</h2>
    <div class="container">
      <input name="store-hash" type="hidden" v-model="storeHash">
      <div class="field">
        <label for="handle" class="label">
          Twitter handle
        </label>
        <div class="control">
          <input
            name="handle"
            class="input"
            v-model="handle"
            placeholder="@username"
          >
            <p class="help">
              Please go ahead and enter your Twitter handle.
            </p>
        </div>

      </div>
      <div class="field">
        <label for="number-posts" class="label">Number of Posts</label>
        <div class="control">
          <select class="select" name="number-posts" v-model="howMany">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
          <p class="help">
            This allows you to choose the amount of Twitter posts to display to your customers
          </p>
        </div>
      </div>
    </div>
    <saveBar
      v-bind:handle="handle"
      v-bind:store-hash="storeHash"
      v-bind:how-many="howMany"
      v-on:widget-saved="updateStates"
    >
    </saveBar>
  </div>
</template>

<script>
import Notifications from "./Notifications.vue";
import SaveBar from "./SaveBar.vue";

export default {
  props: [
    'twitterHandle',
    'context',
    'numPosts'
  ],
  components: {
    Notifications,
    SaveBar
  },
  data: function() {
    return {
      handle: this.twitterHandle,
      storeHash: this.context,
      howMany: this.numPosts,
      success: false,
      error: false
    };
  },
  methods: {
    updateStates: function(success) {
      this.closeNotifications();

      if (success) {
        this.success = true;
      } else {
        this.error = true;
      }
    },
    closeNotifications: function() {
      this.success = false;
      this.error = false;
    }
  }
};
</script>
