SELECT
	reviews.id
	, reviews.eatery_id
	, reviews.reviewer
	, members.handle
	, members.name
	, reviews.title
	, reviews.comment
	, reviews.rating
	, reviews.image
	, reviews.posted_at
FROM reviews
JOIN members ON reviews.reviewer = members.id
WHERE eatery_id = 2
ORDER BY id;