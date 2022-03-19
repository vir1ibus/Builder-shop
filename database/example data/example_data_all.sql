-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 19 2022 г., 20:49
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `builder_shop`
--

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(3, 'ADMIN'),
(4, 'USER');

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`id`, `name`) VALUES
(1, 'Тип продукта'),
(2, 'Артикул производителя'),
(3, 'Тип двигателя'),
(4, 'Тактность двигателя'),
(5, 'Модель двигателя'),
(6, 'Объем двигателя'),
(7, 'Мощность'),
(8, 'Объем топливного бака'),
(9, 'Объем масляного бака'),
(10, 'Электростартер'),
(11, 'Скорости'),
(12, 'Ширина обработки'),
(13, 'Высота обработки'),
(14, 'Дальность выброса'),
(15, 'Регулировка дальности выброса'),
(16, 'Система шнеков'),
(17, 'Тип шнека');

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(8, 'Снегоуборщики', 'img/category/snowblower.jpg'),
(9, 'ДСП', 'img/category/chipboard.jpg'),
(10, 'Газоселикатные блоки', 'img/category/gas-silicate-blocks.jpg'),
(11, 'Освещение помещений', 'img/category/room-lighting.jpg'),
(12, 'Настенная плитка', 'img/category/wall-tiles.jpg'),
(13, 'Водоснабжение, Канализация, Отопление', 'img/category/water-supply.jpg');

--
-- Дамп данных таблицы `item`
--

INSERT INTO `item` (`id`, `name`, `image`, `price`, `description`, `category_id`) VALUES
(6, 'Снегоуборщик бензиновый Daewoo DAST 7565', 'img/item/Daewoo-DAST-7565.jpg', 74990, NULL, 8),
(7, 'Снегоуборщик электрический Daewoo DAST 3000E', 'img/item/Daewoo-DAST-3000E.jpg', 21990, NULL, 8),
(8, 'Снегоуборщик бензиновый Redverg RD-SB56/7E', 'img/item/Redverg-RD-SB56-7E.jpg', 46490, NULL, 8),
(9, 'Насадка нож-отвал Daewoo DASС 750B', 'img/item/Daewoo-DASС-750B.jpg', 5392, NULL, 8),
(10, 'Снегоуборщик бензиновый Redverg RD-SB60/950BS-E', 'img/item/Redverg-RD-SB60-950BS-E.jpg', 74990, NULL, 8),
(11, 'Тестовый товар', '../img/item/testovyy-tovar.jpg', 10000, NULL, 9);

--
-- Дамп данных таблицы `item_has_characteristics`
--

INSERT INTO `item_has_characteristics` (`item_id`, `characteristics_id`, `value`) VALUES
(6, 1, 'Снегоуборщик'),
(6, 2, 'DAST 7565'),
(6, 3, 'бензиновый'),
(6, 4, '4-тактный'),
(6, 5, 'Daewoo 220 winter'),
(6, 6, '221 см3'),
(6, 7, '7.5 л.с.'),
(6, 8, '3.8 л'),
(6, 9, '600 мл'),
(6, 10, 'да'),
(6, 11, '4 вперед; 1 назад'),
(6, 12, '65 см'),
(6, 13, '53 см'),
(6, 14, '12 м'),
(6, 15, 'с панели оператора'),
(6, 16, 'двухступенчатая'),
(6, 17, 'металлический');

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role_id`) VALUES
(4, 'vir1ibus', '88a4a8297bcf07479d8a47bd41900043d04797f694791e600638fb465b9f446deeae61c3425e0baaac2627eb05f9492fefea3e34155ed4febce6d831d6547763', 'vir1ibus@gmail.com', 3);

--
-- Дамп данных таблицы `user_token`
--

INSERT INTO `user_token` (`id`, `user_id`, `token`, `time_expired`) VALUES
(78, 4, '709e0f99236d7425ebd0b1d4b0f9fda49f35688b154e57443adb2e914d105ae7689d0eff34bd6544dbbda17149816f3a22e841d8d4fec51bdd27e7da2b77529079ad6fbb44c4ec6afb97b02749b6aa086e404894782659a3d98182706a38475bcfea5926e7de0aa4ed4e2ccd8bd4f9c262561983535f5783c282d5ce025c957e', '2022-03-19 21:26:34');
COMMIT;

--
-- Дамп данных таблицы `order_history`
--

INSERT INTO `order_history` (`id`, `user_id`, `sum`, `transaction_date`) VALUES
(1, 4, 50000, '2022-03-19 13:49:16');

--
-- Дамп данных таблицы `order_history_has_item`
--

INSERT INTO `order_history_has_item` (`order_history_id`, `item_id`, `count`) VALUES
(1, 8, 2),
(1, 9, 1);

--
-- Дамп данных таблицы `user_has_item`
--

INSERT INTO `user_has_item` (`user_id`, `item_id`) VALUES
(4, 8),
(4, 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
