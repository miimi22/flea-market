# flea-market

## 環境構築
Dockerビルド<br>
&emsp;1.
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
&emsp;1. 
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
<br>
MAIL_FROM_ADDRESS=test@example.com
<br>
STRIPE_KEY=pk_test_51R5ivkBMK4Sj2g3hDPVzSyDPlPrJj1NTr1dzm0CN8HIXf0LpU0ieXF1tOg1Eys9shiTwJDZtyxrk77WFa1Gq4HML00zAFNGMHA
STRIPE_SECRET=sk_test_51R5ivkBMK4Sj2g3hlwWfNtZwCTpzPhg09ppGC9VqIKIm6A501MO5HzGjm3OgW0ef8SW5vXGv7quVI18kFKMNjM0P00Sizpp5QM
STRIPE_WEBHOOK_SECRET=whsec_942235169754ca9bd2b396061c8d0c02276282396ad7c034d6e1410840665b08
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

## テストアカウント
name：山田太郎
email：taro@gmail.com
password：coachtech1
---------------------
name：鈴木花子
email：hanako@gmail.com
password：coachtech2
---------------------
name：田中一郎
email：ichiro@gmail.com
password：coachtech3

## 使用技術(実行環境)
・PHP 8.4.1
<br>
・Laravel 8.83.29
<br>
・MySQL 8.0.41

## ER図
![fleamarket-er](https://github.com/user-attachments/assets/0ffeac5a-0a44-4d58-8d27-a91f2509e51a)

## URL
・商品一覧画面：http://localhost/
<br>
・ユーザー登録画面：http://localhost/register
<br>
・phpMyAdmin：http://localhost:8080
<br>
・MailHog：http://localhost:8025
