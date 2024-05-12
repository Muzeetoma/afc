<script setup>
import AdminLayout from '../../../Layouts/Auth.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
   services: Object,
   companyId: Number
 })
</script>

<template>
  <AdminLayout>
    <br><br>

    <div class="row">
      <div class="col-12 col-md-10">

        <div class="container">
        <div class="d-flex justify-content-between">
          <div class="p-1">
            <h2 class="fw-bold">Your Services</h2>
          </div>
          <div class="p-1">
            <Link :href="route('admin.services.create.view',companyId)" class="btn btn-dark rounded-0 mt-2 py-1 px-4">
                    create
              </Link>
          </div>
        </div>
        <div class="row mt-4">
        <div class="col-12 mb-3"  v-for="service in services">
          <div class="container border-bottom rounded-1">
            
            <div class="row">
              <div class="col-12">
              <div class="d-flex mt-3">
              <div class="p-1 ms-3"> 
                <small class="mt-3 mt-md-4 mb-0">{{ service.name }}</small>
              </div>
            </div>
              </div>
              <div class="col-12">

              <div class="d-flex justiify-content-end mt-4">
                <div class="p-1">
                  <Link :href="route('admin.services.update.view',service.id)" class="btn btn-outline-dark rounded-0 mt-2 py-1">
                    update
                  </Link>
                </div>
                <div class="p-1">
                  <Link :href="route('admin.services.delete',service.id)" method="delete" class="btn btn-outline-danger rounded-0 mt-2 py-1">
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

    <center>
      <Link :href="route('admin.company.view')" class="btn btn-outline-none rounded-0 mt-2 py-1">
                   < back
    </Link>
    </center>

</AdminLayout>
</template>