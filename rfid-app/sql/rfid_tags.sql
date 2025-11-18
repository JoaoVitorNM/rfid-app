CREATE DATABASE IF NOT EXISTS rfid_tags;
USE rfid_tags;

CREATE TABLE IF NOT EXISTS tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    student_ref INT NOT NULL,
    rfid_uid VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS access_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tag_id INT,
    reader_location VARCHAR(100) NOT NULL,
    access_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id)
);
