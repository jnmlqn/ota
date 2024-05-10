<template>
    <div id="app">
        <h1>Welcome to employer page</h1> 
        <Login role="employer" />
    </div>
</template>

<script>
import Login from '../components/Login.vue';

export default {
  name: 'App',
  components: {
    Login
  }
};
</script>