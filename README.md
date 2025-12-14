# PHP Web Application Starter Kit — Project Template

PHP Web Starter Kit は、PHP による小規模アプリ開発・研修用途に最適化されたテンプレートです。

- ディレクトリ構成、サンプルルーティング、基本設定ファイルを備え、すぐに開発を開始できます。
- 学習用・個人プロジェクト向けに設計されており、メジャーなフレームワークと競合することはありません。

PHPUnit によるテスト環境、Monolog によるログ出力、Dotenv による設定管理など、基本的な開発環境がすぐに再現できる構成となっています。

---

## 🧭 はじめにやること

1. sample のテストを実行して動作確認
2. sample ディレクトリを削除
3. src / tests に自分のコードを書く

※ sample は動作確認用です。確認後は削除し、自分のコードを実装してください。

---

## 📂 プロジェクト構成

```
project-root/
│
├── bin/ # PHPUnit ランナー
│    ├── phpunit.bat
│    └── phpunit.sh
│
├── sample/ # サンプルコード & サンプルテスト（不要なら動作確認後に削除可）
│    ├── src/
│    │    ├── Calculator.php
│    │    └── MonologExample.php
│    ├── tests/
│    │    ├── CalculatorTest.php
│    │    └── MonologExampleTest.php
│    ├── phpunit.sample.xml
│    └── bootstrap.sample.php
│
├── database/ # 【実装対象】SQL スクリプト（DB 作成など）
│    └── create_database.sql
│
├── public/   # 【実装対象】公開ディレクトリ
│
├── src/      # 【実装対象】ソースディレクトリ
│
├── tests/    # 【実装対象】テストディレクトリ
│    ├── phpunit.xml
│    └── bootstrap.php
│
├── vendor/ # Composer パッケージ
├── .env    # 実際の環境設定（gitignore 対象）
├── .env.template # テンプレート（各環境でコピーして利用）
├── composer.json # composer設定
├── composer.lock # composerロックファイル
├── README.md     # いまあなたが読んでいるファイル
├── CHANGELOG.md  # 変更履歴
└── LICENSE       # MITライセンス
```

---

## ❌ このテンプレートが提供しないもの

- ORM
- 認証・認可機構
- 自動ルーティング
- DI コンテナ

---

## 🚀 セットアップ手順

### 1. リポジトリを clone

```bash
git clone <repository-url>
cd eatery-reviews-php
```

### 2. Composer パッケージをインストールする

```bash
composer install
```

### 3. .env を作成（必須）

```bash
cp .env.template .env
```

---

## 🔧 データベース設定

.env で設定した値が vlucas/phpdotenv によって読み込まれます。

.env.template（抜粋）

```dotenv
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=change_me
DB_USERNAME=change_me
DB_PASSWORD=change_me
```

database/create_database.sql を参照し、プレースホルダ「change_me」を自分の環境に合わせて書き換えてください。

---

## 🧪 テストの実行方法（sample）

### バンドルサンプルのすべてのテストを実行

Windows:

```bash
bin\phpunit.bat -c sample/phpunit.sample.xml
```

Linux / macOS / Git Bash:

```bash
./bin/phpunit.sh -c sample/phpunit.sample.xml
```

### 特定テストだけを実行

例 — sample/tests/CalculatorTest.php のみ:

```bash
./bin/phpunit.sh sample/tests/CalculatorTest.php
```

---

## 🧪 テストの実行方法（開発コード）

### 開発プログラムのテストを実行

Windows:

```bash
bin\phpunit.bat -c tests/phpunit.xml
```

Linux / macOS / Git Bash:

```bash
./bin/phpunit.sh -c tests/phpunit.xml
```

---

## 🧱 サンプルコードについて

### Calculator（基礎）

四則演算のサンプルクラスとテスト。

### Monolog の利用例

sample/src/MonologExample.php で Monolog を使用。

ログは sample/src/logs/ に出力され、テストでは作成後に削除されます。

---

## 📝 注意事項

- .env は 絶対に Git に含めないようにしてください（.env.template を使用して環境ごとにコピー）。
- Composer パッケージを更新するときは composer update を使用してください。
- このテンプレートは研修用途・個人利用を想定しており、特に制限なく自由に使用・改変できます。

---

## 🙋 サポート

テンプレートの機能追加・調整が必要な場合は気軽に相談してください。

## 使用環境要件

- PHP 8.1+
- Composer
- MySQL 8.x
- PDO extension

---

## 📄 ライセンス

このプロジェクトは **MIT ライセンス** の下で提供されています。  
著作権表記：© 2025 villageworks

詳細は [LICENSE](./LICENSE) を参照してください。

---

This project is licensed under the MIT License.  
Copyright (c) 2025 villageworks.

See the [LICENSE](./LICENSE) file for the full text.
