SET NAMES utf8mb4;


CREATE TABLE IF NOT EXISTS admins(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120) NOT NULL,email VARCHAR(190) UNIQUE NOT NULL,password VARCHAR(255) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS settings(`key` VARCHAR(100) PRIMARY KEY,`value` TEXT);
CREATE TABLE IF NOT EXISTS pages(id INT AUTO_INCREMENT PRIMARY KEY,slug VARCHAR(100) UNIQUE,title VARCHAR(200),content LONGTEXT,image TEXT);
CREATE TABLE IF NOT EXISTS facilities(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(200),description TEXT,icon VARCHAR(20),image TEXT,sort_order INT DEFAULT 0);
CREATE TABLE IF NOT EXISTS events(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(200),event_date DATE,location VARCHAR(200),description TEXT,image TEXT);
CREATE TABLE IF NOT EXISTS news(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(200),excerpt TEXT,image TEXT,published_on DATE);
CREATE TABLE IF NOT EXISTS gallery(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(200),image TEXT,category VARCHAR(100));
CREATE TABLE IF NOT EXISTS downloads(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(200),file_url TEXT,category VARCHAR(100),class_name VARCHAR(50));
CREATE TABLE IF NOT EXISTS documents(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(200),description TEXT,file_url TEXT);
CREATE TABLE IF NOT EXISTS enquiries(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(150),mobile VARCHAR(30),email VARCHAR(190),type VARCHAR(100),message TEXT,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS result_rankers(id INT AUTO_INCREMENT PRIMARY KEY,class_name VARCHAR(30) NOT NULL,title VARCHAR(200) NOT NULL,session_name VARCHAR(50),image TEXT NOT NULL,sort_order INT DEFAULT 0,active TINYINT(1) DEFAULT 1,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS tc_records(id INT AUTO_INCREMENT PRIMARY KEY,admission_no VARCHAR(80) UNIQUE NOT NULL,student_name VARCHAR(180),class_name VARCHAR(50),issue_date DATE,tc_file TEXT NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS cbse_links(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(180) NOT NULL,url TEXT NOT NULL,icon VARCHAR(20) DEFAULT '🔗',sort_order INT DEFAULT 0,active TINYINT(1) DEFAULT 1);

INSERT INTO admins(name,email,password) VALUES('GGA Administrator','admin@gga.local','$2y$12$DX1g229WIIm0OaZ9jn1dKOqUKke2qRvRsN/7SAI8PhEg1OW95.Uhy') ON DUPLICATE KEY UPDATE email=email;
-- The password above is intended for the documented demo account: admin123.
-- If your PHP version does not accept it, run: UPDATE admins SET password=PASSWORD_HASH_HERE WHERE email='admin@gga.local';

INSERT INTO settings(`key`,`value`) VALUES
('school_name','Gyandayini Girls’ Academy'),('trust_name','Satya Bhama Educational Trust'),('address','Paramapur, Akelwa, Varanasi – 221302'),('affiliation','A Co-Educational English Medium School, Affiliated to U.P. Government'),('email','gyandayinigirlsacademy@gmail.com'),('phone','9473528689'),('facebook','https://www.facebook.com/gyandayiniacademy'),('instagram','https://www.instagram.com/gyandayiniacademyakelwan/'),('announcement','Welcome to Gyandayini Girls’ Academy — admissions, events and school updates.'),('hero_title','Empowering Every Dream To Grow')
ON DUPLICATE KEY UPDATE value=VALUES(value);

INSERT INTO pages(slug,title,content,image) VALUES
('about-school','About the School','Gyandayini Girls’ Academy is an English medium co-educational school at Paramapur, Akelwa, Varanasi. The school information and menu supplied by the academy are presented here in a clear, student-centred format.','https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1200&q=85'),
('mission-vision','Mission & Vision','Our mission and vision content can be edited by the administrator from the GGA Admin Panel. Replace this text with the academy’s approved official message.','https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1200&q=85'),
('manager-message','Manager Message','The official Manager Message can be entered here from the admin panel.','https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1200&q=85'),
('principal-message','Principal Message','The official Principal Message can be entered here from the admin panel.','https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1200&q=85')
ON DUPLICATE KEY UPDATE title=VALUES(title);

INSERT INTO facilities(title,description,icon,image,sort_order) VALUES
('CCTV Secured Campus','A safety-focused campus environment with monitored common areas.','📹','https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=900&q=85',1),
('Purified RO/Chilled Drinking Water','Clean and accessible drinking-water facility for students.','💧','https://images.unsplash.com/photo-1548839140-29a749e1cf4d?auto=format&fit=crop&w=900&q=85',2),
('Smart Classes','Technology-supported classroom learning and presentations.','🖥️','https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=85',3),
('Free Spoken English','Opportunities to strengthen everyday English communication.','🗣️','https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=900&q=85',4),
('Personality Development Classes','Activities designed to support confidence and communication.','✨','https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=900&q=85',5),
('Indoor & Outdoor Games','Space and opportunities for active play and sports.','🏃','https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=900&q=85',6),
('Transport Facilities Available','School transport support for students and families.','🚌','https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&w=900&q=85',7),
('Art & Craft Classes','Creative activities that encourage imagination and expression.','🎨','https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=900&q=85',8),
('Dance Classes','Structured dance and cultural activity opportunities.','💃','https://images.unsplash.com/photo-1504609773096-104ff2c73ba4?auto=format&fit=crop&w=900&q=85',9),
('Music Classes','Music learning and performance-based activities.','🎵','https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=900&q=85',10),
('Yoga Classes','Yoga activities supporting focus, balance and wellbeing.','🧘','https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=900&q=85',11),
('Computer Classes','Computer learning and digital skills for students.','💻','https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=900&q=85',12);

INSERT INTO events(title,event_date,location,description,image) VALUES
('School Activities & Celebrations','2026-10-15','Gyandayini Girls’ Academy','Add the official event details from the admin panel.','https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1000&q=85'),
('Academic & Co-curricular Activities','2026-11-05','Academy Campus','Manage upcoming activities directly from the admin dashboard.','https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1000&q=85');

INSERT INTO news(title,excerpt,image,published_on) VALUES
('Latest School Update','Publish announcements, achievements and notices from the admin panel.','https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1000&q=85','2026-10-03'),
('Admissions & Enquiry Updates','Keep parents informed about current admission and school office information.','https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=1000&q=85','2026-10-03');

INSERT INTO gallery(title,image,category) VALUES
('Campus','https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1000&q=85','Campus'),
('Learning','https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1000&q=85','Learning'),
('Activities','https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1000&q=85','Activities'),
('Creative Arts','https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=1000&q=85','Arts'),
('Sports','https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=1000&q=85','Sports'),
('School Life','https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1000&q=85','School Life');

INSERT INTO documents(title,description,file_url) VALUES
('Mandatory Public Disclosure','Upload the approved mandatory public disclosure PDF from the admin panel.',''),
('School Affiliation','Upload the school affiliation document.',''),
('Society Registration','Upload the society registration document.',''),
('Recognition Certificate','Upload the recognition certificate.',''),
('NOC','Upload the NOC.',''),
('NBC','Upload the NBC document.',''),
('Fire Safety Certificate','Upload the fire safety certificate.',''),
('Self-Certification Proforma','Upload the self-certification proforma.',''),
('DEO Certificate','Upload the DEO certificate.',''),
('Water, Health & Certificate','Upload the relevant certificate.',''),
('Land Certificate','Upload the land certificate.',''),
('PTA Members','Add approved PTA member information/document.',''),
('Management Committee','Add approved management committee information/document.','');

INSERT INTO downloads(title,file_url,category) VALUES
('TC Admin Login','admin/login.php','Online Service'),
('TC Verification','contact.php','Online Service'),
('Syllabus','','Academic'),
('School Calendar','','Academic');


INSERT INTO cbse_links(title,url,icon,sort_order,active) VALUES
('CBSE Official Website','https://www.cbse.gov.in/','🏛️',1,1),
('CBSE Results','https://results.cbse.nic.in/','📊',2,1),
('Pariksha Sangam','https://parikshasangam.cbse.gov.in/ps/frmHO','📝',3,1),
('CBSE Academic Website','https://cbseacademic.nic.in/','📚',4,1),
('SARAS / Affiliation','https://saras.cbse.gov.in/','🏫',5,1),
('DigiLocker Results','https://results.digilocker.gov.in/','🔐',6,1)
ON DUPLICATE KEY UPDATE title=VALUES(title),url=VALUES(url),icon=VALUES(icon),sort_order=VALUES(sort_order),active=VALUES(active);

CREATE INDEX idx_tc_admission ON tc_records(admission_no);
CREATE INDEX idx_ranker_order ON result_rankers(active,sort_order);
CREATE INDEX idx_download_category_class ON downloads(category,class_name);
