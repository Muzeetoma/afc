<script setup>
import AdminLayout from '../../../Layouts/Auth.vue'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

defineProps({
   errors: Object,
   companies: Object,
   companyId: Number
 })

const form = reactive({
  service: null,
  company_id: null,
})

function submit() {
  router.post('/admin/services/create', form)
}
</script>

<template>
  <AdminLayout>
    <br><br>

    <div class="row">
      <div class="col-1 col-md-4"></div>
      <div class="col-10 col-md-4">
        <h2 class="fw-bold">Create services</h2>

        <form @submit.prevent="submit" class="border mt-4 p-2 p-md-4">
          <div class="mb-3">
              <label for="service" class="form-label">Company</label>
              <select class="form-select" v-model="form.company_id">
              <option v-for="company in companies" id="company_id" :value=company.id >{{ company.name }}</option>
            </select>
          </div>

            <div class="mb-3">
                <label for="service" class="form-label">Service</label>
                <input type="text" class="form-control rounded-0" id="service" v-model="form.service" placeholder="Enter company service">
                <small class="text-danger ms-1" v-if="errors.service">{{ errors.service }}</small>
            </div>
          
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-dark rounded-0">Submit</button>
            </div>
        </form>
        <div class="container mt-3 p-2 text-center border rounded-3" v-if="$page.props.flash.error">
                    <i class="bi bi-exclamation-circle text-danger me-2"></i>
                    <small class="text-danger"> {{ $page.props.flash.error }} </small>
         </div>
         <center> 
            <Link :href="route('admin.services.view',companyId)" class="btn btn-outline-none rounded-0 mt-2 py-1">
                   < back
          </Link>
        </center>
      </div>
      <div class="col-1 col-md-4"></div>
    </div>

</AdminLayout>
</template>