# 積んゲーMeter
【URL】https://my-project-proud-sky-7772.fly.dev/

## 概要
買ったはいいがろくに起動もせず積んだままになっているゲーム、  
通称「積んゲー」を管理するアプリです。  
自らの、手つかずの財産を眺めるだけで疲れが取れるという効果があります。  

いつ頃購入したものかや、ゲームのジャンル、  
プラットフォーム、任意の画像を登録しておけます。  

* Steam Store販売タイトルは自動検索・反映が可能
* 積めば積むほどえらい。レベルUP機能完備
* 積んであるゲームの好評レビューをランダムで放流

![image1](https://github.com/user-attachments/assets/88c41d5f-4781-46ca-8483-4a13ee3d1808)
![image2](https://github.com/user-attachments/assets/ae643bab-e02c-4d43-8477-6ba783faa266)


## 使用技術
* Docker 27.2.0
* Laravel 11.31
* Laravel Breeze 1.8
* PostgreSQL 17.0
* Steamworks Web API

## インフラ構成図

## 機能一覧
* ユーザー登録、ログイン機能(Laravel Breeze)
* 投稿機能
    * ゲームタイトル検索機能(Steamworks Web API)
    * 画像投稿
* ペジネーション機能
* レベルUP機能
* レビュー表示機能(Steamworks Web API)