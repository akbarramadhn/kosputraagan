---
1. Clone Project dari GitHub

   ```
   git clone https://github.com/akbarramadhn/kosputraagan.git
   ```
   
2. Pindah directory

   ```
   cd kosputraagan
   ```
   
3. Install Dependency PHP

   ```
   composer install
   ```
   
4. Install Dependency Frontend

   ```
   npm install
   ```
   
5. Copy env

   ```
   cp .env.example .env
   ```
   
   
6. Generate Laravel Key

   ```
   php artisan key:generate
   ```
   
7. Start Laragon jangan lupa, abis itu jalankan migrasi
   
   ```
   php artisan migrate
   ```
   
   pilih *yes*, lalu

   ```
   php artisan db:seed
   ```
   

8. Jalankan Storage Link

    ```
    php artisan storage:link
    ```
    
9. Jalankan Dev Server Laravel + Vite

    ```
    php artisan serve
    ```
    
    lalu

    ```
    npm run dev
    ```
