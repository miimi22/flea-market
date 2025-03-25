# flea-market

## 環境構築
Dockerビルド
1. git clone git@github.com:miimi22/mogitate.git
2. cd mogitate
3. docker-compose up -d --build

Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. cp .env.example .env、.envの環境変数を次の通りに変更<br>
   DB_CONNECTION=mysql<br>
   DB_HOST=mysql<br>
   DB_PORT=3306<br>
   DB_DATABASE=laravel_db<br>
   DB_USERNAME=laravel_user<br>
   DB_PASSWORD=laravel_pass<br>
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

## 使用技術(実行環境)
・PHP 8.0
<br>
・Laravel 10.0
<br>
・MySQL 8.0

## ER図
![mogitate-er](https://github.com/user-attachments/assets/8a1e7b2a-12ac-46fc-8da5-e2a02e480b2b)

## URL
・開発環境：http://localhost/
<br>
・phpMyAdmin：http://localhost:8080
