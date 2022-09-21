
DROP TABLE IF EXISTS `moviment`;

CREATE TABLE `moviment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(120) NOT NULL,
  `date` date NOT NULL,
  `value` double NOT NULL,
  `type` enum('input','output') NOT NULL DEFAULT 'input',
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_moviment_user_idx` (`user_id`),
  CONSTRAINT `fk_moviment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ;

INSERT INTO `moviment` VALUES (1,'Venda a vista','2022-08-01',35.9,'input',1),(2,'Venda de mercadorias a vista','2022-08-01',98.45,'input',1),(3,'Serviço de limpeza','2022-08-01',120,'output',1),(4,'Pagamento de materiais','2022-08-01',250,'output',1),(5,'Pagamento internet','2022-08-01',105.9,'output',1),(6,'venda de mercadorias','2022-08-01',65,'input',1),(7,'Venda de serviço','2022-08-01',90,'input',1),(8,'Pagamente imostos','2022-08-01',189.56,'output',1),(9,'Venda de produtos','2022-08-01',22.85,'input',1),(10,'Venda de produtos','2022-08-01',165.45,'input',1),(11,'Pagamento energia elátrica','2022-08-01',388.85,'output',1),(12,'Pagamento serviço de segurança','2022-08-01',150,'output',1),(13,'Pagamento materiais de escritório','2022-08-01',89.45,'output',1);
