-- MySQL Script generated by MySQL Workbench
-- Thu Nov  9 11:02:15 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema ct467
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ct467
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ct467` DEFAULT CHARACTER SET utf8mb4 ;
USE `ct467` ;

-- -----------------------------------------------------
-- Table `ct467`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ct467`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(15) NULL DEFAULT NULL,
  `address` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `ct467`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ct467`.`product` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `price` DECIMAL(10,0) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `amount` INT(11) NULL DEFAULT NULL,
  `unit` VARCHAR(50) NULL DEFAULT NULL,
  `image` VARCHAR(255) NULL DEFAULT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `ct467`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ct467`.`order` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `userId` INT(11) NOT NULL,
  `productId` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `userId` (`userId` ASC) ,
  INDEX `productId` (`productId` ASC),
  CONSTRAINT `order_ibfk_1`
    FOREIGN KEY (`userId`)
    REFERENCES `ct467`.`user` (`id`),
  CONSTRAINT `order_ibfk_2`
    FOREIGN KEY (`productId`)
    REFERENCES `ct467`.`product` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 35
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `ct467`.`shipments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ct467`.`shipments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `address` VARCHAR(255) NULL DEFAULT NULL,
  `orderId` INT(11) NOT NULL,
  `status` TINYINT(1) NULL DEFAULT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `orderId` (`orderId` ASC) ,
  CONSTRAINT `shipments_ibfk_1`
    FOREIGN KEY (`orderId`)
    REFERENCES `ct467`.`order` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

USE `ct467` ;

INSERT INTO ct467.`product` (name, price, description, amount, unit, image) VALUES ('Womens Light Green Vans Old Skool', '850000', 'thanh lịch nho nhã, dễ phối đồ', '5', 'vnd', 'hinh1.jpg');
INSERT INTO ct467.`product` (name, price, description, amount, unit, image) VALUES ('Nike Air Force 1 Low', '1500000', 'lịch thiệp, cá tính, dễ phối đồ', '5', 'vnd', 'hinh2.jpg');
INSERT INTO ct467.`product` (name, price, description, amount, unit, image) VALUES ('ULTRABOOST 4.0 DNA', '2000000', 'lịch thiệp, cá tính, thể thao', '5', 'vnd', 'hinh3.jpg');
INSERT INTO ct467.`product` (name, price, description, amount, unit, image) VALUES ('DENIS CHELSEA BOOT – BLACK SUEDE', '2550000', 'lịch thiệp, sang trọng', '5', 'vnd', 'hinh4.jpg');
INSERT INTO ct467.`product` (name, price, description, amount, unit, image) VALUES ('Giày Dior B23 Low Top White Dior Oblique Like Auth', '2490000', 'lịch thiệp, sang trọng', '5', 'vnd', 'hinh5.jpg');
INSERT INTO ct467.`product` (name, price, description, amount, unit, image) VALUES ('Jordan 6 Retro Toro Bravo Auth', '2500000', 'sang trọng', '5', 'vnd', 'hinh6.jpg');
INSERT INTO ct467.`product` (name, price, description, amount, unit, image) VALUES ('Balenciaga Speed Trainer Pink Sole (W)', '2600000', 'lịch thiệp, sang trọng', '5', 'vnd', 'hinh7.jpg');
INSERT INTO ct467.`product` (name, price, description, amount, unit, image) VALUES ('Off-White Out Of Office white high trainer Auth', '1800000', 'sang trọng', '5', 'vnd', 'hinh8.jpg');
INSERT INTO ct467.`product` (name, price, description, amount, unit, image) VALUES ('Nike City Loop W Silt Red, Port Wine & White Auth', '1350000', 'thể thao, đường phố', '5', 'vnd', 'hinh9.jpg');
INSERT INTO ct467.`product` (name, price, description, amount, unit, image) VALUES ('ADIDAS YEEZY BOOST 350 V2 ZEBRA', '1770000', 'lịch thiệp, sang trọng', '5', 'vnd', 'hinh10.jpg');

-- -----------------------------------------------------
-- function CalculateTotalPrice
-- -----------------------------------------------------

DELIMITER $$
USE `ct467`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `CalculateTotalPrice`(user_id INT) RETURNS decimal(10,2)
    DETERMINISTIC
BEGIN
	DECLARE total DECIMAL(10,2);
    
	SELECT 
    SUM(p.price * o.quantity)
INTO total FROM
    ct467.order o
        JOIN
    product p ON o.productId = p.id
WHERE
    o.userId = user_id;

    RETURN total;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure CreateOrder
-- -----------------------------------------------------

DELIMITER $$
USE `ct467`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateOrder`(IN user_id INT, IN product_id INT, IN quantity INT)
BEGIN
	INSERT INTO ct467.order (userId, productId, quantity) VALUES (user_id, product_id, quantity);
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure asc
-- -----------------------------------------------------

DELIMITER $$
USE `ct467`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `asc`(userid int)
BEGIN
	SELECT o.id AS order_id, o.createdAt as order_createdAt, o.*, p.* FROM `order` o JOIN 
                `product` p ON o.productId = p.id WHERE o.userId = userid ORDER BY o.createdAt ASC;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure delete_order
-- -----------------------------------------------------

DELIMITER $$
USE `ct467`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_order`(in id int)
BEGIN
	delete from ct467.order where ct467.order.id = id;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure desc
-- -----------------------------------------------------

DELIMITER $$
USE `ct467`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `desc`(userid int)
BEGIN
	SELECT o.id AS order_id, o.updateAt as order_createdAt, o.*, p.* FROM `order` o JOIN 
                `product` p ON o.productId = p.id WHERE o.userId = userid ORDER BY o.createdAt DESC;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure update_order
-- -----------------------------------------------------

DELIMITER $$
USE `ct467`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_order`(in id int ,quantity int)
BEGIN
    UPDATE `ct467`.`order` SET `quantity` = quantity WHERE `id` = id;
END$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
