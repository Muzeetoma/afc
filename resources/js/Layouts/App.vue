<script setup>
import { Link } from '@inertiajs/vue3'
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
                <Link :href="route('login.view')" class="nav-link">Login</Link>
              </li>
              
              <li class="nav-item">
                <Link :href="route('signup.view')" class="nav-link">Signup</Link>
              </li>
              <li class="nav-item">
                <Link :href="route('company.view')" class="nav-link me-4">Admin</Link>
              </li>
            </ul>
            <div class="d-flex" role="search">
              <Link href="/logout" method="post" class="nav-link me-4">Logout</Link>
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