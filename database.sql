CREATE DATABASE membership_system;
USE membership_system;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50), 
    last_name VARCHAR(50) NOT NULL,
    school_id VARCHAR(20) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(11) NOT NULL,
    role ENUM('admin', 'officer', 'member') NOT NULL DEFAULT 'member',
);

INSERT INTO users (first_name, middle_name, last_name, school_id, username, email, password, phone, role) VALUES
('ad', 'admin', 'admin', '231-00000', 'admin', 'email', '$2a$12$VRDSEX2iwipJLHsNm5dEw.N3X5axdaezTeDJKTeP8gVvbwsMCFhha', '09000000000', 'admin'),
('me', 'm', 'ber', '231-00001', 'member','member', '$2a$12$VO6QAmSz/YL04Q5Y5/Ue/eoKTektX86PT8/UqKHowjtw3ViIVmr5G', '09000000001', 'member');