<template>
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
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                    </select>
                </div>
            </div>
            <p class="help">
                This allows you to choose the amount of Twitter posts to display to your customers
            </p>
        </div>

        <div class="field">
            <label for="theme" class="label">Theme</label>
            <div class="control">
                <div class="select is-fullwidth">
                    <select v-model="widgetStyle">
                        <option value="light">Light</option>
                        <option value="dark">Dark</option>
                        <option value="alternate">Alternate</option>
                    </select>
                </div>
            </div>
            <p class="help">
                Choose a particular alternative version of the twitter theme.
            </p>
        </div>
        <div class="control">
            <button v-on:click="saveWidget" class="button">Save</button>
        </div>
    </div>
</template>

<script>
  import axios from 'axios';

  export default {
    props: [
      'twitterHandle',
      'context',
      'numPosts',
      'colorStyle'
    ],
    data: function () {
      return {
        handle: this.twitterHandle,
        storeHash: this.context,
        howMany: this.numPosts,
        widgetStyle: this.colorStyle
      }
    },
    methods: {
      saveWidget: function() {
        axios.post('/save', {
          twitterHandle: this.handle,
          context: this.storeHash,
          numberPosts: this.howMany,
          style: this.widgetStyle
        }).then(function(response){
          if (response.status === 200) {
            console.log(response);
          } else {
            console.log('There was an error saving your configuration');
          }
        })
      }
    }
  }
</script>
