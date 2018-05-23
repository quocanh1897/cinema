-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 23, 2018 lúc 10:20 AM
-- Phiên bản máy phục vụ: 10.1.30-MariaDB
-- Phiên bản PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_bkcinema`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cap_do_khach_hang` (IN `id_kh` INT)  NO SQL
BEGIN
	DECLARE diem_tich_luy int;
    set diem_tich_luy = `tinh_tien_khach_hang`(id_kh)/1000;
    UPDATE khach_hang set khach_hang.diemtichluy = diem_tich_luy where khach_hang.idkh = id_kh;
    IF diem_tich_luy >= 3000 THEN
    	UPDATE khach_hang set khach_hang.capdo = 'VIP' where khach_hang.idkh = id_kh;
    ELSEIF diem_tich_luy >= 1000 THEN
    	UPDATE khach_hang set khach_hang.capdo = 'A' where khach_hang.idkh = id_kh;
    ELSEIF diem_tich_luy >= 500 THEN
    	UPDATE khach_hang set khach_hang.capdo = 'B' where khach_hang.idkh = id_kh;   
    ELSEIF diem_tich_luy >= 250 THEN
    	UPDATE khach_hang set khach_hang.capdo = 'C' where khach_hang.idkh = id_kh; 
    ELSE
    	UPDATE khach_hang set khach_hang.capdo = 'D' where khach_hang.idkh = id_kh; 
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tinh_tien_hoa_don` (IN `ma_hoa_don` INT)  NO SQL
BEGIN
	declare tien_hoa_don int;
	set tien_hoa_don = `tinh_tien_hoa_don`(ma_hoa_don);
	UPDATE hoa_don set hoa_don.tongtien = tien_hoa_don where hoa_don.mahoadon = ma_hoa_don;
END$$

--
-- Các hàm
--
CREATE DEFINER=`root`@`localhost` FUNCTION `doanh_thu_theo_thoi_gian` (`day1` DATE, `day2` DATE) RETURNS INT(11) NO SQL
BEGIN
	DECLARE done INT DEFAULT FALSE;
    DECLARE sum INT DEFAULT 0;
    declare money INT;
	DECLARE money_cursor CURSOR FOR select hd.tongtien from hoa_don as hd where hd.ngayxuat >= day1 and hd.ngayxuat <= day2;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    OPEN money_cursor;
	read_loop: LOOP
		FETCH money_cursor into money;
		IF done THEN
 		     LEAVE read_loop;
		END IF;
		set sum = sum + money;
	END LOOP;
	CLOSE money_cursor;
	return sum;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `tinh_tien_dich_vu` (`ma_hoa_don` INT) RETURNS INT(11) NO SQL
BEGIN
	DECLARE done INT DEFAULT 0;
	declare dichvu, soluong INT;
    DECLARE sum INT DEFAULT 0;
	DECLARE money_cursor CURSOR FOR select dv.gia, sddv.soluong from su_dung_dich_vu as sddv, dich_vu as dv 
		where sddv.mahoadon = ma_hoa_don AND
			sddv.madv = dv.madv;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	OPEN money_cursor;
	read_loop: LOOP
		FETCH money_cursor into dichvu, soluong;
		IF done THEN
 		     LEAVE read_loop;
		END IF;
		set sum = sum + dichvu*soluong;
	END LOOP;
	CLOSE money_cursor;
	return sum;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `tinh_tien_hoa_don` (`ma_hoa_don` INT) RETURNS INT(11) NO SQL
BEGIN
	declare tien_hoa_don int;
	declare phantram float;
	set tien_hoa_don =  `tinh_tien_phim`(ma_hoa_don);
	set tien_hoa_don =  tien_hoa_don + `tinh_tien_dich_vu`(ma_hoa_don);

	set phantram = (select km.giamgia from hoa_don as hd, 	hoa_don_khuyen_mai as hdkm, khuyen_mai as km
		where hd.mahoadon = hdkm.mahoadon AND
    		hdkm.makm = km.makm AND
        	hd.mahoadon = ma_hoa_don);
    if (phantram <=> NULL) THEN
    	set phantram = 0;
    END IF;
	set tien_hoa_don = tien_hoa_don*(1-phantram);
	return tien_hoa_don;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `tinh_tien_khach_hang` (`id_kh` INT) RETURNS INT(11) NO SQL
BEGIN
	DECLARE done INT DEFAULT 0;
	declare money INT;
    DECLARE sum INT DEFAULT 0;
	DECLARE money_cursor CURSOR FOR select hd.tongtien from hoa_don as hd WHERE hd.idkh = id_kh;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    OPEN money_cursor;
	read_loop: LOOP
		FETCH money_cursor into money;
		IF done THEN
 		     LEAVE read_loop;
		END IF;
		set sum = sum + money;
	END LOOP;
	CLOSE money_cursor;
	return sum;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `tinh_tien_phim` (`ma_hoa_don` INT) RETURNS INT(11) NO SQL
BEGIN
	DECLARE done INT DEFAULT FALSE;
	declare giaphong, giaghe INT;
    DECLARE sum INT DEFAULT 0;
	DECLARE money_cursor CURSOR FOR select lp.gia as 'Gia phong', lg.gia as 'Gia ghe' from ve as v, ghe_ngoi as gn, loai_ghe as lg, phong_chieu as pc, loai_phong as lp
    where v.mahoadon = ma_hoa_don AND
        v.maghe = gn.maghe AND
        gn.tenloai = lg.tenloai AND
        gn.maphong = pc.maphong AND
        pc.tenloai = lp.tenloai;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	OPEN money_cursor;
	read_loop: LOOP
		FETCH money_cursor into giaphong, giaghe;
		IF done THEN
 		     LEAVE read_loop;
		END IF;
		set sum = sum + giaphong + giaghe;
	END LOOP;
	CLOSE money_cursor;
	return sum;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dia_ban`
--

