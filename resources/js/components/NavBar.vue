<template>
    <div>
        <div id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'about' }">About </router-link>
          </li>

          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'contact' }"> Contact</router-link> 
          </li>
        </ul>
      </div>
    </div>
</template>

<script>
</script>