SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `shoutbox`
-- ----------------------------
DROP TABLE IF EXISTS `shoutbox`;
CREATE TABLE `shoutbox` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `mensagem` text,
  `data` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shoutbox
-- ----------------------------
INSERT INTO `shoutbox` VALUES ('70', '1', 'sdfsdf', '1507349741', '::1');
INSERT INTO `shoutbox` VALUES ('71', '1', 'e ae', '1507349745', '::1');
INSERT INTO `shoutbox` VALUES ('72', '1', 'asdasd', '1507349774', '::1');
INSERT INTO `shoutbox` VALUES ('73', '2', 'eae', '1507349982', '::1');
INSERT INTO `shoutbox` VALUES ('74', '1', 'salve negao', '1507349988', '::1');
INSERT INTO `shoutbox` VALUES ('75', '2', 'tranquilo', '1507349992', '::1');
INSERT INTO `shoutbox` VALUES ('76', '1', 'aham, e ai', '1507349997', '::1');
INSERT INTO `shoutbox` VALUES ('77', '2', 'aq ta tudo bem', '1507350001', '::1');
INSERT INTO `shoutbox` VALUES ('78', '1', 'asdasd', '1507352566', '::1');

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3');
