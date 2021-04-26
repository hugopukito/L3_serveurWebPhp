<?php

// Recupere la connexion à la DB
require 'connBdd.php';

$pdo->exec("DROP TABLE IF EXISTS articles");
$pdo->exec("CREATE TABLE IF NOT EXISTS articles (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pseudo` varchar(255) NOT NULL,
  `pseudo_content_modif` varchar(255) DEFAULT NULL,
  `date_modif` timestamp NULL DEFAULT NULL,
  `pseudo_title_modif` varchar(255) DEFAULT NULL,
  `date_title_modif` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4");


$pdo->exec("DROP TABLE IF EXISTS comments");
$pdo->exec("CREATE TABLE IF NOT EXISTS comments (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_article` int(11) NOT NULL,
  `pseudo_user_modif` varchar(255) DEFAULT NULL,
  `date_modif` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4");


$pdo->exec("DROP TABLE IF EXISTS users");
$pdo->exec("CREATE TABLE IF NOT EXISTS users (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` enum('Banned','Admin','Subscriber') DEFAULT 'Subscriber',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4");




