# 積んゲーMeter
【URL】https://my-project-proud-sky-7772.fly.dev/

## 概要
買ったはいいがろくに起動もせず積んだままになっているゲーム、  
通称「積んゲー」を管理するアプリです。  
自らの、手つかずの財産を眺めるだけで疲れが取れるという効果があります。  

ゲームのジャンルやプラットフォーム、  
任意の画像を登録可能です。   

![landing_page](https://github.com/user-attachments/assets/6b88aaac-8f3d-4fd6-aeed-56bcaaf20538)
![demo_images](https://github.com/user-attachments/assets/cf51fe4c-0e6e-4811-b725-b3f282089db0)

## 使用技術
* Docker 27.2.0
* Laravel Framework 11.31
    * PHP 8.4.1
    * JavaScript
    * Laravel Breeze 1.8
    * TailwindCSS 3.1.0
* PostgreSQL 17.0
* Steamworks Web API
* Fly.io

## こだわった点
Steam Storeにて取り扱っている作品は  
タイトルの一部より検索できるようにしました。  
タイトルと作品画像がワンタッチで登録できます。

## ER図
![ERdiagram](https://github.com/user-attachments/assets/907d73ff-c02f-45e2-9250-e79713f54db5)

## 機能一覧
* ユーザー登録、ログイン機能(Laravel Breeze)
* 投稿機能
    * ゲームタイトル・画像検索機能(Steamworks Web API)
    * 画像アップロード機能
* ペジネーション機能
* レベルUP機能
* レビュー表示機能(Steamworks Web API)

## ワイヤーフレーム
![wireflame_image](https://github.com/user-attachments/assets/323a7740-232f-4803-8d8a-c69839e234c0)

## Coming Soon
積んであるゲームの好評レビューが  
ランダム表示される機能を実装中です。