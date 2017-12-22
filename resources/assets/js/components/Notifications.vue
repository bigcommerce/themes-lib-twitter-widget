<template>
  <div>
    <div v-if="success" class="notification is-primary">
      The changes you've made to your Twitter widget have been saved.
    </div>
    <div v-if="error" class="notification is-danger">
      Sorry there was an error. Please try again and contact us if the problem persists" is all you might do.
    </div>
  </div>
</template>

<script>
  export default {
    props: ['success', 'error'],
    methods: {
      closeNotifications: function () {
        this.$emit('closeNotifications');
      }
    }
  };
</script>
