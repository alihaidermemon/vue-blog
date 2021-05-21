<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <router-link to="/" class="navbar-brand">
          Laravel Vue JS CRUD Blog - Compasslist
        </router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto"></ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <router-link to="/" class="nav-item nav-link">Home</router-link>
            <router-link to="/blog/add" class="nav-item nav-link"
              >Add Blog</router-link
            >
            <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Test</a>
                </li> -->
          </ul>
        </div>
      </div>
    </nav>
    <br />
    <router-view></router-view>
  </div>
</template>
 
<script>
export default {};
</script>