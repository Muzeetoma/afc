<script setup>
import Layout from '../Layouts/App.vue'
import { Head } from '@inertiajs/vue3'

defineProps({ companies: Object })
</script>

<template>
  <Layout>
    <Head title="Welcome" />
    <br><br><br><br>
  <p> your {{ companies }} </p>
  </Layout>
</template>