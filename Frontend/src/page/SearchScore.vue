<template>
  <div class="container mt-5 position-relative">
    <div class="card shadow mb-4">
      <div class="card-header bg-secondary text-white">
        <h4 class="card-title mb-0">Tra cứu điểm thi</h4>
      </div>
      <div class="card-body">
        <form @submit.prevent="checkScore">
          <div class="row align-items-center g-2">
            <div class="col-md-8">
              <input
                type="text"
                id="sbd"
                v-model="sbd"
                class="form-control"
                placeholder="Nhập số báo danh..."
                required
                :disabled="isLoading"
              />
            </div>
            <div class="col-md-4 text-end">
              <button class="btn btn-success w-100" type="submit" :disabled="isLoading">
                <span v-if="isLoading">
                  <LoadingSpinner :show="true" />
                </span>
                Tra cứu
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div v-if="isLoading" class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.1);">
      <LoadingSpinner :show="true" />
    </div>

    <div v-else-if="score" class="card shadow mb-4">
      <div class="card-header bg-info text-white">
        <h5 class="mb-0">Kết quả chi tiết</h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-bordered mb-0 text-center">
          <thead class="table-light">
            <tr>
              <th v-if="score.toan != null">Toán</th>
              <th v-if="score.ngu_van != null">Ngữ Văn</th>
              <th v-if="score.ngoai_ngu != null">
                Ngoại Ngữ <span v-if="score.ma_ngoai_ngu">({{ score.ma_ngoai_ngu }})</span>
              </th>
              <th v-if="score.toan != null">Vật lý</th>
              <th v-if="score.toan != null">Hoá học</th>
              <th v-if="score.toan != null">Sinh học</th>
              
              
              <th v-if="score.lich_su != null">Lịch Sử</th>
              <th v-if="score.dia_li != null">Địa Lý</th>
              <th v-if="score.gdcd != null">GDCD</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td v-if="score.toan != null">{{ score.toan }}</td>
              <td v-if="score.ngu_van != null">{{ score.ngu_van }}</td>
              <td v-if="score.ngoai_ngu != null">{{ score.ngoai_ngu }}</td>
              <td v-if="score.vat_li != null">{{ score.vat_li }}</td>
              <td v-if="score.hoa_hoc != null">{{ score.hoa_hoc }}</td>
              <td v-if="score.sinh_hoc != null">{{ score.sinh_hoc }}</td>
              <td v-if="score.lich_su != null">{{ score.lich_su }}</td>
              <td v-if="score.dia_li != null">{{ score.dia_li }}</td>
              <td v-if="score.gdcd != null">{{ score.gdcd }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div v-if="error" class="alert alert-danger mt-4">{{ error }}</div>
  </div>
</template>

<script>
import { searchScore } from '../services/score';
import LoadingSpinner from '../components/LoadingSpinner.vue';

export default {
  components: {
    LoadingSpinner,
  },
  data() {
    return {
      sbd: '',
      score: null,
      error: null,
      isLoading: false,
    };
  },
  methods: {
    async checkScore() {
      this.error = null;
      this.score = null;
      this.isLoading = true;
      try {
        const response = await searchScore(this.sbd);
        this.score = response.data.score;
      } catch (err) {
        this.error = "Không tìm thấy số báo danh hoặc có lỗi xảy ra.";
      } finally {
        this.isLoading = false;
      }
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 800px;
}
input::placeholder {
  color: #999;
}
</style>