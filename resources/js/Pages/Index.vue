<script setup>
import Layout from '../Layouts/App.vue'
import { Head } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

defineProps({ 
  companies: Object
 })
</script>

<template>
  <Layout>
    <Head title="Home" />

    <div class="container">
    <br><br>
    <h1 class="fw-bold">Companies</h1>
    <br><br>

      <div class="row">
      <div class="col-12 col-md-4 mb-3"  v-for="company in companies.data">
        <div class="container border rounded-1">
          <div class="d-flex mt-3">
            <div class="p-2">
              <h1 class="py-1 px-3 bg-dark text-light rounded-3">C</h1>
            </div>
            <div class="p-1 ms-3"> 
              <h6 class="mt-2 mb-0 fw-bold">{{ company.name }}</h6>
              <h6 class="fw-light fs-6 text-secondary"><i class="bi bi-geo text-dark"></i>  {{ company.country.name }}</h6>
              <Link :href="route('company.get',company.id)" class="btn btn-outline-dark rounded-0 mt-2 py-1">
                View details
              </Link>
            </div>
          </div>
          <br>
        </div>
      </div>
     </div>
   
     <br><br>
      <div class="container position-absolute border-top" v-if="companies.prev_page_url || companies.next_page_url"> 
        <div class="d-flex justify-content-center">
        <div class="p-1" >
              <Link v-if="companies.prev_page_url" :href="companies.prev_page_url" class="btn btn-outline-dark rounded-0 mt-2 py-1 px-4">
                < Prev
                </Link>
        </div>
        <div class="p-1" >
            <Link v-if="companies.next_page_url" :href="companies.next_page_url" class="btn btn-outline-dark rounded-0 mt-2 py-1 px-4">
               Next >
              </Link>
        </div>
      </div>
      </div>

    </div>
  </Layout>
</template>