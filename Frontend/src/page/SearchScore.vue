<template>
  <div class="container mt-5">
    <div class="card bg-light text-dark shadow mb-4">
      <div class="card-header">
        <h4 class="card-title">User Registration</h4>
      </div>
      <div class="card-body">
        <form @submit.prevent="checkScore">
          <div class="row g-2"> 
            <h5>dd</h5>
            <div class="col-md-6">
              <input
                type="text"
                id="sbd"
                v-model="sbd"
                class="form-control"
                placeholder="Enter Registration Number"
                required
              />
            </div>
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit" >Submit</button>
            </div>

          

          </div>
          
        </form>
      </div>

    </div>
    
    <!-- Detailed Scores Section -->
    <div v-if="score" class="card bg-light text-dark shadow mb-4">
      <div class="card-header">
        <h4 class="card-title">Detailed Scores</h4>
      </div>
      <div class="card-body">
        <ul>
          <li><strong>Math:</strong> {{ score.toan }}</li>
          <li><strong>Literature:</strong> {{ score.ngu_van }}</li>
          <li><strong>Foreign Language:</strong> {{ score.ngoai_ngu }}</li>
          <li><strong>History:</strong> {{ score.lich_su }}</li>
          <li><strong>Geography:</strong> {{ score.dia_li }}</li>
          <li><strong>Ethics:</strong> {{ score.gdcd }}</li>
        </ul>
      </div>
    </div>
    <div v-if="error" class="alert alert-danger mt-4">{{ error }}</div>
  </div>
</template>


<script>
import axios from 'axios';

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

    }
  }
};
</script>

<style scoped>
.container {
  max-width: 600px;
}
.container {
  max-width: 600px;
}

.d-flex {
  display: flex;
}

.d-flex .form-group {
  margin-right: 10px;
}

.btn {
  flex-shrink: 0;
}
</style>
