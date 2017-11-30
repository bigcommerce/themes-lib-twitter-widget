<template>
  <div>
    <input disabled v-model="storeHash" />
    <input v-model="handle" />
    <select v-model="howMany">
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
      <option value="4">Four</option>
    </select>
    <select v-model="widgetStyle">
      <option value="light">Light</option>
      <option value="dark">Dark</option>
      <option value="alternate">Alternate</option>
    </select>
    <button v-on:click="saveWidget">Save</button>
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
