<script setup>
import { reactive } from 'vue'
import AppLayout from '../../Layouts/App.vue'
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

defineProps({
   errors: Object,
   user: Object,
   countries: Object,
   userCountry: Object
 })

const form = reactive({
  name: null,
  address: null,
  email: null,
  image: null,
  mobile: null,
  country: null,
})

function update() {
  router.post('/users/update', form)
} 

function renderImage(imagename){
    return '/uploads/'+imagename;
}
</script>

<template>
<AppLayoout>
    <br><br>

<div class="row">
  <div class="col-1 col-md-3"></div>
  <div class="col-10 col-md-6">
    <h2 class="fw-bold">Update your profile</h2>
    <form @submit.prevent="update" class="border mt-4 p-2 p-md-4">

       <div class="row">

        
        <div class="col-12 mb-3">
            <img :src=renderImage(user.image) height="54px" width="54px" class="rounded-circle" />
            <br><br>
            <input type="file" class="form-control rounded-0" id="image"  @input="form.image = $event.target.files[0]" placeholder="image">
            <small class="text-danger ms-1" v-if="errors.image">{{ errors.image }}</small>
        </div>

        <div class="col-12 mb-3">
            <label for="name" class="form-label">{{ user.name }}</label>
            <input type="text" class="form-control rounded-0" id="name" v-model="form.name" placeholder="name">
            <small class="text-danger ms-1" v-if="errors.name">{{ errors.name }}</small>
        </div>

      <div class="col-12 mb-3">
            <label for="email" class="form-label">{{ user.email }}</label>
            <input type="text" class="form-control rounded-0" id="email" v-model="form.email" placeholder="email">
            <small class="text-danger ms-1" v-if="errors.email">{{ errors.email }}</small>
        </div>

        <div class="col-12 mb-3">
            <label for="mobile" class="form-label">{{ user.mobile }}</label>
            <input type="phone" class="form-control rounded-0" id="mobile" v-model="form.mobile" placeholder="mobile">
            <small class="text-danger ms-1" v-if="errors.mobile">{{ errors.mobile }}</small>
        </div>

        <div class="col-12 mb-3">
            <label for="address" class="form-label">{{ user.address }}</label>
            <input type="text" class="form-control rounded-0" id="address" v-model="form.address" placeholder="address">
            <small class="text-danger ms-1" v-if="errors.address">{{ errors.email }}</small>
        </div>
        <div class="col-12 ">
          <div class="mb-3">
          <label for="service" class="form-label"><span class="fw-bold">Country:</span> {{ userCountry.name }}</label>
          <select class="form-select" v-model="form.country">
          <option v-for="country in countries" id="country" :value=country.name >{{ country.name }}</option>
        </select>
      </div>
        </div>
       </div>
        <br>
       <div class="container border-top">
        
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-dark rounded-0">Update</button>
        </div>
       </div>
       <br>
     
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
  <div class="col-1 col-md-3"></div>
</div>
</AppLayoout>
</template>