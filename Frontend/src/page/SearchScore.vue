<template>
  <div class="container mt-5">
    <!-- Form nhập SBD -->
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
              />
            </div>
            <div class="col-md-4 text-end">
              <button class="btn btn-success w-100" type="submit">Tra cứu</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Kết quả điểm -->
    <div v-if="score" class="card shadow mb-4">
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
              <td v-if="score.lich_su != null">{{ score.lich_su }}</td>
              <td v-if="score.dia_li != null">{{ score.dia_li }}</td>
              <td v-if="score.gdcd != null">{{ score.gdcd }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Thông báo lỗi -->
    <div v-if="error" class="alert alert-danger mt-4">{{ error }}</div>
  </div>
</template>

<script>
import { searchScore } from '../services/score';

export default {
  data() {
    return {
      sbd: '',
      score: null,
      error: null,
    };
  },
  methods: {
    async checkScore() {
      this.error = null;
      this.score = null;
      try {
        const response = await searchScore(this.sbd);
        this.score = response.data.score;
      } catch (err) {
        this.error = "Không tìm thấy số báo danh hoặc có lỗi xảy ra.";
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
