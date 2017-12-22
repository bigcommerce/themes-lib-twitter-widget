<template>
  <div>
    <notifications
      :error="error"
      :success="success"
      @closeNotifications="closeNotifications"
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
          <select class="select" name="number-posts" v-model="howManyPosts">
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
      v-if="showSaveBar"
      :handle="handle"
      :storeHash="storeHash"
      :numPosts="howManyPosts"
      @onWidgetSaved="updateStates"
      @formReset="resetForm"
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
      savedHandle: this.twitterHandle,
      howManyPosts: this.numPosts,
      savedNumPosts: this.numPosts,
      storeHash: this.context,
      success: false,
      error: false,
      showSaveBar: false
    };
  },
  methods: {
    updateStates: function(data) {
      this.closeNotifications();
      this.showSaveBar = false;

      if (success) {
        this.savedHandle = data[0];
        this.savedNumPosts = data[1];
        this.success = true;
      } else {
        this.error = true;
      }
    },
    closeNotifications: function() {
      this.success = false;
      this.error = false;
    },
    resetForm: function() {
      this.success = false;
      this.error = false;
      this.handle = this.savedHandle;
      this.howManyPosts = this.savedNumPosts;
      this.showSaveBar = false;
    },
    toggleSaveBar: function() {
      if (this.handle !== this.savedHandle || this.howManyPosts !== this.savedNumPosts) {
        this.showSaveBar = true;
      } else {
        this.showSaveBar = false;
      }
    }
  },
  watch: {
    handle: function() {
      this.toggleSaveBar();
    },
    howManyPosts: function() {
      this.toggleSaveBar();
    }
  }
};
</script>
