SELECT *
FROM comp440project.blog
WHERE username = 'horse' AND blogID IN (SELECT blogID
										FROM comp440project.comment)
                                        AND blogID NOT IN (SELECT blogID
														FROM comp440project.comment
														WHERE sentiment = 'Negative');