# 積んゲーMeter
【URL】https://my-project-proud-sky-7772.fly.dev/

## 概要
買ったはいいがろくに起動もせず積んだままになっているゲーム、  
通称「積んゲー」を管理するアプリです。  
自らの、手つかずの財産を眺めるだけで疲れが取れるという効果があります。  

ゲームのジャンルやプラットフォーム、  
任意の画像を登録可能です。 
また、積んであるゲームの好評レビューが  
ランダム表示される機能もあります。

![landing_page](https://github.com/user-attachments/assets/6b88aaac-8f3d-4fd6-aeed-56bcaaf20538)

## 使用技術
* Docker 27.2.0
* Laravel 11.31
* Laravel Breeze 1.8
* PostgreSQL 17.0
* Steamworks Web API

## ER図
![ERdiagram](https://github.com/user-attachments/assets/907d73ff-c02f-45e2-9250-e79713f54db5)

## 機能一覧
* ユーザー登録、ログイン機能(Laravel Breeze)
* 投稿機能
    * ゲームタイトル検索機能(Steamworks Web API)
    * 画像投稿
* ペジネーション機能
* レベルUP機能
* レビュー表示機能(Steamworks Web API)

## ワイヤーフレーム
![wireflame_image](https://github.com/user-attachments/assets/323a7740-232f-4803-8d8a-c69839e234c0)