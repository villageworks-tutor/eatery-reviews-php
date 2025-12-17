/** テーブルの削除 */
DROP TABLE IF EXISTS areas;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS eateries;

/** テーブルの作成 */

-- areas：地域テーブル
CREATE TABLE areas (
	id   SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(50)       NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- members：会員テーブル
CREATE TABLE members (
	id       INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name	   VARCHAR(100) NOT NULL,
	handle	 VARCHAR(100),
	email		 VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- eateries：店舗テーブル
CREATE TABLE eateries (
	id          INT      UNSIGNED NOT NULL AUTO_INCREMENT,
	area        SMALLINT UNSIGNED NOT NULL,
	name        VARCHAR(100)      NOT NULL,
	address     VARCHAR(255)      NOT NULL,
	description VARCHAR(255),

	-- 主キー制約
	PRIMARY KEY (id),
	-- インデックスの設定
	KEY idx_eateries_area (area),
	-- 外部参照キー制約
	CONSTRAINT fk_eateries_area FOREIGN KEY (area) REFERENCES areas(id)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- reviews：レビュテーブル
CREATE TABLE reviews (
	id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
	eatery_id  INT UNSIGNED NOT NULL,
	reviewer   INT UNSIGNED NOT NULL,
	title      VARCHAR(100) NOT NULL,
	comment    VARCHAR(255) NOT NULL,
	rating     TINYINT      NOT NULL DEFAULT 3,
	posted_at  DATETIME     NOT NULL DEFAULT current_timestamp,
	updated_at DATETIME     NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp,

	-- 主キー制約
	PRIMARY KEY (id),
	-- インデックスの設定
	KEY idx_reviews_eatery (eatery_id),
	KEY idx_reviews_reviewer (reviewer),
		-- 外部参照キー制約
	CONSTRAINT fk_reviews_eatery FOREIGN KEY (eatery_id) REFERENCES eateries(id),
	CONSTRAINT fk_reviews_reviewer FOREIGN KEY (reviewer) REFERENCES members(id),
	-- チェック制約
	CHECK (rating BETWEEN 1 AND 5)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*
-- 表制約
ALTER TABLE reviews MODIFY id INT NOT NULL AUTO_INCREMENT;
ALTER TABLE reviews MODIFY eatery_id INT NOT NULL;
ALTER TABLE reviews MODIFY reviewer  INT NOT NULL;
ALTER TABLE reviews MODIFY title VARCHAR(100) NOT NULL;
ALTER TABLE reviews MODIFY comment VARCHAR(255) NOT NULL;
ALTER TABLE reviews MODIFY rating  TINYINT NOT NULL DEFAULT 3;
ALTER TABLE reviews MODIFY posted_at  DATETIME NOT NULL DEFAULT current_datetime;
ALTER TABLE reviews MODIFY updated_at DATETIME NOT NULL DEFAULT current_datetime ON UPDATE current_datetime;

-- 外部キー制約
ALTER TABLE reviews ADD CONSTRAINT FK_EATERY_ID FOREIGN KEY(eatery_id) REFERENCES eateries(id);
ALTER table reviews ADD CONSTRAINT FK_REVIEWER FOREIGN KEY(reviewer) REFERENCES members(id);
*/
