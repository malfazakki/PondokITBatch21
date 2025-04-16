-- Create database
CREATE DATABASE IF NOT EXISTS santri_management;
USE santri_management;

-- Create divisions table
CREATE TABLE IF NOT EXISTS divisions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at DATETIME NOT NULL
);

-- Create batches table
CREATE TABLE IF NOT EXISTS batches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    year INT NOT NULL,
    description TEXT,
    created_at DATETIME NOT NULL
);

-- Create students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    address TEXT,
    phone VARCHAR(20),
    email VARCHAR(100),
    batch_id INT,
    division_id INT,
    created_at DATETIME NOT NULL,
    FOREIGN KEY (batch_id) REFERENCES batches(id) ON DELETE SET NULL,
    FOREIGN KEY (division_id) REFERENCES divisions(id) ON DELETE SET NULL
);

-- Insert sample data
INSERT INTO divisions (name, description, created_at) VALUES
('Programming', 'Division for programming and software development', NOW()),
('Multimedia', 'Division for graphic design and multimedia', NOW()),
('Networking', 'Division for computer networking and infrastructure', NOW());

INSERT INTO batches (name, year, description, created_at) VALUES
('Batch 1', 2021, 'First batch of students', NOW()),
('Batch 2', 2022, 'Second batch of students', NOW()),
('Batch 3', 2023, 'Third batch of students', NOW());

INSERT INTO students (name, gender, address, phone, email, batch_id, division_id, created_at) VALUES
('Ahmad Fauzi', 'Male', 'Jakarta', '081234567890', 'ahmad@example.com', 1, 1, NOW()),
('Siti Aminah', 'Female', 'Bandung', '082345678901', 'siti@example.com', 1, 2, NOW()),
('Muhammad Rizki', 'Male', 'Surabaya', '083456789012', 'rizki@example.com', 2, 3, NOW()),
('Nur Hidayah', 'Female', 'Yogyakarta', '084567890123', 'nur@example.com', 2, 1, NOW()),
('Abdul Rahman', 'Male', 'Medan', '085678901234', 'abdul@example.com', 3, 2, NOW());