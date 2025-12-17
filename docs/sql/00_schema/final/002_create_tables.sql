CREATE TABLE `areas` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `handle` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
CREATE TABLE `eateries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area` smallint(5) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_eateries_area` (`area`),
  CONSTRAINT `fk_eateries_area` FOREIGN KEY (`area`) REFERENCES `areas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
CREATE TABLE `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eatery_id` int(10) unsigned NOT NULL,
  `reviewer` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 3,
  `image` varchar(100) DEFAULT NULL,
  `posted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_reviews_eatery` (`eatery_id`),
  KEY `idx_reviews_reviewer` (`reviewer`),
  CONSTRAINT `fk_reviews_eatery` FOREIGN KEY (`eatery_id`) REFERENCES `eateries` (`id`),
  CONSTRAINT `fk_reviews_reviewer` FOREIGN KEY (`reviewer`) REFERENCES `members` (`id`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`rating` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
