// src/services/api.js
import axios from 'axios';

const api = axios.create({
  baseURL: 'https://api.gscores.hmquang.info.vn/api',
   
});


export default api;
