-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2012 at 11:21 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecomfish`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกลุ่ม',
  `group_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อกลุ่ม',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `group_name`) VALUES
(1, 'ปลาทอง'),
(2, 'ปลาคราฟ'),
(3, 'ปลาหางนกยูง'),
(4, 'ปลาบอลลูน'),
(5, 'ปลาสอด'),
(7, 'ปลากัด'),
(8, 'ปลาซอคเกอร์'),
(11, 'ปลาหมอสี'),
(12, 'ปลามังกร');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `identily` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `tel` text COLLATE utf8_unicode_ci NOT NULL,
  `Status` enum('MEMBER','ADMIN') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password`, `name`, `address`, `email`, `identily`, `tel`, `Status`) VALUES
('admin', 'admin', 'นายดูแล  ระบบดี', '123 ต.ดีแล้ว อ.มาดี จ.อุบลราชธานี', 'Madee@hotmail.com', '1340100117657', '0898765432', 'ADMIN'),
('user', 'user', 'นายทดสอบ  ระบบ', '186 หมู่ที่ 1 บ้านนาสะไมย์ อ.เมือง จ.อุบลราชธานี 34000', 'Test@hotmail.com', '1340100117657', '0891234567', 'MEMBER');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderdetails_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายละเอียดการสั่งซื้อ',
  `order_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสใบสั่งซื้อ',
  `pro_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `qty` int(11) NOT NULL COMMENT 'จำนวน',
  `price` int(11) NOT NULL COMMENT 'ราคา',
  PRIMARY KEY (`orderdetails_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderdetails_id`, `order_id`, `pro_id`, `qty`, `price`) VALUES
(10, '200312100422', 3, 1, 5),
(11, '200312100422', 2, 5, 20),
(12, '200312100554', 3, 1, 5),
(13, '200312100554', 2, 5, 20),
(14, '200312101902', 3, 1, 5),
(15, '200312101902', 2, 5, 20),
(16, '200312101902', 3, 1, 5),
(17, '210312045735', 5, 1, 40),
(18, '210312045735', 6, 1, 40);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เลขที่ใบสั่งซื้อ',
  `username` varchar(300) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อผู้สั่ง',
  `order_date` date NOT NULL COMMENT 'วันที่สั่ง',
  `order_time` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'เวลาที่สั่ง',
  `status` enum('N','R','Y') COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะ',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `username`, `order_date`, `order_time`, `status`) VALUES
('200312100422', 'user', '2012-03-20', '10:04:22', 'N'),
('200312100554', 'user', '2012-03-20', '10:05:54', 'N'),
('200312101902', 'user', '2012-03-20', '10:19:02', 'N'),
('210312045735', 'user', '2012-03-21', '04:57:35', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า',
  `group_id` int(11) NOT NULL COMMENT 'รหัสกลุ่ม',
  `pro_name` varchar(300) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อรูป',
  `pro_pix` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'รูปภาพ',
  `Title` text COLLATE utf8_unicode_ci NOT NULL,
  `Detail` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายละเอียดสินค้า',
  `price_normal` double NOT NULL COMMENT 'ราคาปกติ',
  `price` double NOT NULL COMMENT 'ราคาขาย',
  `status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `group_id`, `pro_name`, `pro_pix`, `Title`, `Detail`, `price_normal`, `price`, `status`) VALUES
