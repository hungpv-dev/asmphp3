SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `administrative_regions` (
                                          `id` int(11) NOT NULL,
                                          `name` varchar(255) NOT NULL,
                                          `name_en` varchar(255) NOT NULL,
                                          `code_name` varchar(255) DEFAULT NULL,
                                          `code_name_en` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `administrative_units` (
                                        `id` int(11) NOT NULL,
                                        `full_name` varchar(255) DEFAULT NULL,
                                        `full_name_en` varchar(255) DEFAULT NULL,
                                        `short_name` varchar(255) DEFAULT NULL,
                                        `short_name_en` varchar(255) DEFAULT NULL,
                                        `code_name` varchar(255) DEFAULT NULL,
                                        `code_name_en` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `districts` (
                             `code` varchar(20) NOT NULL,
                             `name` varchar(255) NOT NULL,
                             `name_en` varchar(255) DEFAULT NULL,
                             `full_name` varchar(255) DEFAULT NULL,
                             `full_name_en` varchar(255) DEFAULT NULL,
                             `code_name` varchar(255) DEFAULT NULL,
                             `province_code` varchar(20) DEFAULT NULL,
                             `administrative_unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `provinces` (
                             `code` varchar(20) NOT NULL,
                             `name` varchar(255) NOT NULL,
                             `name_en` varchar(255) DEFAULT NULL,
                             `full_name` varchar(255) NOT NULL,
                             `full_name_en` varchar(255) DEFAULT NULL,
                             `code_name` varchar(255) DEFAULT NULL,
                             `administrative_unit_id` int(11) DEFAULT NULL,
                             `administrative_region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `wards` (
                         `code` varchar(20) NOT NULL,
                         `name` varchar(255) NOT NULL,
                         `name_en` varchar(255) DEFAULT NULL,
                         `full_name` varchar(255) DEFAULT NULL,
                         `full_name_en` varchar(255) DEFAULT NULL,
                         `code_name` varchar(255) DEFAULT NULL,
                         `district_code` varchar(20) DEFAULT NULL,
                         `administrative_unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `administrative_regions`
    ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `administrative_units`
--
ALTER TABLE `administrative_units`
    ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `districts`
--
ALTER TABLE `districts`
    ADD PRIMARY KEY (`code`),
  ADD KEY `idx_districts_province` (`province_code`),
  ADD KEY `idx_districts_unit` (`administrative_unit_id`);

--
-- Chỉ mục cho bảng `provinces`
--
ALTER TABLE `provinces`
    ADD PRIMARY KEY (`code`),
  ADD KEY `idx_provinces_region` (`administrative_region_id`),
  ADD KEY `idx_provinces_unit` (`administrative_unit_id`);

--
-- Chỉ mục cho bảng `wards`
--
ALTER TABLE `wards`
    ADD PRIMARY KEY (`code`),
  ADD KEY `idx_wards_district` (`district_code`),
  ADD KEY `idx_wards_unit` (`administrative_unit_id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `districts`
--
ALTER TABLE `districts`
    ADD CONSTRAINT `districts_administrative_unit_id_fkey` FOREIGN KEY (`administrative_unit_id`) REFERENCES `administrative_units` (`id`),
  ADD CONSTRAINT `districts_province_code_fkey` FOREIGN KEY (`province_code`) REFERENCES `provinces` (`code`);

--
-- Các ràng buộc cho bảng `provinces`
--
ALTER TABLE `provinces`
    ADD CONSTRAINT `provinces_administrative_region_id_fkey` FOREIGN KEY (`administrative_region_id`) REFERENCES `administrative_regions` (`id`),
  ADD CONSTRAINT `provinces_administrative_unit_id_fkey` FOREIGN KEY (`administrative_unit_id`) REFERENCES `administrative_units` (`id`);

--
-- Các ràng buộc cho bảng `wards`
--
ALTER TABLE `wards`
    ADD CONSTRAINT `wards_administrative_unit_id_fkey` FOREIGN KEY (`administrative_unit_id`) REFERENCES `administrative_units` (`id`),
  ADD CONSTRAINT `wards_district_code_fkey` FOREIGN KEY (`district_code`) REFERENCES `districts` (`code`);
COMMIT;
