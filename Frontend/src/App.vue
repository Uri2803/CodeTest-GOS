<script setup>
import { ref, onMounted, computed } from 'vue'

import { RouterLink, RouterView, useRouter, useRoute } from 'vue-router'
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'bootstrap-icons/font/bootstrap-icons.css';

const router = useRouter()
const route = useRoute()

function logout() {
  localStorage.removeItem('token')
  localStorage.removeItem('user')
  user.value = null
  router.push('/login')
}
const user = ref(null);
const userName = '';
onMounted(() => {
  const storedUser = localStorage.getItem('user');
  
  user.value = storedUser ? JSON.parse(storedUser) : null;
  const userName =  user.value;
});


</script>

<template>
  <div id="app" class="bg-light text-dark">
    <!-- Sidebar PC -->
    <aside class="d-none d-md-block sidebar-lg bg-dark text-white vh-100 position-fixed p-3 shadow">
      <h5 class="text-white text-center mb-4 border-bottom pb-2">⚙️ Admin Panel</h5>

      <nav class="nav flex-column">
        <RouterLink
          v-for="item in [
            { path: '/search-score', label: 'Search Score', icon: 'person' },
            { path: '/products', label: 'Quản lý Sản phẩm', icon: 'box-seam' },
            { path: '/customers', label: 'Quản lý Khách hàng', icon: 'people' }
          ]"
          :key="item.path"
          :to="item.path"
          class="nav-link text-white py-2 px-3 rounded mb-1"
          :class="{ 'bg-secondary': route.path.startsWith(item.path) }"
        >
          <i :class="`bi bi-${item.icon}`"></i> {{ item.label }}
        </RouterLink>

        <a href="#" class="nav-link text-danger py-2 px-3 mt-3" @click.prevent="logout">
          <i class="bi bi-box-arrow-right"></i> Đăng xuất
        </a>
      </nav>
    </aside>

    <!-- Sidebar Mobile -->
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasSidebar">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title">📋 Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <RouterLink to="/users" class="text-white px-3 py-2 d-block">
          <i class="bi bi-person"></i> Người dùng
        </RouterLink>
        <RouterLink to="/products" class="d-block text-white py-2">
          <i class="bi bi-box-seam"></i> Sản phẩm
        </RouterLink>
        <RouterLink to="/customers" class="d-block text-white py-2">
          <i class="bi bi-people"></i> Khách hàng
        </RouterLink>

        <button @click="logout" class="btn btn-danger w-100 mt-4">
          <i class="bi bi-box-arrow-right"></i> Đăng xuất
        </button>
      </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
      <div class="container-fluid">
        <button
          class="btn btn-outline-light d-md-none"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasSidebar"
        >
          <i class="bi bi-list"></i>
        </button>
        <RouterLink class="navbar-brand ms-3" to="/">👤 {{ userName || 'ADMIN' }}</RouterLink>
      </div>
    </nav>

    <!-- Main content -->
    <div class="content mt-5 pt-2 pt-md-0">
      <RouterView />
    </div>
  </div>
</template>


<style scoped>
.sidebar-lg {
  width: 240px;
  top: 0;
  left: 0;
  position: fixed;
  height: 100vh;
  overflow-y: auto;
  z-index: 1030;
}

.nav-link:hover {
  background-color: rgba(255, 255, 255, 0.1);
  transition: 0.2s ease;
}

.content {
  margin-left: 240px;
  padding: 70px 20px 20px; 
  min-height: 100vh;
  overflow-x: hidden;
  overflow-y: auto;
}

@media (max-width: 768px) {
  .content {
    margin-left: 0;
    padding-top: 70px;
  }
}
</style>
