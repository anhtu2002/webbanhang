-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 02:39 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webbanhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `product_id`, `user_id`, `num`) VALUES
(84, 28, 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(1, 'Thời Trang Nam', 'https://cf.shopee.vn/file/687f3967b7c2fe6a134a2c11894eea4b_tn'),
(2, 'Thời Trang Nữ', 'https://cf.shopee.vn/file/75ea42f9eca124e9cb3cde744c060e4d_tn'),
(3, 'Điện Thoại', 'https://cf.shopee.vn/file/31234a27876fb89cd522d7e3db1ba5ca_tn'),
(4, 'Thiết Bị Điện Tử', 'https://cf.shopee.vn/file/978b9e4cb61c611aaaf58664fae133c5_tn'),
(5, 'Đời Sống & Nhà Cửa', 'https://cf.shopee.vn/file/24b194a695ea59d384768b7b471d563f_tn'),
(6, 'Thiết bị gia dụng', 'https://cf.shopee.vn/file/7abfbfee3c4844652b4a8245e473d857_tn'),
(7, 'Ô Tô & Xe Máy & Xe Đạp', 'https://cf.shopee.vn/file/3fb459e3449905545701b418e8220334_tn'),
(8, 'Mẹ & Bé', 'https://cf.shopee.vn/file/099edde1ab31df35bc255912bab54a5e_tn'),
(9, 'Nhà Sách', 'https://cf.shopee.vn/file/36013311815c55d303b0e6c62d6a8139_tn'),
(10, 'Bách Hóa', 'https://cf.shopee.vn/file/c432168ee788f903f1ea024487f2c889_tn');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `full_name`, `phone_number`, `email`, `address`, `order_date`, `customer_id`) VALUES
(1, 'Nguyễn Bá Duy', '0123456789', '567@gmail.com', 'Đống Đa', '2022-11-07 16:01:40', 34),
(2, 'Nguyễn Bá Duy', '0987654321', '123@gmail.com', 'Đống Đa', '2022-11-07 16:05:28', 36),
(3, 'Nguyễn Văn A', '05855655428', 'afss@gmail.com', 'Việt Nam', '2022-11-08 15:37:53', 37),
(4, 'Nguyễn Văn B', '0554455112', 'dfasdfasdf@gmail.com', 'Hà Nội', '2022-11-08 15:41:21', 37),
(6, 'Nguyễn Văn C', '0123456783', '123213123@gmail.com', 'Hà Nội, Việt Nam', '2022-12-31 05:56:34', 5),
(7, 'Nguyễn Văn C', '0123456783', '123213123@gmail.com', 'Hà Nội, Việt Nam', '2022-12-31 05:58:21', 5),
(13, 'Khuất Anh Tú', '0393787959', 'tukhuat19@gmail.com', 'Phú Thọ', '0000-00-00 00:00:00', 44);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `num`, `price`, `status`) VALUES
(6, 2, 6, 5, 2000, 'accept'),
(7, 3, 15, 1, 85000, NULL),
(8, 4, 6, 1, 2000, 'accept'),
(10, 6, 25, 1, 16590000, 'accept'),
(11, 7, 24, 1, 13190000, 'refuse'),
(13, 13, 15, 2, 85000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `category_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `created_date`, `seller_id`, `updated_date`, `category_id`) VALUES
(1, 'Iphone 14 PRO MAX màu đen chính hãng', 21990000, 'Điện thoại Iphone 14 PRO MAX đen chính hãng Apple\r\nSmartphone #dienthoai #smartphone #iphone', 'images/848ef3aa.png', '2022-10-27', 5, '2022-11-09', 3),
(2, 'Iphone 15 PRO MAX màu xanh lá cây viền xanh nước biển', 29990000, 'Điện thoại Iphone 15 PRO MAX màu xanh lá cây viền xanh nước biển\r\nSmartphone #dienthoai ', 'images/ip15.jpg', '2022-10-27', 5, '2022-10-30', 3),
(4, 'Xe đạp thể thao AMIDA 24-26inch không đề 1 đĩa + 1 líp dễ sửa chữa', 1730000, 'Xe Đạp Avibus (Hàng Việt Nam Xuất Khẩu)!\r\n \r\n⭐ Khung sườn dày dặn sơn tĩnh điện \r\n⭐ Mayer Taiwan chất lượng và khác biệt trong tầm giá \r\n⭐ Đùi Thép bọc nhựa (đẹp + cứng cáp) \r\n⭐ Tay phanh nhôm Taiwan Ahonga dày dặn \r\n⭐ Vành nhôm 2 lớp dày ( khác biệt tầm giá ) \r\n\r\n❤ Bảo Hành Khung 5 Năm - Phụ tùng 1 Năm ❤ ❤ Hỗ trợ sửa chữa trọn đời ❤ \r\n\r\n➡ #TẤT_CẢ dòng  #XE_MỚI bên mình sẽ có #GIÁ_TỐT_NHẤT Thị Trường !!! \r\n\r\n❤ Bảo Hành Khung 5 Năm - Phụ tùng 1 Năm ❤ ❤ Hỗ trợ sửa chữa trọn đời ❤ đối với tất cả các dòng xe mới !\r\n\r\n*** Xe Đạp Hằng Oanh cam kết ***\r\n√ Shop sẽ kiểm tra hàng cẩn thận trước khi gửi hàng\r\n cam kết sản phẩm đúng theo hình ảnh. Tất cả hình ảnh/video được tăng tải trong gian hàng đều do bên shop tự làm\r\n√  Cam kết đổi trả hàng ngay lập tức nếu giao sai hàng hoặc hàng bị lỗi của nhà sản xuất. \r\n√  Giao hàng trên toàn quốc - nhận hàng trả tiền.', 'images/6e0e5fc0.png', '2022-10-29', 5, NULL, 7),
(6, 'Dao Thái gọt củ quả, dao cắt trái cây nhỏ tiện dụng', 16000, ' Dao Thái gọt củ quả, dao cắt trái cây nhỏ tiện dụng\r\n\r\ncon dao tiện dụng giúp bạn hài lòng và tự tin hơn khi vào bếp.\r\n\r\nDao được làm bằng chất liệu thép không gỉ, giúp dao luôn sáng bóng và sạch đẹp.\r\n\r\nLưỡi dao luôn nổi tiếng với độ sắc bén cao\r\n\r\nViệc cắt, tỉa, thái đồ ăn trở nên dễ dàng và đạt tính thẩm mỹ cao\r\n\r\nCán dao làm bằng chất liệu nhựa PP cao cấp;bạn sử dụng sẽ rất bền bỉ theo thời gian', 'images/daoo.png', '2022-10-29', 34, '2023-08-29', 5),
(13, 'Tất ngắn nam Vớ thấp cổ 4 màu trơn chống hôi chân', 3900, 'Thông tin sản phẩm tất ngắn nam:\r\n- Được thiết kế theo đúng form chuẩn của nam giới Việt Nam \r\n- Sản phẩm chính là mẫu thiết kế mới nhất\r\n- Chất liệuco giãn, cực mềm mịn, thoáng mát mồ hôi, chống hôi chân\r\n- Đem lại sự thoải mái tiện lợi nhất cho người sử dụng\r\n- Giá sp là 1 đôi tất (3k9/đôi)\r\n\r\nChế độ bảo hành Litaia:\r\n- Tất cả các sản phẩm đều được shop bảo hành\r\n- Đối với sản phẩm lỗi/đơn hàng thiếu sản phẩm, quý khách vui lòng nhắn tin/gọi ngay cho shop trong vòng 3 ngày (kể từ ngày nhận đơn hàng)\r\n- Nếu quá thời hạn 3 ngày kể từ ngày nhận đơn hàng, chế độ bảo hành của Litaia sẽ hết hiệu lực', 'images/c409a932.png', '2022-10-29', 5, NULL, 1),
(14, 'Giày cầu lông Kawasaki K063 chính hãng, chuyên nghiệp, đế kếp, đủ size', 649000, '???? Cam kết UY TÍN - CHẤT LƯỢNG là số 1.\r\n ???? NHẬN HÀNG - THANH TOÁN tại nhà. \r\n ???? Hoàn tiền 100% nếu bán sản phẩm không giống ảnh. \r\n ???? Cam kết được đổi hàng trong vòng 15 ngày.\r\n ???? Bảo hành keo 12 tháng\r\n\r\n------------------------------------------.........\r\nKawasaki là một thương hiệu Thể thao nối tiếng đến từ NHẬT BẢN. Các sản phẩm giày của thương hiệu này có thiết kế bắt mắt với khả năng vượt trội trong môi trường thể thao đặc biệt là dành cho bộ môn cầu long/bóng chuyền.  Điểm cộng đối với thương hiệu Kawasaki được thể hiện với thiết kế không chỉ đa dạng về kiểu dáng mà còn có nhiều màu sắc khác nhau phù hợp với mọi độ tuổi chơi thể thao.\r\n•	Giày thể thao Kawasaki chính hãng có chất liệu da bóng mép ngoài giúp tăng độ bền khi cọ sát. \r\n•	Cổ giày ôm khít tạo cảm giác an toàn khi di chuyển, trong khi đó đế giày có đệm khí tạo độ êm trong quá trình bật nảy, di chuyển khi chơi cầu lông.\r\n•	Giày thể thao Kawasaki  chính hãng được thiết kế đặc biệt với các thành phần như PU leather, Eva, Rubber giúp đôi giày bền và mềm hơn so với các thương hiệu cầu lông khác. \r\n•	Giày  chính hãng được làm từ các loại chất liệu chất lượng cao và các loại da thật nên thường sẽ mềm mại và có màu sắc tối hơn so với các mẫu hàng giả.\r\n-----------------------------------------\r\n- Với mỗi phản hồi 5 sao, quý khách sẽ được nhận một phần quà từ shop ở lần mua hàng sau.\r\n- Đừng quên theo bấm theo dõi shop để cập nhập những mẫu mới nhất \r\n- Cám ơn quý khách đã tin tưởng và ủng hộ shop. \r\n- Shop luôn sẵn sàng trả lời inbox để tư vấn.\r\n\r\n#giaynam #giaythethao #giaydep  #giaycaulong  #giaynu  #giaybongchuyen #giaychoicaulong #giaydanhcaulong #giaycaulongnam #giaycaulongnu #giaycaulongnamnu #giaycaulongchinhhang #giaythethao', 'images/e885e695.png', '2022-10-29', 5, NULL, 1),
(15, 'Áo phông nam Urano ngắn tay cổ bẻ phối viền cao cấp : Kiểu dáng Hàn Quốc chất liệu cotton , co giãn ', 85000, 'Urano_clothing hân hạnh được phục vụ quý khách. Những sản phẩm mới nhất liên tục được cập nhật mỗi ngày . QUÝ KHÁCH NHỚ LIKE SẢN PHẨM VÀ THEO DÕI SHOP ĐỂ LUÔN CẬP NHẬT MÃ GIẢM GIÁ, CHƯƠNG TRÌNH DEAL SỐC , KHUYẾN MÃI KHỦNG TRONG THÔNG BÁO CỦA QUÝ KHÁCH .\r\n\r\n1. GIỚI THIỆU SẢN PHẨM\r\n    Áo Phông Nam ngắn tay , cổ bẻ , chống nhăn cao cấp  chính là gợi ý tuyệt vời cho nam giới mỗi khi lựa chọn trang phục mỗi ngày. Với những mẫu áo phông nam thiết kế đơn giản và toát lên vẻ lịch lãm tinh tế, mang đến phong cách thời trang trẻ trung, năng động chắc chắn sẽ là lựa chọn hoàn hảo cho chàng trai hiện đại, nam tính. Những chiếc áo phông nam dù kết hợp với quần âu, quần jeans khi đi làm hay diện cùng quần ngố, quần short đi chơi đều NỔI BẬT, THOẢI MÁI và PHONG CÁCH. Với form dáng vừa vặn các chàng có thể tự tin khoe body cực chuẩn của mình. Hãy bổ sung ngay vào tủ đồ item này để diện thật chất nhé!\r\n\r\n2. THÔNG TIN CHI TIẾT \r\n????Màu sắc  : ĐEN, TRẮNG , XANH THAN, GHI SÁNG , XÁM ĐẬM ,VÀNG , ĐỎ \r\n???? Chất liệu: cotton , thấm hút mồ hôi \r\n???? Chất vải sờ mịn không bai, không nhăn, không xù\r\n???? Quy cách, tiêu chuẩn đường may tinh tế, tỉ mỉ trong từng chi tiết\r\n???? Kiểu dáng: Thiết kế đơn giản, dễ mặc, dễ phối đồ\r\n???? Form body Hàn Quốc mang lại phong cách trẻ trung, lịch lãm\r\n???? Chất lượng sản phẩm tốt, giá cả hợp lý\r\n\r\n3. CHÍNH SÁCH BÁN HÀNG:\r\n???? Cam kết chất lượng và mẫu mã sản phẩm giống với hình ảnh.\r\n???? Hoàn tiền nếu sản phẩm không giống với mô tả.\r\n???? Ngoài ra IKEMEN SHOP tặng voucher hoặc hoàn xu cho các đơn hàng tương ứng đủ điều kiện.\r\n???? Rất mong nhận được ý kiến đóng góp của Quý khách hàng để chúng tôi cải thiện chất lượng dịch vụ tốt hơn.\r\n\r\n 4. HƯỚNG DẪN CÁCH ĐẶT HÀNG\r\n???? Bước 1: Cách chọn size, shop có bảng size mẫu. Bạn NÊN INBOX, cung cấp chiều cao, cân nặng để SHOP TƯ VẤN SIZE\r\n???? Bước 2: Cách đặt hàng: Nếu bạn muốn mua 2 sản phẩm khác nhau hoặc 2 size khác nhau, để được freeship\r\n???? Bạn chọn từng sản phẩm rồi thêm vào giỏ hàng\r\n???? Khi giỏ hàng đã có đầy đủ các sản phẩm cần mua, bạn mới tiến hành ấn nút “ Thanh toán”\r\n???? Shop luôn sẵn sàng trả lời inbox để tư vấn\r\n\r\n5. HƯỚNG DẪN CHỌN SIZE ÁO PHÔNG NAM:\r\n    (Size áo phụ thuộc vào chiều cao cân nặng và các yếu tố khác như vòng ngực, bụng, vai, bắp tay,... Do đó quý khách còn phân vân xin vui lòng nhắn tin trực tiếp để được hỗ trợ tốt nhất)\r\n????  Size M     :  Cân nặng từ 45-51kg,  Chiều cao dưới 160cm\r\n????  Size L      :  Cân nặng từ 52-58kg,  Chiều cao dưới 165cm\r\n????  Size XL    :  Cân nặng từ 59-65kg,  Chiều cao dưới 170cm\r\n????  Size 2XL  :  Cân nặng từ 66-72kg,  Chiều cao dưới 175cm\r\n????  Size 3XL  :  Cân nặng từ 73-80kg,  Chiều cao dưới 185cm\r\n------- Hàng có sẵn, đủ size:   M, L, XL, 2XL,3XL -----\r\n              NHẬN ĐẶT HÀNG MUA BUÔN/MUA SỈ SỐ LƯỢNG LỚN\r\n  Tham khảo thêm các sản phẩm khác tại:#Urano_clothing\r\n#thoitrangnam#aothunnam#aothun#aophongnu#aonam#aophongnam#aophongtrang#aothuncoco#aothunnamtaylo#aophongdoi#aothunnam', 'images/51f529cc.png', '2022-10-29', 36, NULL, 1),
(18, 'Ensure Gold Coffee (HMB) 850g', 855000, 'Ensure Gold là nguồn dinh dưỡng đầy đủ và cân đối giúp bảo vệ khối cơ, tăng cường sức khỏe cho người lớn tuổi góp phần cải thiện thể chất và chất lượng cuộc sống. \r\n\r\nEnsure Gold có chứa: \r\n- HMB + Hỗn hợp Protein chất lượng cao giúp tái tạo và bảo vệ khối cơ. \r\n- 28 Vitamin & khoáng chất thiết yếu tăng cường sức đề kháng giúp cơ thể khỏe mạnh. \r\n- Hỗn hợp chất béo có lợi Omega 3-6-9 tốt cho hệ tim mạch. \r\n- Chất xơ FOS giúp hệ tiêu hóa khỏe mạnh. \r\n\r\nĐối tượng sử dụng: người lớn, người ăn uống kém, người bệnh cần hồi phục nhanh. \r\n\r\nCách pha 1 ly Ensure Gold chuẩn: \r\n- Để pha 230 ml, cho 185 ml nước chín nguội vào ly, vừa từ từ cho vào 6 muỗng gạt ngang vừa khuấy đều cho đến khi bột tan hết.\r\n- Đạt hiệu quả tốt nhất khi sử dụng 2 ly mỗi ngày.\r\n\r\nBảo quản: Bảo quản hộp chưa mở ở nhiệt độ phòng. Hộp đã mở phải được đậy kín và bảo quản ở nơi khô mát, nhưng không cho vào tủ lạnh. Khi đã mở phải sử dụng trong vòng 3 tuần. Ensure Gold đã pha phải dùng ngay hay đậy kín cho vào tủ lạnh và dùng trong vòng 24 giờ.\r\n\r\nLưu ý: \r\n- Ensure Gold dưới sự giám sát của bác sỹ hoặc chuyên gia dinh dưỡng, cần theo đúng các hướng dẫn.\r\n- Không dùng cho người bệnh Galactosemia.\r\n- Không dùng qua đường tĩnh mạch.\r\n- Không dùng cho trẻ em trừ khi có hướng dẫn của chuyên gia y tế.\r\n\r\nHạn sử dụng: 24 tháng kể từ ngày sản xuất. \r\nSản xuất tại Singapore.\r\n\r\n*Sản phẩm không phải là thuốc và không có tác dụng thay thế thuốc chữa bệnh.\r\n**Bao bì có thể thay đổi theo từng đợt hàng***', 'images/d81e2813.png', '2022-11-07', 5, NULL, 10),
(21, 'Nồi chiên không dầu GAABOR GA-M6A dung tích 6L - Thép không gỉ - Giá rẻ - Hàng chính hãng', 949000, 'Nồi chiên không dầu là một thiết bị điện gia dụng giúp hỗ trợ người dùng nấu chín thức ăn mà không cần sử dụng dầu, rất thích hợp cho những người có vấn đề về cân nặng, hay bệnh huyết áp... Vì chúng có khả năng hạn chế dầu mỡ đi vào cơ thể. Đây thật sự là một trong những giải pháp thông minh giúp người dùng vừa có thể thưởng thức món ăn chiên giòn, nhưng vẫn giảm tối đa lượng dầu mỡ. \r\n\r\n\r\n\r\nTrong những năm gần đây, những chiếc nồi chiên không dầu ngày càng được ưa chuộng hơn, nhờ tích hợp nhiều công nghệ mới như công nghệ độc đáo Cyclone air, khả năng lọc mùi, giảm khói, đa dạng chế độ nấu,dung tích nồi lớn… Tuy có nhiều tính năng ưu việt, nhưng việc chọn lựa và mua nồi phù hợp chưa bao giờ là dễ dàng. Cùng điểm qua các chức năng của nồi chiên không dầu Gaabor GA-M6A.\r\n\r\n\r\n\r\nĐẶC ĐIỂM SẢN PHẨM:\r\n\r\n- 360 ° lưu thông không khí nóng ba chiều, làm nóng đồng đều.\r\n\r\n- Núm điều khiển kép nhiệt độ kép, đơn giản và dễ vận hành.\r\n\r\n- Dung tích lớn 6L, dễ dàng đáp ứng cho bữa tối của gia đình.\r\n\r\n- Lòng nồi phủ lớp chống dính, dễ vệ sinh.\r\n\r\n- 8 thực đơn chức năng cho nhiều bữa ăn trong ngày.\r\n\r\n- Chế độ làm nóng: Làm nóng ống sưởi bằng thép không gỉ bằng không khí lưu thông động cơ.\r\n\r\n\r\n\r\nĐIỂM PHỤ TRỢ CỦA SẢN PHẨM:\r\n\r\n- Núm điều khiển kép, dễ nấu.\r\n\r\n- Rổ chiên liền khối chống dính, không lo vệ sinh.\r\n\r\n- Nhiều thực đơn, giúp bạn trở thành đầu bếp ngay lập tức.\r\n\r\n- Bộ nhớ tự động tắt nguồn, tiết kiệm năng lượng, an toàn và yên tâm.\r\n\r\n\r\n\r\nTHAM SỐ SẢN PHẨM:\r\n\r\n- Công suất định mức (W): 1700\r\n\r\n- Điện áp định mức (V): 220~240\r\n\r\n- Tổng trọng lượng sản phẩm (kg): 5.2\r\n\r\n- Công suất định mức (l): 6\r\n\r\n- Màu sắc sản phẩm: Xám\r\n\r\n- Chiều dài dây nguồn (m): 1.1\r\n\r\n- Kích thước sản phẩm (dài * Rộng * Cao mm): 280x350x310\r\n\r\n\r\n\r\nCHẤT LIỆU SẢN PHẨM:\r\n\r\n- Vật liệu phần thân: Vật liệu chính ABS PP.\r\n\r\n- Vật liệu động cơ: Động cơ dây đồng.\r\n\r\n- Vật liệu lót: Phun teflon cho các bộ phận dập tấm cán nguội bên trong.\r\n\r\n\r\n\r\nMÀN HÌNH KIỂM SOÁT:\r\n\r\n- Kiểm soát KNOB: Nút đôi.\r\n\r\n\r\n\r\nPHỤ KIỆN ĐI KÈM:\r\n\r\n- Hướng dẫn (bản sao): 1\r\n\r\n- Túi PE: 1\r\n\r\n- Nguồn cắm điện: VDE\r\n\r\n\r\n\r\nCHẾ ĐỘ BẢO HÀNH:\r\n\r\n- Bảo hành 1 năm.\r\n\r\n- Đổi mới hoàn toàn trong 1 năm nếu lỗi do nhà sản xuất.\r\n\r\n\r\n\r\nNƠI SẢN XUẤT:\r\n\r\n- Trung Quốc.\r\n\r\n\r\n\r\nTHÔNG TIN THƯƠNG HIỆU:\r\n\r\n- Gaabor được thành lập bởi Gabor Lorenz - nhà sản xuất và doanh nhân trong ngành ẩm thực của Đức. Xuất thân là một chuyên gia kỹ thuật trong lĩnh vực nhà bếp, nấu ăn chính là sở thích lớn nhất của Gabor. Tuy nhiên, thao tác chiên, rán phức tạp, để quá trình này đơn giản dễ dàng hơn, và vẫn giữ được hương vị thơm ngon, ông đã kết hợp hệ thống dẫn gió tuần hoàn nóng lạnh Cyclone Air, nghiên cứu ra lò nướng điện, và như vậy được ra mắt thị trường. Gabor hy vọng thương hiệu này sẽ được đưa vào trong các gia đình trẻ, tạo ra thương hiệu đồ điện gia dụng tiện lợi, đem phương pháp nấu ăn dễ dàng đơn giản vào hàng nghìn hộ gia đình. Đây cũng là tư tưởng nòng cốt của Thương hiệu Gaabor - thể hiện và sẻ chia tình yêu. \r\n\r\n\r\n\r\n#Gaabor #noichien #noichienkhongdau #noichienchinhhang', 'images/6282bee9.png', '2022-11-09', 5, NULL, 6),
(24, 'Smart Nanocell Tivi LG 55 Inch 4K 55NANO77TPA ThinQ AI - Model 2021-Miễn phí lắp đặt', 13190000, '8 triệu điểm ảnh cùng thể hiện trong 1 bức tranh\r\nMàu sắc thuần khiết được thể hiện tuyệt đẹp trên màn hình 4K Đích thực với khoảng 8 triệu điểm ảnh, TV 4K đích thực truyền tải hình ảnh sắc nét hơn và chi tiết hơn rõ rệt so với TV UHD thông thường. Với TV NanoCell, độ phân giải 4K đích thực được bổ sung công nghệ NanoCell để mang lại trải nghiệm 4K vượt qua mọi tiêu chuẩn quốc tế.\r\n\r\nMọi màu sắc hiện lên trong veo\r\nTV LG NanoCell sử dụng các hạt nano, công nghệ Nano đặc biệt của riêng chúng tôi, để lọc và tinh chỉnh màu sắc, loại bỏ tín hiệu gây nhiễu khỏi các bước sóng RGB. Nghĩa là, chỉ những màu sắc tinh khiết, chính xác mới được hiển thị trên màn hình. Nhờ đó hình ảnh tạo ra sẽ tươi đẹp hơn, chân thực hơn, giúp nội dung của bạn trở nên sống động.\r\n\r\nKinh ngạc từ mọi góc nhìn\r\nMàu sắc tuyệt đối của TV NanoCell đảm bảo rằng màu sắc được hiển thị chính xác cho hình ảnh trung thực ngay cả khi nhìn từ góc rộng.\r\n\r\nChân đỡ nghệ thuật tinh tế - Gallery Stand\r\nThiết kế tinh tế, thêm gu thẩm mỹ\r\nTác phẩm nghệ thuật đẹp như tranh vẽ không chỉ dành để treo trên các bức tường nữa. Chân đỡ Gallery cho phép bạn tự do đặt TV và biến ngôi nhà của bạn thành một phòng trưng bày hiện đại.\r\n\r\nChất lượng ngang tầm với màn chiếu lớn\r\nPure Colors và một loạt các công nghệ màn hình mới nhất mang cả rạp phim về nhà bạn với LG NanoCell TV. Với công nghệ HDR nâng cao của chúng tôi, các công nghệ được nâng cấp của Dolby, và một chế độ điện ảnh mới vừa được hãng công bố sẽ mang đến trải nghiệm điện ảnh thực sự.\r\n\r\nThông số kỹ thuật\r\n\r\nTHÔNG SỐ TẤM NỀN\r\nLoại màn hình hiển thị: 4K NanoCell\r\nKích thước: 55\r\nĐộ phân giải: 3840 x 2160\r\nNanoCell Color: Có\r\nMotion / Refresh Rate: Refresh Rate 60Hz\r\n\r\nNGUỒN & TIÊU THỤ ĐIỆN\r\nPower Supply	AC 100~240V 50-60Hz\r\nTiêu thụ năng lượng ờ chế độ chờ: Dưới 0.5W\r\nChế độ tiết kiệm năng lượng: Có\r\nCảm biến ánh sáng xanh lá cây: Có\r\n\r\nCÔNG NGHỆ ÂM THANH\r\nLoa (Âm thanh đầu ra): 20W\r\nHệ thống loa: 2.0ch\r\nAI Sound / Pro: AI Sound\r\n\r\nKẾT NỐI\r\nHDMI: 3\r\nHDMI Version: HDMI 2.0\r\nUSB: 2\r\nLAN: Có\r\nHeadphone out: Có\r\nLine out: Có\r\nWifi: Có (802.11ac)\r\nBluetooth: Có (V5.0)\r\n\r\nTRỌNG LƯỢNG & KÍCH THƯỚC\r\nKích thước (Rộng x Cao x Sâu) mm: 1235 x 715 x 58.1\r\nKích thước có chân đế (Rộng x Cao x Sâu) mm: 1235 x 774 x 232\r\nTrọng lượng (kg): 14.8\r\nTrọng lượng có chân đế (kg): 15\r\n\r\nThông tin bảo hành\r\nThời gian bảo hành: 24 tháng\r\nThông tin chi tiết xem tại: https://www.lg.com/vn/tro-giup/bao-hanh\r\n\r\nCông lắp đặt:\r\n\r\n- Miễn phí cho nội thành HCM (Quận 1, 2, 3, 4, 5, 6, 7, 8, 10, 11, Tân Bình, Tân Phú, Phú Nhuận, Bình Thạnh, Gò Vấp, Quận 9, 12, Thủ Đức, Bình Tân, Hóc Môn) và nội thành Hà Nội (Quận Ba Đình, Quận Bắc Từ Liêm, Quận Cầu Giấy, Quận Hà Đông, Quận Hai Bà Trưng, Quận Hoàn Kiếm, Quận Hoàng Mai, Quận Long Biên, Quận Nam Từ Liêm, Quận Tây Hồ, Quận Thanh Xuân, Quận Đống Đa)\r\n- Chi phí vật tư: Nhân viên sẽ thông báo phí vật tư (ống đồng, dây điện v.v...) khi khảo sát lắp đặt (Bảng kê xem tại ảnh 2). Khách hàng sẽ thanh toán trực tiếp cho nhân viên kỹ thuật sau khi việc lắp đặt hoàn thành - chi phí này sẽ không hoàn lại trong bất cứ trường hợp nào.\r\n- Quý khách hàng có thể trì hoãn việc lắp đặt tối đa là 7 ngày lịch kể từ ngày giao hàng thành công (không tính ngày Lễ). Nếu nhân viên hỗ trợ không thể liên hệ được với Khách hàng quá 3 lần, hoặc Khách hàng trì hoãn việc lắp đặt quá thời hạn trên, Dịch vụ lắp đặt sẽ được hủy bỏ.\r\n- Đơn vị vận chuyển giao hàng cho bạn KHÔNG có nghiệp vụ lắp đặt sản phẩm. \r\n- Thời gian bộ phận lắp đặt liên hệ (không bao gồm thời gian lắp đặt): trong vòng 24h kể từ khi nhận hàng (Trừ Chủ nhật/ Ngày Lễ). Trong trường hợp bạn chưa được liên hệ sau thời gian này, vui lòng gọi lên hotline của Shopee (19001221) để được tư vấn.\r\n- Tìm hiểu thêm về Dịch vụ lắp đặt: \r\nhelp.shopee.vn/vn/s/article/Làm-thế-nào-để-tôi-có-thể-sử-dụng-dịch-vụ-lắp-đặt-tại-nhà-cho-các-sản-phẩm-tivi-điện-máy-lớn-1542942683961\r\n\r\n- Quy định đổi trả: Chỉ đổi/trả sản phẩm, từ chối nhận hàng tại thời điểm nhận hàng trong trường hợp sản phẩm giao đến không còn nguyên vẹn, thiếu phụ kiện hoặc nhận được sai hàng. Khi sản phẩm đã được cắm điện sử dụng và/hoặc lắp đặt, và gặp lỗi kĩ thuật, sản phẩm sẽ được hưởng chế độ bảo hành theo đúng chính sách của nhà sản xuất', 'images/46da28c5.png', '2022-11-20', 35, NULL, 4),
(25, 'Tủ Lạnh Inverter Samsung 488L RF48A4000B4/SV (Hàng Chính Hãng 100% Bảo Hành 24 Tháng Tại Nhà)', 16590000, 'THÔNG SỐ KỸ THUẬT:\r\nKiểu tủ: Multi Door - 4 cánh\r\nDung tích sử dụng: 488 lít - Trên 5 người\r\nDung tích tổng: 511 lít\r\nDung tích ngăn đá: 159 lít\r\nDung tích ngăn lạnh: 329 lít\r\nCông suất tiêu thụ công bố theo TCVN: ~ 1.74 kW/ngày\r\nCông nghệ tiết kiệm điện: Digital Inverter\r\nCông nghệ làm lạnh: 2 dàn lạnh độc lập Twin Cooling Plus™\r\nCông nghệ kháng khuẩn, khử mùi: Bộ lọc than hoạt tính Deodorizer\r\nCông nghệ bảo quản thực phẩm: Ngăn rau quả giữ ẩm\r\nTiện ích: Bảng điều khiển bên ngoài\r\nChất liệu cửa tủ lạnh: Thép không gỉ\r\nChất liệu khay ngăn lạnh: Kính chịu lực\r\nKích thước tủ lạnh: Cao 179.3 cm - Rộng 83.3 cm - Sâu 74 cm - Nặng 99 kg\r\nNăm ra mắt: 2021\r\nSản xuất tại: Trung Quốc\r\nHãng: Samsung\r\nBảo hành tại nhà: 24 tháng', 'images/cdcf5a6e.png', '2022-11-20', 35, NULL, 4),
(30, 'Áo POLO nam', 99000, 'Chi tiết sản phẩm : \r\n\r\n???? Chất vải thun cá sấu CVC , co giãn, thoáng mát\r\n\r\n???? Sợi vải kháng khuẩn , chống nhăn, tiết kiệm thời gian vệ sinh và giữ form bền bỉ\r\n\r\n???? Cổ áo được dệt chống giãn\r\n\r\n???? Logo in sử dụng kĩ thuật in lụa không bong tróc , nứt hình\r\n\r\n???? Form áo rộng , tay lỡ , thanh lịch\r\n\r\nSize áo được thiết kế riêng gồm 3 size : M , L ,XL\r\n\r\n\r\n\r\n+ HƯỚNG DẪN BẢO QUẢN SẢN PHẨM \r\n\r\n_ Giặt máy, giặt tay bình thường \r\n\r\n_ Không ngâm áo\r\n\r\n_ Giặt riêng đồ trắng, đồ màu\r\n\r\n_ Không ủi lên hình in\r\n\r\n_ Ủi áo sử dụng nhiệt vừa phải', './images/50cbd28e.png', '2023-08-31', 44, NULL, 1),
(31, 'Áo POLO nam', 90000, 'Chi tiết sản phẩm : \r\n\r\n???? Chất vải thun cá sấu CVC , co giãn, thoáng mát\r\n\r\n???? Sợi vải kháng khuẩn , chống nhăn, tiết kiệm thời gian vệ sinh và giữ form bền bỉ\r\n\r\n???? Cổ áo được dệt chống giãn\r\n\r\n???? Logo in sử dụng kĩ thuật in lụa không bong tróc , nứt hình\r\n\r\n???? Form áo rộng , tay lỡ , thanh lịch\r\n\r\nSize áo được thiết kế riêng gồm 3 size : M , L ,XL\r\n\r\n\r\n\r\n+ HƯỚNG DẪN BẢO QUẢN SẢN PHẨM \r\n\r\n_ Giặt máy, giặt tay bình thường \r\n\r\n_ Không ngâm áo\r\n\r\n_ Giặt riêng đồ trắng, đồ màu\r\n\r\n_ Không ủi lên hình in\r\n\r\n_ Ủi áo sử dụng nhiệt vừa phải', './images/0ef56fe3.png', '2023-08-31', 44, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `token`) VALUES
(5, '123@gmail.com', '123', '7e73d15e3c46d73be92f594f2cbf37c6'),
(34, '567@gmail.com', '123', ''),
(35, '234@gmail.com', '111', ''),
(36, '1234@gmail.com', '123', ''),
(37, 'nbdhhth@gmail.com', '123456', ''),
(44, 'tukhuat19@gmail.com', '123', 'ec1eb2352a585cd8b09cba2a9346590c'),
(48, 'duy@gmail.com', '123', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_inf`
--

CREATE TABLE `user_inf` (
  `stt` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` int(10) NOT NULL,
  `user_adress` varchar(255) NOT NULL,
  `user_sex` varchar(50) NOT NULL,
  `user_ava` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_inf`
--

INSERT INTO `user_inf` (`stt`, `user_id`, `user_name`, `user_phone`, `user_adress`, `user_sex`, `user_ava`) VALUES
(1, 44, 'Khuất Anh Tú                                  ', 393787959, 'Thanh Thủy, Phú Thọ', 'Nữ', './images/img_user/logo-cttdt.png'),
(2, 48, 'Nguyễn Bá Duy', 987654321, 'Hà Nội', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_inf`
--
ALTER TABLE `user_inf`
  ADD PRIMARY KEY (`stt`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_inf`
--
ALTER TABLE `user_inf`
  MODIFY `stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `user_inf`
--
ALTER TABLE `user_inf`
  ADD CONSTRAINT `user_inf_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
