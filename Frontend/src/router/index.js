import { createRouter, createWebHistory } from 'vue-router'
import SearchScore from '@/page/SearchScore.vue'
import Report from '@/page/Report.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: SearchScore,
  },
  {
    path: '/search-score',
    name: 'SearchScore',
    component: SearchScore
  },
  {
    path: '/report',
    name: 'Report',
    component: Report
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