CREATE TABLE `dia_ban` (
  `maqh` int(11) NOT NULL,
  `tenqh` varchar(100) DEFAULT NULL,
  `sorap` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dia_ban`
--

INSERT INTO `dia_ban` (`maqh`, `tenqh`, `sorap`) VALUES
(1, 'Quận 1', 2),
(2, 'Quận 5', 1),
(3, 'Quận 10', 1),
(4, 'Tân Bình', 1),
(5, 'Thủ Đức', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dich_vu`
--

CREATE TABLE `dich_vu` (
  `madv` int(11) NOT NULL,
  `loaidv` varchar(50) DEFAULT NULL,
  `tendv` varchar(50) DEFAULT NULL,
  `gia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dich_vu`
--

INSERT INTO `dich_vu` (`madv`, `loaidv`, `tendv`, `gia`) VALUES
(1, 'Thức ăn', 'Bỏng ngô', 10000),
(2, 'Thức ăn', 'Khoai tây chiên', 15000),
(3, 'Thức uống', 'Coca Cola', 10000),
(4, 'Thức uống', 'Trà sữa', 20000),
(5, 'Thức uống', 'Sinh tố trái cây', 25000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dien_vien`
--

CREATE TABLE `dien_vien` (
  `maphim` int(11) NOT NULL,
  `dienvien` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dien_vien`
--

INSERT INTO `dien_vien` (`maphim`, `dienvien`) VALUES
(1, 'Josh Brolin'),
(1, 'Julian Dennison'),
(1, 'Morena Baccarin'),
(1, 'Ryan Reynolds'),
(1, 'T. J. Miller'),
(1, 'Zazie Beetz'),
(2, 'Dave Bautista'),
(2, 'Karen Gillan'),
(2, 'Tom Holland'),
(3, 'Bryce Dallas Howard'),
(3, 'Chris Pratt'),
(3, 'Judy Greer'),
(3, 'Vincent D\'Onofrio'),
(4, 'hotgirl Nene'),
(4, 'Huy Khánh'),
(4, 'Kiều Minh Tuấn'),
(4, 'Song Luân'),
(5, 'Gin Tuấn Kiệt'),
(5, 'Jun Phạm'),
(5, 'Khả Ngân'),
(5, 'NSƯT Mỹ Uyên'),
(6, 'Alexandra Lamy'),
(6, 'Elsa Zylberstein'),
(6, 'Franck Dubosc'),
(7, 'Greg Proops'),
(7, 'Jim Gaffigan'),
(7, 'Lance Lim'),
(7, 'Zendaya'),
(8, 'Bruce Willis'),
(8, 'Elisabeth Shue'),
(8, 'Vincent D\'Onofrio'),
(9, 'Diệu Nhi'),
(9, 'Khả Như'),
(9, 'La Thành'),
(9, 'Thuận Nguyễn'),
(10, 'Dwayne Johnson'),
(10, 'Jeffrey Dean Morgan'),
(10, 'Malin Akerman'),
(11, 'George Bailey'),
(11, 'H.D. Quinn'),
(11, 'Marc Thompson'),
(11, 'Mike Pollock'),
(11, 'Sondra James'),
(12, 'Alden Ehrenreich'),
(12, 'Emilia Clarke'),
(12, 'Thandie Newton'),
(13, 'Kakazu Yumi'),
(13, 'Kimura Subaru'),
(13, 'Mizuta Wasabi'),
(13, 'Ohara Megumi'),
(14, 'Ngọc Trai'),
(14, 'Đại Nghĩa'),
(15, 'Dwayne Johnson'),
(15, 'Neve Campbell'),
(15, 'Pablo Schreiber'),
(16, 'Jason Statham'),
(16, 'Rainn Wilson'),
(16, 'Ruby Rose'),
(17, 'Evangeline Lilly'),
(17, 'Michelle Pfeiffer'),
(17, 'Walton Goggins'),
(18, 'Benedict Cumberbatch'),
(19, 'Holly Hunter'),
(19, 'Samuel L. Jackson'),
(19, 'Sarah Vowell '),
(20, 'Emily Blunt'),
(20, 'John Krasinski'),
(20, 'Noah Jupe');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ghe_ngoi`
--

CREATE TABLE `ghe_ngoi` (
  `maghe` int(11) NOT NULL,
  `soghe` varchar(10) DEFAULT NULL,
  `maphong` int(11) NOT NULL,
  `marap` int(11) NOT NULL,
  `tenloai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ghe_ngoi`
--

INSERT INTO `ghe_ngoi` (`maghe`, `soghe`, `maphong`, `marap`, `tenloai`) VALUES
(132, 'A1', 57, 1, 'Ghế Thường'),
(133, 'A2', 57, 1, 'Ghế Thường'),
(134, 'A3', 57, 1, 'Ghế Thường'),
(135, 'A4', 57, 1, 'Ghế Thường'),
(136, 'A5', 57, 1, 'Ghế Thường'),
(137, 'A6', 57, 1, 'Ghế Thường'),
(138, 'A7', 57, 1, 'Ghế Thường'),
(139, 'A8', 57, 1, 'Ghế Thường'),
(140, 'A9', 57, 1, 'Ghế Thường'),
(141, 'A10', 57, 1, 'Ghế Thường'),
(142, 'A11', 57, 1, 'Ghế Thường'),
(143, 'A12', 57, 1, 'Ghế Thường'),
(144, 'B1', 57, 1, 'Ghế Thường'),
(145, 'B2', 57, 1, 'Ghế Thường'),
(146, 'B3', 57, 1, 'Ghế Thường'),
(147, 'B4', 57, 1, 'Ghế Thường'),
(148, 'B5', 57, 1, 'Ghế Thường'),
(149, 'B6', 57, 1, 'Ghế Thường'),
(150, 'B7', 57, 1, 'Ghế Thường'),
(151, 'B8', 57, 1, 'Ghế Thường'),
(152, 'B9', 57, 1, 'Ghế Thường'),
(153, 'B10', 57, 1, 'Ghế Thường'),
(154, 'B11', 57, 1, 'Ghế Thường'),
(155, 'B12', 57, 1, 'Ghế Thường'),
(156, 'C1', 57, 1, 'Ghế Thường'),
(157, 'C2', 57, 1, 'Ghế Thường'),
(158, 'C3', 57, 1, 'Ghế Thường'),
(159, 'C4', 57, 1, 'Ghế Thường'),
(160, 'C5', 57, 1, 'Ghế Thường'),
(161, 'C6', 57, 1, 'Ghế Thường'),
(162, 'C7', 57, 1, 'Ghế Thường'),
(163, 'C8', 57, 1, 'Ghế Thường'),
(164, 'C9', 57, 1, 'Ghế Thường'),
(165, 'C10', 57, 1, 'Ghế Thường'),
(166, 'C11', 57, 1, 'Ghế Thường'),
(167, 'C12', 57, 1, 'Ghế Thường'),
(168, 'D1', 57, 1, 'Ghế Thường'),
(169, 'D2', 57, 1, 'Ghế Thường'),
(170, 'D3', 57, 1, 'Ghế Thường'),
(171, 'D4', 57, 1, 'Ghế Thường'),
(172, 'D5', 57, 1, 'Ghế Thường'),
(173, 'D6', 57, 1, 'Ghế Thường'),
(174, 'D7', 57, 1, 'Ghế Thường'),
(175, 'D8', 57, 1, 'Ghế Thường'),
(176, 'D9', 57, 1, 'Ghế Thường'),
(177, 'D10', 57, 1, 'Ghế Thường'),
(178, 'D11', 57, 1, 'Ghế Thường'),
(179, 'D12', 57, 1, 'Ghế Thường'),
(180, 'E1', 57, 1, 'Ghế Thường'),
(181, 'E2', 57, 1, 'Ghế Thường'),
(182, 'E3', 57, 1, 'Ghế Thường'),
(183, 'E4', 57, 1, 'Ghế Thường'),
(184, 'E5', 57, 1, 'Ghế Thường'),
(185, 'E6', 57, 1, 'Ghế Thường'),
(186, 'E7', 57, 1, 'Ghế Thường'),
(187, 'E8', 57, 1, 'Ghế Thường'),
(188, 'E9', 57, 1, 'Ghế Thường'),
(189, 'E10', 57, 1, 'Ghế Thường'),
(190, 'E11', 57, 1, 'Ghế Thường'),
(191, 'E12', 57, 1, 'Ghế Thường'),
(192, 'F1', 57, 1, 'Ghế Thường'),
(193, 'F2', 57, 1, 'Ghế Thường'),
(194, 'F3', 57, 1, 'Ghế Thường'),
(195, 'F4', 57, 1, 'Ghế Thường'),
(196, 'F5', 57, 1, 'Ghế Thường'),
(197, 'F6', 57, 1, 'Ghế Thường'),
(198, 'F7', 57, 1, 'Ghế Thường'),
(199, 'F8', 57, 1, 'Ghế Thường'),
(200, 'F9', 57, 1, 'Ghế Thường'),
(201, 'F10', 57, 1, 'Ghế Thường'),
(202, 'F11', 57, 1, 'Ghế Thường'),
(203, 'F12', 57, 1, 'Ghế Thường'),
(204, 'G1', 57, 1, 'Ghế Thường'),
(205, 'G2', 57, 1, 'Ghế Thường'),
(206, 'G3', 57, 1, 'Ghế Thường'),
(207, 'G4', 57, 1, 'Ghế Thường'),
(208, 'G5', 57, 1, 'Ghế Thường'),
(209, 'G6', 57, 1, 'Ghế Thường'),
(210, 'G7', 57, 1, 'Ghế Thường'),
(211, 'G8', 57, 1, 'Ghế Thường'),
(212, 'G9', 57, 1, 'Ghế Thường'),
(213, 'G10', 57, 1, 'Ghế Thường'),
(214, 'G11', 57, 1, 'Ghế Thường'),
(215, 'G12', 57, 1, 'Ghế Thường'),
(216, 'H1', 57, 1, 'Ghế Thường'),
(217, 'H2', 57, 1, 'Ghế Thường'),
(218, 'H3', 57, 1, 'Ghế Thường'),
(219, 'H4', 57, 1, 'Ghế Thường'),
(220, 'H5', 57, 1, 'Ghế Thường'),
(221, 'H6', 57, 1, 'Ghế Thường'),
(222, 'H7', 57, 1, 'Ghế Thường'),
(223, 'H8', 57, 1, 'Ghế Thường'),
(224, 'H9', 57, 1, 'Ghế Thường'),
(225, 'H10', 57, 1, 'Ghế Thường'),
(226, 'H11', 57, 1, 'Ghế Thường'),
(227, 'H12', 57, 1, 'Ghế Thường'),
(228, 'I1', 57, 1, 'Ghế Thường'),
(229, 'I2', 57, 1, 'Ghế Thường'),
(230, 'I3', 57, 1, 'Ghế Thường'),
(231, 'I4', 57, 1, 'Ghế Thường'),
(232, 'I5', 57, 1, 'Ghế Thường'),
(233, 'I6', 57, 1, 'Ghế Thường'),
(234, 'I7', 57, 1, 'Ghế Thường'),
(235, 'I8', 57, 1, 'Ghế Thường'),
(236, 'I9', 57, 1, 'Ghế Thường'),
(237, 'I10', 57, 1, 'Ghế Thường'),
(238, 'I11', 57, 1, 'Ghế Thường'),
(239, 'I12', 57, 1, 'Ghế Thường'),
(240, 'J1', 57, 1, 'Ghế đôi'),
(241, 'J2', 57, 1, 'Ghế đôi'),
(242, 'J3', 57, 1, 'Ghế đôi'),
(243, 'J4', 57, 1, 'Ghế đôi'),
(244, 'J5', 57, 1, 'Ghế đôi'),
(245, 'J6', 57, 1, 'Ghế đôi'),
(246, 'J7', 57, 1, 'Ghế đôi'),
(247, 'J8', 57, 1, 'Ghế đôi'),
(248, 'J9', 57, 1, 'Ghế đôi'),
(249, 'J10', 57, 1, 'Ghế đôi'),
(250, 'J11', 57, 1, 'Ghế đôi'),
(251, 'J12', 57, 1, 'Ghế đôi'),
(252, 'A1', 58, 1, 'Ghế Thường'),
(253, 'A2', 58, 1, 'Ghế Thường'),
(254, 'A3', 58, 1, 'Ghế Thường'),
(255, 'A4', 58, 1, 'Ghế Thường'),
(256, 'A5', 58, 1, 'Ghế Thường'),
(257, 'A6', 58, 1, 'Ghế Thường'),
(258, 'A7', 58, 1, 'Ghế Thường'),
(259, 'A8', 58, 1, 'Ghế Thường'),
(260, 'A9', 58, 1, 'Ghế Thường'),
(261, 'A10', 58, 1, 'Ghế Thường'),
(262, 'A11', 58, 1, 'Ghế Thường'),
(263, 'A12', 58, 1, 'Ghế Thường'),
(264, 'B1', 58, 1, 'Ghế Thường'),
(265, 'B2', 58, 1, 'Ghế Thường'),
(266, 'B3', 58, 1, 'Ghế Thường'),
(267, 'B4', 58, 1, 'Ghế Thường'),
(268, 'B5', 58, 1, 'Ghế Thường'),
(269, 'B6', 58, 1, 'Ghế Thường'),
(270, 'B7', 58, 1, 'Ghế Thường'),
(271, 'B8', 58, 1, 'Ghế Thường'),
(272, 'B9', 58, 1, 'Ghế Thường'),
(273, 'B10', 58, 1, 'Ghế Thường'),
(274, 'B11', 58, 1, 'Ghế Thường'),
(275, 'B12', 58, 1, 'Ghế Thường'),
(276, 'C1', 58, 1, 'Ghế Thường'),
(277, 'C2', 58, 1, 'Ghế Thường'),
(278, 'C3', 58, 1, 'Ghế Thường'),
(279, 'C4', 58, 1, 'Ghế Thường'),
(280, 'C5', 58, 1, 'Ghế Thường'),
(281, 'C6', 58, 1, 'Ghế Thường'),
(282, 'C7', 58, 1, 'Ghế Thường'),
(283, 'C8', 58, 1, 'Ghế Thường'),
(284, 'C9', 58, 1, 'Ghế Thường'),
(285, 'C10', 58, 1, 'Ghế Thường'),
(286, 'C11', 58, 1, 'Ghế Thường'),
(287, 'C12', 58, 1, 'Ghế Thường'),
(288, 'D1', 58, 1, 'Ghế Thường'),
(289, 'D2', 58, 1, 'Ghế Thường'),
(290, 'D3', 58, 1, 'Ghế Thường'),
(291, 'D4', 58, 1, 'Ghế Thường'),
(292, 'D5', 58, 1, 'Ghế Thường'),
(293, 'D6', 58, 1, 'Ghế Thường'),
(294, 'D7', 58, 1, 'Ghế Thường'),
(295, 'D8', 58, 1, 'Ghế Thường'),
(296, 'D9', 58, 1, 'Ghế Thường'),
(297, 'D10', 58, 1, 'Ghế Thường'),
(298, 'D11', 58, 1, 'Ghế Thường'),
(299, 'D12', 58, 1, 'Ghế Thường'),
(300, 'E1', 58, 1, 'Ghế Thường'),
(301, 'E2', 58, 1, 'Ghế Thường'),
(302, 'E3', 58, 1, 'Ghế Thường'),
(303, 'E4', 58, 1, 'Ghế Thường'),
(304, 'E5', 58, 1, 'Ghế Thường'),
(305, 'E6', 58, 1, 'Ghế Thường'),
(306, 'E7', 58, 1, 'Ghế Thường'),
(307, 'E8', 58, 1, 'Ghế Thường'),
(308, 'E9', 58, 1, 'Ghế Thường'),
(309, 'E10', 58, 1, 'Ghế Thường'),
(310, 'E11', 58, 1, 'Ghế Thường'),
(311, 'E12', 58, 1, 'Ghế Thường'),
(312, 'F1', 58, 1, 'Ghế Thường'),
(313, 'F2', 58, 1, 'Ghế Thường'),
(314, 'F3', 58, 1, 'Ghế Thường'),
(315, 'F4', 58, 1, 'Ghế Thường'),
(316, 'F5', 58, 1, 'Ghế Thường'),
(317, 'F6', 58, 1, 'Ghế Thường'),
(318, 'F7', 58, 1, 'Ghế Thường'),
(319, 'F8', 58, 1, 'Ghế Thường'),
(320, 'F9', 58, 1, 'Ghế Thường'),
(321, 'F10', 58, 1, 'Ghế Thường'),
(322, 'F11', 58, 1, 'Ghế Thường'),
(323, 'F12', 58, 1, 'Ghế Thường'),
(324, 'G1', 58, 1, 'Ghế Thường'),
(325, 'G2', 58, 1, 'Ghế Thường'),
(326, 'G3', 58, 1, 'Ghế Thường'),
(327, 'G4', 58, 1, 'Ghế Thường'),
(328, 'G5', 58, 1, 'Ghế Thường'),
(329, 'G6', 58, 1, 'Ghế Thường'),
(330, 'G7', 58, 1, 'Ghế Thường'),
(331, 'G8', 58, 1, 'Ghế Thường'),
(332, 'G9', 58, 1, 'Ghế Thường'),
(333, 'G10', 58, 1, 'Ghế Thường'),
(334, 'G11', 58, 1, 'Ghế Thường'),
(335, 'G12', 58, 1, 'Ghế Thường'),
(336, 'H1', 58, 1, 'Ghế Thường'),
(337, 'H2', 58, 1, 'Ghế Thường'),
(338, 'H3', 58, 1, 'Ghế Thường'),
(339, 'H4', 58, 1, 'Ghế Thường'),
(340, 'H5', 58, 1, 'Ghế Thường'),
(341, 'H6', 58, 1, 'Ghế Thường'),
(342, 'H7', 58, 1, 'Ghế Thường'),
(343, 'H8', 58, 1, 'Ghế Thường'),
(344, 'H9', 58, 1, 'Ghế Thường'),
(345, 'H10', 58, 1, 'Ghế Thường'),
(346, 'H11', 58, 1, 'Ghế Thường'),
(347, 'H12', 58, 1, 'Ghế Thường'),
(348, 'I1', 58, 1, 'Ghế Thường'),
(349, 'I2', 58, 1, 'Ghế Thường'),
(350, 'I3', 58, 1, 'Ghế Thường'),
(351, 'I4', 58, 1, 'Ghế Thường'),
(352, 'I5', 58, 1, 'Ghế Thường'),
(353, 'I6', 58, 1, 'Ghế Thường'),
(354, 'I7', 58, 1, 'Ghế Thường'),
(355, 'I8', 58, 1, 'Ghế Thường'),
(356, 'I9', 58, 1, 'Ghế Thường'),
(357, 'I10', 58, 1, 'Ghế Thường'),
(358, 'I11', 58, 1, 'Ghế Thường'),
(359, 'I12', 58, 1, 'Ghế Thường'),
(360, 'J1', 58, 1, 'Ghế đôi'),
(361, 'J2', 58, 1, 'Ghế đôi'),
(362, 'J3', 58, 1, 'Ghế đôi'),
(363, 'J4', 58, 1, 'Ghế đôi'),
(364, 'J5', 58, 1, 'Ghế đôi'),
(365, 'J6', 58, 1, 'Ghế đôi'),
(366, 'J7', 58, 1, 'Ghế đôi'),
(367, 'J8', 58, 1, 'Ghế đôi'),
(368, 'J9', 58, 1, 'Ghế đôi'),
(369, 'J10', 58, 1, 'Ghế đôi'),
(370, 'J11', 58, 1, 'Ghế đôi'),
(371, 'J12', 58, 1, 'Ghế đôi'),
(372, 'A1', 59, 1, 'Ghế Imax'),
(373, 'A2', 59, 1, 'Ghế Imax'),
(374, 'A3', 59, 1, 'Ghế Imax'),
(375, 'A4', 59, 1, 'Ghế Imax'),
(376, 'A5', 59, 1, 'Ghế Imax'),
(377, 'A6', 59, 1, 'Ghế Imax'),
(378, 'A7', 59, 1, 'Ghế Imax'),
(379, 'A8', 59, 1, 'Ghế Imax'),
(380, 'A9', 59, 1, 'Ghế Imax'),
(381, 'A10', 59, 1, 'Ghế Imax'),
(382, 'A11', 59, 1, 'Ghế Imax'),
(383, 'A12', 59, 1, 'Ghế Imax'),
(384, 'B1', 59, 1, 'Ghế Imax'),
(385, 'B2', 59, 1, 'Ghế Imax'),
(386, 'B3', 59, 1, 'Ghế Imax'),
(387, 'B4', 59, 1, 'Ghế Imax'),
(388, 'B5', 59, 1, 'Ghế Imax'),
(389, 'B6', 59, 1, 'Ghế Imax'),
(390, 'B7', 59, 1, 'Ghế Imax'),
(391, 'B8', 59, 1, 'Ghế Imax'),
(392, 'B9', 59, 1, 'Ghế Imax'),
(393, 'B10', 59, 1, 'Ghế Imax'),
(394, 'B11', 59, 1, 'Ghế Imax'),
(395, 'B12', 59, 1, 'Ghế Imax'),
(396, 'C1', 59, 1, 'Ghế Imax'),
(397, 'C2', 59, 1, 'Ghế Imax'),
(398, 'C3', 59, 1, 'Ghế Imax'),
(399, 'C4', 59, 1, 'Ghế Imax'),
(400, 'C5', 59, 1, 'Ghế Imax'),
(401, 'C6', 59, 1, 'Ghế Imax'),
(402, 'C7', 59, 1, 'Ghế Imax'),
(403, 'C8', 59, 1, 'Ghế Imax'),
(404, 'C9', 59, 1, 'Ghế Imax'),
(405, 'C10', 59, 1, 'Ghế Imax'),
(406, 'C11', 59, 1, 'Ghế Imax'),
(407, 'C12', 59, 1, 'Ghế Imax'),
(408, 'D1', 59, 1, 'Ghế Imax'),
(409, 'D2', 59, 1, 'Ghế Imax'),
(410, 'D3', 59, 1, 'Ghế Imax'),
(411, 'D4', 59, 1, 'Ghế Imax'),
(412, 'D5', 59, 1, 'Ghế Imax'),
(413, 'D6', 59, 1, 'Ghế Imax'),
(414, 'D7', 59, 1, 'Ghế Imax'),
(415, 'D8', 59, 1, 'Ghế Imax'),
(416, 'D9', 59, 1, 'Ghế Imax'),
(417, 'D10', 59, 1, 'Ghế Imax'),
(418, 'D11', 59, 1, 'Ghế Imax'),
(419, 'D12', 59, 1, 'Ghế Imax'),
(420, 'E1', 59, 1, 'Ghế Imax'),
(421, 'E2', 59, 1, 'Ghế Imax'),
(422, 'E3', 59, 1, 'Ghế Imax'),
(423, 'E4', 59, 1, 'Ghế Imax'),
(424, 'E5', 59, 1, 'Ghế Imax'),
(425, 'E6', 59, 1, 'Ghế Imax'),
(426, 'E7', 59, 1, 'Ghế Imax'),
(427, 'E8', 59, 1, 'Ghế Imax'),
(428, 'E9', 59, 1, 'Ghế Imax'),
(429, 'E10', 59, 1, 'Ghế Imax'),
(430, 'E11', 59, 1, 'Ghế Imax'),
(431, 'E12', 59, 1, 'Ghế Imax'),
(432, 'F1', 59, 1, 'Ghế Imax'),
(433, 'F2', 59, 1, 'Ghế Imax'),
(434, 'F3', 59, 1, 'Ghế Imax'),
(435, 'F4', 59, 1, 'Ghế Imax'),
(436, 'F5', 59, 1, 'Ghế Imax'),
(437, 'F6', 59, 1, 'Ghế Imax'),
(438, 'F7', 59, 1, 'Ghế Imax'),
(439, 'F8', 59, 1, 'Ghế Imax'),
(440, 'F9', 59, 1, 'Ghế Imax'),
(441, 'F10', 59, 1, 'Ghế Imax'),
(442, 'F11', 59, 1, 'Ghế Imax'),
(443, 'F12', 59, 1, 'Ghế Imax'),
(444, 'G1', 59, 1, 'Ghế Imax'),
(445, 'G2', 59, 1, 'Ghế Imax'),
(446, 'G3', 59, 1, 'Ghế Imax'),
(447, 'G4', 59, 1, 'Ghế Imax'),
(448, 'G5', 59, 1, 'Ghế Imax'),
(449, 'G6', 59, 1, 'Ghế Imax'),
(450, 'G7', 59, 1, 'Ghế Imax'),
(451, 'G8', 59, 1, 'Ghế Imax'),
(452, 'G9', 59, 1, 'Ghế Imax'),
(453, 'G10', 59, 1, 'Ghế Imax'),
(454, 'G11', 59, 1, 'Ghế Imax'),
(455, 'G12', 59, 1, 'Ghế Imax'),
(456, 'H1', 59, 1, 'Ghế Imax'),
(457, 'H2', 59, 1, 'Ghế Imax'),
(458, 'H3', 59, 1, 'Ghế Imax'),
(459, 'H4', 59, 1, 'Ghế Imax'),
(460, 'H5', 59, 1, 'Ghế Imax'),
(461, 'H6', 59, 1, 'Ghế Imax'),
(462, 'H7', 59, 1, 'Ghế Imax'),
(463, 'H8', 59, 1, 'Ghế Imax'),
(464, 'H9', 59, 1, 'Ghế Imax'),
(465, 'H10', 59, 1, 'Ghế Imax'),
(466, 'H11', 59, 1, 'Ghế Imax'),
(467, 'H12', 59, 1, 'Ghế Imax'),
(468, 'I1', 59, 1, 'Ghế Imax'),
(469, 'I2', 59, 1, 'Ghế Imax'),
(470, 'I3', 59, 1, 'Ghế Imax'),
(471, 'I4', 59, 1, 'Ghế Imax'),
(472, 'I5', 59, 1, 'Ghế Imax'),
(473, 'I6', 59, 1, 'Ghế Imax'),
(474, 'I7', 59, 1, 'Ghế Imax'),
(475, 'I8', 59, 1, 'Ghế Imax'),
(476, 'I9', 59, 1, 'Ghế Imax'),
(477, 'I10', 59, 1, 'Ghế Imax'),
(478, 'I11', 59, 1, 'Ghế Imax'),
(479, 'I12', 59, 1, 'Ghế Imax'),
(480, 'J1', 59, 1, 'Ghế Imax'),
(481, 'J2', 59, 1, 'Ghế Imax'),
(482, 'J3', 59, 1, 'Ghế Imax'),
(483, 'J4', 59, 1, 'Ghế Imax'),
(484, 'J5', 59, 1, 'Ghế Imax'),
(485, 'J6', 59, 1, 'Ghế Imax'),
(486, 'J7', 59, 1, 'Ghế Imax'),
(487, 'J8', 59, 1, 'Ghế Imax'),
(488, 'J9', 59, 1, 'Ghế Imax'),
(489, 'J10', 59, 1, 'Ghế Imax'),
(490, 'J11', 59, 1, 'Ghế Imax'),
(491, 'J12', 59, 1, 'Ghế Imax'),
(492, 'A1', 60, 2, 'Ghế Thường'),
(493, 'A2', 60, 2, 'Ghế Thường'),
(494, 'A3', 60, 2, 'Ghế Thường'),
(495, 'A4', 60, 2, 'Ghế Thường'),
(496, 'A5', 60, 2, 'Ghế Thường'),
(497, 'A6', 60, 2, 'Ghế Thường'),
(498, 'A7', 60, 2, 'Ghế Thường'),
(499, 'A8', 60, 2, 'Ghế Thường'),
(500, 'A9', 60, 2, 'Ghế Thường'),
(501, 'A10', 60, 2, 'Ghế Thường'),
(502, 'A11', 60, 2, 'Ghế Thường'),
(503, 'A12', 60, 2, 'Ghế Thường'),
(504, 'B1', 60, 2, 'Ghế Thường'),
(505, 'B2', 60, 2, 'Ghế Thường'),
(506, 'B3', 60, 2, 'Ghế Thường'),
(507, 'B4', 60, 2, 'Ghế Thường'),
(508, 'B5', 60, 2, 'Ghế Thường'),
(509, 'B6', 60, 2, 'Ghế Thường'),
(510, 'B7', 60, 2, 'Ghế Thường'),
(511, 'B8', 60, 2, 'Ghế Thường'),
(512, 'B9', 60, 2, 'Ghế Thường'),
(513, 'B10', 60, 2, 'Ghế Thường'),
(514, 'B11', 60, 2, 'Ghế Thường'),
(515, 'B12', 60, 2, 'Ghế Thường'),
(516, 'C1', 60, 2, 'Ghế Thường'),
(517, 'C2', 60, 2, 'Ghế Thường'),
(518, 'C3', 60, 2, 'Ghế Thường'),
(519, 'C4', 60, 2, 'Ghế Thường'),
(520, 'C5', 60, 2, 'Ghế Thường'),
(521, 'C6', 60, 2, 'Ghế Thường'),
(522, 'C7', 60, 2, 'Ghế Thường'),
(523, 'C8', 60, 2, 'Ghế Thường'),
(524, 'C9', 60, 2, 'Ghế Thường'),
(525, 'C10', 60, 2, 'Ghế Thường'),
(526, 'C11', 60, 2, 'Ghế Thường'),
(527, 'C12', 60, 2, 'Ghế Thường'),
(528, 'D1', 60, 2, 'Ghế Thường'),
(529, 'D2', 60, 2, 'Ghế Thường'),
(530, 'D3', 60, 2, 'Ghế Thường'),
(531, 'D4', 60, 2, 'Ghế Thường'),
(532, 'D5', 60, 2, 'Ghế Thường'),
(533, 'D6', 60, 2, 'Ghế Thường'),
(534, 'D7', 60, 2, 'Ghế Thường'),
(535, 'D8', 60, 2, 'Ghế Thường'),
(536, 'D9', 60, 2, 'Ghế Thường'),
(537, 'D10', 60, 2, 'Ghế Thường'),
(538, 'D11', 60, 2, 'Ghế Thường'),
(539, 'D12', 60, 2, 'Ghế Thường'),
(540, 'E1', 60, 2, 'Ghế Thường'),
(541, 'E2', 60, 2, 'Ghế Thường'),
(542, 'E3', 60, 2, 'Ghế Thường'),
(543, 'E4', 60, 2, 'Ghế Thường'),
(544, 'E5', 60, 2, 'Ghế Thường'),
(545, 'E6', 60, 2, 'Ghế Thường'),
(546, 'E7', 60, 2, 'Ghế Thường'),
(547, 'E8', 60, 2, 'Ghế Thường'),
(548, 'E9', 60, 2, 'Ghế Thường'),
(549, 'E10', 60, 2, 'Ghế Thường'),
(550, 'E11', 60, 2, 'Ghế Thường'),
(551, 'E12', 60, 2, 'Ghế Thường'),
(552, 'F1', 60, 2, 'Ghế Thường'),
(553, 'F2', 60, 2, 'Ghế Thường'),
(554, 'F3', 60, 2, 'Ghế Thường'),
(555, 'F4', 60, 2, 'Ghế Thường'),
(556, 'F5', 60, 2, 'Ghế Thường'),
(557, 'F6', 60, 2, 'Ghế Thường'),
(558, 'F7', 60, 2, 'Ghế Thường'),
(559, 'F8', 60, 2, 'Ghế Thường'),
(560, 'F9', 60, 2, 'Ghế Thường'),
(561, 'F10', 60, 2, 'Ghế Thường'),
(562, 'F11', 60, 2, 'Ghế Thường'),
(563, 'F12', 60, 2, 'Ghế Thường'),
(564, 'G1', 60, 2, 'Ghế Thường'),
(565, 'G2', 60, 2, 'Ghế Thường'),
(566, 'G3', 60, 2, 'Ghế Thường'),
(567, 'G4', 60, 2, 'Ghế Thường'),
(568, 'G5', 60, 2, 'Ghế Thường'),
(569, 'G6', 60, 2, 'Ghế Thường'),
(570, 'G7', 60, 2, 'Ghế Thường'),
(571, 'G8', 60, 2, 'Ghế Thường'),
(572, 'G9', 60, 2, 'Ghế Thường'),
(573, 'G10', 60, 2, 'Ghế Thường'),
(574, 'G11', 60, 2, 'Ghế Thường'),
(575, 'G12', 60, 2, 'Ghế Thường'),
(576, 'H1', 60, 2, 'Ghế Thường'),
(577, 'H2', 60, 2, 'Ghế Thường'),
(578, 'H3', 60, 2, 'Ghế Thường'),
(579, 'H4', 60, 2, 'Ghế Thường'),
(580, 'H5', 60, 2, 'Ghế Thường'),
(581, 'H6', 60, 2, 'Ghế Thường'),
(582, 'H7', 60, 2, 'Ghế Thường'),
(583, 'H8', 60, 2, 'Ghế Thường'),
(584, 'H9', 60, 2, 'Ghế Thường'),
(585, 'H10', 60, 2, 'Ghế Thường'),
(586, 'H11', 60, 2, 'Ghế Thường'),
(587, 'H12', 60, 2, 'Ghế Thường'),
(588, 'I1', 60, 2, 'Ghế Thường'),
(589, 'I2', 60, 2, 'Ghế Thường'),
(590, 'I3', 60, 2, 'Ghế Thường'),
(591, 'I4', 60, 2, 'Ghế Thường'),
(592, 'I5', 60, 2, 'Ghế Thường'),
(593, 'I6', 60, 2, 'Ghế Thường'),
(594, 'I7', 60, 2, 'Ghế Thường'),
(595, 'I8', 60, 2, 'Ghế Thường'),
(596, 'I9', 60, 2, 'Ghế Thường'),
(597, 'I10', 60, 2, 'Ghế Thường'),
(598, 'I11', 60, 2, 'Ghế Thường'),
(599, 'I12', 60, 2, 'Ghế Thường'),
(600, 'J1', 60, 2, 'Ghế đôi'),
(601, 'J2', 60, 2, 'Ghế đôi'),
(602, 'J3', 60, 2, 'Ghế đôi'),
(603, 'J4', 60, 2, 'Ghế đôi'),
(604, 'J5', 60, 2, 'Ghế đôi'),
(605, 'J6', 60, 2, 'Ghế đôi'),
(606, 'J7', 60, 2, 'Ghế đôi'),
(607, 'J8', 60, 2, 'Ghế đôi'),
(608, 'J9', 60, 2, 'Ghế đôi'),
(609, 'J10', 60, 2, 'Ghế đôi'),
(610, 'J11', 60, 2, 'Ghế đôi'),
(611, 'J12', 60, 2, 'Ghế đôi'),
(612, 'A1', 61, 2, 'Ghế Imax'),
(613, 'A2', 61, 2, 'Ghế Imax'),
(614, 'A3', 61, 2, 'Ghế Imax'),
(615, 'A4', 61, 2, 'Ghế Imax'),
(616, 'A5', 61, 2, 'Ghế Imax'),
(617, 'A6', 61, 2, 'Ghế Imax'),
(618, 'A7', 61, 2, 'Ghế Imax'),
(619, 'A8', 61, 2, 'Ghế Imax'),
(620, 'A9', 61, 2, 'Ghế Imax'),
(621, 'A10', 61, 2, 'Ghế Imax'),
(622, 'A11', 61, 2, 'Ghế Imax'),
(623, 'A12', 61, 2, 'Ghế Imax'),
(624, 'B1', 61, 2, 'Ghế Imax'),
(625, 'B2', 61, 2, 'Ghế Imax'),
(626, 'B3', 61, 2, 'Ghế Imax'),
(627, 'B4', 61, 2, 'Ghế Imax'),
(628, 'B5', 61, 2, 'Ghế Imax'),
(629, 'B6', 61, 2, 'Ghế Imax'),
(630, 'B7', 61, 2, 'Ghế Imax'),
(631, 'B8', 61, 2, 'Ghế Imax'),
(632, 'B9', 61, 2, 'Ghế Imax'),
(633, 'B10', 61, 2, 'Ghế Imax'),
(634, 'B11', 61, 2, 'Ghế Imax'),
(635, 'B12', 61, 2, 'Ghế Imax'),
(636, 'C1', 61, 2, 'Ghế Imax'),
(637, 'C2', 61, 2, 'Ghế Imax'),
(638, 'C3', 61, 2, 'Ghế Imax'),
(639, 'C4', 61, 2, 'Ghế Imax'),
(640, 'C5', 61, 2, 'Ghế Imax'),
(641, 'C6', 61, 2, 'Ghế Imax'),
(642, 'C7', 61, 2, 'Ghế Imax'),
(643, 'C8', 61, 2, 'Ghế Imax'),
(644, 'C9', 61, 2, 'Ghế Imax'),
(645, 'C10', 61, 2, 'Ghế Imax'),
(646, 'C11', 61, 2, 'Ghế Imax'),
(647, 'C12', 61, 2, 'Ghế Imax'),
(648, 'D1', 61, 2, 'Ghế Imax'),
(649, 'D2', 61, 2, 'Ghế Imax'),
(650, 'D3', 61, 2, 'Ghế Imax'),
(651, 'D4', 61, 2, 'Ghế Imax'),
(652, 'D5', 61, 2, 'Ghế Imax'),
(653, 'D6', 61, 2, 'Ghế Imax'),
(654, 'D7', 61, 2, 'Ghế Imax'),
(655, 'D8', 61, 2, 'Ghế Imax'),
(656, 'D9', 61, 2, 'Ghế Imax'),
(657, 'D10', 61, 2, 'Ghế Imax'),
(658, 'D11', 61, 2, 'Ghế Imax'),
(659, 'D12', 61, 2, 'Ghế Imax'),
(660, 'E1', 61, 2, 'Ghế Imax'),
(661, 'E2', 61, 2, 'Ghế Imax'),
(662, 'E3', 61, 2, 'Ghế Imax'),
(663, 'E4', 61, 2, 'Ghế Imax'),
(664, 'E5', 61, 2, 'Ghế Imax'),
(665, 'E6', 61, 2, 'Ghế Imax'),
(666, 'E7', 61, 2, 'Ghế Imax'),
(667, 'E8', 61, 2, 'Ghế Imax'),
(668, 'E9', 61, 2, 'Ghế Imax'),
(669, 'E10', 61, 2, 'Ghế Imax'),
(670, 'E11', 61, 2, 'Ghế Imax'),
(671, 'E12', 61, 2, 'Ghế Imax'),
(672, 'F1', 61, 2, 'Ghế Imax'),
(673, 'F2', 61, 2, 'Ghế Imax'),
(674, 'F3', 61, 2, 'Ghế Imax'),
(675, 'F4', 61, 2, 'Ghế Imax'),
(676, 'F5', 61, 2, 'Ghế Imax'),
(677, 'F6', 61, 2, 'Ghế Imax'),
(678, 'F7', 61, 2, 'Ghế Imax'),
(679, 'F8', 61, 2, 'Ghế Imax'),
(680, 'F9', 61, 2, 'Ghế Imax'),
(681, 'F10', 61, 2, 'Ghế Imax'),
(682, 'F11', 61, 2, 'Ghế Imax'),
(683, 'F12', 61, 2, 'Ghế Imax'),
(684, 'G1', 61, 2, 'Ghế Imax'),
(685, 'G2', 61, 2, 'Ghế Imax'),
(686, 'G3', 61, 2, 'Ghế Imax'),
(687, 'G4', 61, 2, 'Ghế Imax'),
(688, 'G5', 61, 2, 'Ghế Imax'),
(689, 'G6', 61, 2, 'Ghế Imax'),
(690, 'G7', 61, 2, 'Ghế Imax'),
(691, 'G8', 61, 2, 'Ghế Imax'),
(692, 'G9', 61, 2, 'Ghế Imax'),
(693, 'G10', 61, 2, 'Ghế Imax'),
(694, 'G11', 61, 2, 'Ghế Imax'),
(695, 'G12', 61, 2, 'Ghế Imax'),
(696, 'H1', 61, 2, 'Ghế Imax'),
(697, 'H2', 61, 2, 'Ghế Imax'),
(698, 'H3', 61, 2, 'Ghế Imax'),
(699, 'H4', 61, 2, 'Ghế Imax'),
(700, 'H5', 61, 2, 'Ghế Imax'),
(701, 'H6', 61, 2, 'Ghế Imax'),
(702, 'H7', 61, 2, 'Ghế Imax'),
(703, 'H8', 61, 2, 'Ghế Imax'),
(704, 'H9', 61, 2, 'Ghế Imax'),
(705, 'H10', 61, 2, 'Ghế Imax'),
(706, 'H11', 61, 2, 'Ghế Imax'),
(707, 'H12', 61, 2, 'Ghế Imax'),
(708, 'I1', 61, 2, 'Ghế Imax'),
(709, 'I2', 61, 2, 'Ghế Imax'),
(710, 'I3', 61, 2, 'Ghế Imax'),
(711, 'I4', 61, 2, 'Ghế Imax'),
(712, 'I5', 61, 2, 'Ghế Imax'),
(713, 'I6', 61, 2, 'Ghế Imax'),
(714, 'I7', 61, 2, 'Ghế Imax'),
(715, 'I8', 61, 2, 'Ghế Imax'),
(716, 'I9', 61, 2, 'Ghế Imax'),
(717, 'I10', 61, 2, 'Ghế Imax'),
(718, 'I11', 61, 2, 'Ghế Imax'),
(719, 'I12', 61, 2, 'Ghế Imax'),
(720, 'J1', 61, 2, 'Ghế Imax'),
(721, 'J2', 61, 2, 'Ghế Imax'),
(722, 'J3', 61, 2, 'Ghế Imax'),
(723, 'J4', 61, 2, 'Ghế Imax'),
(724, 'J5', 61, 2, 'Ghế Imax'),
(725, 'J6', 61, 2, 'Ghế Imax'),
(726, 'J7', 61, 2, 'Ghế Imax'),
(727, 'J8', 61, 2, 'Ghế Imax'),
(728, 'J9', 61, 2, 'Ghế Imax'),
(729, 'J10', 61, 2, 'Ghế Imax'),
(730, 'J11', 61, 2, 'Ghế Imax'),
(731, 'J12', 61, 2, 'Ghế Imax'),
(732, 'A1', 62, 2, 'Ghế Thường'),
(733, 'A2', 62, 2, 'Ghế Thường'),
(734, 'A3', 62, 2, 'Ghế Thường'),
(735, 'A4', 62, 2, 'Ghế Thường'),
(736, 'A5', 62, 2, 'Ghế Thường'),
(737, 'A6', 62, 2, 'Ghế Thường'),
(738, 'A7', 62, 2, 'Ghế Thường'),
(739, 'A8', 62, 2, 'Ghế Thường'),
(740, 'A9', 62, 2, 'Ghế Thường'),
(741, 'A10', 62, 2, 'Ghế Thường'),
(742, 'A11', 62, 2, 'Ghế Thường'),
(743, 'A12', 62, 2, 'Ghế Thường'),
(744, 'B1', 62, 2, 'Ghế Thường'),
(745, 'B2', 62, 2, 'Ghế Thường'),
(746, 'B3', 62, 2, 'Ghế Thường'),
(747, 'B4', 62, 2, 'Ghế Thường'),
(748, 'B5', 62, 2, 'Ghế Thường'),
(749, 'B6', 62, 2, 'Ghế Thường'),
(750, 'B7', 62, 2, 'Ghế Thường'),
(751, 'B8', 62, 2, 'Ghế Thường'),
(752, 'B9', 62, 2, 'Ghế Thường'),
(753, 'B10', 62, 2, 'Ghế Thường'),
(754, 'B11', 62, 2, 'Ghế Thường'),
(755, 'B12', 62, 2, 'Ghế Thường'),
(756, 'C1', 62, 2, 'Ghế Thường'),
(757, 'C2', 62, 2, 'Ghế Thường'),
(758, 'C3', 62, 2, 'Ghế Thường'),
(759, 'C4', 62, 2, 'Ghế Thường'),
(760, 'C5', 62, 2, 'Ghế Thường'),
(761, 'C6', 62, 2, 'Ghế Thường'),
(762, 'C7', 62, 2, 'Ghế Thường'),
(763, 'C8', 62, 2, 'Ghế Thường'),
(764, 'C9', 62, 2, 'Ghế Thường'),
(765, 'C10', 62, 2, 'Ghế Thường'),
(766, 'C11', 62, 2, 'Ghế Thường'),
(767, 'C12', 62, 2, 'Ghế Thường'),
(768, 'D1', 62, 2, 'Ghế Thường'),
(769, 'D2', 62, 2, 'Ghế Thường'),
(770, 'D3', 62, 2, 'Ghế Thường'),
(771, 'D4', 62, 2, 'Ghế Thường'),
(772, 'D5', 62, 2, 'Ghế Thường'),
(773, 'D6', 62, 2, 'Ghế Thường'),
(774, 'D7', 62, 2, 'Ghế Thường'),
(775, 'D8', 62, 2, 'Ghế Thường'),
(776, 'D9', 62, 2, 'Ghế Thường'),
(777, 'D10', 62, 2, 'Ghế Thường'),
(778, 'D11', 62, 2, 'Ghế Thường'),
(779, 'D12', 62, 2, 'Ghế Thường'),
(780, 'E1', 62, 2, 'Ghế Thường'),
(781, 'E2', 62, 2, 'Ghế Thường'),
(782, 'E3', 62, 2, 'Ghế Thường'),
(783, 'E4', 62, 2, 'Ghế Thường'),
(784, 'E5', 62, 2, 'Ghế Thường'),
(785, 'E6', 62, 2, 'Ghế Thường'),
(786, 'E7', 62, 2, 'Ghế Thường'),
(787, 'E8', 62, 2, 'Ghế Thường'),
(788, 'E9', 62, 2, 'Ghế Thường'),
(789, 'E10', 62, 2, 'Ghế Thường'),
(790, 'E11', 62, 2, 'Ghế Thường'),
(791, 'E12', 62, 2, 'Ghế Thường'),
(792, 'F1', 62, 2, 'Ghế Thường'),
(793, 'F2', 62, 2, 'Ghế Thường'),
(794, 'F3', 62, 2, 'Ghế Thường'),
(795, 'F4', 62, 2, 'Ghế Thường'),
(796, 'F5', 62, 2, 'Ghế Thường'),
(797, 'F6', 62, 2, 'Ghế Thường'),
(798, 'F7', 62, 2, 'Ghế Thường'),
(799, 'F8', 62, 2, 'Ghế Thường'),
(800, 'F9', 62, 2, 'Ghế Thường'),
(801, 'F10', 62, 2, 'Ghế Thường'),
(802, 'F11', 62, 2, 'Ghế Thường'),
(803, 'F12', 62, 2, 'Ghế Thường'),
(804, 'G1', 62, 2, 'Ghế Thường'),
(805, 'G2', 62, 2, 'Ghế Thường'),
(806, 'G3', 62, 2, 'Ghế Thường'),
(807, 'G4', 62, 2, 'Ghế Thường'),
(808, 'G5', 62, 2, 'Ghế Thường'),
(809, 'G6', 62, 2, 'Ghế Thường'),
(810, 'G7', 62, 2, 'Ghế Thường'),
(811, 'G8', 62, 2, 'Ghế Thường'),
(812, 'G9', 62, 2, 'Ghế Thường'),
(813, 'G10', 62, 2, 'Ghế Thường'),
(814, 'G11', 62, 2, 'Ghế Thường'),
(815, 'G12', 62, 2, 'Ghế Thường'),
(816, 'H1', 62, 2, 'Ghế Thường'),
(817, 'H2', 62, 2, 'Ghế Thường'),
(818, 'H3', 62, 2, 'Ghế Thường'),
(819, 'H4', 62, 2, 'Ghế Thường'),
(820, 'H5', 62, 2, 'Ghế Thường'),
(821, 'H6', 62, 2, 'Ghế Thường'),
(822, 'H7', 62, 2, 'Ghế Thường'),
(823, 'H8', 62, 2, 'Ghế Thường'),
(824, 'H9', 62, 2, 'Ghế Thường'),
(825, 'H10', 62, 2, 'Ghế Thường'),
(826, 'H11', 62, 2, 'Ghế Thường'),
(827, 'H12', 62, 2, 'Ghế Thường'),
(828, 'I1', 62, 2, 'Ghế Thường'),
(829, 'I2', 62, 2, 'Ghế Thường'),
(830, 'I3', 62, 2, 'Ghế Thường'),
(831, 'I4', 62, 2, 'Ghế Thường'),
(832, 'I5', 62, 2, 'Ghế Thường'),
(833, 'I6', 62, 2, 'Ghế Thường'),
(834, 'I7', 62, 2, 'Ghế Thường'),
(835, 'I8', 62, 2, 'Ghế Thường'),
(836, 'I9', 62, 2, 'Ghế Thường'),
(837, 'I10', 62, 2, 'Ghế Thường'),
(838, 'I11', 62, 2, 'Ghế Thường'),
(839, 'I12', 62, 2, 'Ghế Thường'),
(840, 'J1', 62, 2, 'Ghế đôi'),
(841, 'J2', 62, 2, 'Ghế đôi'),
(842, 'J3', 62, 2, 'Ghế đôi'),
(843, 'J4', 62, 2, 'Ghế đôi'),
(844, 'J5', 62, 2, 'Ghế đôi'),
(845, 'J6', 62, 2, 'Ghế đôi'),
(846, 'J7', 62, 2, 'Ghế đôi'),
(847, 'J8', 62, 2, 'Ghế đôi'),
(848, 'J9', 62, 2, 'Ghế đôi'),
(849, 'J10', 62, 2, 'Ghế đôi'),
(850, 'J11', 62, 2, 'Ghế đôi'),
(851, 'J12', 62, 2, 'Ghế đôi'),
(852, 'A1', 63, 2, 'Ghế 4DX'),
(853, 'A2', 63, 2, 'Ghế 4DX'),
(854, 'A3', 63, 2, 'Ghế 4DX'),
(855, 'A4', 63, 2, 'Ghế 4DX'),
(856, 'A5', 63, 2, 'Ghế 4DX'),
(857, 'A6', 63, 2, 'Ghế 4DX'),
(858, 'A7', 63, 2, 'Ghế 4DX'),
(859, 'A8', 63, 2, 'Ghế 4DX'),
(860, 'A9', 63, 2, 'Ghế 4DX'),
(861, 'A10', 63, 2, 'Ghế 4DX'),
(862, 'A11', 63, 2, 'Ghế 4DX'),
(863, 'A12', 63, 2, 'Ghế 4DX'),
(864, 'B1', 63, 2, 'Ghế 4DX'),
(865, 'B2', 63, 2, 'Ghế 4DX'),
(866, 'B3', 63, 2, 'Ghế 4DX'),
(867, 'B4', 63, 2, 'Ghế 4DX'),
(868, 'B5', 63, 2, 'Ghế 4DX'),
(869, 'B6', 63, 2, 'Ghế 4DX'),
(870, 'B7', 63, 2, 'Ghế 4DX'),
(871, 'B8', 63, 2, 'Ghế 4DX'),
(872, 'B9', 63, 2, 'Ghế 4DX'),
(873, 'B10', 63, 2, 'Ghế 4DX'),
(874, 'B11', 63, 2, 'Ghế 4DX'),
(875, 'B12', 63, 2, 'Ghế 4DX'),
(876, 'C1', 63, 2, 'Ghế 4DX'),
(877, 'C2', 63, 2, 'Ghế 4DX'),
(878, 'C3', 63, 2, 'Ghế 4DX'),
(879, 'C4', 63, 2, 'Ghế 4DX'),
(880, 'C5', 63, 2, 'Ghế 4DX'),
(881, 'C6', 63, 2, 'Ghế 4DX'),
(882, 'C7', 63, 2, 'Ghế 4DX'),
(883, 'C8', 63, 2, 'Ghế 4DX'),
(884, 'C9', 63, 2, 'Ghế 4DX'),
(885, 'C10', 63, 2, 'Ghế 4DX'),
(886, 'C11', 63, 2, 'Ghế 4DX'),
(887, 'C12', 63, 2, 'Ghế 4DX'),
(888, 'D1', 63, 2, 'Ghế 4DX'),
(889, 'D2', 63, 2, 'Ghế 4DX'),
(890, 'D3', 63, 2, 'Ghế 4DX'),
(891, 'D4', 63, 2, 'Ghế 4DX'),
(892, 'D5', 63, 2, 'Ghế 4DX'),
(893, 'D6', 63, 2, 'Ghế 4DX'),
(894, 'D7', 63, 2, 'Ghế 4DX'),
(895, 'D8', 63, 2, 'Ghế 4DX'),
(896, 'D9', 63, 2, 'Ghế 4DX'),
(897, 'D10', 63, 2, 'Ghế 4DX'),
(898, 'D11', 63, 2, 'Ghế 4DX'),
(899, 'D12', 63, 2, 'Ghế 4DX'),
(900, 'E1', 63, 2, 'Ghế 4DX'),
(901, 'E2', 63, 2, 'Ghế 4DX'),
(902, 'E3', 63, 2, 'Ghế 4DX'),
(903, 'E4', 63, 2, 'Ghế 4DX'),
(904, 'E5', 63, 2, 'Ghế 4DX'),
(905, 'E6', 63, 2, 'Ghế 4DX'),
(906, 'E7', 63, 2, 'Ghế 4DX'),
(907, 'E8', 63, 2, 'Ghế 4DX'),
(908, 'E9', 63, 2, 'Ghế 4DX'),
(909, 'E10', 63, 2, 'Ghế 4DX'),
(910, 'E11', 63, 2, 'Ghế 4DX'),
(911, 'E12', 63, 2, 'Ghế 4DX'),
(912, 'F1', 63, 2, 'Ghế 4DX'),
(913, 'F2', 63, 2, 'Ghế 4DX'),
(914, 'F3', 63, 2, 'Ghế 4DX'),
(915, 'F4', 63, 2, 'Ghế 4DX'),
(916, 'F5', 63, 2, 'Ghế 4DX'),
(917, 'F6', 63, 2, 'Ghế 4DX'),
(918, 'F7', 63, 2, 'Ghế 4DX'),
(919, 'F8', 63, 2, 'Ghế 4DX'),
(920, 'F9', 63, 2, 'Ghế 4DX'),
(921, 'F10', 63, 2, 'Ghế 4DX'),
(922, 'F11', 63, 2, 'Ghế 4DX'),
(923, 'F12', 63, 2, 'Ghế 4DX'),
(924, 'G1', 63, 2, 'Ghế 4DX'),
(925, 'G2', 63, 2, 'Ghế 4DX'),
(926, 'G3', 63, 2, 'Ghế 4DX'),
(927, 'G4', 63, 2, 'Ghế 4DX'),
(928, 'G5', 63, 2, 'Ghế 4DX'),
(929, 'G6', 63, 2, 'Ghế 4DX'),
(930, 'G7', 63, 2, 'Ghế 4DX'),
(931, 'G8', 63, 2, 'Ghế 4DX'),
(932, 'G9', 63, 2, 'Ghế 4DX'),
(933, 'G10', 63, 2, 'Ghế 4DX'),
(934, 'G11', 63, 2, 'Ghế 4DX'),
(935, 'G12', 63, 2, 'Ghế 4DX'),
(936, 'H1', 63, 2, 'Ghế 4DX'),
(937, 'H2', 63, 2, 'Ghế 4DX'),
(938, 'H3', 63, 2, 'Ghế 4DX'),
(939, 'H4', 63, 2, 'Ghế 4DX'),
(940, 'H5', 63, 2, 'Ghế 4DX'),
(941, 'H6', 63, 2, 'Ghế 4DX'),
(942, 'H7', 63, 2, 'Ghế 4DX'),
(943, 'H8', 63, 2, 'Ghế 4DX'),
(944, 'H9', 63, 2, 'Ghế 4DX'),
(945, 'H10', 63, 2, 'Ghế 4DX'),
(946, 'H11', 63, 2, 'Ghế 4DX'),
(947, 'H12', 63, 2, 'Ghế 4DX'),
(948, 'I1', 63, 2, 'Ghế 4DX'),
(949, 'I2', 63, 2, 'Ghế 4DX'),
(950, 'I3', 63, 2, 'Ghế 4DX'),
(951, 'I4', 63, 2, 'Ghế 4DX'),
(952, 'I5', 63, 2, 'Ghế 4DX'),
(953, 'I6', 63, 2, 'Ghế 4DX'),
(954, 'I7', 63, 2, 'Ghế 4DX'),
(955, 'I8', 63, 2, 'Ghế 4DX'),
(956, 'I9', 63, 2, 'Ghế 4DX'),
(957, 'I10', 63, 2, 'Ghế 4DX'),
(958, 'I11', 63, 2, 'Ghế 4DX'),
(959, 'I12', 63, 2, 'Ghế 4DX'),
(960, 'J1', 63, 2, 'Ghế 4DX'),
(961, 'J2', 63, 2, 'Ghế 4DX'),
(962, 'J3', 63, 2, 'Ghế 4DX'),
(963, 'J4', 63, 2, 'Ghế 4DX'),
(964, 'J5', 63, 2, 'Ghế 4DX'),
(965, 'J6', 63, 2, 'Ghế 4DX'),
(966, 'J7', 63, 2, 'Ghế 4DX'),
(967, 'J8', 63, 2, 'Ghế 4DX'),
(968, 'J9', 63, 2, 'Ghế 4DX'),
(969, 'J10', 63, 2, 'Ghế 4DX'),
(970, 'J11', 63, 2, 'Ghế 4DX'),
(971, 'J12', 63, 2, 'Ghế 4DX'),
(972, 'A1', 64, 3, 'Ghế Thường'),
(973, 'A2', 64, 3, 'Ghế Thường'),
(974, 'A3', 64, 3, 'Ghế Thường'),
(975, 'A4', 64, 3, 'Ghế Thường'),
(976, 'A5', 64, 3, 'Ghế Thường'),
(977, 'A6', 64, 3, 'Ghế Thường'),
(978, 'A7', 64, 3, 'Ghế Thường'),
(979, 'A8', 64, 3, 'Ghế Thường'),
(980, 'A9', 64, 3, 'Ghế Thường'),
(981, 'A10', 64, 3, 'Ghế Thường'),
(982, 'A11', 64, 3, 'Ghế Thường'),
(983, 'A12', 64, 3, 'Ghế Thường'),
(984, 'B1', 64, 3, 'Ghế Thường'),
(985, 'B2', 64, 3, 'Ghế Thường'),
(986, 'B3', 64, 3, 'Ghế Thường'),
(987, 'B4', 64, 3, 'Ghế Thường'),
(988, 'B5', 64, 3, 'Ghế Thường'),
(989, 'B6', 64, 3, 'Ghế Thường'),
(990, 'B7', 64, 3, 'Ghế Thường'),
(991, 'B8', 64, 3, 'Ghế Thường'),
(992, 'B9', 64, 3, 'Ghế Thường'),
(993, 'B10', 64, 3, 'Ghế Thường'),
(994, 'B11', 64, 3, 'Ghế Thường'),
(995, 'B12', 64, 3, 'Ghế Thường'),
(996, 'C1', 64, 3, 'Ghế Thường'),
(997, 'C2', 64, 3, 'Ghế Thường'),
(998, 'C3', 64, 3, 'Ghế Thường'),
(999, 'C4', 64, 3, 'Ghế Thường'),
(1000, 'C5', 64, 3, 'Ghế Thường'),
(1001, 'C6', 64, 3, 'Ghế Thường'),
(1002, 'C7', 64, 3, 'Ghế Thường'),
(1003, 'C8', 64, 3, 'Ghế Thường'),
(1004, 'C9', 64, 3, 'Ghế Thường'),
(1005, 'C10', 64, 3, 'Ghế Thường'),
(1006, 'C11', 64, 3, 'Ghế Thường'),
(1007, 'C12', 64, 3, 'Ghế Thường'),
(1008, 'D1', 64, 3, 'Ghế Thường'),
(1009, 'D2', 64, 3, 'Ghế Thường'),
(1010, 'D3', 64, 3, 'Ghế Thường'),
(1011, 'D4', 64, 3, 'Ghế Thường'),
(1012, 'D5', 64, 3, 'Ghế Thường'),
(1013, 'D6', 64, 3, 'Ghế Thường'),
(1014, 'D7', 64, 3, 'Ghế Thường'),
(1015, 'D8', 64, 3, 'Ghế Thường'),
(1016, 'D9', 64, 3, 'Ghế Thường'),
(1017, 'D10', 64, 3, 'Ghế Thường'),
(1018, 'D11', 64, 3, 'Ghế Thường'),
(1019, 'D12', 64, 3, 'Ghế Thường'),
(1020, 'E1', 64, 3, 'Ghế Thường'),
(1021, 'E2', 64, 3, 'Ghế Thường'),
(1022, 'E3', 64, 3, 'Ghế Thường'),
(1023, 'E4', 64, 3, 'Ghế Thường'),
(1024, 'E5', 64, 3, 'Ghế Thường'),
(1025, 'E6', 64, 3, 'Ghế Thường'),
(1026, 'E7', 64, 3, 'Ghế Thường'),
(1027, 'E8', 64, 3, 'Ghế Thường'),
(1028, 'E9', 64, 3, 'Ghế Thường'),
(1029, 'E10', 64, 3, 'Ghế Thường'),
(1030, 'E11', 64, 3, 'Ghế Thường'),
(1031, 'E12', 64, 3, 'Ghế Thường'),
(1032, 'F1', 64, 3, 'Ghế Thường'),
(1033, 'F2', 64, 3, 'Ghế Thường'),
(1034, 'F3', 64, 3, 'Ghế Thường'),
(1035, 'F4', 64, 3, 'Ghế Thường'),
(1036, 'F5', 64, 3, 'Ghế Thường'),
(1037, 'F6', 64, 3, 'Ghế Thường'),
(1038, 'F7', 64, 3, 'Ghế Thường'),
(1039, 'F8', 64, 3, 'Ghế Thường'),
(1040, 'F9', 64, 3, 'Ghế Thường'),
(1041, 'F10', 64, 3, 'Ghế Thường'),
(1042, 'F11', 64, 3, 'Ghế Thường'),
(1043, 'F12', 64, 3, 'Ghế Thường'),
(1044, 'G1', 64, 3, 'Ghế Thường'),
(1045, 'G2', 64, 3, 'Ghế Thường'),
(1046, 'G3', 64, 3, 'Ghế Thường'),
(1047, 'G4', 64, 3, 'Ghế Thường'),
(1048, 'G5', 64, 3, 'Ghế Thường'),
(1049, 'G6', 64, 3, 'Ghế Thường'),
(1050, 'G7', 64, 3, 'Ghế Thường'),
(1051, 'G8', 64, 3, 'Ghế Thường'),
(1052, 'G9', 64, 3, 'Ghế Thường'),
(1053, 'G10', 64, 3, 'Ghế Thường'),
(1054, 'G11', 64, 3, 'Ghế Thường'),
(1055, 'G12', 64, 3, 'Ghế Thường'),
(1056, 'H1', 64, 3, 'Ghế Thường'),
(1057, 'H2', 64, 3, 'Ghế Thường'),
(1058, 'H3', 64, 3, 'Ghế Thường'),
(1059, 'H4', 64, 3, 'Ghế Thường'),
(1060, 'H5', 64, 3, 'Ghế Thường'),
(1061, 'H6', 64, 3, 'Ghế Thường'),
(1062, 'H7', 64, 3, 'Ghế Thường'),
(1063, 'H8', 64, 3, 'Ghế Thường'),
(1064, 'H9', 64, 3, 'Ghế Thường'),
(1065, 'H10', 64, 3, 'Ghế Thường'),
(1066, 'H11', 64, 3, 'Ghế Thường'),
(1067, 'H12', 64, 3, 'Ghế Thường'),
(1068, 'I1', 64, 3, 'Ghế Thường'),
(1069, 'I2', 64, 3, 'Ghế Thường'),
(1070, 'I3', 64, 3, 'Ghế Thường'),
(1071, 'I4', 64, 3, 'Ghế Thường'),
(1072, 'I5', 64, 3, 'Ghế Thường'),
(1073, 'I6', 64, 3, 'Ghế Thường'),
(1074, 'I7', 64, 3, 'Ghế Thường'),
(1075, 'I8', 64, 3, 'Ghế Thường'),
(1076, 'I9', 64, 3, 'Ghế Thường'),
(1077, 'I10', 64, 3, 'Ghế Thường'),
(1078, 'I11', 64, 3, 'Ghế Thường'),
(1079, 'I12', 64, 3, 'Ghế Thường'),
(1080, 'J1', 64, 3, 'Ghế đôi'),
(1081, 'J2', 64, 3, 'Ghế đôi'),
(1082, 'J3', 64, 3, 'Ghế đôi'),
(1083, 'J4', 64, 3, 'Ghế đôi'),
(1084, 'J5', 64, 3, 'Ghế đôi'),
(1085, 'J6', 64, 3, 'Ghế đôi'),
(1086, 'J7', 64, 3, 'Ghế đôi'),
(1087, 'J8', 64, 3, 'Ghế đôi'),
(1088, 'J9', 64, 3, 'Ghế đôi'),
(1089, 'J10', 64, 3, 'Ghế đôi'),
(1090, 'J11', 64, 3, 'Ghế đôi'),
(1091, 'J12', 64, 3, 'Ghế đôi'),
(1092, 'A1', 65, 3, 'Gold Class'),
(1093, 'A2', 65, 3, 'Gold Class'),
(1094, 'A3', 65, 3, 'Gold Class'),
(1095, 'A4', 65, 3, 'Gold Class'),
(1096, 'A5', 65, 3, 'Gold Class'),
(1097, 'A6', 65, 3, 'Gold Class'),
(1098, 'A7', 65, 3, 'Gold Class'),
(1099, 'A8', 65, 3, 'Gold Class'),
(1100, 'A9', 65, 3, 'Gold Class'),
(1101, 'A10', 65, 3, 'Gold Class'),
(1102, 'A11', 65, 3, 'Gold Class'),
(1103, 'A12', 65, 3, 'Gold Class'),
(1104, 'B1', 65, 3, 'Gold Class'),
(1105, 'B2', 65, 3, 'Gold Class'),
(1106, 'B3', 65, 3, 'Gold Class'),
(1107, 'B4', 65, 3, 'Gold Class'),
(1108, 'B5', 65, 3, 'Gold Class'),
(1109, 'B6', 65, 3, 'Gold Class'),
(1110, 'B7', 65, 3, 'Gold Class'),
(1111, 'B8', 65, 3, 'Gold Class'),
(1112, 'B9', 65, 3, 'Gold Class'),
(1113, 'B10', 65, 3, 'Gold Class'),
(1114, 'B11', 65, 3, 'Gold Class'),
(1115, 'B12', 65, 3, 'Gold Class'),
(1116, 'C1', 65, 3, 'Gold Class'),
(1117, 'C2', 65, 3, 'Gold Class'),
(1118, 'C3', 65, 3, 'Gold Class'),
(1119, 'C4', 65, 3, 'Gold Class'),
(1120, 'C5', 65, 3, 'Gold Class'),
(1121, 'C6', 65, 3, 'Gold Class'),
(1122, 'C7', 65, 3, 'Gold Class'),
(1123, 'C8', 65, 3, 'Gold Class'),
(1124, 'C9', 65, 3, 'Gold Class'),
(1125, 'C10', 65, 3, 'Gold Class'),
(1126, 'C11', 65, 3, 'Gold Class'),
(1127, 'C12', 65, 3, 'Gold Class'),
(1128, 'D1', 65, 3, 'Gold Class'),
(1129, 'D2', 65, 3, 'Gold Class'),
(1130, 'D3', 65, 3, 'Gold Class'),
(1131, 'D4', 65, 3, 'Gold Class'),
(1132, 'D5', 65, 3, 'Gold Class'),
(1133, 'D6', 65, 3, 'Gold Class'),
(1134, 'D7', 65, 3, 'Gold Class'),
(1135, 'D8', 65, 3, 'Gold Class'),
(1136, 'D9', 65, 3, 'Gold Class'),
(1137, 'D10', 65, 3, 'Gold Class'),
(1138, 'D11', 65, 3, 'Gold Class'),
(1139, 'D12', 65, 3, 'Gold Class'),
(1140, 'E1', 65, 3, 'Gold Class'),
(1141, 'E2', 65, 3, 'Gold Class'),
(1142, 'E3', 65, 3, 'Gold Class'),
(1143, 'E4', 65, 3, 'Gold Class'),
(1144, 'E5', 65, 3, 'Gold Class'),
(1145, 'E6', 65, 3, 'Gold Class'),
(1146, 'E7', 65, 3, 'Gold Class'),
(1147, 'E8', 65, 3, 'Gold Class'),
(1148, 'E9', 65, 3, 'Gold Class'),
(1149, 'E10', 65, 3, 'Gold Class'),
(1150, 'E11', 65, 3, 'Gold Class'),
(1151, 'E12', 65, 3, 'Gold Class'),
(1152, 'F1', 65, 3, 'Gold Class'),
(1153, 'F2', 65, 3, 'Gold Class'),
(1154, 'F3', 65, 3, 'Gold Class'),
(1155, 'F4', 65, 3, 'Gold Class'),
(1156, 'F5', 65, 3, 'Gold Class'),
(1157, 'F6', 65, 3, 'Gold Class'),
(1158, 'F7', 65, 3, 'Gold Class'),
(1159, 'F8', 65, 3, 'Gold Class'),
(1160, 'F9', 65, 3, 'Gold Class'),
(1161, 'F10', 65, 3, 'Gold Class'),
(1162, 'F11', 65, 3, 'Gold Class'),
(1163, 'F12', 65, 3, 'Gold Class'),
(1164, 'G1', 65, 3, 'Gold Class'),
(1165, 'G2', 65, 3, 'Gold Class'),
(1166, 'G3', 65, 3, 'Gold Class'),
(1167, 'G4', 65, 3, 'Gold Class'),
(1168, 'G5', 65, 3, 'Gold Class'),
(1169, 'G6', 65, 3, 'Gold Class'),
(1170, 'G7', 65, 3, 'Gold Class'),
(1171, 'G8', 65, 3, 'Gold Class'),
(1172, 'G9', 65, 3, 'Gold Class'),
(1173, 'G10', 65, 3, 'Gold Class'),
(1174, 'G11', 65, 3, 'Gold Class'),
(1175, 'G12', 65, 3, 'Gold Class'),
(1176, 'H1', 65, 3, 'Gold Class'),
(1177, 'H2', 65, 3, 'Gold Class'),
(1178, 'H3', 65, 3, 'Gold Class'),
(1179, 'H4', 65, 3, 'Gold Class'),
(1180, 'H5', 65, 3, 'Gold Class'),
(1181, 'H6', 65, 3, 'Gold Class'),
(1182, 'H7', 65, 3, 'Gold Class'),
(1183, 'H8', 65, 3, 'Gold Class'),
(1184, 'H9', 65, 3, 'Gold Class'),
(1185, 'H10', 65, 3, 'Gold Class'),
(1186, 'H11', 65, 3, 'Gold Class'),
(1187, 'H12', 65, 3, 'Gold Class'),
(1188, 'I1', 65, 3, 'Gold Class'),
(1189, 'I2', 65, 3, 'Gold Class'),
(1190, 'I3', 65, 3, 'Gold Class'),
(1191, 'I4', 65, 3, 'Gold Class'),
(1192, 'I5', 65, 3, 'Gold Class'),
(1193, 'I6', 65, 3, 'Gold Class'),
(1194, 'I7', 65, 3, 'Gold Class'),
(1195, 'I8', 65, 3, 'Gold Class'),
(1196, 'I9', 65, 3, 'Gold Class'),
(1197, 'I10', 65, 3, 'Gold Class'),
(1198, 'I11', 65, 3, 'Gold Class'),
(1199, 'I12', 65, 3, 'Gold Class'),
(1200, 'J1', 65, 3, 'Gold Class'),
(1201, 'J2', 65, 3, 'Gold Class'),
(1202, 'J3', 65, 3, 'Gold Class'),
(1203, 'J4', 65, 3, 'Gold Class'),
(1204, 'J5', 65, 3, 'Gold Class'),
(1205, 'J6', 65, 3, 'Gold Class'),
(1206, 'J7', 65, 3, 'Gold Class'),
(1207, 'J8', 65, 3, 'Gold Class'),
(1208, 'J9', 65, 3, 'Gold Class'),
(1209, 'J10', 65, 3, 'Gold Class'),
(1210, 'J11', 65, 3, 'Gold Class'),
(1211, 'J12', 65, 3, 'Gold Class'),
(1212, 'A1', 66, 3, 'Ghế 4DX'),
(1213, 'A2', 66, 3, 'Ghế 4DX'),
(1214, 'A3', 66, 3, 'Ghế 4DX'),
(1215, 'A4', 66, 3, 'Ghế 4DX'),
(1216, 'A5', 66, 3, 'Ghế 4DX'),
(1217, 'A6', 66, 3, 'Ghế 4DX'),
(1218, 'A7', 66, 3, 'Ghế 4DX'),
(1219, 'A8', 66, 3, 'Ghế 4DX'),
(1220, 'A9', 66, 3, 'Ghế 4DX'),
(1221, 'A10', 66, 3, 'Ghế 4DX'),
(1222, 'A11', 66, 3, 'Ghế 4DX'),
(1223, 'A12', 66, 3, 'Ghế 4DX'),
(1224, 'B1', 66, 3, 'Ghế 4DX'),
(1225, 'B2', 66, 3, 'Ghế 4DX'),
(1226, 'B3', 66, 3, 'Ghế 4DX'),
(1227, 'B4', 66, 3, 'Ghế 4DX'),
(1228, 'B5', 66, 3, 'Ghế 4DX'),
(1229, 'B6', 66, 3, 'Ghế 4DX'),
(1230, 'B7', 66, 3, 'Ghế 4DX'),
(1231, 'B8', 66, 3, 'Ghế 4DX'),
(1232, 'B9', 66, 3, 'Ghế 4DX'),
(1233, 'B10', 66, 3, 'Ghế 4DX'),
(1234, 'B11', 66, 3, 'Ghế 4DX'),
(1235, 'B12', 66, 3, 'Ghế 4DX'),
(1236, 'C1', 66, 3, 'Ghế 4DX'),
(1237, 'C2', 66, 3, 'Ghế 4DX'),
(1238, 'C3', 66, 3, 'Ghế 4DX'),
(1239, 'C4', 66, 3, 'Ghế 4DX'),
(1240, 'C5', 66, 3, 'Ghế 4DX'),
(1241, 'C6', 66, 3, 'Ghế 4DX'),
(1242, 'C7', 66, 3, 'Ghế 4DX'),
(1243, 'C8', 66, 3, 'Ghế 4DX'),
(1244, 'C9', 66, 3, 'Ghế 4DX'),
(1245, 'C10', 66, 3, 'Ghế 4DX'),
(1246, 'C11', 66, 3, 'Ghế 4DX'),
(1247, 'C12', 66, 3, 'Ghế 4DX'),
(1248, 'D1', 66, 3, 'Ghế 4DX'),
(1249, 'D2', 66, 3, 'Ghế 4DX'),
(1250, 'D3', 66, 3, 'Ghế 4DX'),
(1251, 'D4', 66, 3, 'Ghế 4DX'),
(1252, 'D5', 66, 3, 'Ghế 4DX'),
(1253, 'D6', 66, 3, 'Ghế 4DX'),
(1254, 'D7', 66, 3, 'Ghế 4DX'),
(1255, 'D8', 66, 3, 'Ghế 4DX'),
(1256, 'D9', 66, 3, 'Ghế 4DX'),
(1257, 'D10', 66, 3, 'Ghế 4DX'),
(1258, 'D11', 66, 3, 'Ghế 4DX'),
(1259, 'D12', 66, 3, 'Ghế 4DX'),
(1260, 'E1', 66, 3, 'Ghế 4DX'),
(1261, 'E2', 66, 3, 'Ghế 4DX'),
(1262, 'E3', 66, 3, 'Ghế 4DX'),
(1263, 'E4', 66, 3, 'Ghế 4DX'),
(1264, 'E5', 66, 3, 'Ghế 4DX'),
(1265, 'E6', 66, 3, 'Ghế 4DX'),
(1266, 'E7', 66, 3, 'Ghế 4DX'),
(1267, 'E8', 66, 3, 'Ghế 4DX'),
(1268, 'E9', 66, 3, 'Ghế 4DX'),
(1269, 'E10', 66, 3, 'Ghế 4DX'),
(1270, 'E11', 66, 3, 'Ghế 4DX'),
(1271, 'E12', 66, 3, 'Ghế 4DX'),
(1272, 'F1', 66, 3, 'Ghế 4DX'),
(1273, 'F2', 66, 3, 'Ghế 4DX'),
(1274, 'F3', 66, 3, 'Ghế 4DX'),
(1275, 'F4', 66, 3, 'Ghế 4DX'),
(1276, 'F5', 66, 3, 'Ghế 4DX'),
(1277, 'F6', 66, 3, 'Ghế 4DX'),
(1278, 'F7', 66, 3, 'Ghế 4DX'),
(1279, 'F8', 66, 3, 'Ghế 4DX'),
(1280, 'F9', 66, 3, 'Ghế 4DX'),
(1281, 'F10', 66, 3, 'Ghế 4DX'),
(1282, 'F11', 66, 3, 'Ghế 4DX'),
(1283, 'F12', 66, 3, 'Ghế 4DX'),
(1284, 'G1', 66, 3, 'Ghế 4DX'),
(1285, 'G2', 66, 3, 'Ghế 4DX'),
(1286, 'G3', 66, 3, 'Ghế 4DX'),
(1287, 'G4', 66, 3, 'Ghế 4DX'),
(1288, 'G5', 66, 3, 'Ghế 4DX'),
(1289, 'G6', 66, 3, 'Ghế 4DX'),
(1290, 'G7', 66, 3, 'Ghế 4DX'),
(1291, 'G8', 66, 3, 'Ghế 4DX'),
(1292, 'G9', 66, 3, 'Ghế 4DX'),
(1293, 'G10', 66, 3, 'Ghế 4DX'),
(1294, 'G11', 66, 3, 'Ghế 4DX'),
(1295, 'G12', 66, 3, 'Ghế 4DX'),
(1296, 'H1', 66, 3, 'Ghế 4DX'),
(1297, 'H2', 66, 3, 'Ghế 4DX'),
(1298, 'H3', 66, 3, 'Ghế 4DX'),
(1299, 'H4', 66, 3, 'Ghế 4DX'),
(1300, 'H5', 66, 3, 'Ghế 4DX'),
(1301, 'H6', 66, 3, 'Ghế 4DX'),
(1302, 'H7', 66, 3, 'Ghế 4DX'),
(1303, 'H8', 66, 3, 'Ghế 4DX'),
(1304, 'H9', 66, 3, 'Ghế 4DX'),
(1305, 'H10', 66, 3, 'Ghế 4DX'),
(1306, 'H11', 66, 3, 'Ghế 4DX'),
(1307, 'H12', 66, 3, 'Ghế 4DX'),
(1308, 'I1', 66, 3, 'Ghế 4DX'),
(1309, 'I2', 66, 3, 'Ghế 4DX'),
(1310, 'I3', 66, 3, 'Ghế 4DX'),
(1311, 'I4', 66, 3, 'Ghế 4DX'),
(1312, 'I5', 66, 3, 'Ghế 4DX'),
(1313, 'I6', 66, 3, 'Ghế 4DX'),
(1314, 'I7', 66, 3, 'Ghế 4DX'),
(1315, 'I8', 66, 3, 'Ghế 4DX'),
(1316, 'I9', 66, 3, 'Ghế 4DX'),
(1317, 'I10', 66, 3, 'Ghế 4DX'),
(1318, 'I11', 66, 3, 'Ghế 4DX'),
(1319, 'I12', 66, 3, 'Ghế 4DX'),
(1320, 'J1', 66, 3, 'Ghế 4DX'),
(1321, 'J2', 66, 3, 'Ghế 4DX'),
(1322, 'J3', 66, 3, 'Ghế 4DX'),
(1323, 'J4', 66, 3, 'Ghế 4DX'),
(1324, 'J5', 66, 3, 'Ghế 4DX'),
(1325, 'J6', 66, 3, 'Ghế 4DX'),
(1326, 'J7', 66, 3, 'Ghế 4DX'),
(1327, 'J8', 66, 3, 'Ghế 4DX'),
(1328, 'J9', 66, 3, 'Ghế 4DX'),
(1329, 'J10', 66, 3, 'Ghế 4DX'),
(1330, 'J11', 66, 3, 'Ghế 4DX'),
(1331, 'J12', 66, 3, 'Ghế 4DX'),
(1332, 'A1', 67, 4, 'Ghế Thường'),
(1333, 'A2', 67, 4, 'Ghế Thường'),
(1334, 'A3', 67, 4, 'Ghế Thường'),
(1335, 'A4', 67, 4, 'Ghế Thường'),
(1336, 'A5', 67, 4, 'Ghế Thường'),
(1337, 'A6', 67, 4, 'Ghế Thường'),
(1338, 'A7', 67, 4, 'Ghế Thường'),
(1339, 'A8', 67, 4, 'Ghế Thường'),
(1340, 'A9', 67, 4, 'Ghế Thường'),
(1341, 'A10', 67, 4, 'Ghế Thường'),
(1342, 'A11', 67, 4, 'Ghế Thường'),
(1343, 'A12', 67, 4, 'Ghế Thường'),
(1344, 'B1', 67, 4, 'Ghế Thường'),
(1345, 'B2', 67, 4, 'Ghế Thường'),
(1346, 'B3', 67, 4, 'Ghế Thường'),
(1347, 'B4', 67, 4, 'Ghế Thường'),
(1348, 'B5', 67, 4, 'Ghế Thường'),
(1349, 'B6', 67, 4, 'Ghế Thường'),
(1350, 'B7', 67, 4, 'Ghế Thường'),
(1351, 'B8', 67, 4, 'Ghế Thường'),
(1352, 'B9', 67, 4, 'Ghế Thường'),
(1353, 'B10', 67, 4, 'Ghế Thường'),
(1354, 'B11', 67, 4, 'Ghế Thường'),
(1355, 'B12', 67, 4, 'Ghế Thường'),
(1356, 'C1', 67, 4, 'Ghế Thường'),
(1357, 'C2', 67, 4, 'Ghế Thường'),
(1358, 'C3', 67, 4, 'Ghế Thường'),
(1359, 'C4', 67, 4, 'Ghế Thường'),
(1360, 'C5', 67, 4, 'Ghế Thường'),
(1361, 'C6', 67, 4, 'Ghế Thường'),
(1362, 'C7', 67, 4, 'Ghế Thường'),
(1363, 'C8', 67, 4, 'Ghế Thường'),
(1364, 'C9', 67, 4, 'Ghế Thường'),
(1365, 'C10', 67, 4, 'Ghế Thường'),
(1366, 'C11', 67, 4, 'Ghế Thường'),
(1367, 'C12', 67, 4, 'Ghế Thường'),
(1368, 'D1', 67, 4, 'Ghế Thường'),
(1369, 'D2', 67, 4, 'Ghế Thường'),
(1370, 'D3', 67, 4, 'Ghế Thường'),
(1371, 'D4', 67, 4, 'Ghế Thường'),
(1372, 'D5', 67, 4, 'Ghế Thường'),
(1373, 'D6', 67, 4, 'Ghế Thường'),
(1374, 'D7', 67, 4, 'Ghế Thường'),
(1375, 'D8', 67, 4, 'Ghế Thường'),
(1376, 'D9', 67, 4, 'Ghế Thường'),
(1377, 'D10', 67, 4, 'Ghế Thường'),
(1378, 'D11', 67, 4, 'Ghế Thường'),
(1379, 'D12', 67, 4, 'Ghế Thường'),
(1380, 'E1', 67, 4, 'Ghế Thường'),
(1381, 'E2', 67, 4, 'Ghế Thường'),
(1382, 'E3', 67, 4, 'Ghế Thường'),
(1383, 'E4', 67, 4, 'Ghế Thường'),
(1384, 'E5', 67, 4, 'Ghế Thường'),
(1385, 'E6', 67, 4, 'Ghế Thường'),
(1386, 'E7', 67, 4, 'Ghế Thường'),
(1387, 'E8', 67, 4, 'Ghế Thường'),
(1388, 'E9', 67, 4, 'Ghế Thường'),
(1389, 'E10', 67, 4, 'Ghế Thường'),
(1390, 'E11', 67, 4, 'Ghế Thường'),
(1391, 'E12', 67, 4, 'Ghế Thường'),
(1392, 'F1', 67, 4, 'Ghế Thường'),
(1393, 'F2', 67, 4, 'Ghế Thường'),
(1394, 'F3', 67, 4, 'Ghế Thường'),
(1395, 'F4', 67, 4, 'Ghế Thường'),
(1396, 'F5', 67, 4, 'Ghế Thường'),
(1397, 'F6', 67, 4, 'Ghế Thường'),
(1398, 'F7', 67, 4, 'Ghế Thường'),
(1399, 'F8', 67, 4, 'Ghế Thường'),
(1400, 'F9', 67, 4, 'Ghế Thường'),
(1401, 'F10', 67, 4, 'Ghế Thường'),
(1402, 'F11', 67, 4, 'Ghế Thường'),
(1403, 'F12', 67, 4, 'Ghế Thường'),
(1404, 'G1', 67, 4, 'Ghế Thường'),
(1405, 'G2', 67, 4, 'Ghế Thường'),
(1406, 'G3', 67, 4, 'Ghế Thường'),
(1407, 'G4', 67, 4, 'Ghế Thường'),
(1408, 'G5', 67, 4, 'Ghế Thường'),
(1409, 'G6', 67, 4, 'Ghế Thường'),
(1410, 'G7', 67, 4, 'Ghế Thường'),
(1411, 'G8', 67, 4, 'Ghế Thường'),
(1412, 'G9', 67, 4, 'Ghế Thường'),
(1413, 'G10', 67, 4, 'Ghế Thường'),
(1414, 'G11', 67, 4, 'Ghế Thường'),
(1415, 'G12', 67, 4, 'Ghế Thường'),
(1416, 'H1', 67, 4, 'Ghế Thường'),
(1417, 'H2', 67, 4, 'Ghế Thường'),
(1418, 'H3', 67, 4, 'Ghế Thường'),
(1419, 'H4', 67, 4, 'Ghế Thường'),
(1420, 'H5', 67, 4, 'Ghế Thường'),
(1421, 'H6', 67, 4, 'Ghế Thường'),
(1422, 'H7', 67, 4, 'Ghế Thường'),
(1423, 'H8', 67, 4, 'Ghế Thường'),
(1424, 'H9', 67, 4, 'Ghế Thường'),
(1425, 'H10', 67, 4, 'Ghế Thường'),
(1426, 'H11', 67, 4, 'Ghế Thường'),
(1427, 'H12', 67, 4, 'Ghế Thường'),
(1428, 'I1', 67, 4, 'Ghế Thường'),
(1429, 'I2', 67, 4, 'Ghế Thường'),
(1430, 'I3', 67, 4, 'Ghế Thường'),
(1431, 'I4', 67, 4, 'Ghế Thường'),
(1432, 'I5', 67, 4, 'Ghế Thường'),
(1433, 'I6', 67, 4, 'Ghế Thường'),
(1434, 'I7', 67, 4, 'Ghế Thường'),
(1435, 'I8', 67, 4, 'Ghế Thường'),
(1436, 'I9', 67, 4, 'Ghế Thường'),
(1437, 'I10', 67, 4, 'Ghế Thường'),
(1438, 'I11', 67, 4, 'Ghế Thường'),
(1439, 'I12', 67, 4, 'Ghế Thường'),
(1440, 'J1', 67, 4, 'Ghế đôi'),
(1441, 'J2', 67, 4, 'Ghế đôi'),
(1442, 'J3', 67, 4, 'Ghế đôi'),
(1443, 'J4', 67, 4, 'Ghế đôi'),
(1444, 'J5', 67, 4, 'Ghế đôi'),
(1445, 'J6', 67, 4, 'Ghế đôi'),
(1446, 'J7', 67, 4, 'Ghế đôi'),
(1447, 'J8', 67, 4, 'Ghế đôi'),
(1448, 'J9', 67, 4, 'Ghế đôi'),
(1449, 'J10', 67, 4, 'Ghế đôi'),
(1450, 'J11', 67, 4, 'Ghế đôi'),
(1451, 'J12', 67, 4, 'Ghế đôi'),
(1452, 'A1', 68, 4, 'Ghế Imax'),
(1453, 'A2', 68, 4, 'Ghế Imax'),
(1454, 'A3', 68, 4, 'Ghế Imax'),
(1455, 'A4', 68, 4, 'Ghế Imax'),
(1456, 'A5', 68, 4, 'Ghế Imax'),
(1457, 'A6', 68, 4, 'Ghế Imax'),
(1458, 'A7', 68, 4, 'Ghế Imax'),
(1459, 'A8', 68, 4, 'Ghế Imax'),
(1460, 'A9', 68, 4, 'Ghế Imax'),
(1461, 'A10', 68, 4, 'Ghế Imax'),
(1462, 'A11', 68, 4, 'Ghế Imax'),
(1463, 'A12', 68, 4, 'Ghế Imax'),
(1464, 'B1', 68, 4, 'Ghế Imax'),
(1465, 'B2', 68, 4, 'Ghế Imax'),
(1466, 'B3', 68, 4, 'Ghế Imax'),
(1467, 'B4', 68, 4, 'Ghế Imax'),
(1468, 'B5', 68, 4, 'Ghế Imax'),
(1469, 'B6', 68, 4, 'Ghế Imax'),
(1470, 'B7', 68, 4, 'Ghế Imax'),
(1471, 'B8', 68, 4, 'Ghế Imax'),
(1472, 'B9', 68, 4, 'Ghế Imax'),
(1473, 'B10', 68, 4, 'Ghế Imax'),
(1474, 'B11', 68, 4, 'Ghế Imax'),
(1475, 'B12', 68, 4, 'Ghế Imax'),
(1476, 'C1', 68, 4, 'Ghế Imax'),
(1477, 'C2', 68, 4, 'Ghế Imax'),
(1478, 'C3', 68, 4, 'Ghế Imax'),
(1479, 'C4', 68, 4, 'Ghế Imax'),
(1480, 'C5', 68, 4, 'Ghế Imax'),
(1481, 'C6', 68, 4, 'Ghế Imax'),
(1482, 'C7', 68, 4, 'Ghế Imax'),
(1483, 'C8', 68, 4, 'Ghế Imax'),
(1484, 'C9', 68, 4, 'Ghế Imax'),
(1485, 'C10', 68, 4, 'Ghế Imax'),
(1486, 'C11', 68, 4, 'Ghế Imax'),
(1487, 'C12', 68, 4, 'Ghế Imax'),
(1488, 'D1', 68, 4, 'Ghế Imax'),
(1489, 'D2', 68, 4, 'Ghế Imax'),
(1490, 'D3', 68, 4, 'Ghế Imax'),
(1491, 'D4', 68, 4, 'Ghế Imax'),
(1492, 'D5', 68, 4, 'Ghế Imax'),
(1493, 'D6', 68, 4, 'Ghế Imax'),
(1494, 'D7', 68, 4, 'Ghế Imax'),
(1495, 'D8', 68, 4, 'Ghế Imax'),
(1496, 'D9', 68, 4, 'Ghế Imax'),
(1497, 'D10', 68, 4, 'Ghế Imax'),
(1498, 'D11', 68, 4, 'Ghế Imax'),
(1499, 'D12', 68, 4, 'Ghế Imax'),
(1500, 'E1', 68, 4, 'Ghế Imax'),
(1501, 'E2', 68, 4, 'Ghế Imax'),
(1502, 'E3', 68, 4, 'Ghế Imax'),
(1503, 'E4', 68, 4, 'Ghế Imax'),
(1504, 'E5', 68, 4, 'Ghế Imax'),
(1505, 'E6', 68, 4, 'Ghế Imax'),
(1506, 'E7', 68, 4, 'Ghế Imax'),
(1507, 'E8', 68, 4, 'Ghế Imax'),
(1508, 'E9', 68, 4, 'Ghế Imax'),
(1509, 'E10', 68, 4, 'Ghế Imax'),
(1510, 'E11', 68, 4, 'Ghế Imax'),
(1511, 'E12', 68, 4, 'Ghế Imax'),
(1512, 'F1', 68, 4, 'Ghế Imax'),
(1513, 'F2', 68, 4, 'Ghế Imax'),
(1514, 'F3', 68, 4, 'Ghế Imax'),
(1515, 'F4', 68, 4, 'Ghế Imax'),
(1516, 'F5', 68, 4, 'Ghế Imax'),
(1517, 'F6', 68, 4, 'Ghế Imax'),
(1518, 'F7', 68, 4, 'Ghế Imax'),
(1519, 'F8', 68, 4, 'Ghế Imax'),
(1520, 'F9', 68, 4, 'Ghế Imax'),
(1521, 'F10', 68, 4, 'Ghế Imax'),
(1522, 'F11', 68, 4, 'Ghế Imax'),
(1523, 'F12', 68, 4, 'Ghế Imax'),
(1524, 'G1', 68, 4, 'Ghế Imax'),
(1525, 'G2', 68, 4, 'Ghế Imax'),
(1526, 'G3', 68, 4, 'Ghế Imax'),
(1527, 'G4', 68, 4, 'Ghế Imax'),
(1528, 'G5', 68, 4, 'Ghế Imax'),
(1529, 'G6', 68, 4, 'Ghế Imax'),
(1530, 'G7', 68, 4, 'Ghế Imax'),
(1531, 'G8', 68, 4, 'Ghế Imax'),
(1532, 'G9', 68, 4, 'Ghế Imax'),
(1533, 'G10', 68, 4, 'Ghế Imax'),
(1534, 'G11', 68, 4, 'Ghế Imax'),
(1535, 'G12', 68, 4, 'Ghế Imax'),
(1536, 'H1', 68, 4, 'Ghế Imax'),
(1537, 'H2', 68, 4, 'Ghế Imax'),
(1538, 'H3', 68, 4, 'Ghế Imax'),
(1539, 'H4', 68, 4, 'Ghế Imax'),
(1540, 'H5', 68, 4, 'Ghế Imax'),
(1541, 'H6', 68, 4, 'Ghế Imax'),
(1542, 'H7', 68, 4, 'Ghế Imax'),
(1543, 'H8', 68, 4, 'Ghế Imax'),
(1544, 'H9', 68, 4, 'Ghế Imax'),
(1545, 'H10', 68, 4, 'Ghế Imax'),
(1546, 'H11', 68, 4, 'Ghế Imax'),
(1547, 'H12', 68, 4, 'Ghế Imax'),
(1548, 'I1', 68, 4, 'Ghế Imax'),
(1549, 'I2', 68, 4, 'Ghế Imax'),
(1550, 'I3', 68, 4, 'Ghế Imax'),
(1551, 'I4', 68, 4, 'Ghế Imax'),
(1552, 'I5', 68, 4, 'Ghế Imax'),
(1553, 'I6', 68, 4, 'Ghế Imax'),
(1554, 'I7', 68, 4, 'Ghế Imax'),
(1555, 'I8', 68, 4, 'Ghế Imax'),
(1556, 'I9', 68, 4, 'Ghế Imax'),
(1557, 'I10', 68, 4, 'Ghế Imax'),
(1558, 'I11', 68, 4, 'Ghế Imax'),
(1559, 'I12', 68, 4, 'Ghế Imax'),
(1560, 'J1', 68, 4, 'Ghế Imax'),
(1561, 'J2', 68, 4, 'Ghế Imax'),
(1562, 'J3', 68, 4, 'Ghế Imax'),
(1563, 'J4', 68, 4, 'Ghế Imax'),
(1564, 'J5', 68, 4, 'Ghế Imax'),
(1565, 'J6', 68, 4, 'Ghế Imax'),
(1566, 'J7', 68, 4, 'Ghế Imax'),
(1567, 'J8', 68, 4, 'Ghế Imax'),
(1568, 'J9', 68, 4, 'Ghế Imax'),
(1569, 'J10', 68, 4, 'Ghế Imax'),
(1570, 'J11', 68, 4, 'Ghế Imax'),
(1571, 'J12', 68, 4, 'Ghế Imax'),
(1572, 'A1', 69, 4, 'Ghế Thường'),
(1573, 'A2', 69, 4, 'Ghế Thường'),
(1574, 'A3', 69, 4, 'Ghế Thường'),
(1575, 'A4', 69, 4, 'Ghế Thường'),
(1576, 'A5', 69, 4, 'Ghế Thường'),
(1577, 'A6', 69, 4, 'Ghế Thường'),
(1578, 'A7', 69, 4, 'Ghế Thường'),
(1579, 'A8', 69, 4, 'Ghế Thường'),
(1580, 'A9', 69, 4, 'Ghế Thường'),
(1581, 'A10', 69, 4, 'Ghế Thường'),
(1582, 'A11', 69, 4, 'Ghế Thường'),
(1583, 'A12', 69, 4, 'Ghế Thường'),
(1584, 'B1', 69, 4, 'Ghế Thường'),
(1585, 'B2', 69, 4, 'Ghế Thường'),
(1586, 'B3', 69, 4, 'Ghế Thường'),
(1587, 'B4', 69, 4, 'Ghế Thường'),
(1588, 'B5', 69, 4, 'Ghế Thường'),
(1589, 'B6', 69, 4, 'Ghế Thường'),
(1590, 'B7', 69, 4, 'Ghế Thường'),
(1591, 'B8', 69, 4, 'Ghế Thường'),
(1592, 'B9', 69, 4, 'Ghế Thường'),
(1593, 'B10', 69, 4, 'Ghế Thường'),
(1594, 'B11', 69, 4, 'Ghế Thường'),
(1595, 'B12', 69, 4, 'Ghế Thường'),
(1596, 'C1', 69, 4, 'Ghế Thường'),
(1597, 'C2', 69, 4, 'Ghế Thường'),
(1598, 'C3', 69, 4, 'Ghế Thường'),
(1599, 'C4', 69, 4, 'Ghế Thường'),
(1600, 'C5', 69, 4, 'Ghế Thường'),
(1601, 'C6', 69, 4, 'Ghế Thường'),
(1602, 'C7', 69, 4, 'Ghế Thường'),
(1603, 'C8', 69, 4, 'Ghế Thường'),
(1604, 'C9', 69, 4, 'Ghế Thường'),
(1605, 'C10', 69, 4, 'Ghế Thường'),
(1606, 'C11', 69, 4, 'Ghế Thường'),
(1607, 'C12', 69, 4, 'Ghế Thường'),
(1608, 'D1', 69, 4, 'Ghế Thường'),
(1609, 'D2', 69, 4, 'Ghế Thường'),
(1610, 'D3', 69, 4, 'Ghế Thường'),
(1611, 'D4', 69, 4, 'Ghế Thường'),
(1612, 'D5', 69, 4, 'Ghế Thường'),
(1613, 'D6', 69, 4, 'Ghế Thường'),
(1614, 'D7', 69, 4, 'Ghế Thường'),
(1615, 'D8', 69, 4, 'Ghế Thường'),
(1616, 'D9', 69, 4, 'Ghế Thường'),
(1617, 'D10', 69, 4, 'Ghế Thường'),
(1618, 'D11', 69, 4, 'Ghế Thường'),
(1619, 'D12', 69, 4, 'Ghế Thường'),
(1620, 'E1', 69, 4, 'Ghế Thường'),
(1621, 'E2', 69, 4, 'Ghế Thường'),
(1622, 'E3', 69, 4, 'Ghế Thường'),
(1623, 'E4', 69, 4, 'Ghế Thường'),
(1624, 'E5', 69, 4, 'Ghế Thường'),
(1625, 'E6', 69, 4, 'Ghế Thường'),
(1626, 'E7', 69, 4, 'Ghế Thường'),
(1627, 'E8', 69, 4, 'Ghế Thường'),
(1628, 'E9', 69, 4, 'Ghế Thường'),
(1629, 'E10', 69, 4, 'Ghế Thường'),
(1630, 'E11', 69, 4, 'Ghế Thường'),
(1631, 'E12', 69, 4, 'Ghế Thường'),
(1632, 'F1', 69, 4, 'Ghế Thường'),
(1633, 'F2', 69, 4, 'Ghế Thường'),
(1634, 'F3', 69, 4, 'Ghế Thường'),
(1635, 'F4', 69, 4, 'Ghế Thường'),
(1636, 'F5', 69, 4, 'Ghế Thường'),
(1637, 'F6', 69, 4, 'Ghế Thường'),
(1638, 'F7', 69, 4, 'Ghế Thường'),
(1639, 'F8', 69, 4, 'Ghế Thường'),
(1640, 'F9', 69, 4, 'Ghế Thường'),
(1641, 'F10', 69, 4, 'Ghế Thường'),
(1642, 'F11', 69, 4, 'Ghế Thường'),
(1643, 'F12', 69, 4, 'Ghế Thường'),
(1644, 'G1', 69, 4, 'Ghế Thường'),
(1645, 'G2', 69, 4, 'Ghế Thường'),
(1646, 'G3', 69, 4, 'Ghế Thường'),
(1647, 'G4', 69, 4, 'Ghế Thường'),
(1648, 'G5', 69, 4, 'Ghế Thường'),
(1649, 'G6', 69, 4, 'Ghế Thường'),
(1650, 'G7', 69, 4, 'Ghế Thường'),
(1651, 'G8', 69, 4, 'Ghế Thường'),
(1652, 'G9', 69, 4, 'Ghế Thường'),
(1653, 'G10', 69, 4, 'Ghế Thường'),
(1654, 'G11', 69, 4, 'Ghế Thường'),
(1655, 'G12', 69, 4, 'Ghế Thường'),
(1656, 'H1', 69, 4, 'Ghế Thường'),
(1657, 'H2', 69, 4, 'Ghế Thường'),
(1658, 'H3', 69, 4, 'Ghế Thường'),
(1659, 'H4', 69, 4, 'Ghế Thường'),
(1660, 'H5', 69, 4, 'Ghế Thường'),
(1661, 'H6', 69, 4, 'Ghế Thường'),
(1662, 'H7', 69, 4, 'Ghế Thường'),
(1663, 'H8', 69, 4, 'Ghế Thường'),
(1664, 'H9', 69, 4, 'Ghế Thường'),
(1665, 'H10', 69, 4, 'Ghế Thường'),
(1666, 'H11', 69, 4, 'Ghế Thường'),
(1667, 'H12', 69, 4, 'Ghế Thường'),
(1668, 'I1', 69, 4, 'Ghế Thường'),
(1669, 'I2', 69, 4, 'Ghế Thường'),
(1670, 'I3', 69, 4, 'Ghế Thường'),
(1671, 'I4', 69, 4, 'Ghế Thường'),
(1672, 'I5', 69, 4, 'Ghế Thường'),
(1673, 'I6', 69, 4, 'Ghế Thường'),
(1674, 'I7', 69, 4, 'Ghế Thường'),
(1675, 'I8', 69, 4, 'Ghế Thường'),
(1676, 'I9', 69, 4, 'Ghế Thường'),
(1677, 'I10', 69, 4, 'Ghế Thường'),
(1678, 'I11', 69, 4, 'Ghế Thường'),
(1679, 'I12', 69, 4, 'Ghế Thường'),
(1680, 'J1', 69, 4, 'Ghế đôi'),
(1681, 'J2', 69, 4, 'Ghế đôi'),
(1682, 'J3', 69, 4, 'Ghế đôi'),
(1683, 'J4', 69, 4, 'Ghế đôi'),
(1684, 'J5', 69, 4, 'Ghế đôi'),
(1685, 'J6', 69, 4, 'Ghế đôi'),
(1686, 'J7', 69, 4, 'Ghế đôi'),
(1687, 'J8', 69, 4, 'Ghế đôi'),
(1688, 'J9', 69, 4, 'Ghế đôi'),
(1689, 'J10', 69, 4, 'Ghế đôi'),
(1690, 'J11', 69, 4, 'Ghế đôi'),
(1691, 'J12', 69, 4, 'Ghế đôi'),
(1692, 'A1', 70, 5, 'Ghế Thường'),
(1693, 'A2', 70, 5, 'Ghế Thường'),
(1694, 'A3', 70, 5, 'Ghế Thường'),
(1695, 'A4', 70, 5, 'Ghế Thường'),
(1696, 'A5', 70, 5, 'Ghế Thường'),
(1697, 'A6', 70, 5, 'Ghế Thường'),
(1698, 'A7', 70, 5, 'Ghế Thường'),
(1699, 'A8', 70, 5, 'Ghế Thường'),
(1700, 'A9', 70, 5, 'Ghế Thường'),
(1701, 'A10', 70, 5, 'Ghế Thường'),
(1702, 'A11', 70, 5, 'Ghế Thường'),
(1703, 'A12', 70, 5, 'Ghế Thường'),
(1704, 'B1', 70, 5, 'Ghế Thường'),
(1705, 'B2', 70, 5, 'Ghế Thường'),
(1706, 'B3', 70, 5, 'Ghế Thường'),
(1707, 'B4', 70, 5, 'Ghế Thường'),
(1708, 'B5', 70, 5, 'Ghế Thường'),
(1709, 'B6', 70, 5, 'Ghế Thường');
INSERT INTO `ghe_ngoi` (`maghe`, `soghe`, `maphong`, `marap`, `tenloai`) VALUES
(1710, 'B7', 70, 5, 'Ghế Thường'),
(1711, 'B8', 70, 5, 'Ghế Thường'),
(1712, 'B9', 70, 5, 'Ghế Thường'),
(1713, 'B10', 70, 5, 'Ghế Thường'),
(1714, 'B11', 70, 5, 'Ghế Thường'),
(1715, 'B12', 70, 5, 'Ghế Thường'),
(1716, 'C1', 70, 5, 'Ghế Thường'),
(1717, 'C2', 70, 5, 'Ghế Thường'),
(1718, 'C3', 70, 5, 'Ghế Thường'),
(1719, 'C4', 70, 5, 'Ghế Thường'),
(1720, 'C5', 70, 5, 'Ghế Thường'),
(1721, 'C6', 70, 5, 'Ghế Thường'),
(1722, 'C7', 70, 5, 'Ghế Thường'),
(1723, 'C8', 70, 5, 'Ghế Thường'),
(1724, 'C9', 70, 5, 'Ghế Thường'),
(1725, 'C10', 70, 5, 'Ghế Thường'),
(1726, 'C11', 70, 5, 'Ghế Thường'),
(1727, 'C12', 70, 5, 'Ghế Thường'),
(1728, 'D1', 70, 5, 'Ghế Thường'),
(1729, 'D2', 70, 5, 'Ghế Thường'),
(1730, 'D3', 70, 5, 'Ghế Thường'),
(1731, 'D4', 70, 5, 'Ghế Thường'),
(1732, 'D5', 70, 5, 'Ghế Thường'),
(1733, 'D6', 70, 5, 'Ghế Thường'),
(1734, 'D7', 70, 5, 'Ghế Thường'),
(1735, 'D8', 70, 5, 'Ghế Thường'),
(1736, 'D9', 70, 5, 'Ghế Thường'),
(1737, 'D10', 70, 5, 'Ghế Thường'),
(1738, 'D11', 70, 5, 'Ghế Thường'),
(1739, 'D12', 70, 5, 'Ghế Thường'),
(1740, 'E1', 70, 5, 'Ghế Thường'),
(1741, 'E2', 70, 5, 'Ghế Thường'),
(1742, 'E3', 70, 5, 'Ghế Thường'),
(1743, 'E4', 70, 5, 'Ghế Thường'),
(1744, 'E5', 70, 5, 'Ghế Thường'),
(1745, 'E6', 70, 5, 'Ghế Thường'),
(1746, 'E7', 70, 5, 'Ghế Thường'),
(1747, 'E8', 70, 5, 'Ghế Thường'),
(1748, 'E9', 70, 5, 'Ghế Thường'),
(1749, 'E10', 70, 5, 'Ghế Thường'),
(1750, 'E11', 70, 5, 'Ghế Thường'),
(1751, 'E12', 70, 5, 'Ghế Thường'),
(1752, 'F1', 70, 5, 'Ghế Thường'),
(1753, 'F2', 70, 5, 'Ghế Thường'),
(1754, 'F3', 70, 5, 'Ghế Thường'),
(1755, 'F4', 70, 5, 'Ghế Thường'),
(1756, 'F5', 70, 5, 'Ghế Thường'),
(1757, 'F6', 70, 5, 'Ghế Thường'),
(1758, 'F7', 70, 5, 'Ghế Thường'),
(1759, 'F8', 70, 5, 'Ghế Thường'),
(1760, 'F9', 70, 5, 'Ghế Thường'),
(1761, 'F10', 70, 5, 'Ghế Thường'),
(1762, 'F11', 70, 5, 'Ghế Thường'),
(1763, 'F12', 70, 5, 'Ghế Thường'),
(1764, 'G1', 70, 5, 'Ghế Thường'),
(1765, 'G2', 70, 5, 'Ghế Thường'),
(1766, 'G3', 70, 5, 'Ghế Thường'),
(1767, 'G4', 70, 5, 'Ghế Thường'),
(1768, 'G5', 70, 5, 'Ghế Thường'),
(1769, 'G6', 70, 5, 'Ghế Thường'),
(1770, 'G7', 70, 5, 'Ghế Thường'),
(1771, 'G8', 70, 5, 'Ghế Thường'),
(1772, 'G9', 70, 5, 'Ghế Thường'),
(1773, 'G10', 70, 5, 'Ghế Thường'),
(1774, 'G11', 70, 5, 'Ghế Thường'),
(1775, 'G12', 70, 5, 'Ghế Thường'),
(1776, 'H1', 70, 5, 'Ghế Thường'),
(1777, 'H2', 70, 5, 'Ghế Thường'),
(1778, 'H3', 70, 5, 'Ghế Thường'),
(1779, 'H4', 70, 5, 'Ghế Thường'),
(1780, 'H5', 70, 5, 'Ghế Thường'),
(1781, 'H6', 70, 5, 'Ghế Thường'),
(1782, 'H7', 70, 5, 'Ghế Thường'),
(1783, 'H8', 70, 5, 'Ghế Thường'),
(1784, 'H9', 70, 5, 'Ghế Thường'),
(1785, 'H10', 70, 5, 'Ghế Thường'),
(1786, 'H11', 70, 5, 'Ghế Thường'),
(1787, 'H12', 70, 5, 'Ghế Thường'),
(1788, 'I1', 70, 5, 'Ghế Thường'),
(1789, 'I2', 70, 5, 'Ghế Thường'),
(1790, 'I3', 70, 5, 'Ghế Thường'),
(1791, 'I4', 70, 5, 'Ghế Thường'),
(1792, 'I5', 70, 5, 'Ghế Thường'),
(1793, 'I6', 70, 5, 'Ghế Thường'),
(1794, 'I7', 70, 5, 'Ghế Thường'),
(1795, 'I8', 70, 5, 'Ghế Thường'),
(1796, 'I9', 70, 5, 'Ghế Thường'),
(1797, 'I10', 70, 5, 'Ghế Thường'),
(1798, 'I11', 70, 5, 'Ghế Thường'),
(1799, 'I12', 70, 5, 'Ghế Thường'),
(1800, 'J1', 70, 5, 'Ghế đôi'),
(1801, 'J2', 70, 5, 'Ghế đôi'),
(1802, 'J3', 70, 5, 'Ghế đôi'),
(1803, 'J4', 70, 5, 'Ghế đôi'),
(1804, 'J5', 70, 5, 'Ghế đôi'),
(1805, 'J6', 70, 5, 'Ghế đôi'),
(1806, 'J7', 70, 5, 'Ghế đôi'),
(1807, 'J8', 70, 5, 'Ghế đôi'),
(1808, 'J9', 70, 5, 'Ghế đôi'),
(1809, 'J10', 70, 5, 'Ghế đôi'),
(1810, 'J11', 70, 5, 'Ghế đôi'),
(1811, 'J12', 70, 5, 'Ghế đôi'),
(1812, 'A1', 71, 5, 'Gold Class'),
(1813, 'A2', 71, 5, 'Gold Class'),
(1814, 'A3', 71, 5, 'Gold Class'),
(1815, 'A4', 71, 5, 'Gold Class'),
(1816, 'A5', 71, 5, 'Gold Class'),
(1817, 'A6', 71, 5, 'Gold Class'),
(1818, 'A7', 71, 5, 'Gold Class'),
(1819, 'A8', 71, 5, 'Gold Class'),
(1820, 'A9', 71, 5, 'Gold Class'),
(1821, 'A10', 71, 5, 'Gold Class'),
(1822, 'A11', 71, 5, 'Gold Class'),
(1823, 'A12', 71, 5, 'Gold Class'),
(1824, 'B1', 71, 5, 'Gold Class'),
(1825, 'B2', 71, 5, 'Gold Class'),
(1826, 'B3', 71, 5, 'Gold Class'),
(1827, 'B4', 71, 5, 'Gold Class'),
(1828, 'B5', 71, 5, 'Gold Class'),
(1829, 'B6', 71, 5, 'Gold Class'),
(1830, 'B7', 71, 5, 'Gold Class'),
(1831, 'B8', 71, 5, 'Gold Class'),
(1832, 'B9', 71, 5, 'Gold Class'),
(1833, 'B10', 71, 5, 'Gold Class'),
(1834, 'B11', 71, 5, 'Gold Class'),
(1835, 'B12', 71, 5, 'Gold Class'),
(1836, 'C1', 71, 5, 'Gold Class'),
(1837, 'C2', 71, 5, 'Gold Class'),
(1838, 'C3', 71, 5, 'Gold Class'),
(1839, 'C4', 71, 5, 'Gold Class'),
(1840, 'C5', 71, 5, 'Gold Class'),
(1841, 'C6', 71, 5, 'Gold Class'),
(1842, 'C7', 71, 5, 'Gold Class'),
(1843, 'C8', 71, 5, 'Gold Class'),
(1844, 'C9', 71, 5, 'Gold Class'),
(1845, 'C10', 71, 5, 'Gold Class'),
(1846, 'C11', 71, 5, 'Gold Class'),
(1847, 'C12', 71, 5, 'Gold Class'),
(1848, 'D1', 71, 5, 'Gold Class'),
(1849, 'D2', 71, 5, 'Gold Class'),
(1850, 'D3', 71, 5, 'Gold Class'),
(1851, 'D4', 71, 5, 'Gold Class'),
(1852, 'D5', 71, 5, 'Gold Class'),
(1853, 'D6', 71, 5, 'Gold Class'),
(1854, 'D7', 71, 5, 'Gold Class'),
(1855, 'D8', 71, 5, 'Gold Class'),
(1856, 'D9', 71, 5, 'Gold Class'),
(1857, 'D10', 71, 5, 'Gold Class'),
(1858, 'D11', 71, 5, 'Gold Class'),
(1859, 'D12', 71, 5, 'Gold Class'),
(1860, 'E1', 71, 5, 'Gold Class'),
(1861, 'E2', 71, 5, 'Gold Class'),
(1862, 'E3', 71, 5, 'Gold Class'),
(1863, 'E4', 71, 5, 'Gold Class'),
(1864, 'E5', 71, 5, 'Gold Class'),
(1865, 'E6', 71, 5, 'Gold Class'),
(1866, 'E7', 71, 5, 'Gold Class'),
(1867, 'E8', 71, 5, 'Gold Class'),
(1868, 'E9', 71, 5, 'Gold Class'),
(1869, 'E10', 71, 5, 'Gold Class'),
(1870, 'E11', 71, 5, 'Gold Class'),
(1871, 'E12', 71, 5, 'Gold Class'),
(1872, 'F1', 71, 5, 'Gold Class'),
(1873, 'F2', 71, 5, 'Gold Class'),
(1874, 'F3', 71, 5, 'Gold Class'),
(1875, 'F4', 71, 5, 'Gold Class'),
(1876, 'F5', 71, 5, 'Gold Class'),
(1877, 'F6', 71, 5, 'Gold Class'),
(1878, 'F7', 71, 5, 'Gold Class'),
(1879, 'F8', 71, 5, 'Gold Class'),
(1880, 'F9', 71, 5, 'Gold Class'),
(1881, 'F10', 71, 5, 'Gold Class'),
(1882, 'F11', 71, 5, 'Gold Class'),
(1883, 'F12', 71, 5, 'Gold Class'),
(1884, 'G1', 71, 5, 'Gold Class'),
(1885, 'G2', 71, 5, 'Gold Class'),
(1886, 'G3', 71, 5, 'Gold Class'),
(1887, 'G4', 71, 5, 'Gold Class'),
(1888, 'G5', 71, 5, 'Gold Class'),
(1889, 'G6', 71, 5, 'Gold Class'),
(1890, 'G7', 71, 5, 'Gold Class'),
(1891, 'G8', 71, 5, 'Gold Class'),
(1892, 'G9', 71, 5, 'Gold Class'),
(1893, 'G10', 71, 5, 'Gold Class'),
(1894, 'G11', 71, 5, 'Gold Class'),
(1895, 'G12', 71, 5, 'Gold Class'),
(1896, 'H1', 71, 5, 'Gold Class'),
(1897, 'H2', 71, 5, 'Gold Class'),
(1898, 'H3', 71, 5, 'Gold Class'),
(1899, 'H4', 71, 5, 'Gold Class'),
(1900, 'H5', 71, 5, 'Gold Class'),
(1901, 'H6', 71, 5, 'Gold Class'),
(1902, 'H7', 71, 5, 'Gold Class'),
(1903, 'H8', 71, 5, 'Gold Class'),
(1904, 'H9', 71, 5, 'Gold Class'),
(1905, 'H10', 71, 5, 'Gold Class'),
(1906, 'H11', 71, 5, 'Gold Class'),
(1907, 'H12', 71, 5, 'Gold Class'),
(1908, 'I1', 71, 5, 'Gold Class'),
(1909, 'I2', 71, 5, 'Gold Class'),
(1910, 'I3', 71, 5, 'Gold Class'),
(1911, 'I4', 71, 5, 'Gold Class'),
(1912, 'I5', 71, 5, 'Gold Class'),
(1913, 'I6', 71, 5, 'Gold Class'),
(1914, 'I7', 71, 5, 'Gold Class'),
(1915, 'I8', 71, 5, 'Gold Class'),
(1916, 'I9', 71, 5, 'Gold Class'),
(1917, 'I10', 71, 5, 'Gold Class'),
(1918, 'I11', 71, 5, 'Gold Class'),
(1919, 'I12', 71, 5, 'Gold Class'),
(1920, 'J1', 71, 5, 'Gold Class'),
(1921, 'J2', 71, 5, 'Gold Class'),
(1922, 'J3', 71, 5, 'Gold Class'),
(1923, 'J4', 71, 5, 'Gold Class'),
(1924, 'J5', 71, 5, 'Gold Class'),
(1925, 'J6', 71, 5, 'Gold Class'),
(1926, 'J7', 71, 5, 'Gold Class'),
(1927, 'J8', 71, 5, 'Gold Class'),
(1928, 'J9', 71, 5, 'Gold Class'),
(1929, 'J10', 71, 5, 'Gold Class'),
(1930, 'J11', 71, 5, 'Gold Class'),
(1931, 'J12', 71, 5, 'Gold Class'),
(1932, 'A1', 72, 5, 'Ghế 4DX'),
(1933, 'A2', 72, 5, 'Ghế 4DX'),
(1934, 'A3', 72, 5, 'Ghế 4DX'),
(1935, 'A4', 72, 5, 'Ghế 4DX'),
(1936, 'A5', 72, 5, 'Ghế 4DX'),
(1937, 'A6', 72, 5, 'Ghế 4DX'),
(1938, 'A7', 72, 5, 'Ghế 4DX'),
(1939, 'A8', 72, 5, 'Ghế 4DX'),
(1940, 'A9', 72, 5, 'Ghế 4DX'),
(1941, 'A10', 72, 5, 'Ghế 4DX'),
(1942, 'A11', 72, 5, 'Ghế 4DX'),
(1943, 'A12', 72, 5, 'Ghế 4DX'),
(1944, 'B1', 72, 5, 'Ghế 4DX'),
(1945, 'B2', 72, 5, 'Ghế 4DX'),
(1946, 'B3', 72, 5, 'Ghế 4DX'),
(1947, 'B4', 72, 5, 'Ghế 4DX'),
(1948, 'B5', 72, 5, 'Ghế 4DX'),
(1949, 'B6', 72, 5, 'Ghế 4DX'),
(1950, 'B7', 72, 5, 'Ghế 4DX'),
(1951, 'B8', 72, 5, 'Ghế 4DX'),
(1952, 'B9', 72, 5, 'Ghế 4DX'),
(1953, 'B10', 72, 5, 'Ghế 4DX'),
(1954, 'B11', 72, 5, 'Ghế 4DX'),
(1955, 'B12', 72, 5, 'Ghế 4DX'),
(1956, 'C1', 72, 5, 'Ghế 4DX'),
(1957, 'C2', 72, 5, 'Ghế 4DX'),
(1958, 'C3', 72, 5, 'Ghế 4DX'),
(1959, 'C4', 72, 5, 'Ghế 4DX'),
(1960, 'C5', 72, 5, 'Ghế 4DX'),
(1961, 'C6', 72, 5, 'Ghế 4DX'),
(1962, 'C7', 72, 5, 'Ghế 4DX'),
(1963, 'C8', 72, 5, 'Ghế 4DX'),
(1964, 'C9', 72, 5, 'Ghế 4DX'),
(1965, 'C10', 72, 5, 'Ghế 4DX'),
(1966, 'C11', 72, 5, 'Ghế 4DX'),
(1967, 'C12', 72, 5, 'Ghế 4DX'),
(1968, 'D1', 72, 5, 'Ghế 4DX'),
(1969, 'D2', 72, 5, 'Ghế 4DX'),
(1970, 'D3', 72, 5, 'Ghế 4DX'),
(1971, 'D4', 72, 5, 'Ghế 4DX'),
(1972, 'D5', 72, 5, 'Ghế 4DX'),
(1973, 'D6', 72, 5, 'Ghế 4DX'),
(1974, 'D7', 72, 5, 'Ghế 4DX'),
(1975, 'D8', 72, 5, 'Ghế 4DX'),
(1976, 'D9', 72, 5, 'Ghế 4DX'),
(1977, 'D10', 72, 5, 'Ghế 4DX'),
(1978, 'D11', 72, 5, 'Ghế 4DX'),
(1979, 'D12', 72, 5, 'Ghế 4DX'),
(1980, 'E1', 72, 5, 'Ghế 4DX'),
(1981, 'E2', 72, 5, 'Ghế 4DX'),
(1982, 'E3', 72, 5, 'Ghế 4DX'),
(1983, 'E4', 72, 5, 'Ghế 4DX'),
(1984, 'E5', 72, 5, 'Ghế 4DX'),
(1985, 'E6', 72, 5, 'Ghế 4DX'),
(1986, 'E7', 72, 5, 'Ghế 4DX'),
(1987, 'E8', 72, 5, 'Ghế 4DX'),
(1988, 'E9', 72, 5, 'Ghế 4DX'),
(1989, 'E10', 72, 5, 'Ghế 4DX'),
(1990, 'E11', 72, 5, 'Ghế 4DX'),
(1991, 'E12', 72, 5, 'Ghế 4DX'),
(1992, 'F1', 72, 5, 'Ghế 4DX'),
(1993, 'F2', 72, 5, 'Ghế 4DX'),
(1994, 'F3', 72, 5, 'Ghế 4DX'),
(1995, 'F4', 72, 5, 'Ghế 4DX'),
(1996, 'F5', 72, 5, 'Ghế 4DX'),
(1997, 'F6', 72, 5, 'Ghế 4DX'),
(1998, 'F7', 72, 5, 'Ghế 4DX'),
(1999, 'F8', 72, 5, 'Ghế 4DX'),
(2000, 'F9', 72, 5, 'Ghế 4DX'),
(2001, 'F10', 72, 5, 'Ghế 4DX'),
(2002, 'F11', 72, 5, 'Ghế 4DX'),
(2003, 'F12', 72, 5, 'Ghế 4DX'),
(2004, 'G1', 72, 5, 'Ghế 4DX'),
(2005, 'G2', 72, 5, 'Ghế 4DX'),
(2006, 'G3', 72, 5, 'Ghế 4DX'),
(2007, 'G4', 72, 5, 'Ghế 4DX'),
(2008, 'G5', 72, 5, 'Ghế 4DX'),
(2009, 'G6', 72, 5, 'Ghế 4DX'),
(2010, 'G7', 72, 5, 'Ghế 4DX'),
(2011, 'G8', 72, 5, 'Ghế 4DX'),
(2012, 'G9', 72, 5, 'Ghế 4DX'),
(2013, 'G10', 72, 5, 'Ghế 4DX'),
(2014, 'G11', 72, 5, 'Ghế 4DX'),
(2015, 'G12', 72, 5, 'Ghế 4DX'),
(2016, 'H1', 72, 5, 'Ghế 4DX'),
(2017, 'H2', 72, 5, 'Ghế 4DX'),
(2018, 'H3', 72, 5, 'Ghế 4DX'),
(2019, 'H4', 72, 5, 'Ghế 4DX'),
(2020, 'H5', 72, 5, 'Ghế 4DX'),
(2021, 'H6', 72, 5, 'Ghế 4DX'),
(2022, 'H7', 72, 5, 'Ghế 4DX'),
(2023, 'H8', 72, 5, 'Ghế 4DX'),
(2024, 'H9', 72, 5, 'Ghế 4DX'),
(2025, 'H10', 72, 5, 'Ghế 4DX'),
(2026, 'H11', 72, 5, 'Ghế 4DX'),
(2027, 'H12', 72, 5, 'Ghế 4DX'),
(2028, 'I1', 72, 5, 'Ghế 4DX'),
(2029, 'I2', 72, 5, 'Ghế 4DX'),
(2030, 'I3', 72, 5, 'Ghế 4DX'),
(2031, 'I4', 72, 5, 'Ghế 4DX'),
(2032, 'I5', 72, 5, 'Ghế 4DX'),
(2033, 'I6', 72, 5, 'Ghế 4DX'),
(2034, 'I7', 72, 5, 'Ghế 4DX'),
(2035, 'I8', 72, 5, 'Ghế 4DX'),
(2036, 'I9', 72, 5, 'Ghế 4DX'),
(2037, 'I10', 72, 5, 'Ghế 4DX'),
(2038, 'I11', 72, 5, 'Ghế 4DX'),
(2039, 'I12', 72, 5, 'Ghế 4DX'),
(2040, 'J1', 72, 5, 'Ghế 4DX'),
(2041, 'J2', 72, 5, 'Ghế 4DX'),
(2042, 'J3', 72, 5, 'Ghế 4DX'),
(2043, 'J4', 72, 5, 'Ghế 4DX'),
(2044, 'J5', 72, 5, 'Ghế 4DX'),
(2045, 'J6', 72, 5, 'Ghế 4DX'),
(2046, 'J7', 72, 5, 'Ghế 4DX'),
(2047, 'J8', 72, 5, 'Ghế 4DX'),
(2048, 'J9', 72, 5, 'Ghế 4DX'),
(2049, 'J10', 72, 5, 'Ghế 4DX'),
(2050, 'J11', 72, 5, 'Ghế 4DX'),
(2051, 'J12', 72, 5, 'Ghế 4DX'),
(2052, 'A1', 73, 5, 'Ghế Imax'),
(2053, 'A2', 73, 5, 'Ghế Imax'),
(2054, 'A3', 73, 5, 'Ghế Imax'),
(2055, 'A4', 73, 5, 'Ghế Imax'),
(2056, 'A5', 73, 5, 'Ghế Imax'),
(2057, 'A6', 73, 5, 'Ghế Imax'),
(2058, 'A7', 73, 5, 'Ghế Imax'),
(2059, 'A8', 73, 5, 'Ghế Imax'),
(2060, 'A9', 73, 5, 'Ghế Imax'),
(2061, 'A10', 73, 5, 'Ghế Imax'),
(2062, 'A11', 73, 5, 'Ghế Imax'),
(2063, 'A12', 73, 5, 'Ghế Imax'),
(2064, 'B1', 73, 5, 'Ghế Imax'),
(2065, 'B2', 73, 5, 'Ghế Imax'),
(2066, 'B3', 73, 5, 'Ghế Imax'),
(2067, 'B4', 73, 5, 'Ghế Imax'),
(2068, 'B5', 73, 5, 'Ghế Imax'),
(2069, 'B6', 73, 5, 'Ghế Imax'),
(2070, 'B7', 73, 5, 'Ghế Imax'),
(2071, 'B8', 73, 5, 'Ghế Imax'),
(2072, 'B9', 73, 5, 'Ghế Imax'),
(2073, 'B10', 73, 5, 'Ghế Imax'),
(2074, 'B11', 73, 5, 'Ghế Imax'),
(2075, 'B12', 73, 5, 'Ghế Imax'),
(2076, 'C1', 73, 5, 'Ghế Imax'),
(2077, 'C2', 73, 5, 'Ghế Imax'),
(2078, 'C3', 73, 5, 'Ghế Imax'),
(2079, 'C4', 73, 5, 'Ghế Imax'),
(2080, 'C5', 73, 5, 'Ghế Imax'),
(2081, 'C6', 73, 5, 'Ghế Imax'),
(2082, 'C7', 73, 5, 'Ghế Imax'),
(2083, 'C8', 73, 5, 'Ghế Imax'),
(2084, 'C9', 73, 5, 'Ghế Imax'),
(2085, 'C10', 73, 5, 'Ghế Imax'),
(2086, 'C11', 73, 5, 'Ghế Imax'),
(2087, 'C12', 73, 5, 'Ghế Imax'),
(2088, 'D1', 73, 5, 'Ghế Imax'),
(2089, 'D2', 73, 5, 'Ghế Imax'),
(2090, 'D3', 73, 5, 'Ghế Imax'),
(2091, 'D4', 73, 5, 'Ghế Imax'),
(2092, 'D5', 73, 5, 'Ghế Imax'),
(2093, 'D6', 73, 5, 'Ghế Imax'),
(2094, 'D7', 73, 5, 'Ghế Imax'),
(2095, 'D8', 73, 5, 'Ghế Imax'),
(2096, 'D9', 73, 5, 'Ghế Imax'),
(2097, 'D10', 73, 5, 'Ghế Imax'),
(2098, 'D11', 73, 5, 'Ghế Imax'),
(2099, 'D12', 73, 5, 'Ghế Imax'),
(2100, 'E1', 73, 5, 'Ghế Imax'),
(2101, 'E2', 73, 5, 'Ghế Imax'),
(2102, 'E3', 73, 5, 'Ghế Imax'),
(2103, 'E4', 73, 5, 'Ghế Imax'),
(2104, 'E5', 73, 5, 'Ghế Imax'),
(2105, 'E6', 73, 5, 'Ghế Imax'),
(2106, 'E7', 73, 5, 'Ghế Imax'),
(2107, 'E8', 73, 5, 'Ghế Imax'),
(2108, 'E9', 73, 5, 'Ghế Imax'),
(2109, 'E10', 73, 5, 'Ghế Imax'),
(2110, 'E11', 73, 5, 'Ghế Imax'),
(2111, 'E12', 73, 5, 'Ghế Imax'),
(2112, 'F1', 73, 5, 'Ghế Imax'),
(2113, 'F2', 73, 5, 'Ghế Imax'),
(2114, 'F3', 73, 5, 'Ghế Imax'),
(2115, 'F4', 73, 5, 'Ghế Imax'),
(2116, 'F5', 73, 5, 'Ghế Imax'),
(2117, 'F6', 73, 5, 'Ghế Imax'),
(2118, 'F7', 73, 5, 'Ghế Imax'),
(2119, 'F8', 73, 5, 'Ghế Imax'),
(2120, 'F9', 73, 5, 'Ghế Imax'),
(2121, 'F10', 73, 5, 'Ghế Imax'),
(2122, 'F11', 73, 5, 'Ghế Imax'),
(2123, 'F12', 73, 5, 'Ghế Imax'),
(2124, 'G1', 73, 5, 'Ghế Imax'),
(2125, 'G2', 73, 5, 'Ghế Imax'),
(2126, 'G3', 73, 5, 'Ghế Imax'),
(2127, 'G4', 73, 5, 'Ghế Imax'),
(2128, 'G5', 73, 5, 'Ghế Imax'),
(2129, 'G6', 73, 5, 'Ghế Imax'),
(2130, 'G7', 73, 5, 'Ghế Imax'),
(2131, 'G8', 73, 5, 'Ghế Imax'),
(2132, 'G9', 73, 5, 'Ghế Imax'),
(2133, 'G10', 73, 5, 'Ghế Imax'),
(2134, 'G11', 73, 5, 'Ghế Imax'),
(2135, 'G12', 73, 5, 'Ghế Imax'),
(2136, 'H1', 73, 5, 'Ghế Imax'),
(2137, 'H2', 73, 5, 'Ghế Imax'),
(2138, 'H3', 73, 5, 'Ghế Imax'),
(2139, 'H4', 73, 5, 'Ghế Imax'),
(2140, 'H5', 73, 5, 'Ghế Imax'),
(2141, 'H6', 73, 5, 'Ghế Imax'),
(2142, 'H7', 73, 5, 'Ghế Imax'),
(2143, 'H8', 73, 5, 'Ghế Imax'),
(2144, 'H9', 73, 5, 'Ghế Imax'),
(2145, 'H10', 73, 5, 'Ghế Imax'),
(2146, 'H11', 73, 5, 'Ghế Imax'),
(2147, 'H12', 73, 5, 'Ghế Imax'),
(2148, 'I1', 73, 5, 'Ghế Imax'),
(2149, 'I2', 73, 5, 'Ghế Imax'),
(2150, 'I3', 73, 5, 'Ghế Imax'),
(2151, 'I4', 73, 5, 'Ghế Imax'),
(2152, 'I5', 73, 5, 'Ghế Imax'),
(2153, 'I6', 73, 5, 'Ghế Imax'),
(2154, 'I7', 73, 5, 'Ghế Imax'),
(2155, 'I8', 73, 5, 'Ghế Imax'),
(2156, 'I9', 73, 5, 'Ghế Imax'),
(2157, 'I10', 73, 5, 'Ghế Imax'),
(2158, 'I11', 73, 5, 'Ghế Imax'),
(2159, 'I12', 73, 5, 'Ghế Imax'),
(2160, 'J1', 73, 5, 'Ghế Imax'),
(2161, 'J2', 73, 5, 'Ghế Imax'),
(2162, 'J3', 73, 5, 'Ghế Imax'),
(2163, 'J4', 73, 5, 'Ghế Imax'),
(2164, 'J5', 73, 5, 'Ghế Imax'),
(2165, 'J6', 73, 5, 'Ghế Imax'),
(2166, 'J7', 73, 5, 'Ghế Imax'),
(2167, 'J8', 73, 5, 'Ghế Imax'),
(2168, 'J9', 73, 5, 'Ghế Imax'),
(2169, 'J10', 73, 5, 'Ghế Imax'),
(2170, 'J11', 73, 5, 'Ghế Imax'),
(2171, 'J12', 73, 5, 'Ghế Imax'),
(2172, 'A1', 74, 6, 'Ghế Thường'),
(2173, 'A2', 74, 6, 'Ghế Thường'),
(2174, 'A3', 74, 6, 'Ghế Thường'),
(2175, 'A4', 74, 6, 'Ghế Thường'),
(2176, 'A5', 74, 6, 'Ghế Thường'),
(2177, 'A6', 74, 6, 'Ghế Thường'),
(2178, 'A7', 74, 6, 'Ghế Thường'),
(2179, 'A8', 74, 6, 'Ghế Thường'),
(2180, 'A9', 74, 6, 'Ghế Thường'),
(2181, 'A10', 74, 6, 'Ghế Thường'),
(2182, 'A11', 74, 6, 'Ghế Thường'),
(2183, 'A12', 74, 6, 'Ghế Thường'),
(2184, 'B1', 74, 6, 'Ghế Thường'),
(2185, 'B2', 74, 6, 'Ghế Thường'),
(2186, 'B3', 74, 6, 'Ghế Thường'),
(2187, 'B4', 74, 6, 'Ghế Thường'),
(2188, 'B5', 74, 6, 'Ghế Thường'),
(2189, 'B6', 74, 6, 'Ghế Thường'),
(2190, 'B7', 74, 6, 'Ghế Thường'),
(2191, 'B8', 74, 6, 'Ghế Thường'),
(2192, 'B9', 74, 6, 'Ghế Thường'),
(2193, 'B10', 74, 6, 'Ghế Thường'),
(2194, 'B11', 74, 6, 'Ghế Thường'),
(2195, 'B12', 74, 6, 'Ghế Thường'),
(2196, 'C1', 74, 6, 'Ghế Thường'),
(2197, 'C2', 74, 6, 'Ghế Thường'),
(2198, 'C3', 74, 6, 'Ghế Thường'),
(2199, 'C4', 74, 6, 'Ghế Thường'),
(2200, 'C5', 74, 6, 'Ghế Thường'),
(2201, 'C6', 74, 6, 'Ghế Thường'),
(2202, 'C7', 74, 6, 'Ghế Thường'),
(2203, 'C8', 74, 6, 'Ghế Thường'),
(2204, 'C9', 74, 6, 'Ghế Thường'),
(2205, 'C10', 74, 6, 'Ghế Thường'),
(2206, 'C11', 74, 6, 'Ghế Thường'),
(2207, 'C12', 74, 6, 'Ghế Thường'),
(2208, 'D1', 74, 6, 'Ghế Thường'),
(2209, 'D2', 74, 6, 'Ghế Thường'),
(2210, 'D3', 74, 6, 'Ghế Thường'),
(2211, 'D4', 74, 6, 'Ghế Thường'),
(2212, 'D5', 74, 6, 'Ghế Thường'),
(2213, 'D6', 74, 6, 'Ghế Thường'),
(2214, 'D7', 74, 6, 'Ghế Thường'),
(2215, 'D8', 74, 6, 'Ghế Thường'),
(2216, 'D9', 74, 6, 'Ghế Thường'),
(2217, 'D10', 74, 6, 'Ghế Thường'),
(2218, 'D11', 74, 6, 'Ghế Thường'),
(2219, 'D12', 74, 6, 'Ghế Thường'),
(2220, 'E1', 74, 6, 'Ghế Thường'),
(2221, 'E2', 74, 6, 'Ghế Thường'),
(2222, 'E3', 74, 6, 'Ghế Thường'),
(2223, 'E4', 74, 6, 'Ghế Thường'),
(2224, 'E5', 74, 6, 'Ghế Thường'),
(2225, 'E6', 74, 6, 'Ghế Thường'),
(2226, 'E7', 74, 6, 'Ghế Thường'),
(2227, 'E8', 74, 6, 'Ghế Thường'),
(2228, 'E9', 74, 6, 'Ghế Thường'),
(2229, 'E10', 74, 6, 'Ghế Thường'),
(2230, 'E11', 74, 6, 'Ghế Thường'),
(2231, 'E12', 74, 6, 'Ghế Thường'),
(2232, 'F1', 74, 6, 'Ghế Thường'),
(2233, 'F2', 74, 6, 'Ghế Thường'),
(2234, 'F3', 74, 6, 'Ghế Thường'),
(2235, 'F4', 74, 6, 'Ghế Thường'),
(2236, 'F5', 74, 6, 'Ghế Thường'),
(2237, 'F6', 74, 6, 'Ghế Thường'),
(2238, 'F7', 74, 6, 'Ghế Thường'),
(2239, 'F8', 74, 6, 'Ghế Thường'),
(2240, 'F9', 74, 6, 'Ghế Thường'),
(2241, 'F10', 74, 6, 'Ghế Thường'),
(2242, 'F11', 74, 6, 'Ghế Thường'),
(2243, 'F12', 74, 6, 'Ghế Thường'),
(2244, 'G1', 74, 6, 'Ghế Thường'),
(2245, 'G2', 74, 6, 'Ghế Thường'),
(2246, 'G3', 74, 6, 'Ghế Thường'),
(2247, 'G4', 74, 6, 'Ghế Thường'),
(2248, 'G5', 74, 6, 'Ghế Thường'),
(2249, 'G6', 74, 6, 'Ghế Thường'),
(2250, 'G7', 74, 6, 'Ghế Thường'),
(2251, 'G8', 74, 6, 'Ghế Thường'),
(2252, 'G9', 74, 6, 'Ghế Thường'),
(2253, 'G10', 74, 6, 'Ghế Thường'),
(2254, 'G11', 74, 6, 'Ghế Thường'),
(2255, 'G12', 74, 6, 'Ghế Thường'),
(2256, 'H1', 74, 6, 'Ghế Thường'),
(2257, 'H2', 74, 6, 'Ghế Thường'),
(2258, 'H3', 74, 6, 'Ghế Thường'),
(2259, 'H4', 74, 6, 'Ghế Thường'),
(2260, 'H5', 74, 6, 'Ghế Thường'),
(2261, 'H6', 74, 6, 'Ghế Thường'),
(2262, 'H7', 74, 6, 'Ghế Thường'),
(2263, 'H8', 74, 6, 'Ghế Thường'),
(2264, 'H9', 74, 6, 'Ghế Thường'),
(2265, 'H10', 74, 6, 'Ghế Thường'),
(2266, 'H11', 74, 6, 'Ghế Thường'),
(2267, 'H12', 74, 6, 'Ghế Thường'),
(2268, 'I1', 74, 6, 'Ghế Thường'),
(2269, 'I2', 74, 6, 'Ghế Thường'),
(2270, 'I3', 74, 6, 'Ghế Thường'),
(2271, 'I4', 74, 6, 'Ghế Thường'),
(2272, 'I5', 74, 6, 'Ghế Thường'),
(2273, 'I6', 74, 6, 'Ghế Thường'),
(2274, 'I7', 74, 6, 'Ghế Thường'),
(2275, 'I8', 74, 6, 'Ghế Thường'),
(2276, 'I9', 74, 6, 'Ghế Thường'),
(2277, 'I10', 74, 6, 'Ghế Thường'),
(2278, 'I11', 74, 6, 'Ghế Thường'),
(2279, 'I12', 74, 6, 'Ghế Thường'),
(2280, 'J1', 74, 6, 'Ghế đôi'),
(2281, 'J2', 74, 6, 'Ghế đôi'),
(2282, 'J3', 74, 6, 'Ghế đôi'),
(2283, 'J4', 74, 6, 'Ghế đôi'),
(2284, 'J5', 74, 6, 'Ghế đôi'),
(2285, 'J6', 74, 6, 'Ghế đôi'),
(2286, 'J7', 74, 6, 'Ghế đôi'),
(2287, 'J8', 74, 6, 'Ghế đôi'),
(2288, 'J9', 74, 6, 'Ghế đôi'),
(2289, 'J10', 74, 6, 'Ghế đôi'),
(2290, 'J11', 74, 6, 'Ghế đôi'),
(2291, 'J12', 74, 6, 'Ghế đôi'),
(2292, 'A1', 75, 6, 'Ghế Thường'),
(2293, 'A2', 75, 6, 'Ghế Thường'),
(2294, 'A3', 75, 6, 'Ghế Thường'),
(2295, 'A4', 75, 6, 'Ghế Thường'),
(2296, 'A5', 75, 6, 'Ghế Thường'),
(2297, 'A6', 75, 6, 'Ghế Thường'),
(2298, 'A7', 75, 6, 'Ghế Thường'),
(2299, 'A8', 75, 6, 'Ghế Thường'),
(2300, 'A9', 75, 6, 'Ghế Thường'),
(2301, 'A10', 75, 6, 'Ghế Thường'),
(2302, 'A11', 75, 6, 'Ghế Thường'),
(2303, 'A12', 75, 6, 'Ghế Thường'),
(2304, 'B1', 75, 6, 'Ghế Thường'),
(2305, 'B2', 75, 6, 'Ghế Thường'),
(2306, 'B3', 75, 6, 'Ghế Thường'),
(2307, 'B4', 75, 6, 'Ghế Thường'),
(2308, 'B5', 75, 6, 'Ghế Thường'),
(2309, 'B6', 75, 6, 'Ghế Thường'),
(2310, 'B7', 75, 6, 'Ghế Thường'),
(2311, 'B8', 75, 6, 'Ghế Thường'),
(2312, 'B9', 75, 6, 'Ghế Thường'),
(2313, 'B10', 75, 6, 'Ghế Thường'),
(2314, 'B11', 75, 6, 'Ghế Thường'),
(2315, 'B12', 75, 6, 'Ghế Thường'),
(2316, 'C1', 75, 6, 'Ghế Thường'),
(2317, 'C2', 75, 6, 'Ghế Thường'),
(2318, 'C3', 75, 6, 'Ghế Thường'),
(2319, 'C4', 75, 6, 'Ghế Thường'),
(2320, 'C5', 75, 6, 'Ghế Thường'),
(2321, 'C6', 75, 6, 'Ghế Thường'),
(2322, 'C7', 75, 6, 'Ghế Thường'),
(2323, 'C8', 75, 6, 'Ghế Thường'),
(2324, 'C9', 75, 6, 'Ghế Thường'),
(2325, 'C10', 75, 6, 'Ghế Thường'),
(2326, 'C11', 75, 6, 'Ghế Thường'),
(2327, 'C12', 75, 6, 'Ghế Thường'),
(2328, 'D1', 75, 6, 'Ghế Thường'),
(2329, 'D2', 75, 6, 'Ghế Thường'),
(2330, 'D3', 75, 6, 'Ghế Thường'),
(2331, 'D4', 75, 6, 'Ghế Thường'),
(2332, 'D5', 75, 6, 'Ghế Thường'),
(2333, 'D6', 75, 6, 'Ghế Thường'),
(2334, 'D7', 75, 6, 'Ghế Thường'),
(2335, 'D8', 75, 6, 'Ghế Thường'),
(2336, 'D9', 75, 6, 'Ghế Thường'),
(2337, 'D10', 75, 6, 'Ghế Thường'),
(2338, 'D11', 75, 6, 'Ghế Thường'),
(2339, 'D12', 75, 6, 'Ghế Thường'),
(2340, 'E1', 75, 6, 'Ghế Thường'),
(2341, 'E2', 75, 6, 'Ghế Thường'),
(2342, 'E3', 75, 6, 'Ghế Thường'),
(2343, 'E4', 75, 6, 'Ghế Thường'),
(2344, 'E5', 75, 6, 'Ghế Thường'),
(2345, 'E6', 75, 6, 'Ghế Thường'),
(2346, 'E7', 75, 6, 'Ghế Thường'),
(2347, 'E8', 75, 6, 'Ghế Thường'),
(2348, 'E9', 75, 6, 'Ghế Thường'),
(2349, 'E10', 75, 6, 'Ghế Thường'),
(2350, 'E11', 75, 6, 'Ghế Thường'),
(2351, 'E12', 75, 6, 'Ghế Thường'),
(2352, 'F1', 75, 6, 'Ghế Thường'),
(2353, 'F2', 75, 6, 'Ghế Thường'),
(2354, 'F3', 75, 6, 'Ghế Thường'),
(2355, 'F4', 75, 6, 'Ghế Thường'),
(2356, 'F5', 75, 6, 'Ghế Thường'),
(2357, 'F6', 75, 6, 'Ghế Thường'),
(2358, 'F7', 75, 6, 'Ghế Thường'),
(2359, 'F8', 75, 6, 'Ghế Thường'),
(2360, 'F9', 75, 6, 'Ghế Thường'),
(2361, 'F10', 75, 6, 'Ghế Thường'),
(2362, 'F11', 75, 6, 'Ghế Thường'),
(2363, 'F12', 75, 6, 'Ghế Thường'),
(2364, 'G1', 75, 6, 'Ghế Thường'),
(2365, 'G2', 75, 6, 'Ghế Thường'),
(2366, 'G3', 75, 6, 'Ghế Thường'),
(2367, 'G4', 75, 6, 'Ghế Thường'),
(2368, 'G5', 75, 6, 'Ghế Thường'),
(2369, 'G6', 75, 6, 'Ghế Thường'),
(2370, 'G7', 75, 6, 'Ghế Thường'),
(2371, 'G8', 75, 6, 'Ghế Thường'),
(2372, 'G9', 75, 6, 'Ghế Thường'),
(2373, 'G10', 75, 6, 'Ghế Thường'),
(2374, 'G11', 75, 6, 'Ghế Thường'),
(2375, 'G12', 75, 6, 'Ghế Thường'),
(2376, 'H1', 75, 6, 'Ghế Thường'),
(2377, 'H2', 75, 6, 'Ghế Thường'),
(2378, 'H3', 75, 6, 'Ghế Thường'),
(2379, 'H4', 75, 6, 'Ghế Thường'),
(2380, 'H5', 75, 6, 'Ghế Thường'),
(2381, 'H6', 75, 6, 'Ghế Thường'),
(2382, 'H7', 75, 6, 'Ghế Thường'),
(2383, 'H8', 75, 6, 'Ghế Thường'),
(2384, 'H9', 75, 6, 'Ghế Thường'),
(2385, 'H10', 75, 6, 'Ghế Thường'),
(2386, 'H11', 75, 6, 'Ghế Thường'),
(2387, 'H12', 75, 6, 'Ghế Thường'),
(2388, 'I1', 75, 6, 'Ghế Thường'),
(2389, 'I2', 75, 6, 'Ghế Thường'),
(2390, 'I3', 75, 6, 'Ghế Thường'),
(2391, 'I4', 75, 6, 'Ghế Thường'),
(2392, 'I5', 75, 6, 'Ghế Thường'),
(2393, 'I6', 75, 6, 'Ghế Thường'),
(2394, 'I7', 75, 6, 'Ghế Thường'),
(2395, 'I8', 75, 6, 'Ghế Thường'),
(2396, 'I9', 75, 6, 'Ghế Thường'),
(2397, 'I10', 75, 6, 'Ghế Thường'),
(2398, 'I11', 75, 6, 'Ghế Thường'),
(2399, 'I12', 75, 6, 'Ghế Thường'),
(2400, 'J1', 75, 6, 'Ghế đôi'),
(2401, 'J2', 75, 6, 'Ghế đôi'),
(2402, 'J3', 75, 6, 'Ghế đôi'),
(2403, 'J4', 75, 6, 'Ghế đôi'),
(2404, 'J5', 75, 6, 'Ghế đôi'),
(2405, 'J6', 75, 6, 'Ghế đôi'),
(2406, 'J7', 75, 6, 'Ghế đôi'),
(2407, 'J8', 75, 6, 'Ghế đôi'),
(2408, 'J9', 75, 6, 'Ghế đôi'),
(2409, 'J10', 75, 6, 'Ghế đôi'),
(2410, 'J11', 75, 6, 'Ghế đôi'),
(2411, 'J12', 75, 6, 'Ghế đôi'),
(2412, 'A1', 76, 6, 'Ghế 4DX'),
(2413, 'A2', 76, 6, 'Ghế 4DX'),
(2414, 'A3', 76, 6, 'Ghế 4DX'),
(2415, 'A4', 76, 6, 'Ghế 4DX'),
(2416, 'A5', 76, 6, 'Ghế 4DX'),
(2417, 'A6', 76, 6, 'Ghế 4DX'),
(2418, 'A7', 76, 6, 'Ghế 4DX'),
(2419, 'A8', 76, 6, 'Ghế 4DX'),
(2420, 'A9', 76, 6, 'Ghế 4DX'),
(2421, 'A10', 76, 6, 'Ghế 4DX'),
(2422, 'A11', 76, 6, 'Ghế 4DX'),
(2423, 'A12', 76, 6, 'Ghế 4DX'),
(2424, 'B1', 76, 6, 'Ghế 4DX'),
(2425, 'B2', 76, 6, 'Ghế 4DX'),
(2426, 'B3', 76, 6, 'Ghế 4DX'),
(2427, 'B4', 76, 6, 'Ghế 4DX'),
(2428, 'B5', 76, 6, 'Ghế 4DX'),
(2429, 'B6', 76, 6, 'Ghế 4DX'),
(2430, 'B7', 76, 6, 'Ghế 4DX'),
(2431, 'B8', 76, 6, 'Ghế 4DX'),
(2432, 'B9', 76, 6, 'Ghế 4DX'),
(2433, 'B10', 76, 6, 'Ghế 4DX'),
(2434, 'B11', 76, 6, 'Ghế 4DX'),
(2435, 'B12', 76, 6, 'Ghế 4DX'),
(2436, 'C1', 76, 6, 'Ghế 4DX'),
(2437, 'C2', 76, 6, 'Ghế 4DX'),
(2438, 'C3', 76, 6, 'Ghế 4DX'),
(2439, 'C4', 76, 6, 'Ghế 4DX'),
(2440, 'C5', 76, 6, 'Ghế 4DX'),
(2441, 'C6', 76, 6, 'Ghế 4DX'),
(2442, 'C7', 76, 6, 'Ghế 4DX'),
(2443, 'C8', 76, 6, 'Ghế 4DX'),
(2444, 'C9', 76, 6, 'Ghế 4DX'),
(2445, 'C10', 76, 6, 'Ghế 4DX'),
(2446, 'C11', 76, 6, 'Ghế 4DX'),
(2447, 'C12', 76, 6, 'Ghế 4DX'),
(2448, 'D1', 76, 6, 'Ghế 4DX'),
(2449, 'D2', 76, 6, 'Ghế 4DX'),
(2450, 'D3', 76, 6, 'Ghế 4DX'),
(2451, 'D4', 76, 6, 'Ghế 4DX'),
(2452, 'D5', 76, 6, 'Ghế 4DX'),
(2453, 'D6', 76, 6, 'Ghế 4DX'),
(2454, 'D7', 76, 6, 'Ghế 4DX'),
(2455, 'D8', 76, 6, 'Ghế 4DX'),
(2456, 'D9', 76, 6, 'Ghế 4DX'),
(2457, 'D10', 76, 6, 'Ghế 4DX'),
(2458, 'D11', 76, 6, 'Ghế 4DX'),
(2459, 'D12', 76, 6, 'Ghế 4DX'),
(2460, 'E1', 76, 6, 'Ghế 4DX'),
(2461, 'E2', 76, 6, 'Ghế 4DX'),
(2462, 'E3', 76, 6, 'Ghế 4DX'),
(2463, 'E4', 76, 6, 'Ghế 4DX'),
(2464, 'E5', 76, 6, 'Ghế 4DX'),
(2465, 'E6', 76, 6, 'Ghế 4DX'),
(2466, 'E7', 76, 6, 'Ghế 4DX'),
(2467, 'E8', 76, 6, 'Ghế 4DX'),
(2468, 'E9', 76, 6, 'Ghế 4DX'),
(2469, 'E10', 76, 6, 'Ghế 4DX'),
(2470, 'E11', 76, 6, 'Ghế 4DX'),
(2471, 'E12', 76, 6, 'Ghế 4DX'),
(2472, 'F1', 76, 6, 'Ghế 4DX'),
(2473, 'F2', 76, 6, 'Ghế 4DX'),
(2474, 'F3', 76, 6, 'Ghế 4DX'),
(2475, 'F4', 76, 6, 'Ghế 4DX'),
(2476, 'F5', 76, 6, 'Ghế 4DX'),
(2477, 'F6', 76, 6, 'Ghế 4DX'),
(2478, 'F7', 76, 6, 'Ghế 4DX'),
(2479, 'F8', 76, 6, 'Ghế 4DX'),
(2480, 'F9', 76, 6, 'Ghế 4DX'),
(2481, 'F10', 76, 6, 'Ghế 4DX'),
(2482, 'F11', 76, 6, 'Ghế 4DX'),
(2483, 'F12', 76, 6, 'Ghế 4DX'),
(2484, 'G1', 76, 6, 'Ghế 4DX'),
(2485, 'G2', 76, 6, 'Ghế 4DX'),
(2486, 'G3', 76, 6, 'Ghế 4DX'),
(2487, 'G4', 76, 6, 'Ghế 4DX'),
(2488, 'G5', 76, 6, 'Ghế 4DX'),
(2489, 'G6', 76, 6, 'Ghế 4DX'),
(2490, 'G7', 76, 6, 'Ghế 4DX'),
(2491, 'G8', 76, 6, 'Ghế 4DX'),
(2492, 'G9', 76, 6, 'Ghế 4DX'),
(2493, 'G10', 76, 6, 'Ghế 4DX'),
(2494, 'G11', 76, 6, 'Ghế 4DX'),
(2495, 'G12', 76, 6, 'Ghế 4DX'),
(2496, 'H1', 76, 6, 'Ghế 4DX'),
(2497, 'H2', 76, 6, 'Ghế 4DX'),
(2498, 'H3', 76, 6, 'Ghế 4DX'),
(2499, 'H4', 76, 6, 'Ghế 4DX'),
(2500, 'H5', 76, 6, 'Ghế 4DX'),
(2501, 'H6', 76, 6, 'Ghế 4DX'),
(2502, 'H7', 76, 6, 'Ghế 4DX'),
(2503, 'H8', 76, 6, 'Ghế 4DX'),
(2504, 'H9', 76, 6, 'Ghế 4DX'),
(2505, 'H10', 76, 6, 'Ghế 4DX'),
(2506, 'H11', 76, 6, 'Ghế 4DX'),
(2507, 'H12', 76, 6, 'Ghế 4DX'),
(2508, 'I1', 76, 6, 'Ghế 4DX'),
(2509, 'I2', 76, 6, 'Ghế 4DX'),
(2510, 'I3', 76, 6, 'Ghế 4DX'),
(2511, 'I4', 76, 6, 'Ghế 4DX'),
(2512, 'I5', 76, 6, 'Ghế 4DX'),
(2513, 'I6', 76, 6, 'Ghế 4DX'),
(2514, 'I7', 76, 6, 'Ghế 4DX'),
(2515, 'I8', 76, 6, 'Ghế 4DX'),
(2516, 'I9', 76, 6, 'Ghế 4DX'),
(2517, 'I10', 76, 6, 'Ghế 4DX'),
(2518, 'I11', 76, 6, 'Ghế 4DX'),
(2519, 'I12', 76, 6, 'Ghế 4DX'),
(2520, 'J1', 76, 6, 'Ghế 4DX'),
(2521, 'J2', 76, 6, 'Ghế 4DX'),
(2522, 'J3', 76, 6, 'Ghế 4DX'),
(2523, 'J4', 76, 6, 'Ghế 4DX'),
(2524, 'J5', 76, 6, 'Ghế 4DX'),
(2525, 'J6', 76, 6, 'Ghế 4DX'),
(2526, 'J7', 76, 6, 'Ghế 4DX'),
(2527, 'J8', 76, 6, 'Ghế 4DX'),
(2528, 'J9', 76, 6, 'Ghế 4DX'),
(2529, 'J10', 76, 6, 'Ghế 4DX'),
(2530, 'J11', 76, 6, 'Ghế 4DX'),
(2531, 'J12', 76, 6, 'Ghế 4DX');

--
-- Bẫy `ghe_ngoi`
--
DELIMITER $$
CREATE TRIGGER `kt_ghe` AFTER INSERT ON `ghe_ngoi` FOR EACH ROW BEGIN
	declare marap_gn, marap_pc int;   
    declare loaiphong, loaighe varchar(20);
	set marap_gn = new.marap;
	select pc.marap from phong_chieu as pc
		where pc.maphong = new.maphong into marap_pc;
	set loaighe = new.tenloai;
    select pc.tenloai from phong_chieu as pc
		where pc.maphong = new.maphong into loaiphong;
    IF marap_gn <> marap_pc THEN 
    	DELETE FROM ghe_ngoi where ghe_ngoi.maghe = new.maghe;
    ELSEIF ((loaiphong = '4DX' AND loaighe <> 'Ghế 4DX') OR (loaiphong <> '4DX' AND loaighe = 'Ghế 4DX')) THEN
    	DELETE FROM ghe_ngoi where ghe_ngoi.maghe = new.maghe;
    ELSEIF ((loaiphong = 'Gold Class' AND loaighe <> 'Gold Class') OR (loaiphong <> 'Gold Class' AND loaighe = 'Gold Class')) THEN
    	DELETE FROM ghe_ngoi where ghe_ngoi.maghe = new.maghe;
    ELSEIF ((loaiphong = 'Imax' AND loaighe <> 'Ghế Imax') OR (loaiphong <> 'Imax' AND loaighe = 'Ghế Imax')) THEN
    	DELETE FROM ghe_ngoi where ghe_ngoi.maghe = new.maghe;
    END IF;
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `mahoadon` int(11) NOT NULL,
  `tongtien` int(11) NOT NULL DEFAULT '0',
  `ngayxuat` date DEFAULT NULL,
  `idkh` int(11) DEFAULT NULL,
  `idnv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`mahoadon`, `tongtien`, `ngayxuat`, `idkh`, `idnv`) VALUES
(1, 126000, '2018-05-12', 1, 10),
(2, 180000, '2018-05-30', 1, 10),
(6, 0, '2018-05-19', 2, 10);

--
-- Bẫy `hoa_don`
--
DELIMITER $$
CREATE TRIGGER `kt_khuyen_mai` AFTER INSERT ON `hoa_don` FOR EACH ROW BEGIN
	DECLARE done, khmai INT DEFAULT 0;
	declare day1, day2 date;
	DECLARE money_cursor CURSOR FOR select km.makm, km.batdau, km.ketthuc from khuyen_mai as km;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	OPEN money_cursor;
	read_loop: LOOP
		FETCH money_cursor into khmai, day1, day2;
		IF done THEN
 		     LEAVE read_loop;
		END IF;
        IF ((new.ngayxuat >= day1) AND (new.ngayxuat <= day2)) THEN
        	insert INTO hoa_don_khuyen_mai values (new.mahoadon, khmai);
        END IF;
	END LOOP;
	CLOSE money_cursor;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don_khuyen_mai`
--

CREATE TABLE `hoa_don_khuyen_mai` (
  `mahoadon` int(11) NOT NULL,
  `makm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hoa_don_khuyen_mai`
--

INSERT INTO `hoa_don_khuyen_mai` (`mahoadon`, `makm`) VALUES
(6, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `idkh` int(11) NOT NULL,
  `capdo` varchar(10) DEFAULT NULL,
  `diemtichluy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`idkh`, `capdo`, `diemtichluy`) VALUES
(1, 'C', 297),
(2, 'D', 0),
(3, 'D', 0),
(4, 'D', 5),
(5, 'VIP', 110),
(6, 'A', 90),
(7, 'B', 70);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khung_gio`
--

CREATE TABLE `khung_gio` (
  `makhunggio` int(11) NOT NULL,
  `batdau` varchar(10) DEFAULT NULL,
  `ketthuc` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khung_gio`
--

INSERT INTO `khung_gio` (`makhunggio`, `batdau`, `ketthuc`) VALUES
(1, '09:30', '12:00'),
(2, '12:00', '14:30'),
(3, '14:30', '17:00'),
(4, '17:00', '19:30'),
(5, '19:30', '22:00'),
(6, '22:00', '00:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `makm` int(11) NOT NULL,
  `tenkm` varchar(50) DEFAULT NULL,
  `mota` varchar(200) DEFAULT NULL,
  `batdau` date DEFAULT NULL,
  `giamgia` float DEFAULT NULL,
  `ketthuc` date DEFAULT NULL,
  `hinhanh` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`makm`, `tenkm`, `mota`, `batdau`, `giamgia`, `ketthuc`, `hinhanh`) VALUES
(1, 'Giải phóng 30-4 & Quốc tế lao động 1-5', NULL, '2018-04-30', 0.1, '2018-05-01', 'http://www.vnnetsoft.com/wp-content/uploads/2016/04/km30415.jpg'),
(2, 'Mừng sinh nhật Bác 19-5', NULL, '2018-05-19', 0.05, '2018-05-19', 'http://www.phuong9govap.gov.vn/uploads/file//Ho%20Chi%20Minh/images1163920_19_5_02.jpg'),
(3, 'Ngày của mẹ', NULL, '2018-05-12', 0.1, '2018-05-12', 'https://vnn-imgs-f.vgcloud.vn/2018/05/03/15/ngay-cua-me-nam-2018-la-ngay-nao-1.jpg'),
(4, 'Khai trương rạp mới', 'Lễ khánh thành rạp BK Liberty Citypoint ở quận 1, cụm rạp thứ 6', '2018-05-25', 0.2, '2018-05-25', 'https://images.foody.vn/res/g3/27861/prof/s640x400/foody-mobile-galaxy-cinema-tp-hcm.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_ghe`
--

CREATE TABLE `loai_ghe` (
  `tenloai` varchar(10) NOT NULL,
  `gia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loai_ghe`
--

INSERT INTO `loai_ghe` (`tenloai`, `gia`) VALUES
('Ghế 4DX', 200000),
('Ghế Imax', 250000),
('Ghế Thường', 45000),
('Ghế đôi', 100000),
('Giường nằm', 400000),
('Gold Class', 300000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_phong`
--

CREATE TABLE `loai_phong` (
  `tenloai` varchar(10) NOT NULL,
  `gia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loai_phong`
--

INSERT INTO `loai_phong` (`tenloai`, `gia`) VALUES
('3D', 60000),
('4DX', 200000),
('Gold Class', 400000),
('Imax', 150000),
('Thường', 45000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `idnv` int(11) NOT NULL,
  `anhdaidien` varchar(500) DEFAULT NULL,
  `ngaybatdau` date DEFAULT NULL,
  `chucvu` varchar(50) DEFAULT NULL,
  `marap` int(11) NOT NULL,
  `idquanly` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhan_vien`
--

INSERT INTO `nhan_vien` (`idnv`, `anhdaidien`, `ngaybatdau`, `chucvu`, `marap`, `idquanly`) VALUES
(8, 'https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.0-9/27544899_2112039145692527_4574425775502617674_n.jpg?_nc_cat=0&_nc_eui2=AeEd9zJ18bK5ZRzXNmwGsn5ydrI_etyxbX7xoQt3qDteQSefybf4VruJsEYcW4QO3zg7uf1ymhpvZZ0jFZK0g2WmM7gAgKhki3igFC0BND-QcQ&oh=3bf94b3c9cc7f1a7bedab17bd13de718&oe=5B84AF8B', '2018-05-15', 'Bán vé', 3, 11),
(9, 'https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.0-9/32598574_1334443983323691_4755508246783983616_n.jpg?_nc_cat=0&_nc_eui2=AeFEteDv9BorLQDR-V2qIE6x3lNbvLUc7tchwaenq410X65-Ik1OpHwj6JpPfnX5-jVSrjKHjGsR0nO6kuS5ryizg52A8-aWRxQ0cf4yCEovbQ&oh=e68eda6f2a37d7a8deb102620111b0ce&oe=5B969C7E', '2015-09-15', 'Bán vé', 5, 11),
(10, 'https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.0-1/28661097_739455619587322_1604038202721761123_n.jpg?_nc_cat=0&_nc_eui2=AeFeIn58bfZiPcnG_goyUDyfuDYn8ndWJaK7mp1g4SJskQEyhWobNpv09g9BK2Kqfe0rgaIOtvwy5-hQvO2YcNYFc9_rHRPxUWP91fwXHU42Hw&oh=b033ce6fe5142670acb5dd07eb5a2df9&oe=5B783F35', '2017-09-15', 'Bán vé', 1, 11),
(11, 'https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.0-9/20664575_847255178773864_2973611719685943201_n.jpg?_nc_cat=0&_nc_eui2=AeFKAT3r-6xyO9HNIwItkjPhlgHbef5AvhgWNmmov-NVJNMdgwZdMdli6qXl5KCloNrlbiKHE4Hl8FTexrv1cH8W3gIe3p3esq4HdsH6vOlQ9w&oh=ad635f4c482d25ddcb939fc8374bdab1&oe=5B7DA261', '2016-08-15', 'Bán vé, quản lý', 6, NULL),
(12, 'https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.0-1/32294622_2020570854870618_8840139440836837376_n.jpg?_nc_cat=0&_nc_eui2=AeGlwbv4fJNGTq3TLeil9Mhm3YaPIuP2xai_A9iZlKk5gJpW0OsW9XhqOHVTucpJEpfu75zN28GYkMOnrWBkhZBa_jgpsYc1n6Ny-TizRv5B4A&oh=fede4855cc363ed8901d0e1b6847753d&oe=5B98AC51', '2018-05-15', 'Bán vé', 4, 11),
(13, 'https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.0-9/32511958_2070093176648254_1424641236198752256_n.jpg?_nc_cat=0&_nc_eui2=AeHdbD4zrIqTn9HfBLwhPRmouejTjrIkL-LKnPTzFSK6c0467Nbl5X_3BmBFF83Mi_MGijPcj2sJ6j7YF8vTv6ZsLNyPUAPN9FASBvqziEfNqg&oh=b4e8417280aa4f123412ec9a01570651&oe=5B95826F', '2016-08-15', 'Bán vé', 5, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phim`
--

CREATE TABLE `phim` (
  `maphim` int(11) NOT NULL,
  `tenphim` varchar(50) DEFAULT NULL,
  `daodien` varchar(100) DEFAULT NULL,
  `doituong` varchar(10) DEFAULT NULL,
  `ngonngu` varchar(100) DEFAULT NULL,
  `batdau` date DEFAULT NULL,
  `ketthuc` date DEFAULT NULL,
  `mota` varchar(1000) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `thoiluong` varchar(20) DEFAULT NULL,
  `hinhanh` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phim`
--

INSERT INTO `phim` (`maphim`, `tenphim`, `daodien`, `doituong`, `ngonngu`, `batdau`, `ketthuc`, `mota`, `trailer`, `thoiluong`, `hinhanh`) VALUES
(1, 'Deadpool 2', 'David Leitch', 'C18', 'Tiếng Anh với phụ đề tiếng Việt', '2018-05-18', '2018-06-01', 'Đoạn trailer mở đầu bằng hình ảnh thế giới tương lai khá u ám và tăm tối của. Theo đó, anh chàng được sinh ra và lớn lên trong chiến tranh cũng như trải qua rất nhiều nỗi đau. Cable cũng hé lộ rằng vì cuộc chiến này mà cơ thể anh đã biến dạng thành nửa người nửa máy. Theo nguyên tác, dị nhân này là con trai của Cyclops và bản sao của Jean Grey. Anh được cha gửi tới tương lai từ khi lọt lòng để chữa khỏi căn bệnh lạ. Sau này, Cable trở về hiện tại và lập ra nhóm X-Force cùng với Deadpool, Domino,... Liệu các nhà làm phim 20th Century Fox có giữ nguyên nguồn gốc của anh khi bước lên màn ảnh rộng? Liệu thế giới điêu tàn mà Cable sinh sống là của X-Men: Days of Future Past hay Logan? Liệu việc du hành thời gian có giải thích được sự rối loạn dòng thời gian của vũ trụ X-Men? Tất cả sẽ được giải đáp khi phim chính thức tấn công màn ảnh rộng.', 'https://www.youtube.com/watch?v=D86RtevtfrA', '119 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/d/p/dp240x355.png'),
(2, 'Avengers: Cuộc Chiến Vô Cực', 'Anthony Russo, Joe Russo', 'C16', 'Tiếng Anh với phụ đề tiếng Việt', '2018-04-25', '2018-05-09', 'Sau chuyến hành trình độc nhất vô nhị không ngừng mở rộng và phát triển vụ trũ điện ảnh Marvel, bộ phim Avengers: Cuộc Chiến Vô Cực sẽ mang đến màn ảnh trận chiến cuối cùng khốc liệt nhất mọi thời đại. Biệt đội Avengers và các đồng minh siêu anh hùng của họ phải chấp nhận hy sinh tất cả để có thể chống lại kẻ thù hùng mạnh Thanos trước tham vọng hủy diệt toàn bộ vũ trụ của hắn.', 'https://www.youtube.com/watch?v=6ZfuNTqbHE8', '150 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/f/n/fnposter-240x355.jpg'),
(3, 'Jurassic World: Thế Giới Khủng Long (2015)', 'Chris Pratt, Bryce Dallas Howard, Vincent D\'Onofrio, Judy Greer,...', 'P', 'Tiếng Anh với phụ đề tiếng Việt', '2018-05-11', '2018-05-25', 'Bối cảnh của Jurassic World là hơn 20 năm sau kể từ sự kiện công viên kỷ Jura (1993). Isla Nublar - một hòn đảo ngoài khơi Thái Bình Dương thuộc khu vực Trung Mỹ - hiện là thế giới khủng long thật sự. Các nhà di truyền học tại đây vừa tạo ra loài khủng long lai mang tên Indominus Rex, nhằm thu hút khách du lịch hơn. Nhưng chính việc làm đó biến con người có nguy cơ thành món mồi cho quái thú.', 'https://www.youtube.com/watch?v=zR6kV-s2Qn0', '125 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/2/4/240x355_jurassic_world.jpg'),
(4, 'Lật Mặt: 3 Chàng Khuyết', 'Lý Hải', 'C13', 'Tiếng Việt với phụ đề Tiếng Anh', '2018-04-20', '2018-05-05', 'Lật Mặt: Ba Chàng Khuyết là hành trình tìm lại người thân của ba người bạn Tâm - Đức - Lộc tuy kém may mắn phải chịu khuyết tật trên cơ thể và bị cha mẹ bỏ rơi từ nhỏ nhưng luôn lạc quan với cuộc đời. Phim là phần tiếp theo của Series hành động hài - hành động Lật Mặt, do Kiều Minh Tuấn, Huy Khánh, Song Luân và hot girl Thái Lan Nene đóng chính.', 'https://www.youtube.com/watch?v=JcKMQQLycpQ', '103 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/l/a/latmat240x355.jpg'),
(5, '100 Ngày Bên Em', 'Vũ Ngọc Phượng', 'C13', 'Tiếng Việt với phụ đề Tiếng Anh', '2018-04-25', '2018-05-10', 'Ngày Bên Em là câu chuyện về hai con người tưởng chừng như ở hai thế giới khác nhau nhưng nhờ một “biến cố” mà đã tìm thấy tình yêu của đời mình. Họ đến bên nhau, cháy hết mình cho tuổi trẻ, cho tình yêu. Để rồi, nếu chẳng may có buông tay nhau ra, cả hai không phải hối tiếc điều gì.', 'https://www.youtube.com/watch?v=e6ieOmZlizM', '99 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/1/0/100ngay240x355.jpg'),
(6, '\"Lăn\" Đến Bên Em', 'Franck Dubosc', 'C16', 'Tiếng Pháp với phụ đề Anh/Việt', '2018-05-11', '2018-05-26', 'Jocelyn là một doanh nhân thành đạt, một người đàn ông đào hoa và cũng là một kẻ hay nói dối. Trở nên buồn chán, anh ta giả làm một người tàn tật để quyến rũ cô hàng xóm bốc lửa. Cho đến một ngày cô ấy giới thiệu anh ta với chị gái mình, người thực sự bị tàn tật…', 'https://www.youtube.com/watch?v=t3AyFd9HuyE', '108 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/r/o/rolling240x355.jpg'),
(7, 'Ngỗng Vịt Phiêu Lưu Ký', 'Christopher Jenkins', 'P', 'Tiếng Anh với phụ đề tiếng Việt và lồng tiếng Việt', '2018-04-25', '2018-05-10', 'Bộ phim xoay quanh câu chuyện về Peng, một chú ngỗng độc thân tự do thích làm người hùng hơn là luyện tập cho chuyến di cư sắp tới. Ngỗng Peng cho rằng mình giỏi hơn những người khác và dành hầu hết thời gian cho những pha nhào lộn phô trương. Trong một màn nhào lộn điên cuồng, Peng bay quá sát mặt đất, va trúng một bầy vịt con, chia cắt Chao và Chi với bầy đàn của chúng. Sau pha chấn thương và tiếp đất này, chàng ngỗng độc thân thích bay cao – Peng buộc phải chăm sóc hai chú vịt con, cùng chúng bước vào cuộc hành trình thưởng lãm vẻ đẹp của thế giới bên ngoài nhưng cũng phải đối mặt với những hiểm nguy lúc nào cũng rình rập.', 'https://www.youtube.com/watch?v=wDv1iMJSmh4', '91 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/d/u/duck_duck_goose_-_240x355_1.jpg'),
(8, 'Thần Chết', 'Eli Roth', 'C18', 'Tiếng Anh với phụ đề tiếng Việt', '2018-05-04', '2018-05-19', 'Được MGM làm lại dựa trên bộ phim gốc cùng tên năm 1974, nội dung phim tập trung vào Paul Kersey (Bruce Willis vào vai), một bác sĩ phẫu thuật sống tại Chicago, người đã nhận thấy thành phố nơi ông đang sinh sống luôn bị bao trùm bởi những hành động bạo lực và phi nhân tính mà trong đó vợ và cô con gái của Paul cũng là nạn nhân. Lực lượng cảnh sát không thể khống chế được hết những tên tội phạm trong thành phố, vậy nên đây chính là lúc Paul trả thù và làm người hùng.', 'https://www.youtube.com/watch?v=03cYuMmHZMU', '108 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/d/e/death_wish_240x355.jpg'),
(9, 'Yêu Nữ Siêu Quậy', 'Nguyễn Ngọc Hùng', 'C13', 'Tiếng Việt', '2018-05-11', '2018-05-26', 'Câu chuyện cảm động về tình yêu khi người em (Ngân) yêu thầm người anh nuôi (Khanh). Trong khi đó, Khanh chỉ xem Ngân như là người thân duy nhất, người em nũng nịu của mình mà thôi. Và tình yêu, Khanh chỉ dành duy nhất cho Lê Trinh.', 'https://www.youtube.com/watch?v=EkIUk_J1Cjs', '90 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/f/i/final_poster_yeunu2018_240.jpg'),
(10, 'Siêu Thú Cuồng Nộ', 'Brad Peyton', 'C16', 'Tiếng Anh với phụ đề tiếng Việt và tiếng Hàn', '2018-04-13', '2018-04-28', 'Bộ phim kể về nhà sinh vật học Davis Okoye có mối liên kết khăng khít với George - một chú gorilla lưng bạc được anh chăm sóc từ nhỏ. Một thí nghiệm đột biến ngoài ý muốn đã làm biến đổi gorilla thành quái vật khổng lồ hung hăng. Gorilla cùng những sinh vật bị biến đổi khác đã tấn công con người và đẩy nhân loại đứng trước hiểm họa diệt vong. Liệu Davis Okoye sẽ làm gì để giành chiến thắng, không chỉ để ngăn chặn một thảm họa toàn cầu, mà còn để cứu gorilla đã từng là bạn tốt của mình?', 'https://www.youtube.com/watch?v=RDAZZh22qzI', '107 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/r/a/rampage240x355_1.jpg'),
(11, 'Kikoriki Du Hành Vượt Thời Gian', 'Denis Chernov', 'P', 'Tiếng Anh với phụ đề và lồng tiếng Việt', '2018-05-18', '2018-06-02', 'Chú thỏ Kikoriki muốn tặng món quà bất ngờ trong ngày sinh nhật của người bạn thân Barry bằng việc liên hệ với Déjà vu – một công ty du lịch xuyên thời gian để đặt một chuyến du lịch thám hiểm. Kém may mắn thay, cả phi hành đoàn trong chuyến đi đều bị thất lạc và rơi vào những khoảng không thời gian khác nhau. KIKORIKI phải làm gì để trở về thời gian hiện tại và cứu lấy Barry và những người bạn?', '', '85 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/k/i/kikoriki-flyer-front_240.jpg'),
(12, 'Solo: Star Wars Ngoại Truyện', 'Ron Howard', 'P', 'Tiếng Anh với phụ đề tiếng Việt', '2018-05-25', '2018-06-10', 'Bộ phim Solo: Star Wars Ngoại truyện của Lucasfilm sẽ dẫn dắt người xem đến với chuyến phiêu lưu của Han Solo, thanh niên lông bông được yêu mến nhất trong lịch sử điện ảnh. Qua những phi vụ liều lĩnh, anh gặp được đồng bọn chí cốt Chewbacca và đụng độ tay cờ bạc khét tiếng Lando Calrissian. Làm thế nào từ gã trai kiêu ngạo, Han Solo trở thành người anh hùng của loạt phim Star Wars?', 'https://www.youtube.com/watch?v=eLq53DPwjP4', '108 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/s/o/solo-payoff_poster_240.png'),
(13, 'Phim Doraemon: Nobita Và Đảo Giấu Vàng', 'Imai Kazuaki', 'P', 'Tiếng Nhật với phụ đề tiếng Việt, tiếng Anh', '2018-05-25', '2018-06-10', '“Tớ sẽ tìm ra hòn đảo kho báu!”… Quyết tâm thực hiện bằng được kế hoạch sau khi hùng hồn tuyên bố với nhóm bạn Jaian, Suneo và Shizuka, nhờ bảo bối “Bản đồ truy tìm kho báu” của Doraemon, Nobita đã tìm thấy một hòn đảo mới đột nhiên xuất hiện giữa Thái Bình Dương…Nobita cùng các bạn bắt đầu chuyến phiêu lưu hướng tới đảo kho báu trên con tàu mang tên “Vầng hào quang Nobita”. Thế nhưng, chưa kịp cập bến, cả nhóm đã bị hải tặc tấn công! Trong lúc chống trả lại kẻ địch, Shizuka đã bị hải tặc bắt cóc lên tàu của chúng! Sau khi chạy thoát khỏi đám hải tặc, nhóm bạn Nobita tình cờ gặp cậu bé Flock trôi dạt trên biển cùng con vẹt robot tên Quiz. Flock vốn là một thợ cơ khí vừa trốn thoát khỏi tàu của lũ hải tặc, cậu biết được bí mật quan trọng của hòn đảo kho báu! Liệu Nobita cùng những người bạn có thể giải cứu Shizuka khỏi tay bè lũ hải tặc xấu xa và khám phá ra bí mật ẩn giấu trên hòn đảo kho báu đang ngủ yên hay không!?', 'https://www.youtube.com/watch?v=5o9nCd67o6U', '117 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/d/o/doraemon240x355_2.jpg'),
(14, 'Giải Cứu Tí Nị', 'Shen Yu & Wang Yan', 'P', 'Lồng tiếng Việt với phụ đề tiếng Anh', '2018-05-28', '2018-06-13', 'Bé con nào cũng đều có một người bạn thú nhồi bông đáng yêu và thân thiết bên cạnh bảo vệ, chúng được xem là những “Hộ Vệ Tuổi Thơ” của bọn trẻ. Cho đến khi… các loại trò chơi công nghệ xuất hiện, chúng “hút” dần các “Năng Lượng Tuổi Thơ” của các bé. “GIẢI CỨU TÍ NỊ” chính là hành trình mạo hiểm của bạn thú bông dũng cảm Hổ Con, đồng hành cùng thú bông hàng xóm Răng Sún, anh Rô-bô và bạn Nấm Nhí; cùng nhau giành lại “Năng Lượng Tuổi Thơ” cho cô chủ nhỏ Tí Nị.', 'https://www.youtube.com/watch?v=FzegFPjVinE', '108 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/p/o/poster_chinh_thuc_240.jpg'),
(15, 'Skyscraper', 'Rawson Marshall Thurber', 'C16', 'Tiếng Anh với phụ đề tiếng Việt', '2018-07-13', NULL, 'Dwayne Johnson (The Rock) sẽ vào vai cựu quân nhân và cựu trưởng nhóm đặc nhiệm giải cứu của FBI Will Ford đầy dũng cảm. Không may trong một nhiệm vụ nguy hiểm, tai nạn khủng khiếp xảy đến với Will làm anh mất đi chân trái của mình. Kể từ đó, Will Ford từ bỏ công việc tại FBI và trở thành chuyên gia đánh giá an ninh cho các tòa nhà. Trong một lần làm việc, Tòa nhà cao 240 tầng với hệ thống an ninh tối tân đột nhiên bị cháy lớn ở tầng 96. Những con người, cạm bẫy và thế lực nào đứng sau thảm họa này chắc chắn đang nhắm vào cựu quân nhân và lấy gia đình anh ra làm con tin. Với kinh nghiệm, sự gan dạ của một người lính cùng tình yêu gia đình mãnh liệt, liệu Will Ford có tìm ra được kẻ chủ mưu và cứu lấy gia đình của anh?', 'https://www.youtube.com/watch?v=t9QePUT-Yt8', '118 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/s/k/sky240x355.jpg'),
(16, 'Cá Mập Siêu Bạo Chúa', 'Jon Turteltaub', NULL, 'Tiếng Anh với phụ đề tiếng Việt', '2018-08-10', NULL, 'Dự kiến khởi chiếu ngày 10.8.2018', 'https://www.youtube.com/watch?v=dfNqTShwypw', NULL, 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/m/e/meg240x355.jpg'),
(17, 'Người Kiến Và Chiến Binh Ong', 'Peyton Reed', NULL, 'Tiếng Anh với phụ đề tiếng Việt', '2018-07-06', NULL, 'Sau trận nội chiến khốc liệt, Scott Lang – anh hùng Người Kiến với khả năng phóng to, thu nhỏ lại phải đối mặt với sự lựa chọn khó khăn trong cuộc sống đời thường: làm siêu anh hùng gánh vác những trách nhiệm nặng nề của thế giới hay làm một người cha có trách nhiệm. Trong lúc ấy, Scott được tiến sĩ Hank Pym và Hope Van Dyne – Chiến Binh Ong triệu tập để thực hiện một nhiệm vụ cấp bách mới. Scott sẽ phải mặc vào bộ áo Người Kiến một lần nữa và chiến đấu bên cạnh chiến binh ong để lật mở những bí ẩn trong quá khứ.', 'https://www.youtube.com/watch?v=BnAj5BRbw4g', NULL, 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/p/o/poster_5_240.jpg'),
(18, 'Dr.Seuss’ How The Grinch Stole Christma', 'Yarrow Cheney, Scott Mosier', NULL, 'Tiếng Anh với phụ đề tiếng Việt', '2018-11-16', NULL, 'Khởi chiếu ngày 16.11.2018.', NULL, NULL, 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/g/r/grinch240x355_1.jpg'),
(19, 'Incredibles 2', 'Brad Bird', NULL, 'Tiếng Anh với phụ đề tiếng Việt', '2018-06-15', NULL, 'Dự kiến khởi chiếu 15.06.2018', 'https://www.youtube.com/watch?v=6cLn1-OE2dI', NULL, 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/i/n/incre240x355.jpg'),
(20, 'Vùng Đất Câm Lặng', 'John Krasinski', 'C16', 'Tiếng Anh với phụ đề tiếng Việt', '2018-04-20', '2018-05-05', 'Một thế lực siêu nhiên đang đe dọa mạng sống của gia đình 4 người, nếu họ phát ra tiếng động.', 'https://www.youtube.com/watch?v=0hLoZ20qTM8', '91 phút', 'https://www.cgv.vn/media/catalog/product/cache/1/small_image/190x260/052b7e4a4f6d2886829431e534ef7a43/a/q/aquietplace240x355.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong_chieu`
--

CREATE TABLE `phong_chieu` (
  `maphong` int(11) NOT NULL,
  `marap` int(11) NOT NULL,
  `soghe` int(11) DEFAULT NULL,
  `tenloai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phong_chieu`
--

INSERT INTO `phong_chieu` (`maphong`, `marap`, `soghe`, `tenloai`) VALUES
(57, 1, 30, '3D'),
(58, 1, 50, 'Thường'),
(59, 1, 40, 'Imax'),
(60, 2, 50, 'Thường'),
(61, 2, 40, 'Imax'),
(62, 2, 30, '3D'),
(63, 2, 30, '4DX'),
(64, 3, 40, '3D'),
(65, 3, 30, 'Gold Class'),
(66, 3, 50, '4DX'),
(67, 4, 40, 'Thường'),
(68, 4, 50, 'Imax'),
(69, 4, 30, '3D'),
(70, 5, 40, 'Thường'),
(71, 5, 50, 'Gold Class'),
(72, 5, 30, '4DX'),
(73, 5, 30, 'Imax'),
(74, 6, 50, '3D'),
(75, 6, 30, 'Thường'),
(76, 6, 40, '4DX');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rap_chieu`
--

CREATE TABLE `rap_chieu` (
  `marap` int(11) NOT NULL,
  `maqh` int(11) NOT NULL,
  `tenrap` varchar(50) DEFAULT NULL,
  `daichi` varchar(100) DEFAULT NULL,
  `sodt` varchar(20) DEFAULT NULL,
  `soluongphong` int(11) DEFAULT NULL,
  `giomo` time DEFAULT NULL,
  `giodong` time DEFAULT NULL,
  `mota` varchar(200) DEFAULT NULL,
  `hinh_anh` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `rap_chieu`
--

INSERT INTO `rap_chieu` (`marap`, `maqh`, `tenrap`, `daichi`, `sodt`, `soluongphong`, `giomo`, `giodong`, `mota`, `hinh_anh`) VALUES
(1, 3, 'BK Golden Plaza', 'Lầu 4, Trung tâm thương mại Golden Plaza, 465 Hồng Bàng, Phường 14, Quận 5, Hồ Chí Minh', '1900 6017', 9, NULL, NULL, NULL, 'http://cdn01.diadiemanuong.com/ddau/640x/gioi-tre-do-xo-xem-phim-mien-phi-tai-cgv-golden-plaza-vua-moi-khai-truong-2d4d58c5636263113300801696.jpg'),
(2, 5, 'BK Vincom Thủ Đức', 'Tầng 5, TTTM Vincom Thủ Đức, 216 Võ Văn Ngân, Phường Bình Thọ, Quận Thủ Đức', '1900 6017', 7, NULL, NULL, NULL, 'https://rapchieuphim.com/photos/2/cgv/cgv-vincom-thu-duc-2.png'),
(3, 4, 'BK Hoàng Văn Thụ', 'Tầng 1 và 2, Gala Center, số 415, Hoàng Văn Thụ, Phường 2, Quận Tân Bình, TPHCM', '1900 6017', 8, NULL, NULL, NULL, 'https://khenphim.com/wp-content/uploads/2016/07/CGV-Hoang-Van-Thu2.jpg'),
(4, 2, 'BK Sư Vạn Hạnh', 'Tầng 6, Vạn Hạnh Mall, 11 Sư Vạn Hạnh, Phường 12, Quận 10', '1900 6017', 9, NULL, NULL, NULL, 'http://photo.thantuong.tv/articles/fullsize/article24683/cgv-su-van-hanh-cum-rap-chieu-1516901640-TZzqb4.jpg'),
(5, 1, 'BK Vincom Đồng Khởi', 'Tầng 3, TTTM Vincom Center Đồng Khởi, 72 Lê Thánh Tôn & 45A Lý Tự Trọng, Quận 1, TP.HCM', '1900 6017', 10, NULL, NULL, NULL, 'https://s3img.vcdn.vn/123phim/2017/10/cgv-vincom-dong-khoi-15077821398909.jpg'),
(6, 1, 'BK Liberty Citypoint', 'Tầng M - 1, khách sạn Liberty Center Saigon Citypoint, 59 - 61 Pasteur, Quận 1', '1900 6017', 10, NULL, NULL, NULL, 'https://images.foody.vn/res/g12/115871/s800/foody-cgv-cinemas-liberty-central-saigon-city-point-876-636199379781404202.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rap_khuyen_mai`
--

CREATE TABLE `rap_khuyen_mai` (
  `marap` int(11) NOT NULL,
  `makm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `rap_khuyen_mai`
--

INSERT INTO `rap_khuyen_mai` (`marap`, `makm`) VALUES
(1, 2),
(5, 1),
(6, 3),
(6, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suat_chieu`
--

CREATE TABLE `suat_chieu` (
  `masuatchieu` int(11) NOT NULL,
  `ngaychieu` date DEFAULT NULL,
  `makhunggio` int(11) NOT NULL,
  `maphim` int(11) NOT NULL,
  `marap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `suat_chieu`
--

INSERT INTO `suat_chieu` (`masuatchieu`, `ngaychieu`, `makhunggio`, `maphim`, `marap`) VALUES
(1, '2018-05-12', 1, 4, 3),
(2, '2018-05-19', 5, 1, 5),
(4, '2018-05-21', 1, 5, 3),
(5, '2018-05-21', 2, 2, 6),
(6, '2018-05-23', 3, 16, 4),
(7, '2018-05-24', 5, 18, 2),
(8, '2018-05-25', 5, 14, 5),
(9, '2018-05-26', 1, 19, 1),
(10, '2018-05-27', 2, 3, 3),
(11, '2018-05-28', 5, 7, 3);

--
-- Bẫy `suat_chieu`
--
DELIMITER $$
CREATE TRIGGER `kt_suat_chieu` AFTER INSERT ON `suat_chieu` FOR EACH ROW BEGIN
	DECLARE khoi_chieu DATE;
    SET khoi_chieu = (select p.batdau from phim as p 
    	where p.maphim = new.maphim                
    );
    IF new.ngaychieu < khoi_chieu THEN
    	delete from suat_chieu where suat_chieu.masuatchieu = new.masuatchieu;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `su_dung_dich_vu`
--

CREATE TABLE `su_dung_dich_vu` (
  `mahoadon` int(11) NOT NULL,
  `madv` int(11) NOT NULL,
  `soluong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `su_dung_dich_vu`
--

INSERT INTO `su_dung_dich_vu` (`mahoadon`, `madv`, `soluong`) VALUES
(1, 2, 1),
(1, 3, 2),
(2, 4, 2),
(2, 5, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `the_loai`
--

CREATE TABLE `the_loai` (
  `maphim` int(11) NOT NULL,
  `theloai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `the_loai`
--

INSERT INTO `the_loai` (`maphim`, `theloai`) VALUES
(1, 'Hành động'),
(2, 'Hành động'),
(2, 'Phiêu lưu'),
(3, 'Hành động'),
(3, 'Phiêu lưu'),
(4, 'Hài'),
(5, 'Tình cảm'),
(6, 'Hài'),
(6, 'Tình cảm'),
(7, 'Gia đình'),
(7, 'Hoạt hình'),
(8, 'Hành động'),
(8, 'Tội phạm'),
(9, 'Hài'),
(9, 'Tâm lý'),
(10, 'Hành động'),
(10, 'Phiêu lưu'),
(11, 'Hoạt hình'),
(11, 'Phiêu lưu'),
(12, 'Hành Động'),
(12, 'Phiêu lưu'),
(13, 'Hoạt hình'),
(14, 'Hoạt hình'),
(14, 'Phiêu lưu'),
(15, 'Hành động'),
(15, 'Tội phạm'),
(16, 'Hành động'),
(16, 'Kinh dị'),
(17, 'Hành động'),
(17, 'Phiêu lưu'),
(18, 'Hoạt hình'),
(19, 'Hành động'),
(19, 'Hoạt hình'),
(20, 'Kinh dị'),
(20, 'Tâm lý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(400) NOT NULL,
  `ngaysinh` date DEFAULT NULL,
  `gioitinh` tinyint(1) DEFAULT NULL,
  `sodt` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cmnd` varchar(10) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `ngaysinh`, `gioitinh`, `sodt`, `name`, `cmnd`, `updated_at`, `created_at`, `remember_token`) VALUES
(1, 'nhuttan@gmail.com', 'nhuttan', '1998-03-08', 1, '0168425933', 'Trần Nhựt Tân', '321456987', NULL, NULL, NULL),
(2, 'tiencuong@gmail.com', 'tiencuong', '1997-09-12', 1, '0125866977', 'Văn Tiến Cường', '312569874', NULL, NULL, NULL),
(3, 'nhuy@gmail.com', 'nhuy', '1995-08-15', 0, '0147569823', 'Nguyễn Thị Như Ý', '326587419', NULL, NULL, NULL),
(4, 'ducmanh@gmail.com', 'ducmanh', '1995-11-12', 1, '0169852365', 'Lê Đức Mạnh', '312478555', NULL, NULL, NULL),
(5, 'thaiminh@gmail.com', 'thaiminh', '1990-06-01', 0, '0125866347', 'Trương Thị Thái Minh', '325144696', NULL, NULL, NULL),
(6, 'thuyhang@gmail.com', 'thuyhang', '1999-04-30', 0, '0153698742', 'Lê Thúy Hằng', '312546985', NULL, NULL, NULL),
(7, 'tuankiet@gmail.com', 'tuankiet', '1998-04-30', 1, '0121355655', 'Lương Tuấn Kiệt', '312564888', NULL, NULL, NULL),
(8, 'nguyenbinh@gmail.com', 'nguyenbinh', '1998-01-20', 1, '01678424666', 'Cao Nguyên Bình', '312346384', NULL, NULL, NULL),
(9, 'quocanh@gmail.com', 'quocanh', '1996-02-29', 1, '01218003162', 'Nguyễn Quốc Anh', '31256841', NULL, NULL, NULL),
(10, 'hoangnguyen@gmail.com', 'hoangnguyen', '1995-03-08', 0, '0902303802', 'Thái Hoàng Nguyên', '32569147', NULL, NULL, NULL),
(11, 'bangbang@gmail.com', 'bangbang', '1995-03-08', 0, '0902303802', 'Phạm Băng Băng', '32569147', NULL, NULL, NULL),
(12, 'xuanhuy@gmail.com', 'xuanhuy', '1998-11-20', 1, '0167425983', 'Nguyễn Xuân Huy', '312459876', NULL, NULL, NULL),
(13, 'thanhduy@gmail.com', 'thanhduy', '1998-12-01', 1, '0121369875', 'Nguyễn Thàn Duy', '325698741', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ve`
--

CREATE TABLE `ve` (
  `mave` int(11) NOT NULL,
  `masuatchieu` int(11) NOT NULL,
  `maghe` int(11) NOT NULL,
  `mahoadon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ve`
--

INSERT INTO `ve` (`mave`, `masuatchieu`, `maghe`, `mahoadon`) VALUES
(16, 1, 1050, 1),
(20, 2, 1700, 2);

--
-- Bẫy `ve`
--
DELIMITER $$
CREATE TRIGGER `kt_nhatquan_rapchieu` AFTER INSERT ON `ve` FOR EACH ROW BEGIN
	declare marap_ve, marap_sc int;
	set marap_ve = (select gn.marap from ghe_ngoi as gn
    	where gn.maghe = new.maghe             
    );
	select sc.marap from suat_chieu as sc
		where sc.masuatchieu = new.masuatchieu into marap_sc;
	IF marap_ve <> marap_sc 
    THEN 
    	DELETE FROM ve where ve.mave = new.mave;
    END IF;
END
$$
DELIMITER ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dia_ban`
--
ALTER TABLE `dia_ban`
  ADD PRIMARY KEY (`maqh`);

--
-- Chỉ mục cho bảng `dich_vu`
--
ALTER TABLE `dich_vu`
  ADD PRIMARY KEY (`madv`);

--
-- Chỉ mục cho bảng `dien_vien`
--
ALTER TABLE `dien_vien`
  ADD PRIMARY KEY (`maphim`,`dienvien`);

--
-- Chỉ mục cho bảng `ghe_ngoi`
--
ALTER TABLE `ghe_ngoi`
  ADD PRIMARY KEY (`maghe`),
  ADD KEY `tenloai` (`tenloai`),
  ADD KEY `maphong` (`maphong`),
  ADD KEY `marap` (`marap`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`mahoadon`),
  ADD KEY `matk_kh` (`idkh`),
  ADD KEY `matk_nv` (`idnv`);

--
-- Chỉ mục cho bảng `hoa_don_khuyen_mai`
--
ALTER TABLE `hoa_don_khuyen_mai`
  ADD PRIMARY KEY (`mahoadon`),
  ADD KEY `makm` (`makm`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`idkh`);

--
-- Chỉ mục cho bảng `khung_gio`
--
ALTER TABLE `khung_gio`
  ADD PRIMARY KEY (`makhunggio`);

--
-- Chỉ mục cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`makm`);

--
-- Chỉ mục cho bảng `loai_ghe`
--
ALTER TABLE `loai_ghe`
  ADD PRIMARY KEY (`tenloai`);

--
-- Chỉ mục cho bảng `loai_phong`
--
ALTER TABLE `loai_phong`
  ADD PRIMARY KEY (`tenloai`);

--
-- Chỉ mục cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`idnv`),
  ADD KEY `matk_quanly` (`idquanly`),
  ADD KEY `marap` (`marap`);

--
-- Chỉ mục cho bảng `phim`
--
ALTER TABLE `phim`
  ADD PRIMARY KEY (`maphim`);

--
-- Chỉ mục cho bảng `phong_chieu`
--
ALTER TABLE `phong_chieu`
  ADD PRIMARY KEY (`maphong`,`marap`),
  ADD KEY `tenloaiphong` (`tenloai`),
  ADD KEY `marap` (`marap`);

--
-- Chỉ mục cho bảng `rap_chieu`
--
ALTER TABLE `rap_chieu`
  ADD PRIMARY KEY (`marap`),
  ADD KEY `maqh` (`maqh`);

--
-- Chỉ mục cho bảng `rap_khuyen_mai`
--
ALTER TABLE `rap_khuyen_mai`
  ADD PRIMARY KEY (`marap`,`makm`),
  ADD KEY `makm` (`makm`);

--
-- Chỉ mục cho bảng `suat_chieu`
--
ALTER TABLE `suat_chieu`
  ADD PRIMARY KEY (`masuatchieu`),
  ADD KEY `makhunggio` (`makhunggio`),
  ADD KEY `maphim` (`maphim`),
  ADD KEY `marap` (`marap`);

--
-- Chỉ mục cho bảng `su_dung_dich_vu`
--
ALTER TABLE `su_dung_dich_vu`
  ADD PRIMARY KEY (`mahoadon`,`madv`),
  ADD KEY `su_dung_dich_vu_ibfk_1` (`madv`);

--
-- Chỉ mục cho bảng `the_loai`
--
ALTER TABLE `the_loai`
  ADD PRIMARY KEY (`maphim`,`theloai`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ve`
--
ALTER TABLE `ve`
  ADD PRIMARY KEY (`mave`),
  ADD KEY `masuatchieu` (`masuatchieu`),
  ADD KEY `maghe` (`maghe`),
  ADD KEY `mahoadon` (`mahoadon`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dia_ban`
--
ALTER TABLE `dia_ban`
  MODIFY `maqh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `dich_vu`
--
ALTER TABLE `dich_vu`
  MODIFY `madv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `ghe_ngoi`
--
ALTER TABLE `ghe_ngoi`
  MODIFY `maghe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2532;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `mahoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `khung_gio`
--
ALTER TABLE `khung_gio`
  MODIFY `makhunggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  MODIFY `makm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `phim`
--
ALTER TABLE `phim`
  MODIFY `maphim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `phong_chieu`
--
ALTER TABLE `phong_chieu`
  MODIFY `maphong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `rap_chieu`
--
ALTER TABLE `rap_chieu`
  MODIFY `marap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `suat_chieu`
--
ALTER TABLE `suat_chieu`
  MODIFY `masuatchieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `ve`
--
ALTER TABLE `ve`
  MODIFY `mave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dien_vien`
--
ALTER TABLE `dien_vien`
  ADD CONSTRAINT `dien_vien_ibfk_1` FOREIGN KEY (`maphim`) REFERENCES `phim` (`maphim`);

--
-- Các ràng buộc cho bảng `ghe_ngoi`
--
ALTER TABLE `ghe_ngoi`
  ADD CONSTRAINT `ghe_ngoi_ibfk_1` FOREIGN KEY (`maphong`) REFERENCES `phong_chieu` (`maphong`),
  ADD CONSTRAINT `ghe_ngoi_ibfk_2` FOREIGN KEY (`marap`) REFERENCES `phong_chieu` (`marap`),
  ADD CONSTRAINT `ghe_ngoi_ibfk_3` FOREIGN KEY (`tenloai`) REFERENCES `loai_ghe` (`tenloai`);

--
-- Các ràng buộc cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `hoa_don_ibfk_2` FOREIGN KEY (`idnv`) REFERENCES `nhan_vien` (`idnv`) ON DELETE SET NULL,
  ADD CONSTRAINT `hoa_don_ibfk_3` FOREIGN KEY (`idkh`) REFERENCES `khach_hang` (`idkh`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `hoa_don_khuyen_mai`
--
ALTER TABLE `hoa_don_khuyen_mai`
  ADD CONSTRAINT `hoa_don_khuyen_mai_ibfk_1` FOREIGN KEY (`makm`) REFERENCES `khuyen_mai` (`makm`),
  ADD CONSTRAINT `hoa_don_khuyen_mai_ibfk_2` FOREIGN KEY (`mahoadon`) REFERENCES `hoa_don` (`mahoadon`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD CONSTRAINT `khach_hang_ibfk_1` FOREIGN KEY (`idkh`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD CONSTRAINT `nhan_vien_ibfk_1` FOREIGN KEY (`idnv`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `nhan_vien_ibfk_2` FOREIGN KEY (`idquanly`) REFERENCES `nhan_vien` (`idnv`),
  ADD CONSTRAINT `nhan_vien_ibfk_3` FOREIGN KEY (`marap`) REFERENCES `rap_chieu` (`marap`);

--
-- Các ràng buộc cho bảng `phong_chieu`
--
ALTER TABLE `phong_chieu`
  ADD CONSTRAINT `phong_chieu_ibfk_1` FOREIGN KEY (`marap`) REFERENCES `rap_chieu` (`marap`),
  ADD CONSTRAINT `phong_chieu_ibfk_2` FOREIGN KEY (`tenloai`) REFERENCES `loai_phong` (`tenloai`);

--
-- Các ràng buộc cho bảng `rap_chieu`
--
ALTER TABLE `rap_chieu`
  ADD CONSTRAINT `rap_chieu_ibfk_1` FOREIGN KEY (`maqh`) REFERENCES `dia_ban` (`maqh`);

--
-- Các ràng buộc cho bảng `rap_khuyen_mai`
--
ALTER TABLE `rap_khuyen_mai`
  ADD CONSTRAINT `rap_khuyen_mai_ibfk_1` FOREIGN KEY (`marap`) REFERENCES `rap_chieu` (`marap`),
  ADD CONSTRAINT `rap_khuyen_mai_ibfk_2` FOREIGN KEY (`makm`) REFERENCES `khuyen_mai` (`makm`);

--
-- Các ràng buộc cho bảng `suat_chieu`
--
ALTER TABLE `suat_chieu`
  ADD CONSTRAINT `suat_chieu_ibfk_1` FOREIGN KEY (`makhunggio`) REFERENCES `khung_gio` (`makhunggio`),
  ADD CONSTRAINT `suat_chieu_ibfk_2` FOREIGN KEY (`maphim`) REFERENCES `phim` (`maphim`),
  ADD CONSTRAINT `suat_chieu_ibfk_3` FOREIGN KEY (`marap`) REFERENCES `rap_chieu` (`marap`);

--
-- Các ràng buộc cho bảng `su_dung_dich_vu`
--
ALTER TABLE `su_dung_dich_vu`
  ADD CONSTRAINT `su_dung_dich_vu_ibfk_1` FOREIGN KEY (`madv`) REFERENCES `dich_vu` (`madv`) ON UPDATE CASCADE,
  ADD CONSTRAINT `su_dung_dich_vu_ibfk_2` FOREIGN KEY (`mahoadon`) REFERENCES `hoa_don` (`mahoadon`);

--
-- Các ràng buộc cho bảng `the_loai`
--
ALTER TABLE `the_loai`
  ADD CONSTRAINT `the_loai_ibfk_1` FOREIGN KEY (`maphim`) REFERENCES `phim` (`maphim`);

--
-- Các ràng buộc cho bảng `ve`
--
ALTER TABLE `ve`
  ADD CONSTRAINT `ve_ibfk_1` FOREIGN KEY (`masuatchieu`) REFERENCES `suat_chieu` (`masuatchieu`),
  ADD CONSTRAINT `ve_ibfk_2` FOREIGN KEY (`maghe`) REFERENCES `ghe_ngoi` (`maghe`),
  ADD CONSTRAINT `ve_ibfk_3` FOREIGN KEY (`mahoadon`) REFERENCES `hoa_don` (`mahoadon`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
