SELECT username
FROM comp440project.blog
WHERE p_date = '05-04-22'
GROUP BY username
HAVING COUNT(username) = (SELECT MAX(largest) as highest
						FROM (SELECT COUNT(username) AS largest
							FROM comp440project.blog
							WHERE p_date = '05-04-22'
							GROUP BY username) 
							AS table1);