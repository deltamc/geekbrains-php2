CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `description`) VALUES
(1, '176698653.jpg', 'Это радуга'),
(2, 'image2.PNG', 'Это пони');