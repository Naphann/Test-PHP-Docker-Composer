import Vue from 'vue'
import App from './app.vue'

// new Vue({
//   el: '#console-app',
//   data: {
//     message: "hello world"
//   }
// });

new Vue({
  el: '#console-app',
  components: {
    App
  },
  data: {
    message: "hello world"
  }
});

