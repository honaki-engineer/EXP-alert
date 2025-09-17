# 消費期限管理アプリ

## 概要

**消費（賞味）期限**を簡単に記録・管理・可視化できる Laravel 製アプリです。  
ユーザーは食品の消費（賞味）期限を登録でき、一覧表示・期限切れアラート・検索などの機能を通じて、**在庫管理や食品ロス削減をサポート**します。  
また、ログイン機能やバリデーション、エラーページ対応など、使いやすさにも配慮した設計となっています。

---

## デモサイト

- アプリ  
  https://exp-alert.akkun1114.com/  
- ゲストログイン（今すぐ試せます）  
  https://exp-alert.akkun1114.com/guest-login?token=guest123  

### ゲストログイン情報
- メールアドレス：不要
- パスワード：不要

上記のURLをクリックするだけで、ゲストログインが完了します。

---

## 目次

- [概要](#概要)
- [デモサイト](#デモサイト)
- [使用技術](#使用技術)
- [主な機能](#主な機能)
- [セットアップ手順(開発環境)](#セットアップ手順開発環境)
- [ディレクトリ構成](#ディレクトリ構成)
- [本番環境の注意点](#本番環境の注意点)
  
---

## 使用技術

- **フロントエンド**：HTML / JavaScript / Tailwind CSS  
- **バックエンド**：PHP 8.x（開発: 8.2.27 / 本番: 8.2.28） / Laravel 9.52.20  
- **データベース**：MySQL 8.0（開発） / MariaDB 10.5（本番・MySQL互換）  
- **インフラ・環境**：MAMP / Xserver / macOS Sequoia 15.3.1  
- **ビルド環境**：Node.js 24.4.0（開発） / Node.js 16.20.2（本番: Xserver に nodebrew で導入） / Composer 2.8.x（開発: 2.8.4 / 本番: 2.8.5）  
- **開発ツール**：VSCode / Git / GitHub / phpMyAdmin  
  
※ ローカル開発環境は、Node.js 24.4.0 を使用してビルドを実行しています。  
本番環境（Xserver）は、nodebrew を利用して Node.js 16.20.2 を導入し、ビルドを行っています。  
なお、Xserver では Node.js の標準提供は行われていないため、サーバー内ビルドは公式サポート対象外の構成となります。  
必要に応じて、ローカルビルド済みのファイルをアップロードする運用をおすすめいたします。

---

## 主な機能
### 開発者目線

- **認証/認可**：Breeze、全ルート `auth` / 取得は本人スコープ固定
- **ゲストログイン**（ワンクリック）
- **消費（賞味）期限**：CRUD / 検索 / 期限切れ・3日以内アラート  
- **400〜503**：カスタムエラーページ
- **その他**：バリデーション / 入力保持（old関数） / バリデーションエラーメッセージ表示 / ページネーション


### ユーザー目線
#### 区分別 機能対応表

| 機能                        | 非ログインユーザー | 一般ユーザー |
| -------------------------- | --------- | ------ |
| 新規登録・ログイン            | ●         | ●      |
| パスワード再発行              | ●         | ●      |
| ゲストログイン（1クリック）     | ●         | -      |
| 商品一覧の閲覧                | -         | ●      |
| 商品の登録（画像・期限・メモ等） | -         | ●      |
| 商品の編集・削除              | -         | ●      |
| 商品の検索（キーワード）        | -         | ●      |
| 期限切れ・3日以内のアラート表示  | -         | ●      |
| プロフィール編集               | -         | ●      |

---

## セットアップ手順

1. リポジトリをクローン
```bash
git clone https://github.com/honaki-engineer/EXP-alert.git
cd EXP-alert
```
2. 環境変数を設定
```bash
cp .env.example .env
```
.env の `DB_` 各項目などは、開発環境に応じて適宜変更してください。  
- [.env 設定例](#env-設定例)
3. PHPパッケージをインストール
```bash
composer install
```
4. アプリケーションキーを生成
```bash
php artisan key:generate
```
5. DBマイグレーション & 初期データ投入
```bash
php artisan migrate --seed
```
6. フロントエンドビルド（Tailwind/Vite 使用時）
```bash
npm install
npm run dev
```
7. ストレージリンク作成（画像表示のため必須）
```bash
php artisan storage:link
```
8. サーバー起動
```bash
php artisan serve
```

---

### .env 設定例（開発用）

```env
APP_NAME=消費期限管理
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Mailpit を使う場合
MAIL_MAILER=smtp
MAIL_HOST=localhost # MAMP の場合
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# ゲストログイン
GUEST_LOGIN_TOKEN=guest123
```

---

## ディレクトリ構成

```txt
EXP-alert/
├── app/                     # アプリケーションロジック（モデル、サービス、コントローラーなど）
├── config/                  # 各種設定ファイル
├── database/
│   ├── migrations/          # マイグレーションファイル
│   └── seeders/             # 初期データ投入用
├── public/
│   └── index.php            # エントリーポイント
├── resources/
│   ├── views/               # Bladeテンプレート
│   ├── css/                 # カスタムCSS
│   └── js/                  # カスタムJS
├── routes/
│   └── web.php              # ルーティング設定
├── storage/                 # ログ、ファイルストレージ
├── .env.example             # 環境変数のテンプレート
├── composer.json            # PHPパッケージ管理
├── package.json             # Node.js用パッケージ管理（Tailwind/Viteなど）
├── vite.config.js           # Vite設定
├── tailwind.config.js       # Tailwind CSSの設定
└── README.md
```

---

## 本番環境の注意点

Xserver 上で Laravel アプリを本番公開する際の詳細な手順 (SSH 接続、`.env` 設定、`.htaccess` 配置、`index.php` 修正、ビルドファイルの配置など) は、以下の記事にまとめています：

- メインドメインの場合  
  https://qiita.com/honaki/items/bf82986954c7db568094

- サブドメインの場合  
  https://qiita.com/honaki/items/a9c01bb8ae753ed67add
