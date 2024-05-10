<template>
    <div id="app">
        <h1>Welcome to seeker page</h1> 
        <Login role="seeker" />
    </div>
</template>

<script>
import Api from '../helpers/api.ts';
import Login from '../components/Login.vue';

export default {
  name: 'App',

  components: {
    Login
  },

  data() {
    return {
      api: new Api,
    };
  },

  mounted() {
    this.api.checkAuth(true);
  },
};
</script>