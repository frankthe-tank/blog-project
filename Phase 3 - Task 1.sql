SELECT username
FROM comp440project.blog
WHERE blogID IN (SELECT blogID
			FROM comp440project.tag_blog
			WHERE tagID IN (SELECT tagID
							FROM comp440project.tag
                            WHERE tag = 'X'))
AND blogID IN (SELECT blogID
			FROM comp440project.tag_blog
			WHERE tagID IN (SELECT tagID
							FROM comp440project.tag
                            WHERE tag = 'Y'))
GROUP BY username
HAVING COUNT(username) >= 2;
	