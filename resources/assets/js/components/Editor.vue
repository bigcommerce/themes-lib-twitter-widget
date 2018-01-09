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
    <AccordionMenu :faqs="faqs"></AccordionMenu>
    <crossPromos :promos="promos"></crossPromos>
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
import AccordionMenu from './AccordionMenu.vue';
import CrossPromos from "./CrossPromos.vue";

export default {
  props: [
    'twitterHandle',
    'context',
    'numPosts'
  ],
  components: {
    Notifications,
    SaveBar,
    AccordionMenu,
    CrossPromos
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
      showSaveBar: false,
      faqs: [
        {
          title: 'Lorem ipusm',
          msg: '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
        },
        {
          title: 'Lorem ipsum',
          msg: '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
        },
        {
          title: 'Lorem ipsum',
          msg: '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
        },
        {
          title: 'Lorem ipsum',
          msg: '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
        },
      ],
      promos: [
        {
          title: 'Capacity theme',
          description: 'Capacity sets a new standard for ecommerce navigation and search functionality.',
          link: 'https://www.pixelunion.net/themes/capacity/',
          img: 'https://s3-us-west-2.amazonaws.com/bc-theme-utils/twitter-widget/img/pixelpop.png'
        },
        {
          title: 'PixelPop - Popups & Banners with Exit-Intent',
          description: 'Pixelpop is an all-in-one popup maker by the ecommerce design team PixelUnion',
          link: 'https://www.bigcommerce.com/apps/pixelpop-popups-banners-with-exit-intent/',
          img: 'https://s3-us-west-2.amazonaws.com/bc-theme-utils/twitter-widget/img/pixelpop.png'
        }
      ]
    };
  },
  methods: {
    updateStates: function(data) {
      this.closeNotifications();
      this.showSaveBar = false;
// const success = data[0];

      if (data.success) {
        this.savedHandle = data.handle;
        this.savedNumPosts = data.numPosts;
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
      if (this.handle &&
        (this.handle !== this.savedHandle || this.howManyPosts !== this.savedNumPosts)
      ) {
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
