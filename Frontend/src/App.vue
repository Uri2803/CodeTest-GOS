<template>
  <div id="app" class="bg-light text-dark">
    <aside class="d-none d-md-block sidebar bg-dark text-white vh-100 position-fixed top-0 start-0 p-4 shadow">
      <div class="d-flex align-items-center mb-4">
        <i class="bi bi-award fs-3 me-2"></i>
        <h5 class="text-white text-center mb-0 fw-bold">G-Scores</h5>
      </div>

      <nav class="nav flex-column">
        <RouterLink
          v-for="item in [
            { path: '/dashboard', label: 'Dashboard', icon: 'speedometer2' },
            { path: '/search-score', label: 'Tra Cứu Điểm', icon: 'search' },
            { path: '/report', label: 'Thống Kê', icon: 'bar-chart-line' }
          ]"
          :key="item.path"
          :to="item.path"
          class="nav-link text-white py-3 rounded-2 mb-2 d-flex align-items-center"
          :class="{ 'bg-secondary': route.path.startsWith(item.path) }"
        >
          <i :class="`bi bi-${item.icon} fs-5 me-3`"></i>
          <span class="flex-grow-1">{{ item.label }}</span>
        </RouterLink>

        <hr class="text-white-50 my-3">
      </nav>
    </aside>

    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasSidebar">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold"><i class="bi bi-award fs-4 me-2"></i> G-Scores</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Đóng"></button>
      </div>
      <div class="offcanvas-body p-4">
        <RouterLink to="/dashboard" class="d-block text-white py-3 rounded-2 mb-2 d-flex align-items-center" data-bs-dismiss="offcanvas">
          <i class="bi bi-speedometer2 fs-5 me-3"></i>
          <span class="flex-grow-1">Dashboard</span>
        </RouterLink>
        <RouterLink to="/search-score" class="d-block text-white py-3 rounded-2 mb-2 d-flex align-items-center" data-bs-dismiss="offcanvas">
          <i class="bi bi-search fs-5 me-3"></i>
          <span class="flex-grow-1">Search Score</span>
        </RouterLink>
        <RouterLink to="/report" class="d-block text-white py-3 rounded-2 mb-4 d-flex align-items-center" data-bs-dismiss="offcanvas">
          <i class="bi bi-bar-chart-line fs-5 me-3"></i>
          <span class="flex-grow-1">Report</span>
        </RouterLink>

        
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
      <div class="container-fluid">
        <button
          class="btn btn-outline-light d-md-none"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasSidebar"
          aria-controls="offcanvasSidebar"
        >
          <i class="bi bi-list fs-4"></i>
        </button>
        <RouterLink class="navbar-brand ms-md-3 fw-bold" to="/">
          <i class="bi bi-award fs-4 me-2 d-inline-block align-text-top"></i>
          G-Scores
        </RouterLink>
        
      </div>
    </nav>

    <div class="content">
      <RouterView />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { RouterLink, RouterView, useRouter, useRoute } from 'vue-router';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'bootstrap-icons/font/bootstrap-icons.css';

const router = useRouter();
const route = useRoute();

const user = ref(null);

function logout() {
  localStorage.removeItem('token');
  localStorage.removeItem('user');
  user.value = null;
  router.push('/login');
}

onMounted(() => {
  const storedUser = localStorage.getItem('user');
  user.value = storedUser ? JSON.parse(storedUser) : null;
});
</script>

<style scoped>
.sidebar {
  width: 260px; /* Tăng kích thước sidebar */
  z-index: 1031; /* Đảm bảo trên navbar mobile */
}

.nav-link {
  transition: background-color 0.3s ease; /* Thêm hiệu ứng hover mượt mà */
}

.nav-link:hover {
  background-color: rgba(255, 255, 255, 0.15); /* Màu hover đậm hơn một chút */
}

.content {
  margin-left: 260px; /* Điều chỉnh margin content theo kích thước sidebar */
  padding: 80px 30px 30px; /* Tăng padding content */
  min-height: 100vh;
  overflow-x: hidden;
  overflow-y: auto;
}

@media (max-width: 992px) { /* Điều chỉnh breakpoint lớn hơn cho tablet ngang */
  .sidebar {
    display: none; /* Ẩn sidebar PC trên màn hình nhỏ hơn */
  }
  .content {
    margin-left: 0;
    padding-top: 70px;
  }
}

.offcanvas {
  z-index: 1032; /* Đảm bảo trên navbar fixed */
}

.navbar-brand {
  font-size: 1.5rem; /* Tăng kích thước brand */
}
</style>