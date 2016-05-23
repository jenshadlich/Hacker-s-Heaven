CREATE DATABASE `hackers_heaven`;

DROP TABLE IF EXISTS `hackers_heaven`.`users`;
CREATE TABLE  `hackers_heaven`.`users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password_md5` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `hackers_heaven`.`users` (`username`, `password_md5`) VALUES ('admin', MD5('admin'));