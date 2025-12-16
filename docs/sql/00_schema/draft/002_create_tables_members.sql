/** テーブルの削除 */
DROP TABLE IF EXISTS areas;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS eateries;
DROP TABLE IF EXISTS reviews;

/** テーブルの作成 */

-- areas：地域テーブル
CREATE TABLE areas (
	id   SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
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

/*
-- eateries：店舗テーブル
CREATE TABLE eateries (
	id:          INT PRIMARY KEY,
	area:        SMALLINT(2),
	name:        VARCHAR(100),
	address:     VARCHAR(255),
	description: VARCHAR(255)
)
-- 表制約
ALTER TABLE eateries MODIFY id      INT NOT NULL AUTO_INCREMENT;
ALTER TABLE eateries MODIFY area    SMALLINT  NOT NULL;
ALTER TABLE eateries MODIFY name    VARCHAR(100) NOT NULL;
ALTER TABLE eateries MODIFY address VARCHAR(255) NOT NULL;

-- reviews：レビュテーブル
CREATE TABLE reviews (
	id:         INT PRIMARY KEY,
	eatery_id:  INT,
	reviewer:   INT,
	title:      VARCHAR(100),
	comment:    VARCHAR(255),
	rating:     TINYINT,
	posted_at:  DATETIME,
	updated_at: DATETIME
)
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
