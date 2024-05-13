<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const authUser = computed(() => page.props.auth.user)

function getFirstWord(names){
  let firstName = names.split(" ");
  return firstName[0];
}

</script>

<template>
  <main>
    <header>
      <nav class="navbar navbar-expand-lg m-auto bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand fw-bold" href="#">AFC</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <Link href="/" class="nav-link">Home</Link>
              </li>
              <li class="nav-item">
                <Link v-if="authUser" :href="route('admin.company.view')" class="nav-link me-4">Admin</Link>
              </li>
              <li class="nav-item">
                <Link v-if="authUser" :href="route('users.update.view')" class="nav-link">Profile</Link>
              </li>
            </ul>
            <div class="d-flex" role="search">
                <Link v-if="!authUser" :href="route('login.view')" class="nav-link me-3">Login</Link>
                <Link v-if="!authUser" :href="route('signup.view')" class="nav-link me-3">Register</Link>
                <span v-if="authUser" class="fw-bold me-3"><i class="bi bi-person-fill fw-bold"></i> {{ getFirstWord(authUser.name)}}</span>
                <Link v-if="authUser" href="/logout" method="post" class="nav-link me-4 text-danger">Logout</Link>
            </div>
          </div>
        </div>
      </nav>

    </header>
    <article>

      <slot />
    </article>
  </main>
</template>