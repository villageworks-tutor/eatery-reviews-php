-- 既存DB削除
DROP DATABASE IF EXISTS db_eatery_reviews;

-- ロール相当のユーザー削除
DROP USER IF EXISTS 'student'@'localhost';

-- ロール → MariaDB ではユーザーとして作成
CREATE USER 'student'@'%' IDENTIFIED BY 'himitu';

-- データベース作成（UTF-8）
CREATE DATABASE db_eatery_reviews
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

-- オーナー相当：すべての権限を付与
GRANT ALL PRIVILEGES ON db_eatery_reviews.* TO 'student'@'localhost';

FLUSH PRIVILEGES;
