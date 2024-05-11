<script setup>
import { Head } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
   errors: Object,
 })

const form = reactive({
  email: null,
  password: null,
})

function login() {
  router.post('/login', form)
}
</script>

<template>
    <br><br>

    <div class="row">
      <div class="col-1 col-md-4"></div>
      <div class="col-10 col-md-4">
        <h2 class="fw-bold">Login</h2>

        <form @submit.prevent="login" class="border mt-4 p-2 p-md-4">
  
          <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control rounded-0" id="email" v-model="form.email" placeholder="email">
                <small class="text-danger ms-1" v-if="errors.email">{{ errors.email }}</small>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control rounded-0" id="password" v-model="form.password" placeholder="password">
                <small class="text-danger ms-1" v-if="errors.password">{{ errors.password }}</small>
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" v-model="form.remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                </label>
            </div>
          
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-dark rounded-0">Login</button>
            </div>
            <br>
         
         <div class="d-flex justify-content-center">
            <div class="p-1"><Link href="/" class="nav-link">Home</Link> </div>
            <div class="p-1"><i class="bi bi-dot"></i></div>
            <div class="p-1"><Link :href="route('signup.view')" class="nav-link">Signup</Link></div>
         </div>
        </form>
        <div class="container mt-3 p-2 text-center border rounded-3" v-if="$page.props.flash.error">
                    <i class="bi bi-exclamation-circle text-danger me-2"></i>
                    <small class="text-danger"> {{ $page.props.flash.error }} </small>
         </div>
      </div>
      <div class="col-1 col-md-4"></div>
    </div>
</template>