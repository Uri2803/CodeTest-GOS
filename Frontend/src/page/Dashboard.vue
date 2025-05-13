<template>
    <div class="container-fluid p-4">
      <h2 class="text-xl font-bold mb-4 text-center">Top 10 Học Sinh</h2>
  
      <div class="col-md-3 mb-3">
        <label for="blockSelect" class="form-label">Chọn Khối:</label>
        <select class="form-select" id="blockSelect" v-model="selectedBlock" @change="fetchTopStudents">
          <option value="A">Khối A</option>
          <option value="B">Khối B</option>
          <option value="C">Khối C</option>
          <option value="D">Khối D</option>
        </select>
      </div>
  
      <div v-if="isLoading">
        <div class="table-responsive position-relative">
            <div class="d-flex justify-content-center align-items-center" style="min-height: 500px;">
            <LoadingSpinner />
            </div>
        </div>
    </div>
  
      <div v-else-if="topStudents.length > 0">
        <h3 class="text-lg font-semibold mb-2">Top 10 Học Sinh Khối {{ selectedBlock }}</h3>
        <div class="table-responsive">
          <table class="table table-bordered table-striped shadow">
            <thead class="table-light">
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">SBD</th>
                <th class="text-center">Tổng điểm khối {{ selectedBlock }} </th>
                <th class="text-center">Toán</th>
                <th class="text-center">Ngữ Văn</th>
                <th class="text-center">Ngoại Ngữ</th>
                <th class="text-center">Vật lý</th>
                <th class="text-center">Hoá học</th>
                <th class="text-center">Sinh học</th>
                <th class="text-center">Lịch Sử</th>
                <th class="text-center">GDCD</th>
                <th class="text-center">Địa Lý</th>
                
                
              </tr>
            </thead>
            <tbody>
              <tr v-for="(student, index) in topStudents" :key="student.sbd">
                <td class="text-center">{{ index + 1 }}</td>
                <td class="text-center">{{ student.sbd }}</td>
                <td class="text-center"><strong class="text-primary">{{ student.total_score }}</strong></td>
                <td class="text-center">{{ student.toan || '-' }}</td>
                <td class="text-center">{{ student.ngu_van || '-' }}</td>
                <td class="text-center">{{ student.ngoai_ngu || '-' }}</td>
                <td class="text-center">{{ student.vat_li || '-' }}</td>
                <td class="text-center">{{ student.hoa_hoc || '-' }}</td>
                <td class="text-center">{{ student.sinh_hoc || '-' }}</td>
                <td class="text-center">{{ student.lich_su || '-' }}</td>
                <td class="text-center">{{ student.dia_li || '-' }}</td>
                <td class="text-center">{{ student.gdcd || '-' }}</td>

              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div v-else>
        <p class="text-center text-muted">Không có dữ liệu học sinh cho khối {{ selectedBlock }}.</p>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import LoadingSpinner from '../components/LoadingSpinner.vue';
  import { topStudents as getTopStudentsData } from '../services/score';
  
  export default {
    components: {
      LoadingSpinner,
    },
    data() {
      return {
        selectedBlock: 'A',
        topStudents: [],
        isLoading: false,
      };
    },
    methods: {
      async fetchTopStudents() {
        this.isLoading = true;
        this.topStudents = [];
        try {
          const response = await getTopStudentsData(this.selectedBlock);
          const data = response.data;
          if (data.success && data.students) {
            this.topStudents = data.students.sort((a, b) => b.total_score - a.total_score).slice(0, 10);
          } else {
            console.error(`API trả về lỗi hoặc không có dữ liệu học sinh cho khối ${this.selectedBlock}.`);
            this.topStudents = [];
          }
        } catch (error) {
          console.error(`Lỗi khi gọi API cho khối ${this.selectedBlock}:`, error);
          this.topStudents = [];
        } finally {
          this.isLoading = false;
        }
      },
    },
    mounted() {
      this.fetchTopStudents();
    },
  };
  </script>
  
  <style scoped>
  .table-responsive {
    overflow-x: auto;
  }
  
  .table {
    min-width: 600px;
  }
  </style>