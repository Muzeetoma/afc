<script setup>
import AppLayout from '../../../Layouts/App.vue'
import { Link } from '@inertiajs/vue3'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
   errors: Object,
   companies: Object
 })

const form = reactive({
  name: null,
  email: null,
})

function submit() {
  router.post('/admin/company', form)
}
</script>

<template>
  <AppLayout>
    <br><br>

    <div class="row">
    <div class="col-12 col-md-4 "></div>  
      <div class="col-12 col-md-4">
        <div class="container">
            <h2 class="fw-bold mt-2">Create Company</h2>
          <form @submit.prevent="submit" class="border mt-4 p-2 p-md-4">
              <div class="mb-3">
                  <label for="name" class="form-label">Company name</label>
                  <input type="text" class="form-control rounded-0" id="name" v-model="form.name" placeholder="Enter company name">
                  <small class="text-danger ms-1" v-if="errors.name">{{ errors.name }}</small>
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Company email</label>
                  <input type="email" class="form-control rounded-0" id="email" v-model="form.email" placeholder="Enter company email">
                  <small class="text-danger ms-1" v-if="errors.email">{{ errors.email }}</small>
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
            <Link :href="route('admin.company.view')" class="btn btn-outline-none rounded-0 mt-2 py-1">
                   < back
          </Link>
        </center>
        </div>
      </div>
      <div class="col-12 col-md-4 "></div>
    </div>

</AppLayout>
</template>