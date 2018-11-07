/*
SQLyog Professional v12.4.1 (64 bit)
MySQL - 10.1.25-MariaDB : Database - db_restaurant
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_restaurant` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_restaurant`;

/*Table structure for table `tb_employee` */

DROP TABLE IF EXISTS `tb_employee`;

CREATE TABLE `tb_employee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `sallary` float unsigned NOT NULL,
  `tlp` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(20) NOT NULL,
  `status` int(20) NOT NULL,
  `online_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_employee` */

insert  into `tb_employee`(`id`,`nama`,`address`,`sallary`,`tlp`,`username`,`password`,`level`,`status`,`online_status`) values 
(3,'admin','Bali',0,'0','admin','202cb962ac59075b964b07152d234b70',1,1,1),
(4,'casier','Deli',0,'0','casier','77cf34f016313318086c77361bf90784',0,1,1);

/*Table structure for table `tb_kategori` */

DROP TABLE IF EXISTS `tb_kategori`;

CREATE TABLE `tb_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kategori` */

insert  into `tb_kategori`(`id`,`kategori`,`description`) values 
(1,'food',''),
(2,'beverage','');

/*Table structure for table `tb_meja` */

DROP TABLE IF EXISTS `tb_meja`;

CREATE TABLE `tb_meja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meja` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_meja` */

insert  into `tb_meja`(`id`,`meja`,`description`) values 
(1,'1',''),
(2,'2',''),
(3,'3','');

/*Table structure for table `tb_menu` */

DROP TABLE IF EXISTS `tb_menu`;

CREATE TABLE `tb_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(100) NOT NULL,
  `price` float unsigned NOT NULL,
  `kategori` int(11) NOT NULL,
  `stock` float unsigned NOT NULL,
  `img_path` text NOT NULL,
  `status` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tb_menu` */

insert  into `tb_menu`(`id`,`item`,`price`,`kategori`,`stock`,`img_path`,`status`) values 
(1,'Mie Ayam',10000,1,0,'','yes'),
(2,'Nasi Goreng',10000,1,0,'','yes'),
(3,'Ca Tahu',10000,1,0,'','yes'),
(4,'Salad',10000,1,0,'','yes'),
(5,'Ice Lemon Tea',7000,2,0,'','yes'),
(6,'Milo',7000,2,0,'','yes'),
(7,'Ginger Tea',7000,2,0,'','yes'),
(8,'Fruit Juice',7000,2,0,'','yes');

/*Table structure for table `tb_transaksi` */

DROP TABLE IF EXISTS `tb_transaksi`;

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `date_insert` datetime NOT NULL,
  `customer` varchar(100) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `qty` double unsigned NOT NULL,
  `price` double unsigned NOT NULL,
  `total_price` double unsigned NOT NULL,
  `rest_total` double unsigned NOT NULL,
  `method` enum('cash','transfer') NOT NULL,
  `description` text NOT NULL,
  `status` enum('paid') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_transaksi` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
