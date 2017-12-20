<template>
  <div>
    <div v-if="success" class="notification is-primary">
      <button class="delete" @click="closeNotifications" />
      Successfully saved!
    </div>
    <div v-if="error" class="notification is-danger">
      <button class="delete" @click="closeNotifications" />
      Sorry there was an error
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
