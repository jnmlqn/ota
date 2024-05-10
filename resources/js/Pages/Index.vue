<script setup lang="ts">  
import { ref } from 'vue';  
import { Link } from '@inertiajs/vue3';  
  
const greeting = ref('Welcome to OTA');  
  
</script>

<template>  
    <h1>{{ greeting }}</h1>  
    <p><Link href="/employer">Employer site</Link></p>
    <p><Link href="/seeker">Seeker site</Link></p>
</template>