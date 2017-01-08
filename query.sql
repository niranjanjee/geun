ALTER TABLE `gem_products` CHANGE `is_best_seller` `is_negotiable` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0=>no, 1=>Yes';
ALTER TABLE `gem_products` CHANGE `is_negotiable` `is_negotiable` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '1=>no, 2=>Yes';
ALTER TABLE `gem_products` CHANGE `is_negotiable` `is_negotiable` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '1=>Yes, 2=>No';
ALTER TABLE `gem_stores` ADD `payment_options` VARCHAR(60) NULL DEFAULT NULL AFTER `logo`;
ALTER TABLE `gem_products` ADD `total_viewed` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `is_negotiable`;