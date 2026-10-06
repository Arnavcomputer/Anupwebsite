CREATE DATABASE IF NOT EXISTS gyandayini_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gyandayini_academy;

CREATE TABLE IF NOT EXISTS downloads(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(200),file_url TEXT,category VARCHAR(100),class_name VARCHAR(50));
CREATE TABLE IF NOT EXISTS result_rankers(id INT AUTO_INCREMENT PRIMARY KEY,class_name VARCHAR(30) NOT NULL,title VARCHAR(200) NOT NULL,session_name VARCHAR(50),image TEXT NOT NULL,sort_order INT DEFAULT 0,active TINYINT(1) DEFAULT 1,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS tc_records(id INT AUTO_INCREMENT PRIMARY KEY,admission_no VARCHAR(80) UNIQUE NOT NULL,student_name VARCHAR(180),class_name VARCHAR(50),issue_date DATE,tc_file TEXT NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS cbse_links(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(180) NOT NULL,url TEXT NOT NULL,icon VARCHAR(20) DEFAULT '🔗',sort_order INT DEFAULT 0,active TINYINT(1) DEFAULT 1);

SET @has_class_name := (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='downloads' AND COLUMN_NAME='class_name');
SET @sql := IF(@has_class_name=0,'ALTER TABLE downloads ADD COLUMN class_name VARCHAR(50) NULL AFTER category','SELECT 1');
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

SET @i1 := (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='tc_records' AND INDEX_NAME='idx_tc_admission');
SET @sql := IF(@i1=0,'CREATE INDEX idx_tc_admission ON tc_records(admission_no)','SELECT 1'); PREPARE s1 FROM @sql; EXECUTE s1; DEALLOCATE PREPARE s1;
SET @i2 := (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='result_rankers' AND INDEX_NAME='idx_ranker_order');
SET @sql := IF(@i2=0,'CREATE INDEX idx_ranker_order ON result_rankers(active,sort_order)','SELECT 1'); PREPARE s2 FROM @sql; EXECUTE s2; DEALLOCATE PREPARE s2;
SET @i3 := (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='downloads' AND INDEX_NAME='idx_download_category_class');
SET @sql := IF(@i3=0,'CREATE INDEX idx_download_category_class ON downloads(category,class_name)','SELECT 1'); PREPARE s3 FROM @sql; EXECUTE s3; DEALLOCATE PREPARE s3;

INSERT INTO cbse_links(title,url,icon,sort_order,active) VALUES
('CBSE Official Website','https://www.cbse.gov.in/','🏛️',1,1),('CBSE Results','https://results.cbse.nic.in/','📊',2,1),('Pariksha Sangam','https://parikshasangam.cbse.gov.in/ps/frmHO','📝',3,1),('CBSE Academic Website','https://cbseacademic.nic.in/','📚',4,1),('SARAS / Affiliation','https://saras.cbse.gov.in/','🏫',5,1),('DigiLocker Results','https://results.digilocker.gov.in/','🔐',6,1)
ON DUPLICATE KEY UPDATE title=VALUES(title),url=VALUES(url),icon=VALUES(icon),sort_order=VALUES(sort_order),active=VALUES(active);
