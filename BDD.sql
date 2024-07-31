-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour recette_mathias
CREATE DATABASE IF NOT EXISTS `recette_mathias` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `recette_mathias`;

-- Listage de la structure de table recette_mathias. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL,
  `nomCategorie` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table recette_mathias.categorie : ~4 rows (environ)
INSERT IGNORE INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES
	(1, 'Amuse bouche'),
	(2, 'Entrée'),
	(3, 'Plat'),
	(4, 'Dessert');

-- Listage de la structure de table recette_mathias. contenir
CREATE TABLE IF NOT EXISTS `contenir` (
  `quantite` int NOT NULL,
  `id_recette` int NOT NULL,
  `id_ingredient` int NOT NULL,
  KEY `id_ingredient` (`id_ingredient`),
  KEY `id_recette` (`id_recette`),
  CONSTRAINT `FK_contenir_ingredient` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredient` (`id_ingredient`),
  CONSTRAINT `FK_contenir_recette` FOREIGN KEY (`id_recette`) REFERENCES `recette` (`id_recette`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table recette_mathias.contenir : ~34 rows (environ)
INSERT IGNORE INTO `contenir` (`quantite`, `id_recette`, `id_ingredient`) VALUES
	(200, 1, 1),
	(20, 1, 6),
	(50, 1, 19),
	(600, 1, 17),
	(1, 1, 11),
	(20, 1, 10),
	(30, 1, 9),
	(400, 6, 23),
	(20, 6, 9),
	(30, 6, 14),
	(50, 6, 4),
	(10, 6, 20),
	(150, 4, 3),
	(100, 4, 7),
	(70, 4, 5),
	(450, 3, 17),
	(40, 3, 10),
	(60, 3, 6),
	(400, 3, 18),
	(60, 3, 14),
	(90, 3, 22),
	(200, 3, 16),
	(150, 3, 21),
	(3, 10, 11),
	(70, 10, 24),
	(90, 8, 20),
	(300, 8, 17),
	(400, 7, 1),
	(150, 7, 10),
	(900, 5, 1),
	(1, 2, 8),
	(3, 2, 13),
	(4, 2, 11),
	(150, 8, 16);

-- Listage de la structure de table recette_mathias. ingredient
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id_ingredient` int NOT NULL,
  `nomIngredient` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `prix` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `unite` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_ingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table recette_mathias.ingredient : ~21 rows (environ)
INSERT IGNORE INTO `ingredient` (`id_ingredient`, `nomIngredient`, `prix`, `unite`) VALUES
	(1, 'Poulet', 10.000000, 'g'),
	(2, 'Boeuf', 17.000000, 'g'),
	(3, 'Lait', 4.000000, 'ml'),
	(4, 'Tomate', 1.000000, 'g'),
	(5, 'Sucre roux', 2.500000, 'g'),
	(6, 'Crème', 1.700000, 'cl'),
	(7, 'Sucre', 3.000000, 'g'),
	(8, 'Laitue', 3.000000, 'unité'),
	(9, 'Oignon', 0.800000, 'g'),
	(10, 'Echalotte', 0.900000, 'g'),
	(11, 'Oeuf', 1.500000, 'unité'),
	(12, 'Concombre', 2.000000, 'unité'),
	(13, 'Avocat', 3.000000, 'unité'),
	(14, 'Poivron', 1.600000, 'unité'),
	(15, 'Biscuits apéritifs', 4.500000, 'unité'),
	(16, 'Pesto Verde', 3.500000, 'g'),
	(17, 'Pâtes', 2.000000, 'g'),
	(18, 'Purée de tomate', 4.000000, 'g'),
	(19, 'Lardon', 3.000000, 'g'),
	(20, 'Parmesan', 7.000000, 'g'),
	(21, 'Courgette', 2.600000, 'g'),
	(22, 'Aubergine', 3.000000, 'g'),
	(23, 'Pain', 3.500000, 'g'),
	(24, 'Mayonnaise', 4.000000, 'g');

-- Listage de la structure de table recette_mathias. recette
CREATE TABLE IF NOT EXISTS `recette` (
  `id_recette` int NOT NULL,
  `nomRecette` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tempsPreparation` int NOT NULL,
  `instructions` text,
  `imageRecette` varchar(255) NOT NULL,
  `id_categorie` int NOT NULL,
  PRIMARY KEY (`id_recette`),
  KEY `id_categorie` (`id_categorie`),
  CONSTRAINT `FK_recette_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table recette_mathias.recette : ~8 rows (environ)
INSERT IGNORE INTO `recette` (`id_recette`, `nomRecette`, `tempsPreparation`, `instructions`, `imageRecette`, `id_categorie`) VALUES
	(1, 'Pâtes à la carbonara', 20, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in sagittis justo. Etiam pharetra eros sem, sed blandit nisl malesuada maximus. Donec sit amet porta turpis. Integer et lacus sapien. Nunc malesuada fringilla laoreet. Praesent at velit sit amet nibh dignissim blandit. Fusce ante arcu, fermentum eu efficitur at, pellentesque non orci. Sed in laoreet mauris. Aenean commodo libero in est bibendum, vitae hendrerit mi congue. Sed sed finibus tellus. In vitae vehicula lectus. Aliquam vitae sodales turpis, id egestas metus. Donec pretium turpis quis leo aliquet auctor. Duis sollicitudin auctor tortor, a suscipit neque vehicula quis. Aenean eu vestibulum turpis.', '', 3),
	(2, 'Salade niçoise', 15, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in sagittis justo. Etiam pharetra eros sem, sed blandit nisl malesuada maximus. Donec sit amet porta turpis. Integer et lacus sapien. Nunc malesuada fringilla laoreet. Praesent at velit sit amet nibh dignissim blandit. Fusce ante arcu, fermentum eu efficitur at, pellentesque non orci. Sed in laoreet mauris. Aenean commodo libero in est bibendum, vitae hendrerit mi congue. Sed sed finibus tellus. In vitae vehicula lectus. Aliquam vitae sodales turpis, id egestas metus. Donec pretium turpis quis leo aliquet auctor. Duis sollicitudin auctor tortor, a suscipit neque vehicula quis. Aenean eu vestibulum turpis.', '', 2),
	(3, 'Lasagnes', 90, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in sagittis justo. Etiam pharetra eros sem, sed blandit nisl malesuada maximus. Donec sit amet porta turpis. Integer et lacus sapien. Nunc malesuada fringilla laoreet. Praesent at velit sit amet nibh dignissim blandit. Fusce ante arcu, fermentum eu efficitur at, pellentesque non orci. Sed in laoreet mauris. Aenean commodo libero in est bibendum, vitae hendrerit mi congue. Sed sed finibus tellus. In vitae vehicula lectus. Aliquam vitae sodales turpis, id egestas metus. Donec pretium turpis quis leo aliquet auctor. Duis sollicitudin auctor tortor, a suscipit neque vehicula quis. Aenean eu vestibulum turpis.', '', 3),
	(4, 'Crème brûlée', 20, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in sagittis justo. Etiam pharetra eros sem, sed blandit nisl malesuada maximus. Donec sit amet porta turpis. Integer et lacus sapien. Nunc malesuada fringilla laoreet. Praesent at velit sit amet nibh dignissim blandit. Fusce ante arcu, fermentum eu efficitur at, pellentesque non orci. Sed in laoreet mauris. Aenean commodo libero in est bibendum, vitae hendrerit mi congue. Sed sed finibus tellus. In vitae vehicula lectus. Aliquam vitae sodales turpis, id egestas metus. Donec pretium turpis quis leo aliquet auctor. Duis sollicitudin auctor tortor, a suscipit neque vehicula quis. Aenean eu vestibulum turpis.', '', 4),
	(5, 'Poulet braisé', 15, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in sagittis justo. Etiam pharetra eros sem, sed blandit nisl malesuada maximus. Donec sit amet porta turpis. Integer et lacus sapien. Nunc malesuada fringilla laoreet. Praesent at velit sit amet nibh dignissim blandit. Fusce ante arcu, fermentum eu efficitur at, pellentesque non orci. Sed in laoreet mauris. Aenean commodo libero in est bibendum, vitae hendrerit mi congue. Sed sed finibus tellus. In vitae vehicula lectus. Aliquam vitae sodales turpis, id egestas metus. Donec pretium turpis quis leo aliquet auctor. Duis sollicitudin auctor tortor, a suscipit neque vehicula quis. Aenean eu vestibulum turpis.', '', 3),
	(6, 'Bruschetta', 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in sagittis justo. Etiam pharetra eros sem, sed blandit nisl malesuada maximus. Donec sit amet porta turpis. Integer et lacus sapien. Nunc malesuada fringilla laoreet. Praesent at velit sit amet nibh dignissim blandit. Fusce ante arcu, fermentum eu efficitur at, pellentesque non orci. Sed in laoreet mauris. Aenean commodo libero in est bibendum, vitae hendrerit mi congue. Sed sed finibus tellus. In vitae vehicula lectus. Aliquam vitae sodales turpis, id egestas metus. Donec pretium turpis quis leo aliquet auctor. Duis sollicitudin auctor tortor, a suscipit neque vehicula quis. Aenean eu vestibulum turpis.', '', 1),
	(7, 'Poulet basquaise', 70, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in sagittis justo. Etiam pharetra eros sem, sed blandit nisl malesuada maximus. Donec sit amet porta turpis. Integer et lacus sapien. Nunc malesuada fringilla laoreet. Praesent at velit sit amet nibh dignissim blandit. Fusce ante arcu, fermentum eu efficitur at, pellentesque non orci. Sed in laoreet mauris. Aenean commodo libero in est bibendum, vitae hendrerit mi congue. Sed sed finibus tellus. In vitae vehicula lectus. Aliquam vitae sodales turpis, id egestas metus. Donec pretium turpis quis leo aliquet auctor. Duis sollicitudin auctor tortor, a suscipit neque vehicula quis. Aenean eu vestibulum turpis.', '', 3),
	(8, 'Pâtes au pesto ', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in sagittis justo. Etiam pharetra eros sem, sed blandit nisl malesuada maximus. Donec sit amet porta turpis. Integer et lacus sapien. Nunc malesuada fringilla laoreet. Praesent at velit sit amet nibh dignissim blandit. Fusce ante arcu, fermentum eu efficitur at, pellentesque non orci. Sed in laoreet mauris. Aenean commodo libero in est bibendum, vitae hendrerit mi congue. Sed sed finibus tellus. In vitae vehicula lectus. Aliquam vitae sodales turpis, id egestas metus. Donec pretium turpis quis leo aliquet auctor. Duis sollicitudin auctor tortor, a suscipit neque vehicula quis. Aenean eu vestibulum turpis.', '', 3),
	(9, 'Biscuits apéritifs', 5, 'Mettre les biscuits dans un bol', '', 1),
	(10, 'Oeufs mayonnaise', 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in sagittis justo. Etiam pharetra eros sem, sed blandit nisl malesuada maximus. Donec sit amet porta turpis. Integer et lacus sapien. Nunc malesuada fringilla laoreet. Praesent at velit sit amet nibh dignissim blandit. Fusce ante arcu, fermentum eu efficitur at, pellentesque non orci. Sed in laoreet mauris. Aenean commodo libero in est bibendum, vitae hendrerit mi congue. Sed sed finibus tellus. In vitae vehicula lectus. Aliquam vitae sodales turpis, id egestas metus. Donec pretium turpis quis leo aliquet auctor. Duis sollicitudin auctor tortor, a suscipit neque vehicula quis. Aenean eu vestibulum turpis.', '', 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
