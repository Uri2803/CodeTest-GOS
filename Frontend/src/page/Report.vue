<template>
    <div class="container-fluid p-4">
      <h2 class="text-xl font-bold mb-4 text-center">Thống kê học sinh theo mức điểm</h2>
  
      <div class="position-relative">
        <LoadingSpinner v-if="isLoading" />
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" v-if="chartData && chartData.datasets.length > 0">
          <div v-for="(subjectData, subject) in detailedChartData" :key="subject" class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title text-center">{{ subject.replace("_", " ").toUpperCase() }}</h5>
                <div class="chart-container position-relative">
                  <Bar :data="subjectData" :options="detailedChartOptions" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else-if="!isLoading" class="text-center text-gray-500">
          Không có dữ liệu để hiển thị.
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { reactive, onMounted, ref, computed } from 'vue';
  import { Bar } from 'vue-chartjs';
  import { scoreDistribution } from '../services/score';
  import { Chart as ChartJS, BarElement, CategoryScale, LinearScale, Legend, Tooltip } from 'chart.js';
  import LoadingSpinner from '../components/LoadingSpinner.vue';
  
  ChartJS.register(BarElement, CategoryScale, LinearScale, Legend, Tooltip);
  
  const chartData = reactive({
    labels: [],
    datasets: []
  });
  const isLoading = ref(true);
  
  const detailedChartData = reactive({});
  
  const chartOptions = {
    responsive: true,
    plugins: {
      legend: {
        position: 'top'
      },
      tooltip: {
        mode: 'index',
        intersect: false
      },
      title: {
        display: true,
        text: 'Tổng số học sinh theo mức điểm từng môn'
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Số lượng học sinh'
        }
      },
      x: {
        title: {
          display: true,
          text: 'Môn học'
        }
      }
    }
  };
  
  const detailedChartOptions = reactive({
    responsive: true,
    plugins: {
      legend: {
        position: 'top'
      },
      title: {
        display: true,
        text: 'Phân bố theo mức điểm'
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Số lượng học sinh'
        }
      },
      x: {
        title: {
          display: true,
          text: 'Mức điểm'
        }
      }
    }
  });
  
  const fetchData = async () => {
    try {
      isLoading.value = true;
      const response = await scoreDistribution();
      const apiData = response.data.data;
      const levels = [">=8", "6-8", "4-6", "<4"];
      const subjects = Object.keys(apiData);
      chartData.labels = subjects.map(s => s.replace("_", " ").toUpperCase());
      chartData.datasets = levels.map(level => ({
        label: level,
        data: subjects.map(subject => apiData[subject][level]),
        backgroundColor: getColor(level),
        borderRadius: 6,
        barPercentage: 0.7
      }));
      subjects.forEach(subject => {
        detailedChartData[subject] = {
          labels: levels,
          datasets: [{
            label: 'Số lượng học sinh',
            data: levels.map(level => apiData[subject][level]),
            backgroundColor: levels.map(getColor),
            borderRadius: 6,
            barPercentage: 0.7,
          }]
        };
      });
  
    } catch (error) {
      console.error('Error fetching data:', error);
    } finally {
      isLoading.value = false;
    }
  };
  function getColor(level) {
    return {
      ">=8": "#4CAF50",
      "6-8": "#2196F3",
      "4-6": "#FFC107",
      "<4": "#F44336"
    }[level];
  }
  
  onMounted(() => {
    fetchData();
  });
  </script>
  
  <style scoped>
  .chart-container {
    position: relative;
    width: 100%;
    height: auto;
  }


  .loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(238, 234, 234, 0.4);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    transition: opacity 0.3s ease;
  }
  
  .spinner {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    position: relative;
    animation: spin 1s linear infinite;
  }
  
  .spinner::before,
  .spinner::after {
    content: "";
    position: absolute;
    border: 6px solid transparent;
    border-top-color: white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }
  
  .spinner::before {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }
  
  .spinner::after {
    top: 8px;
    left: 8px;
    right: 8px;
    bottom: 8px;
    animation-delay: 0.2s;
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>