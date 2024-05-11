<script setup>
import { Head } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
   errors: Object,
   countries: Object
 })

const form = reactive({
  name: null,
  address: null,
  email: null,
  password: null,
  mobile: null,
  country: null,
  password_confirmation: null,
})

function signup() {
  router.post('/signup', form)
}
</script>

<template>
    <br><br>

    <div class="row">
      <div class="col-1 col-md-3"></div>
      <div class="col-10 col-md-6">
        <h2 class="fw-bold">Register</h2>
        <form @submit.prevent="signup" class="border mt-4 p-2 p-md-4">

           <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control rounded-0" id="name" v-model="form.name" placeholder="name">
                <small class="text-danger ms-1" v-if="errors.name">{{ errors.name }}</small>
            </div>
  
          <div class="col-12 col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control rounded-0" id="email" v-model="form.email" placeholder="email">
                <small class="text-danger ms-1" v-if="errors.email">{{ errors.email }}</small>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="phone" class="form-control rounded-0" id="mobile" v-model="form.mobile" placeholder="mobile">
                <small class="text-danger ms-1" v-if="errors.mobile">{{ errors.mobile }}</small>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control rounded-0" id="address" v-model="form.address" placeholder="address">
                <small class="text-danger ms-1" v-if="errors.address">{{ errors.email }}</small>
            </div>
            <div class="col-12 ">
              <div class="mb-3">
              <label for="service" class="form-label">Country</label>
              <select class="form-select" v-model="form.country">
              <option v-for="country in countries" id="country" :value=country.name >{{ country.name }}</option>
            </select>
          </div>
            </div>
           </div>
            <br>
           <div class="container border-top">
            <br>
            <div class="row">
              <div class="col-12 col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control rounded-0" id="password" v-model="form.password" placeholder="password">
                <small class="text-danger ms-1" v-if="errors.password">{{ errors.password }}</small>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">Confirm password</label>
                <input type="password_confirmation" class="form-control rounded-0" id="password_confirmation" v-model="form.password_confirmation" placeholder="Confirm password">
                <small class="text-danger ms-1" v-if="errors.password_confirmation">{{ errors.password_confirmation }}</small>
            </div>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-dark rounded-0">Register</button>
            </div>
           </div>
           <br>
         
           <div class="d-flex justify-content-center">
              <div class="p-1"><Link href="/" class="nav-link">Home</Link> </div>
              <div class="p-1"><i class="bi bi-dot"></i></div>
              <div class="p-1"><Link :href="route('login.view')" class="nav-link">Login</Link></div>
           </div>
            
          
        </form>
        <div class="container mt-3 p-2 text-center border rounded-3" v-if="$page.props.flash.error">
                    <i class="bi bi-exclamation-circle text-danger me-2"></i>
                    <small class="text-danger"> {{ $page.props.flash.error }} </small>
         </div>
      </div>
      <div class="col-1 col-md-3"></div>
    </div>
</template>