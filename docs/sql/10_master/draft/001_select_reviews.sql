SELECT
	reviews.id
	, reviews.eatery_id AS eatery_id
	, reviews.reviewer  AS reviewer_id
	, members.handle    AS handle
	, reviews.title     AS title
	, reviews.comment   AS comment
	, reviews.rating    AS rating
	, reviews.image     AS image
	, reviews.posted_at AS posted_at
FROM reviews
JOIN members ON reviews.reviewer = members.id
WHERE eatery_id = 2
ORDER BY posted_at DESC;