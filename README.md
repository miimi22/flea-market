# flea-market

## 環境構築
Dockerビルド
1. git clone git@github.com:miimi22/flea-market.git
2. cd flea-market
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
![fleamarket-er](https://github.com/user-attachments/assets/0ffeac5a-0a44-4d58-8d27-a91f2509e51a)

## URL
・商品一覧画面：http://localhost/
<br>
・ユーザー登録画面：http://localhost/register
<br>
・phpMyAdmin：http://localhost:8080
