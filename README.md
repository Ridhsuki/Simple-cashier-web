<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Simple Cashier Web

Simple Cashier Web is a simple cashier application built using **Laravel Framework**, **Bootstrap (Dashmin) template**, **jQuery** and **SweetAlert**.

## Features

- **Dashboard**: Show status, total sales, and total income.
- **Products**: Add, delete, and edit products.
- **Print Product Label**: Print product label with barcode C128.
- **Sales and Receipt**: Print receipts directly to the printer (auto print).
- **Product Log**: Show product changes (add or sell products).

### Additional Features
- **Product Search**: Make it easy to search products.
- **Calendar**: Shows the real-time current time and date.

### Screenshoots
<div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: center;" align="center">
    <img src="https://github.com/user-attachments/assets/24d7bdab-044a-4979-9725-592cccf29911" width="400" alt="Login Page">
    <img src="https://github.com/user-attachments/assets/c0093bb3-6e63-4024-9ccc-1abdcaa555f5" width="400" alt="Register Page">
    <img src="https://github.com/user-attachments/assets/b383eb06-853c-4cdb-8a68-7e12bd5d0f33" width="400" alt="Dashboard">
    <img src="https://github.com/user-attachments/assets/1fb53306-3193-4c7a-91c5-37489c6889c3" width="400" alt="Product List">
    <img src="https://github.com/user-attachments/assets/6fb2d6d5-eea8-422e-8ee9-ed8f5bc9a182" width="400" alt="Add Product">
    <img src="https://github.com/user-attachments/assets/ee5d30bd-d65b-4ed9-a3c5-8e80a63d7630" width="400" alt="Add Product Stock">
    <img src="https://github.com/user-attachments/assets/58466524-638b-404b-94df-2881e05b00af" width="400" alt="Delete Product Stock">
    <img src="https://github.com/user-attachments/assets/25412580-1d21-43d4-94e7-8e9224d1a8f6" width="400" alt="Print Barcode Product">
    <img src="https://github.com/user-attachments/assets/136bf027-a2c7-4b27-8745-66d529e14550" width="400" alt="Sales List">
    <img src="https://github.com/user-attachments/assets/0caae97a-891e-4e9d-b5a2-93ef6aff5ed0" width="400" alt="Add Sale">
    <img src="https://github.com/user-attachments/assets/5aed091c-4fa4-46ac-b09b-0775a35b3db5" width="400" alt="Pay Sale (Cash)">
    <img src="https://github.com/user-attachments/assets/563a0819-c5f3-47a1-99e0-4954fda76ce3" width="400" alt="Receipt/Invoice">
    <img src="https://github.com/user-attachments/assets/4254622d-8ca8-4910-a046-23cc21d32c71" width="400" alt="Produk Log">
    <img src="https://github.com/user-attachments/assets/639c5ea6-8d0c-4061-994a-56395420efed" width="400" alt="Unavailable Qris">
</div>

## How to Use

To use this project, follow these steps:

1. Clone the repository using git and open folder:
   ```bash
   git clone https://github.com/Ridhsuki/Simple-cashier-web.git
   cd Simple-cashier-web
   ```
2. Install the dependencies using Composer:

   ```bash
   composer install
   ```
3. Copy the .env.example file to .env and configure:

   ```bash
   cp .env.example .env
   ```
4. Generate the app key:

   ```bash
   php artisan key:generate
   ```
5. Run the database migrations and seeder:

   ```bash
   php artisan migrate --seed
   ```
6. Start the app locally:

   ```bash
   php artisan serve
   ```
7. Open your browser and go to http://localhost:8000 and login as admin.
   
   ```bash
   admin@email.com
   password
   ```

## Feedback and Suggestions
I am open to any feedback or suggestions. Feel free to open an Issue if you have any problems or want to give advice!

## Social Media
<p align="center">
  <a href="https://ridhsuki.my.id/">
    <img src="https://img.shields.io/badge/Website-ridhsuki.my.id-0A0A0A?style=for-the-badge&logo=googlechrome&logoColor=white" alt="Website">
  </a>
  <a href="https://github.com/Ridhsuki">
    <img src="https://img.shields.io/badge/GitHub-Ridhsuki-181717?style=for-the-badge&logo=github&logoColor=white" alt="GitHub">
  </a>
  <a href="https://www.instagram.com/basukiridhoal/">
    <img src="https://img.shields.io/badge/Instagram-@basukiridhoal-E4405F?style=for-the-badge&logo=instagram&logoColor=white" alt="Instagram">
  </a>
  <a href="https://www.linkedin.com/in/basuki-ridho">
    <img src="https://img.shields.io/badge/LinkedIn-Basuki%20Ridho-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white" alt="LinkedIn">
  </a>
  <a href="https://www.youtube.com/@RIDHO_AG">
    <img src="https://img.shields.io/badge/YouTube-RIDHO_AG-FF0000?style=for-the-badge&logo=youtube&logoColor=white" alt="YouTube">
  </a>
  <a href="https://www.threads.net/@basukiridhoal">
    <img src="https://img.shields.io/badge/Threads-@basukiridhoal-000000?style=for-the-badge&logo=threads&logoColor=white" alt="Threads">
  </a>
  <a href="https://www.facebook.com/basuki.ridho.921/">
    <img src="https://img.shields.io/badge/Facebook-Basuki%20Ridho-1877F2?style=for-the-badge&logo=facebook&logoColor=white" alt="Facebook">
  </a>
  <a href="https://bsky.app/profile/ridhsuki.bsky.social">
    <img src="https://img.shields.io/badge/BlueSky-ridhsuki.bsky.social-0066CC?style=for-the-badge&logo=bluesky&logoColor=white" alt="BlueSky">
  </a>
  <a href="https://www.tiktok.com/@ritsuchi_dev">
    <img src="https://img.shields.io/badge/TikTok-@ritsuchi_dev-010101?style=for-the-badge&logo=tiktok&logoColor=white" alt="TikTok">
  </a>
</p>

## Support
If you like this project or want to support it, please give this repository a Star. ⭐

Thank you for using this project!


