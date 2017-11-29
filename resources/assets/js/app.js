import Editor from './components/Editor.vue';
import Vue from 'vue';

Vue.component('editor', Editor);

new Vue({
  el: '#widget-editor'
});

