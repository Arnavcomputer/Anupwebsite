USE gyandayini_academy;

ALTER TABLE downloads ADD COLUMN class_name VARCHAR(50) NULL AFTER category;

UPDATE downloads SET category='School Calendar', class_name=NULL WHERE LOWER(title) LIKE '%school calendar%';
UPDATE downloads SET category='Syllabus', class_name=NULL WHERE LOWER(title)='syllabus';
