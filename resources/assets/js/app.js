import Editor from './components/Editor.vue';
import './bootstrap';
import Vue from 'vue';

Vue.component('editor', Editor);

new Vue({
  el: '#widget-editor'
});

