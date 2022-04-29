DROP TABLE IF EXISTS `tag_blog`;
DROP TABLE IF EXISTS `tag`;
DROP TABLE IF EXISTS `follow`;
DROP TABLE IF EXISTS `hobby`;
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
  `tagID` int NOT NULL AUTO_INCREMENT,
  `tag` varchar(45) NOT NULL,
  PRIMARY KEY (`tagID`),
  UNIQUE KEY `tagID_UNIQUE` (`tagID`)
);

CREATE TABLE `tag_blog` (
  `blogID` int NOT NULL,
  `tagID` int NOT NULL,
  KEY `tag_glog_tagID_idx` (`tagID`),
  KEY `tag_blog_blogID` (`blogID`),
  CONSTRAINT `tag_blog_blogID` FOREIGN KEY (`blogID`) REFERENCES `blog` (`blogID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tag_glog_tagID` FOREIGN KEY (`tagID`) REFERENCES `tag` (`tagID`) ON DELETE CASCADE ON UPDATE CASCADE
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
  CONSTRAINT `comment_blogID` FOREIGN KEY (`blogID`) REFERENCES `blog` (`blogID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `follow` (
  `username` varchar(45) NOT NULL,
  `following` varchar(45) NOT NULL,
  KEY `follow_username_following_idx` (`following`),
  KEY `follow_username_idx` (`username`),
  CONSTRAINT `follow_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `follow_username_following` FOREIGN KEY (`following`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `hobby` (
  `username` varchar(45) NOT NULL,
  `hobby` varchar(45) NOT NULL,
  KEY `hobbie_username_idx` (`username`),
  CONSTRAINT `hobby_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
);




INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('justaway', 'comp440', 'steven', 'condor', 'steven@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('horse', 'comp440', 'frank', 'ceja', 'frank@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('thejtcooper', 'comp440', 'jeremy', 'dominguez', 'jeremy@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('sasuke69', 'mangekyou', 'sasuke', 'uchiha', 'sasuke@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('fruits_chinpo_samurai', 'gorilla', 'kondo', 'isao', 'gorilla@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('fruits_punch_samurai', 'zura', 'katsura', 'kotarou', 'zura@gmail.com');
INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('admin', 'fsjcomp440', 'frank', 'ceja', 'admin@gmail.com');

INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('1', 'sasuke69', 'The day I killed my brother', 'Long story short, I killed him...', '04-16-22');
INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('2', 'horse', 'Hello World', 'Hello friends', '04-12-22');
INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('3', 'justaway', 'I may explode', 'I am actually a bomb', '04-13-22');
INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('4', 'fruits_chinpo_samurai', 'why do people think I am a gorilla?', 'I am actually a gorilla', '04-12-22');
INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('5', 'horse', 'my second post here', 'How can I delete my account?', '05-01-22');
INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('6', 'horse', 'I am stuck here', 'admin wont delete my account', '05-01-22');
INSERT INTO `blog` (`blogID`, `username`, `subject`, `description`, `p_date`) VALUES ('7', 'thejtcooper', 'I wont lose to horse', 'I will post the most number of blogs', '05-01-22');

INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('1', 'justaway', 'hello', 'Positive', '04-16-22', '1');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('2', 'horse', 'hello', 'Positive', '04-16-22', '4');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('3', 'justaway', 'hello', 'Positive', '04-16-22', '4');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('4', 'sasuke69', 'hello', 'Positive', '04-16-22', '3');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('5', 'thejtcooper', 'This place sucks!', 'Negative', '05-01-22', '5');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('6', 'sasuke69', 'You should contact the admin', 'Positive', '05-01-22', '5');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('7', 'fruits_punch_samurai', 'Hello fellow patriot!', 'Positive', '04-16-22', '2');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('8', 'admin', 'I own you (◣_◢)', 'Negative', '05-01-22', '6');
INSERT INTO `comment` (`commentID`, `username`, `description`, `sentiment`, `c_date`, `blogID`) VALUES ('9', 'admin', 'you cant', 'Negative', '05-01-22', '5');

INSERT INTO `tag` (`tagID`, `tag`) VALUES ('1', 'uchiha');
INSERT INTO `tag` (`tagID`, `tag`) VALUES ('2', 'hello');
INSERT INTO `tag` (`tagID`, `tag`) VALUES ('3', 'justaway');
INSERT INTO `tag` (`tagID`, `tag`) VALUES ('4', 'gorilla');
INSERT INTO `tag` (`tagID`, `tag`) VALUES ('5', 'getmeout');

INSERT INTO `tag_blog` (`blogID`, `tagID`) VALUES ('1', '2');
INSERT INTO `tag_blog` (`blogID`, `tagID`) VALUES ('1', '1');
INSERT INTO `tag_blog` (`blogID`, `tagID`) VALUES ('2', '2');
INSERT INTO `tag_blog` (`blogID`, `tagID`) VALUES ('3', '3');
INSERT INTO `tag_blog` (`blogID`, `tagID`) VALUES ('4', '4');
INSERT INTO `tag_blog` (`blogID`, `tagID`) VALUES ('5', '5');

INSERT INTO `follow` (`username`, `following`) VALUES ('justaway', 'horse');
INSERT INTO `follow` (`username`, `following`) VALUES ('sasuke69', 'justaway');
INSERT INTO `follow` (`username`, `following`) VALUES ('horse', 'sasuke69');
INSERT INTO `follow` (`username`, `following`) VALUES ('fruits_chinpo_samurai', 'sasuke69');
INSERT INTO `follow` (`username`, `following`) VALUES ('justaway', 'thejtcooper');

INSERT INTO `hobby` (`username`, `hobby`) VALUES ('justaway', 'cooking');
INSERT INTO `hobby` (`username`, `hobby`) VALUES ('sasuke69', 'eating');
INSERT INTO `hobby` (`username`, `hobby`) VALUES ('horse', 'cooking');
INSERT INTO `hobby` (`username`, `hobby`) VALUES ('fruits_chinpo_samurai', 'stalking');
INSERT INTO `hobby` (`username`, `hobby`) VALUES ('thejtcooper', 'reading');