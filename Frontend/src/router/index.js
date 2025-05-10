import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SearchScore from '@/page/SearchScore.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
  },
  {
    path: '/search-score',
    name: 'SearchScore',
    component: SearchScore
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
