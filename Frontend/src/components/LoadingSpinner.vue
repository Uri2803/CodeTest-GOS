<template>
  <div class="loading-overlay d-flex justify-content-center align-items-center">
    <div class="spinner"></div>
  </div>
</template>

<style scoped>
.loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
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
    border-top-color: rgba(34, 34, 36, 0.132);
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