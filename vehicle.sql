CREATE DATABASE vehicle; 
USE vehicle; 
CREATE TABLE owners ( 
owner_id INT(10) PRIMARY KEY AUTO_INCREMENT, 
full_name VARCHAR(100) NOT NULL UNIQUE, 
id_number VARCHAR(20) NOT NULL UNIQUE, 
address VARCHAR(255), 
phone VARCHAR(20), 
created_at DATETIME(6) DEFAULT CURRENT_TIMESTAMP 
); 
CREATE TABLE vehicles ( 
vehicle_id INT(10) PRIMARY KEY AUTO_INCREMENT, 
license_plate VARCHAR(20) NOT NULL UNIQUE, 
vehicle_type VARCHAR(50), 
brand VARCHAR(50), 
model VARCHAR(50), 
color VARCHAR(30), 
owner_id INT(10), 
created_at DATETIME(6) DEFAULT CURRENT_TIMESTAMP, 
updated_at DATETIME(6) DEFAULT NULL, 
FOREIGN KEY (owner_id) REFERENCES owners(owner_id) ON DELETE SET NULL 
); 
CREATE TABLE violations ( 
violation_id INT(10) PRIMARY KEY AUTO_INCREMENT, 
vehicle_id INT(10), 
violation_date DATETIME(6), 
location VARCHAR(255), 
description TEXT, 
fine_amount DECIMAL(15, 2), 
payment_status VARCHAR(12), 
created_at DATETIME(6) DEFAULT CURRENT_TIMESTAMP, 
updated_at DATETIME(6) DEFAULT NULL, 
FOREIGN KEY (vehicle_id) REFERENCES vehicles(vehicle_id) ON DELETE 
CASCADE 
); 
CREATE TABLE payments ( 
payment_id INT(10) PRIMARY KEY AUTO_INCREMENT, 
violation_id INT(10), 
qr_code VARCHAR(255), 
amount DECIMAL(15, 2), 
payment_date DATETIME(6) DEFAULT NULL, 
status VARCHAR(9), 
created_at DATETIME(6) DEFAULT CURRENT_TIMESTAMP, 
FOREIGN KEY (violation_id) REFERENCES violations(violation_id) ON DELETE 
CASCADE 
); 
CREATE TABLE users ( 
user_id INT(10) PRIMARY KEY AUTO_INCREMENT, 
username VARCHAR(50) NOT NULL UNIQUE, 
password VARCHAR(255) NOT NULL, 
full_name VARCHAR(100), 
email VARCHAR(100) NOT NULL UNIQUE, 
role VARCHAR(6), 
created_at DATETIME(6) DEFAULT CURRENT_TIMESTAMP 
);