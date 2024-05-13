<script setup>
import AppLayout from '../../../Layouts/App.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
   companies: Object
 })
 function getFirstLetter(names){
  return names.charAt(0)
}
</script>

<template>
  <AppLayout>
    <br><br>

    <div class="row">
      <div class="col-12 col-md-10">

        <div class="container">
        <div class="d-flex justify-content-between">
          <div class="p-1">
            <h2 class="fw-bold">Your Companies</h2>
          </div>
          <div class="p-1" v-if="companies.length !== 0">
            <Link :href="route('admin.company.create.view')" class="btn btn-dark rounded-0 mt-2 py-1 px-4">
                    create
              </Link>
          </div>
        </div>

        <div v-if="companies.length === 0 " class="container py-4 mb-3" >
          <br><br>
          <center>
            <h1>You have no companies</h1>
            <Link :href="route('admin.company.create.view')" class="btn btn-outline-dark rounded-0 mt-4 py-2 px-4">
                    Create a new company
              </Link>
          </center>
        </div>
        
        <div class="row mt-4">
        <div class="col-12 mb-3" v-for="company in companies">
          <div class="container border-top rounded-1">
            
            <div class="row">
              <div class="col-12 col-md-9">
                <div class="d-flex mt-3">
              <div class="p-2">
                <h1 class="py-1 px-3 bg-dark text-light rounded-3">{{ getFirstLetter(company.name) }}</h1>
              </div>
              <div class="p-1 ms-3"> 
                <h6 class="mt-3 mt-md-4 mb-0 fw-bold">{{ company.name }}</h6>
              </div>
            </div>
              </div>
              <div class="col-12 col-md-3">

              <div class="d-flex justiify-content-end mt-4">
                <div class="p-1">
                  <Link :href="route('admin.services.view',company.id)" class="btn btn-outline-dark rounded-0 mt-2 py-1">
                    services
                  </Link>
                </div>
                <div class="p-1">
                  <Link :href="route('admin.company.update.view',company.id)" class="btn btn-outline-dark rounded-0 mt-2 py-1">
                    update
                  </Link>
                </div>
                <div class="p-1">
                  <Link :href="route('admin.company.delete',company.id)" method="delete" class="btn btn-outline-danger rounded-0 mt-2 py-1">
                    delete
                  </Link>
                </div>
            </div>
            </div>
            </div>

            <br>
          </div>
        </div>
      </div>
    </div>

      </div>
      <div class="col-12 col-md-2"></div>
    </div>

</AppLayout>
</template>