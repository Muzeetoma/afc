<script setup>
import Layout from '../../Layouts/App.vue'
import { Head } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

defineProps({
   company: Object
 })
</script>

<template>
  <Layout>
    <Head title="Company" />
   
    <div class="container border-bottom">
    <br><br>
    <h1 class="fw-bold">{{ company.name }}</h1>
    <span class="ms-2 fs-6 text-secondary fw-light"><i class="bi bi-globe"></i> {{ company.country.name }}</span>
    <span class="ms-2 fs-6 text-secondary"> <i class="bi bi-dot"></i> </span>
    <span class="ms-2 text-secondary fs-6 fw-light"><i class="bi bi-envelope"></i> {{ company.email }}</span>
    <br><br>
    </div>
     <br>
    <div class="container mt-3">
      <h4 class="fw-bold">Services</h4>
     <div class="row gx-5">
      <div class="col-12 col-md-7">
        <ul class="list-group list-group-flush list-group-numbered">
         <li class="list-group-item mt-2" v-for="service in company.services">{{ service.name }}</li>
      </ul>
      </div>
      <div class="col-12 col-md-1"></div>
      <div class="col-12 col-md-4">
       <div class="container border rounded-1 p-3">
        <h4 class="fw-bold text-dark">Managed By</h4>
        <div class="d-flex mt-3">
            <div class="p-2">
              <h1 class="py-1 px-3 bg-dark text-light rounded-3">A</h1>
            </div>
            <div class="p-1 ms-3"> 
              <h6 class="mt-2 mb-0 fw-bold">{{  company.user.name }}</h6>
              <h6 class="fw-light text-secondary">{{ company.user.email }}</h6>

              <h6 class="fw-light text-secondary mt-3"><i class="bi bi-geo text-dark"></i> {{ company.user.address }}</h6>
              <h6 class="fw-light text-secondary mt-3"><i class="bi bi-phone text-dark"></i> {{ company.user.mobile }}</h6>
            </div>
          </div>

       </div>
      </div>
     </div>
    </div>
  </Layout>
</template>