(1, 1, 'ปลาทองหัวสิง  ', '20120320092357prd_2.jpg', 'ปลาทองสิงห์จีนเป็นปลาทองหัวสิงห์ประเภทแรกที่จะพูดถึง เป็นสายพันธุ์ปลาทองที่ถูกพัฒนามานานกว่า 600 ปี', 'ปลาทองสิงห์จีนเป็นปลาทองหัวสิงห์ประเภทแรกที่จะพูดถึง เป็นสายพันธุ์ปลาทองที่ถูกพัฒนามานานกว่า 600 ปี โดยประเทศจีนเป็นประเภทแรกที่สามารถเพาะพันธุ์ปลาทองสายพันธุ์นี้ ชาวตะวันตกเรียกปลาทองสายพันธุ์นี้ว่า Lionhead ส่วนในประเทศไทยเรียกว่า ปลาทองหัวสิงห์จีน (Chinese Lionhead) ถ้าพิจารณาจากลักษณะรูปร่างจะเห็นได้ว่า ปลาทองสายพันธุ์นี้ จะมีลักษณะหัวที่มีวุ้นฟูขนาดใหญ่ โดยจะเป็นได้ทั้งเม็ดละเอียด หรือเม็ดใหญ่สม่ำเสมอกัน (ถ้าจะให้ดีควรเป็นเม็ดละเอียด) มองดูคล้ายหัวสิงโต ลำตัว รูปทรง สันหลังจะค่อนข้างตรง หรือโค้งราดลงเล็กน้อย ลำตัวหนาด้านซ้ายและขวาเสมอกัน และถ้ามองจากด้านบน จะมองเห็นสันหลังที่ตรง ครีบหางใหญ่ หางลดปลายเสมอแนวเดียวกับสันหลัง คือถ้าสังเกตุง่ายๆ ก็คือ หัวโต หางลู่ นั่นเอง สีมีได้ทุกสีทั้ง ส้ม แดง ห้าสี (ส้ม ดำ ขาว น้ำเงิน) เมื่อโตเต็มที่จะมีขนาดเฉลี่ยประมาณ 15 เซนติเมตร ( ~ 6 นิ้ว) แต่บางคนเคยพบเห็นตัวที่มีขนาดใหญ่ถึง 25 เซนติเมตร ( ~ 9.5 นิ้ว) โดยมีอายุเฉลี่ยประมาณ 5-7 ปี แล้วแต่การเลี้ยงดู        ', 12, 10, 'Y'),
(2, 2, 'ปลาคราฟ  ', '20120320093232prd_15.jpg', 'ปลาคาร์พ หรือปลาแฟนซีคาร์พ (Fancy Carp) นับเป็นปลาที่สวยงามชนิดหนึ่ง ซึ่งได้รับความนิยมกันอย่างแพร่หลาย ทั้งนี้อาจเป็นเพราะมันเลี้ยงง่าย โตไว', 'ปลาคาร์พ หรือปลาแฟนซีคาร์พ (Fancy Carp) นับเป็นปลาที่สวยงามชนิดหนึ่ง ซึ่งได้รับความนิยมกันอย่างแพร่หลาย ทั้งนี้อาจเป็นเพราะมันเลี้ยงง่าย โตไว อีกทั้งยังมีสีสันสวยงามอีกด้วย และเป็นปลาที่มีอายุยืนที่สุดในโลก  เช่น  ปลาคาร์พ ชื่อ "ฮานาโกะ" ของนายแพทย์ผู้หนึ่ง ที่ เมืองกูฟี ประเทศญี่ปุ่น มีอายุยืนถึง 266 ปี                  ', 25, 20, 'Y'),
(3, 3, 'ปลาหางนกยูง  ', '20120320095515prd_16.jpg', 'เป็นปลาน้ำจืดขนาดเล็กชนิดหนึ่ง มีชื่อวิทยาศาสตร์ว่า Poecilia reticulata ในวงศ์ปลาสอด (Poeciliidae) เป็นปลาน้ำจืดที่มีขนาดเล็ก มีความยาวเต็มที่ไม่เกิน 5 นิ้ว มีจุดเด่นคือครีบหางที่มีขนาดใหญ่ ตัวผู้และตัวเมียมีความแตกต่างกันจนเห็นได้ชัด', 'เป็นปลาน้ำจืดขนาดเล็กชนิดหนึ่ง มีชื่อวิทยาศาสตร์ว่า Poecilia reticulata ในวงศ์ปลาสอด (Poeciliidae) เป็นปลาน้ำจืดที่มีขนาดเล็ก มีความยาวเต็มที่ไม่เกิน 5 นิ้ว มีจุดเด่นคือครีบหางที่มีขนาดใหญ่ ตัวผู้และตัวเมียมีความแตกต่างกันจนเห็นได้ชัด กล่าวคือ ตัวผู้มีขนาดลำตัวที่เล็กกว่ามาก แต่มีสีสันและครีบที่สวยงามกว่า ขณะที่ตัวเมียตัวใหญ่กว่า ท้องอูม สีสันและครีบเครื่องเล็กกว่า', 7, 5, 'Y'),
(4, 12, 'อะโรวาน่าทองมาเลย์  ', '20120321043316.jpg', 'ปลาอะโรวาน่าทองของมาเลเซียจัดเป็นปลาสวยงามอะโรวาน่าที่ีมีราคาแพงที่สุดในบรรดาปลาอะโรวาน่า', 'ปลาอะโรวาน่าทองของมาเลเซียจัดเป็นปลาสวยงามอะโรวาน่าที่ีมีราคาแพงที่สุดในบรรดาปลาอะโรวาน่า\r\nด้วยกัน ทั้งนี้เพระปลาขนิดนี้จะให้ลูกน้อยแและในธณรมชาติหาได้ยากมาก \r\nทุกวันนี้มีเพาะเลี้ยงกันที่มาเลเซีย และสิงคโปร์เท่านั้น  \r\n\r\n', 1000, 750, 'N'),
(5, 2, 'ปลาคราฟ KOHAKU (Red and white)  ', '20120321043759KOHAKU (Red and white).jpg', ' คือปลาคร๊าฟที่มีลำตัวสีขาว และมีลายสีแดงต่อเนื่องตลอดตัวปลา', 'คือปลาคร๊าฟที่มีลำตัวสีขาว และมีลายสีแดงต่อเนื่องตลอดตัวปลา\r\n', 50, 40, 'Y'),
(6, 2, 'ปลาคราฟ YONDAN KOHAKU   ', '20120321043941YONDAN KOHAKU.jpg', 'คือปลาที่มีลำตัวสีขาว และมีลายแดงบนลำตัว 4 ตอน', 'คือปลาที่มีลำตัวสีขาว และมีลายแดงบนลำตัว 4 ตอน', 50, 40, 'Y'),
(7, 2, 'ปลาคราฟ SANDAN KOHAKU  ', '20120321044043SANDAN KOHAKU.jpg', 'คือปลาที่มีลำตัวสีขาว และมีลายแดงบนลำตัว 3 ตอน', 'คือปลาที่มีลำตัวสีขาว และมีลายแดงบนลำตัว 3 ตอน', 50, 40, 'Y'),
(8, 2, 'ปลาคราฟ NIDAN KOHAKU   ', '20120321044531NIDAN KOHAKU.jpg', 'คือปลาที่มีลำตัวสีขาว และมีลายแดงบนลำตัว 2 ตอน เป็นปลาที่มีราคาถูก มีสีสันสวยงาม น่าเลี้ยง นักเลี้ยงปลาที่ชอบปลาที่มีสีสันสวยงามจึงหันมานิยมเลี้ยงปลาคาร์ฟกันมากขึ้น เพราะนอกจากสีสวยแล้ว ยังเลี้ยงง่ายและทนต่อโรคปลาด้วย', 'คือปลาที่มีลำตัวสีขาว และมีลายแดงบนลำตัว 2 ตอน เป็นปลาที่มีราคาถูก มีสีสันสวยงาม น่าเลี้ยง นักเลี้ยงปลาที่ชอบปลาที่มีสีสันสวยงามจึงหันมานิยมเลี้ยงปลาคาร์ฟกันมากขึ้น เพราะนอกจากสีสวยแล้ว ยังเลี้ยงง่ายและทนต่อโรคปลาด้วย', 50, 40, 'Y'),
(9, 12, 'CROSS BACK   ', '20120321045008CROSS BACK.jpg', 'ปลาอะโรวาน่าทองของมาเลเซียจัดเป็นปลาสวยงามอะโรวาน่าที่ีมีราคาแพงที่สุดในบรรดาปลาอะโรวาน่า', 'ปลาอะโรวาน่าทองของมาเลเซียจัดเป็นปลาสวยงาม ปลาอะโรวาน่าทองนี้เป็นปลาที่มีราคาแพงที่สุดในบรรดาปลาอะโรวาน่าด้วยกัน ทั้งนี้เพราะปลาขนิดนี้จะให้ลูกน้อยแและในธณรมชาติหาได้ยากมาก ทุกวันนี้มีเพาะเลี้ยงกันที่มาเลเซีย และสิงคโปร์เท่านั้น\r\n', 1000, 750, 'Y'),
(10, 12, 'Red Tail Golden Arowana  ', '20120321045537Red Tail Golden Arowana.jpg', 'อะโรวาน่าทองอินโดนีเซีย เป็นปลาที่ถูกจำแนกอยู่ภาย ใต้กลุ่มอะโรวาน่าทอง เช่นเดียวกับทองมาเลย์ ปลาชนิดนี้พบใน Pekan Bara ในประเทศอินโดนีเซีย หากเทียบสีแดงและทองมาเลย์ ราคาของทองอินโดนีเซียจะอยู่ในระดับพอเล่นได้ไม่ค่อยแพงนักเนื่องจากสีทองของปลาประเภทนี้จะไม่ข้ามหลังพูดง่ายๆ คือ เวลามันโตเต็มที่มันจะไม่ทองแบบเหลืองอร่ามไปทั้งตัวเช่นเดียวกับทองมาเลย์', 'อะโรวาน่าทองอินโดนีเซีย เป็นปลาที่ถูกจำแนกอยู่ภาย ใต้กลุ่มอะโรวาน่าทอง เช่นเดียวกับทองมาเลย์ ปลาชนิดนี้พบใน Pekan Bara ในประเทศอินโดนีเซีย หากเทียบสีแดงและทองมาเลย์ ราคาของทองอินโดนีเซียจะอยู่ในระดับพอเล่นได้ไม่ค่อยแพงนักเนื่องจากสีทองของปลาประเภทนี้จะไม่ข้ามหลังพูดง่ายๆ คือ เวลามันโตเต็มที่มันจะไม่ทองแบบเหลืองอร่ามไปทั้งตัวเช่นเดียวกับทองมาเลย์\r\n                  ', 700, 500, 'N'),
(11, 12, 'Red Tail Golden Arowana  ', '20120321045817Red Tail Golden Arowana.jpg', 'อะโรวาน่าทองอินโดนีเซีย เป็นปลาที่ถูกจำแนกอยู่ภายใต้กลุ่มอะโรวาน่าทอง เช่นเดียวกับทองมาเลย์ ปลาชนิดนี้พบใน Pekan Bara ในประเทศอินโดนีเซีย หากเทียบสีแดงและทองมาเลย์ ราคาของทองอินโดนีเซียจะอยู่ในระดับพอเล่นได้ไม่ค่อยแพง มีสีสันสวยงาม เลี้ยงง่าย', 'อะโรวาน่าทองอินโดนีเซีย เป็นปลาที่ถูกจำแนกอยู่ภายใต้กลุ่มอะโรวาน่าทอง เช่นเดียวกับทองมาเลย์ ปลาชนิดนี้พบใน Pekan Bara ในประเทศอินโดนีเซีย หากเทียบสีแดงและทองมาเลย์ ราคาของทองอินโดนีเซียจะอยู่ในระดับพอเล่นได้ไม่ค่อยแพง มีสีสันสวยงาม เลี้ยงง่าย\r\n', 700, 500, 'Y'),
(12, 12, 'Silver Arowana  ', '20120321050421silver.jpg', 'ปลาอะโรวาน่าสีเงินเป็นปลาที่เลี้ยงง่าย และมีเสนห์ประจำสายพันธุ์ตัวหนึ่งเป็นปลาที่เติบโตได้ค่อนข้างไวมากภายในการเลี้ยง หากเพื่อนๆมีโอกาศซื้อปลาชนิดนี้มาเลี้ยง ควรเลี้ยงในตู้ขนาดใหญ่ และควรหัดให้เค้ากินอาหารสำเร็จรูปตั้งแต่ตอนเล็กๆขึ้นมาด้วยกัน', 'ปลาอะโรวาน่าสีเงินเป็นปลาที่เลี้ยงง่าย และมีเสนห์ประจำสายพันธุ์ตัวหนึ่งเป็นปลาที่เติบโตได้ค่อนข้างไวมากภายในการเลี้ยง หากเพื่อนๆมีโอกาศซื้อปลาชนิดนี้มาเลี้ยง ควรเลี้ยงในตู้ขนาดใหญ่ และควรหัดให้เค้ากินอาหารสำเร็จรูปตั้งแต่ตอนเล็กๆขึ้นมาด้วยกัน\r\n\r\n                  ', 700, 500, 'Y'),
(13, 11, 'ปลาหมอสีเรดเดวิด', '20120321051043Red devil.jpg', 'เป็นปลาที่มีลำตัวค่อนข้างใหญ่ประมาณ 12 นิ้วขึ้นไป มีสีแดงสด หัวโหนกใหญ่ นับเป็นปลาที่ได้รับความนิยมสูงสุดในการผสมข้ามสายพันธุ์ในบ้านเรา เลี้ยงง่าย ออกลูกเยอะ และที่สำคัญมีราคาไม่แพง', 'เป็นปลาที่มีลำตัวค่อนข้างใหญ่ประมาณ 12 นิ้วขึ้นไป มีสีแดงสด หัวโหนกใหญ่ นับเป็นปลาที่ได้รับความนิยมสูงสุดในการผสมข้ามสายพันธุ์ในบ้านเรา เลี้ยงง่าย ออกลูกเยอะ และที่สำคัญมีราคาไม่แพง\r\n \r\n\r\n                                   ', 70, 50, 'Y'),
(14, 11, 'ปลาหมอสีเฟสเต้', '20120321051227Feste.jpg', 'เป็นปลาที่มีขนาดใหญ่ เมื่อโตเต็มที่จะมีขนาด 35 cm. ตัวเมียจะมีขนาดที่เล็กกว่าเล็กน้อย เมื่อจับคู่ตัวเมียจะมีสีส้มจัดสวยงามกว่า ตัวผู้มีลายตามลำตัวเป็นจุดๆมักนิยมนำมาผสมข้ามสายพันธุ์เพื่อให้ได้ปลาที่มีสีส้มแดงของลำตัว และ Marking ตามลำตัว', 'เป็นปลาที่มีขนาดใหญ่ เมื่อโตเต็มที่จะมีขนาด 35 cm. ตัวเมียจะมีขนาดที่เล็กกว่าเล็กน้อย เมื่อจับคู่ตัวเมียจะมีสีส้มจัดสวยงามกว่า ตัวผู้มีลายตามลำตัวเป็นจุดๆมักนิยมนำมาผสมข้ามสายพันธุ์เพื่อให้ได้ปลาที่มีสีส้มแดงของลำตัว และ Marking ตามลำตัว\r\n                                    ', 70, 50, 'Y'),
(15, 11, 'ปลาหมอสีฟลามิงโก้', '20120321053939midas.jpg', 'ปลาหมอสีฟลามิงโก้ เป็นปลาที่มีขนาดที่ค่อนข้างใหญ่ เมื่อโตเต็มที่จะมีขนาดเกิน 1 ฟุตขึ้นไป รวมทั้งมีสีสันที่หลากหลาย ไล่ตั้งแต่พื้นเหลืองจนออกถึงโทนสีแดงเข้มบางตัวอาจมีขาวแซม สลับกับสีพื้น ซึ่งทำให้ดูรวมๆ แล้วมีสีเป็นขาวแดง สลับกับสีพื้น ซึ่งทำให้ดูรวมๆแล้วมีสีเป็นขาวแดงขาวส้ม หรือขาว เลี้ยงง่าย แต่ต้องดูแลอย่างสม่ำเสมอ', 'ปลาหมอสีฟลามิงโก้ เป็นปลาที่มีขนาดที่ค่อนข้างใหญ่ เมื่อโตเต็มที่จะมีขนาดเกิน 1 ฟุตขึ้นไป รวมทั้งมีสีสันที่หลากหลาย ไล่ตั้งแต่พื้นเหลืองจนออกถึงโทนสีแดงเข้มบางตัวอาจมีขาวแซม สลับกับสีพื้น ซึ่งทำให้ดูรวมๆ แล้วมีสีเป็นขาวแดง สลับกับสีพื้น ซึ่งทำให้ดูรวมๆแล้วมีสีเป็นขาวแดงขาวส้ม หรือขาว เลี้ยงง่าย แต่ต้องดูแลอย่างสม่ำเสมอ                                                     ', 70, 50, 'Y'),
(16, 1, 'ปลาทองฮอรันดา', '20120321054412horunda.jpg', 'ปลาทองพันธุ์นี้เป็นปลาลำตัวค่อนข้างยาว หน้าไม่แหลมเหมือนปลาทองพันธุ์ริวกิ้น ครีบทุกครีบของออแรนด้าก็ค่อนข้างยาวครีบหางอ่อนช้อยเป็นพวง มีความงามมาก ราคาขายไม่สูงเป็นปลาที่เลี้ยงง่าย เหมาะสำหรับนักเลี้ยงปลาทองที่กำลังเริ่มมองหาซื้อมาเลี้ยง ', 'ปลาทองพันธุ์นี้เป็นปลาลำตัวค่อนข้างยาว หน้าไม่แหลมเหมือนปลาทองพันธุ์ริวกิ้น ครีบทุกครีบของออแรนด้าก็ค่อนข้างยาวครีบหางอ่อนช้อยเป็นพวง มีความงามมาก ราคาขายไม่สูงเป็นปลาที่เลี้ยงง่าย เหมาะสำหรับนักเลี้ยงปลาทองที่กำลังเริ่มมองหาซื้อมาเลี้ยง \r\n\r\n\r\n                            ', 20, 15, 'Y'),
(17, 7, 'ปลากัด Veil Tail ประเภทเดียว สี Red  ', '20120321054953plagud.jpg', 'รูปร่างลักษณะ :เป็นปลาที่มีขนาดเล็ก ลำตัวยาวแบนข้าง หัวเล็ก ปากขนาดเล็ก เชิดขึ้นด้านบนเล็กน้อย มีฟันที่ขากรรไกรบนและล่าง มีเกล็ดปกคลุมหัวและตัว ครีบอกมีขนาดเล็กกว่าครีบอื่นๆ มีสีสันสวยงามสะดุดตา และเลี้ยงง่าย   ', 'รูปร่างลักษณะ :เป็นปลาที่มีขนาดเล็ก ลำตัวยาวแบนข้าง หัวเล็ก ปากขนาดเล็ก เชิดขึ้นด้านบนเล็กน้อย มีฟันที่ขากรรไกรบนและล่าง มีเกล็ดปกคลุมหัวและตัว ครีบอกมีขนาดเล็กกว่าครีบอื่นๆ มีสีสันสวยงามสะดุดตา และเลี้ยงง่าย                         ', 50, 45, 'Y'),
(18, 7, 'ปลากัดลายหินอ่อน  ', '20120321055405plagud_11.jpg', 'เป็นปลากัดที่ไม่มีเส้นข้างลำตัว กระดูกที่อยู่ด้านหน้าของดวงตา(Preorbital) มีขอบเรียบมีอวัยวะพิเศษ ช่วยในการหายใจนอกจากเหงือก เรียกว่าLabyrinth Organ อยู่ในโพรงอากาศหลังช่องเหงือก มีลักษณะเป็นเนื้อเยื่อที่มีรอยหยักและมีเส้นเลือดฝอยมาหล่อเลี้ยงมากมาย เหมาะที่จะเอามาเลี้ยงเพื่อความสวยงาม ', 'เป็นปลากัดที่ไม่มีเส้นข้างลำตัว กระดูกที่อยู่ด้านหน้าของดวงตา(Preorbital) มีขอบเรียบมีอวัยวะพิเศษ ช่วยในการหายใจนอกจากเหงือก เรียกว่าLabyrinth Organ อยู่ในโพรงอากาศหลังช่องเหงือก มีลักษณะเป็นเนื้อเยื่อที่มีรอยหยักและมีเส้นเลือดฝอยมาหล่อเลี้ยงมากมาย เหมาะที่จะเอามาเลี้ยงเพื่อความสวยงาม              ', 50, 30, 'Y'),
(19, 3, 'ริบบอนโมเสค (Ribbon mosaic)  ', '20120321060308Ribbon mosaic.jpg', 'ครีบหางมีลวดลายแบบโมเสค โดยลวดลายจะมีลักษณะเป็นแต้มใหญ่ ครีบหางอาจจะมีสีแดง เหลือง น้ำเงิน หรือสีใดก็ได้ ครีบหลังควรมีลวดลายและสีที่สอดคล้องกับครีบหาง สามารถเลี้ยงง่าย ราคาไม่แพง ', 'ครีบหางมีลวดลายแบบโมเสค โดยลวดลายจะมีลักษณะเป็นแต้มใหญ่ ครีบหางอาจจะมีสีแดง เหลือง น้ำเงิน หรือสีใดก็ได้ ครีบหลังควรมีลวดลายและสีที่สอดคล้องกับครีบหาง สามารถเลี้ยงง่าย ราคาไม่แพง \r\n\r\n \r\n\r\n                                ', 20, 10, 'Y'),
(20, 3, 'เยอรมันเยลโลทักซิโด้  (German yellow tuxedo)  ', '20120321061518German yellow tuxedo.jpg', 'ลำตัวจากบริเวณกึ่งกลางลำตัวไปสุดโคนหางมีสีดำหรือน้ำเงินเข้ม ครีบหางอาจเป็นสีพื้นหรือมีลวดลาย ครีบหลังมีสีและลวดลายที่สอดคล้องกับครีบหาง ทั้งตัวมีสีสันที่สวยงาม', 'ลำตัวจากบริเวณกึ่งกลางลำตัวไปสุดโคนหางมีสีดำหรือน้ำเงินเข้ม ครีบหางอาจเป็นสีพื้นหรือมีลวดลาย ครีบหลังมีสีและลวดลายที่สอดคล้องกับครีบหาง ทั้งตัวมีสีสันที่สวยงาม \r\n\r\n            ', 20, 10, 'Y'),
(21, 4, 'ปลาบอลลูน มอลลี่ (Dalmation Balloon Molly) ', '20120321063206balloon.jpg', 'เป็นปลาที่คนไทยนิยมเลี้ยงชนิดหนึ่งเนื่องจากเป็นปลาสวยงามที่มีความหลากหลายสีสันอีกชนิดหนึ่ง ถึงแม้จะมีลวดลายน้อยกว่าปลาหางนกยูง แต่จะเด่นกว่าตรงครีบกระโดงหลังที่สูงและแผ่สะดุดตา ลักษณะเด่นของปลาบอลลูนคือ ลำตัวกลมเหมือนบอลลูน (ยิ่งกลมยิ่งสวย) ลำตัวสั้นและอ้วน การเลี้ยงปลาสวยงามชนิดนี้ในบ้านเรามีอยู่หลายชนิด ถ้าแยกเป็นสีได้แก่สีขาว, ดำ, ส้ม, เหลือง, ลายขาว-ดำ, ลายขาว-น้ำตาล, ลายขาว-ดำ-เหลือง และสีช็อกโกแลต', 'เป็นปลาที่คนไทยนิยมเลี้ยงชนิดหนึ่งเนื่องจากเป็นปลาสวยงามที่มีความหลากหลายสีสันอีกชนิดหนึ่ง ถึงแม้จะมีลวดลายน้อยกว่าปลาหางนกยูง แต่จะเด่นกว่าตรงครีบกระโดงหลังที่สูงและแผ่สะดุดตา ลักษณะเด่นของปลาบอลลูนคือ ลำตัวกลมเหมือนบอลลูน (ยิ่งกลมยิ่งสวย) ลำตัวสั้นและอ้วน การเลี้ยงปลาสวยงามชนิดนี้ในบ้านเรามีอยู่หลายชนิด ถ้าแยกเป็นสีได้แก่สีขาว, ดำ, ส้ม, เหลือง, ลายขาว-ดำ, ลายขาว-น้ำตาล, ลายขาว-ดำ-เหลือง และสีช็อกโกแลต                                    ', 10, 5, 'Y'),
(22, 4, 'ปลาบอลลูน มอลลี่ (Golden Balloon Molly)', '20120321072610Golden Balloon Molly.jpg', 'ปลาบอลลูนเป็นปลาที่เลี้ยงในเมืองไทย และเป็นที่นิยมในการเลี้ยง เนื่องจากเป็นปลาสวยงามที่มีความหลากหลายสีสันอีกชนิดหนึ่ง  มีครีบกระโดงหลังที่สูงและแผ่สะดุดตา ลักษณะเด่นของปลาบอลลูนคือ ลำตัวกลมเหมือนบอลลูน (ยิ่งกลมยิ่งสวย) ลำตัวสั้นและอ้วน การเลี้ยงปลาสวยงามชนิดนี้ในบ้านเรามีอยู่หลายชนิด ถ้าแยกเป็นสีได้แก่สีขาว, ดำ, ส้ม, เหลือง, ลายขาว-ดำ, ลายขาว-น้ำตาล, ลายขาว-ดำ-เหลือง และสีช็อกโกแลต                  ', 'ปลาบอลลูนเป็นปลาที่เลี้ยงในเมืองไทย และเป็นที่นิยมในการเลี้ยง เนื่องจากเป็นปลาสวยงามที่มีความหลากหลายสีสันอีกชนิดหนึ่ง  มีครีบกระโดงหลังที่สูงและแผ่สะดุดตา ลักษณะเด่นของปลาบอลลูนคือ ลำตัวกลมเหมือนบอลลูน (ยิ่งกลมยิ่งสวย) ลำตัวสั้นและอ้วน การเลี้ยงปลาสวยงามชนิดนี้ในบ้านเรามีอยู่หลายชนิด ถ้าแยกเป็นสีได้แก่สีขาว, ดำ, ส้ม, เหลือง, ลายขาว-ดำ, ลายขาว-น้ำตาล, ลายขาว-ดำ-เหลือง และสีช็อกโกแลต                                                                        ', 10, 5, 'Y'),
(23, 5, 'ปลาสอด Orange Molly  ', '20120321072432Orange Molly.jpg', 'ปลาสอดเป็นปลาที่มีลำตัวยาวเรียว  แบนด้านข้างเล็กน้อย  บางชนิดอาจลำตัวอ้วนกลม  ส่วนหัวมีขนาดเล็กและค่อนข้างแบนลง  ปากเล็กเชิดขึ้นด้านบนเล็กน้อย  ตาโต  ครีบทุกครีบไม่มีก้านครีบแข็ง  มีสีสวยงามสะดุดตา', 'ปลาสอดเป็นปลาที่มีลำตัวยาวเรียว  แบนด้านข้างเล็กน้อย  บางชนิดอาจลำตัวอ้วนกลม  ส่วนหัวมีขนาดเล็กและค่อนข้างแบนลง  ปากเล็กเชิดขึ้นด้านบนเล็กน้อย  ตาโต  ครีบทุกครีบไม่มีก้านครีบแข็ง  มีสีสวยงามสะดุดตา                            ', 10, 5, 'Y'),
(24, 4, 'ปลาบอลลูน มอลลี่ (Marble Balloon Molly)  ', '20120321074001Marble Balloon Molly.jpg', 'เป็นปลาที่คนไทยนิยมเลี้ยงชนิดหนึ่งเนื่องจากเป็นปลาสวยงามที่มีความหลากหลายสีสันอีกชนิดหนึ่ง ถึงแม้จะมีลวดลายน้อยกว่าปลาหางนกยูง แต่จะเด่นกว่าตรงครีบกระโดงหลังที่สูงและแผ่สะดุดตา ลักษณะเด่นของปลาบอลลูนคือ ลำตัวกลมเหมือนบอลลูน (ยิ่งกลมยิ่งสวย) ลำตัวสั้นและอ้วน การเลี้ยงปลาสวยงามชนิดนี้ในบ้านเรามีอยู่หลายชนิด ถ้าแยกเป็นสีได้แก่สีขาว, ดำ, ส้ม, เหลือง, ลายขาว-ดำ, ลายขาว-น้ำตาล, ลายขาว-ดำ-เหลือง และสีช็อกโกแลต ', 'เป็นปลาที่คนไทยนิยมเลี้ยงชนิดหนึ่งเนื่องจากเป็นปลาสวยงามที่มีความหลากหลายสีสันอีกชนิดหนึ่ง ถึงแม้จะมีลวดลายน้อยกว่าปลาหางนกยูง แต่จะเด่นกว่าตรงครีบกระโดงหลังที่สูงและแผ่สะดุดตา ลักษณะเด่นของปลาบอลลูนคือ ลำตัวกลมเหมือนบอลลูน (ยิ่งกลมยิ่งสวย) ลำตัวสั้นและอ้วน การเลี้ยงปลาสวยงามชนิดนี้ในบ้านเรามีอยู่หลายชนิด ถ้าแยกเป็นสีได้แก่สีขาว, ดำ, ส้ม, เหลือง, ลายขาว-ดำ, ลายขาว-น้ำตาล, ลายขาว-ดำ-เหลือง และสีช็อกโกแลต \r\n', 10, 5, 'Y'),
(25, 5, 'ปลาสอดดำ (Black Molly)  ', '20120321074855black molly.jpg', 'ปลาสอดดำชนิดนี้จะมีลักษณะตัวเป็นสีดำ มีสีแวววาว มีสีสวยงามสะดุดตา เป็นปลาที่เลี่ยงง่าย ออกลูกเยอะ ราคาก็ไม่แพงและยังเป็นที่นิยมในการเลี้ยงและซื้อ-ขายอีกด้วย', 'ปลาสอดดำชนิดนี้จะมีลักษณะตัวเป็นสีดำ มีสีแวววาว มีสีสวยงามสะดุดตา เป็นปลาที่เลี่ยงง่าย ออกลูกเยอะ ราคาก็ไม่แพงและยังเป็นที่นิยมในการเลี้ยงและซื้อ-ขายอีกด้วย', 10, 5, 'Y'),
(26, 5, 'ปลาสอด (Gold Metallic Molly)  ', '20120321075456Gold Metallic Molly.jpg', 'ปลาสอดชนิดนี้จะมีลักษณะสีสันที่เปล่งประกายสวยงาม สะดุดตา สามารถเพาะเลี้ยงได้ง่าย ราคาไม่แพง ', 'ปลาสอดชนิดนี้จะมีลักษณะสีสันที่เปล่งประกายสวยงาม สะดุดตา สามารถเพาะเลี้ยงได้ง่าย ราคาไม่แพง                   ', 10, 5, 'Y'),
(27, 8, 'ปลาซ๊อคเกอร์ผีเสื้อ   ', '20120321083118_1_~4.JPG', 'ปลาซ๊อคเกอร์ชนิดนี้ มีสีสันสวยงาม เลี้ยงง่าย ราคาไม่แพง เป็นปลาที่นิยมนำมาเลี้ยงเพื่อเอาไว้ดูดฝุ่น เนื่องจากปลาซ๊อคเกอร์ชอบดูดฝุ่นเป็นอาหาร และที่สำคัญเป็นปลาที่แข็งแรงทนทาน ตายอยากกว่าปลาชนิดอื่น ๆ', 'ปลาซ๊อคเกอร์ชนิดนี้ มีสีสันสวยงาม เลี้ยงง่าย ราคาไม่แพง เป็นปลาที่นิยมนำมาเลี้ยงเพื่อเอาไว้ดูดฝุ่น เนื่องจากปลาซ๊อคเกอร์ชอบดูดฝุ่นเป็นอาหาร และที่สำคัญเป็นปลาที่แข็งแรงทนทาน ตายยากกว่าปลาชนิดอื่น ๆ                  ', 100, 80, 'Y'),
(28, 8, 'ปลาซ๊อคเกอร์ สโนว์บอล  ', '20120321084336pic-1140613959.jpg', 'เป็นปลาที่มีสีสันสวยงาม ดูแล้วแปลกตา สามารถเลี่ยงได้ง่าย ราคาไม่แพง และไม่เป็นอันตรายต่อปลาที่เลี้ยงในตู้เดียวกัน และยังช่วยดูดฝุ่นในตู้ปลาได้ด้วย', 'เป็นปลาที่มีสีสันสวยงาม ดูแล้วแปลกตา สามารถเลี่ยงได้ง่าย ราคาไม่แพง และไม่เป็นอันตรายต่อปลาที่เลี้ยงในตู้เดียวกัน และยังช่วยดูดฝุ่นในตู้ปลาได้ด้วย', 100, 80, 'Y'),
(29, 8, 'ปลาซ๊อคเกอร์ ซันไซน์  ', '20120321084648pic-1140631648.jpg', 'เป็นปลาที่มีสีสันสวยงาม ดูแล้วแปลกตา สามารถเลี่ยงได้ง่าย ราคาไม่แพง และไม่เป็นอันตรายต่อปลาที่เลี้ยงในตู้เดียวกัน และยังช่วยดูดฝุ่นในตู้ปลาได้ด้วย ', 'เป็นปลาที่มีสีสันสวยงาม ดูแล้วแปลกตา สามารถเลี้ยงได้ง่าย ราคาไม่แพง และไม่เป็นอันตรายต่อปลาที่เลี้ยงในตู้เดียวกัน และยังช่วยดูดฝุ่นในตู้ปลาได้ด้วย', 100, 80, 'Y');