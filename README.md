# オリジナルアプリについて

## アプリについて

相性占い風ジョークアプリ  
使用したい相手に URL を送り質問に答えてもらうと  
予め登録していた文章と画像が相性占い結果に表示されるアプリ

## アプリの使い方

1. 名前とメールアドレスでユーザー登録
2. 編集ページから画像と表示メッセージを登録
3. index ページから専用 URL をコピーし、使用したい相手に送る
4. 質問に答えてもらう

## ローカル開発環境

-XAMPP for Windows 7.2.3 を使用  
-Apache/2.4.29  
-PHP Version 7.2.3  
-MariaDB 10.1.31

## データベースの設計

-id int 主キー  
-name varchar(255)  
-mail varchar(255)  
-password varchar(255)  
-admin_flag int デフォルト値(0)  
-text text  
-img_path varchar(255)

## 使用技術

-html  
-css(scss, Bootstrap)  
-JavaScript(jQuery)  
-Google マテリアルアイコン  
-Google Fonts  
-PHP
