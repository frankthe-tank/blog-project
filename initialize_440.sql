DROP TABLE IF EXISTS `tag`;
DROP TABLE IF EXISTS `comment`;
DROP TABLE IF EXISTS `blog`;
DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(45) NOT NULL,
  `password` varchar(80) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
);

CREATE TABLE `blog` (
  `blogID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `subject` varchar(125) NOT NULL,
  `description` varchar(250) NOT NULL,
  `p_date` varchar(45) NOT NULL,
  PRIMARY KEY (`blogID`),
  UNIQUE KEY `blogID_UNIQUE` (`blogID`),
  KEY `username_idx` (`username`),
  CONSTRAINT `blog_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `tag` (
  `blogID` int NOT NULL,
  `tag` varchar(45) NOT NULL,
  KEY `tag_blogID_idx` (`blogID`),
  CONSTRAINT `tag_blogID` FOREIGN KEY (`blogID`) REFERENCES `blog` (`blogID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `comment` (
  `commentID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `description` varchar(250) NOT NULL,
  `sentiment` varchar(45) NOT NULL,
  `c_date` varchar(45) NOT NULL,
  `blogID` int NOT NULL,
  PRIMARY KEY (`commentID`),
  UNIQUE KEY `commentID_UNIQUE` (`commentID`),
  KEY `user_username_idx` (`username`),
  KEY `comment_blogID_idx` (`blogID`),
  CONSTRAINT `comment_blogID` FOREIGN KEY (`blogID`) REFERENCES `blog` (`blogID`),
  CONSTRAINT `comment_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
);


INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('justaway', 'comp440', 'steven', 'condor', 'steven@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('horse', 'comp440', 'frank', 'ceja', 'frank@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('thejtcooper', 'comp440', 'jeremy', 'dominguez', 'jeremy@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('sasuke69', 'mangekyou', 'sasuke', 'uchiha', 'sasuke@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('fruits_chinpo_samurai', 'gorilla', 'kondo', 'isao', 'gorilla@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('fruits_punch_samurai', 'zura', 'katsura', 'kotarou', 'zura@gmail.com');

INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('1', 'sasuke69', 'The day I killed my brother', 'Long story short, I killed him...', '04-16-22');
INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('2', 'horse', 'Hello World', 'Hello friends', '04-12-22');
INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('3', 'justaway', 'I may explode', 'I am actually a bomb', '04-13-22');
INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('4', 'fruits_chinpo_samurai', 'why do people think I am a gorilla?', 'I am actually a gorilla', '04-12-22');
INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('5', 'horse', 'my second post here', 'How can I delete this account?', '04-17-22');

INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('1', 'justaway', 'hello', 'Positive', '04-16-22', '1');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('2', 'horse', 'hello', 'Positive', '04-16-22', '4');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('3', 'justaway', 'hello', 'Positive', '04-16-22', '4');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('4', 'sasuke69', 'hello', 'Positive', '04-16-22', '3');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('5', 'thejtcooper', 'hello', 'Positive', '04-16-22', '5');

INSERT INTO `tag` (`blogID`, `tag`) VALUES ('1', 'uchiha');
INSERT INTO `tag` (`blogID`, `tag`) VALUES ('2', 'hello');
INSERT INTO `tag` (`blogID`, `tag`) VALUES ('3', 'justaway');
INSERT INTO `tag` (`blogID`, `tag`) VALUES ('4', 'gorilla');
INSERT INTO `tag` (`blogID`, `tag`) VALUES ('5', 'getmeout');