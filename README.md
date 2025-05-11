# CodeTest-GOS
Dự án được phát triển bằng Laravel - Vuejs nhằm mục đích test code.

---
# Backend

## 🛠️ Cài đặt dự án

### 1. Clone source code

### 2. Cài đặt và khởi chạy nhanh

1. Chuyển vào thư mục dự án: ```Backend``` 
2. Cài đặt các dependencies cần cho dự án: ``` composer install```
3. Tạo file .env từ file mẫu .env.example: ``` cp .env.example .env```
4. Tạo khóa ứng dụng cho Laravel : ``` php artisan key:generate```
5. Cấu hình thông tin database trong file.env (```DB_CONNECTION```, ```DB_HOST```, ```DB_PORT```, ```DB_DATABASE```, ```DB_USERNAME```, ```DB_PASSWORD```): ``` file .env ```
6. Mở termenal mới Chạy lệnh: ```php artisan queue:work```
7. Tạo cấu trúc database và import dữ liệu: ``` php artisan migrate --seed``` 
8. khởi chạy dự án: ``` php artisan serve```

# Frontend

## 🛠️ Cài đặt dự án

### 1. Clone source code

### 2. Cài đặt và khởi chạy nhanh

1. Chuyển vào thư mục dự án: ```Frontend``` 
2. Cài đặt các dependencies cần cho dự án: ```npm i```
3. Cài đặt baseURL tại service/api.js mặc định ```'http://127.0.0.1:8000/api'```,
4. Sau đó chạy lệnh ```npm run dev``` để khởi chạy dự án 
