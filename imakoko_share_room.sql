-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2022 年 6 月 02 日 13:50
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `imakoko_share_room`
--

CREATE TABLE `imakoko_share_room` (
  `room_id` int(64) NOT NULL,
  `loc_lat` double NOT NULL,
  `loc_lon` double NOT NULL,
  `radius` int(11) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `room` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `imakoko_share_room`
--

INSERT INTO `imakoko_share_room` (`room_id`, `loc_lat`, `loc_lon`, `radius`, `time_start`, `time_end`, `room`, `date`) VALUES
(1, 35.669551, 139.711569, 100, '08:00:00', '20:00:00', '結婚式', '2022-06-02 22:13:51'),
(2, 35.6695899, 139.7116525, 200, '07:00:00', '19:00:00', '運動会', '2022-06-02 22:14:40'),
(3, 35.6695798, 139.7115482, 50, '07:00:00', '19:00:00', '2年4組', '2022-06-02 22:15:56'),
(4, 35.6695812, 139.7116675, 100, '07:00:00', '19:00:00', '徒競走', '2022-06-02 22:17:25'),
(5, 35.669584, 139.7115952, 50, '22:37:00', '22:37:00', 'room1', '2022-06-02 22:37:41');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `imakoko_share_room`
--
ALTER TABLE `imakoko_share_room`
  ADD PRIMARY KEY (`room_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `imakoko_share_room`
--
ALTER TABLE `imakoko_share_room`
  MODIFY `room_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
