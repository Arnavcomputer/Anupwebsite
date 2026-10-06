USE gyandayini_academy;

CREATE TABLE IF NOT EXISTS result_rankers(id INT AUTO_INCREMENT PRIMARY KEY,class_name VARCHAR(30) NOT NULL,title VARCHAR(200) NOT NULL,session_name VARCHAR(50),image TEXT NOT NULL,sort_order INT DEFAULT 0,active TINYINT(1) DEFAULT 1,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS tc_records(id INT AUTO_INCREMENT PRIMARY KEY,admission_no VARCHAR(80) UNIQUE NOT NULL,student_name VARCHAR(180),class_name VARCHAR(50),issue_date DATE,tc_file TEXT NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS cbse_links(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(180) NOT NULL,url TEXT NOT NULL,icon VARCHAR(20) DEFAULT '🔗',sort_order INT DEFAULT 0,active TINYINT(1) DEFAULT 1);
INSERT INTO cbse_links(title,url,icon,sort_order,active) SELECT 'CBSE Official Website','https://www.cbse.gov.in/','🏛️',1,1 WHERE NOT EXISTS (SELECT 1 FROM cbse_links);
INSERT INTO cbse_links(title,url,icon,sort_order,active) VALUES ('CBSE Results','https://results.cbse.nic.in/','📊',2,1),('Pariksha Sangam','https://parikshasangam.cbse.gov.in/ps/frmHO','📝',3,1),('CBSE Academic Website','https://cbseacademic.nic.in/','📚',4,1),('SARAS / Affiliation','https://saras.cbse.gov.in/','🏫',5,1),('DigiLocker Results','https://results.digilocker.gov.in/','🔐',6,1);
