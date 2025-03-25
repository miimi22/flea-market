# flea-market

## 環境構築
Dockerビルド<br>
1. 
```
git clone git@github.com:miimi22/flea-market.git
```
2.
```
cd flea-market
```
3.
```
docker-compose up -d --build
```

Laravel環境構築<br>
1. 
```
docker-compose exec php bash
```
2.
```
composer install
```
3. 「.env.example」ファイルをコピーして「.env」ファイルを作成する
```
cp .env.example .env
```
4. 「.env」ファイルの環境変数を次の通りに変更
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
```
php artisan key:generate
```
6. マイグレーションの実行
```
php artisan migrate
```
7. シーディングの実行
```
php artisan db:seed
```
8. シンボリックリンク作成
```
php artisan storage:link
```

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
