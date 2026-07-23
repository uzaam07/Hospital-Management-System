-- ============================================
-- Hospital Management System Database
-- Database Name : myhmsdb
-- ============================================

DROP DATABASE IF EXISTS myhmsdb;
CREATE DATABASE myhmsdb;

USE myhmsdb;

-- ============================================
-- ADMIN TABLE
-- ============================================

CREATE TABLE admintb (
    username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(100) NOT NULL
);

INSERT INTO admintb(username,password)
VALUES
('admin','admin123');

-- ============================================
-- PATIENT TABLE
-- ============================================

CREATE TABLE patreg (

    pid INT AUTO_INCREMENT PRIMARY KEY,

    fname VARCHAR(50) NOT NULL,

    lname VARCHAR(50) NOT NULL,

    gender VARCHAR(15) NOT NULL,

    email VARCHAR(100) UNIQUE NOT NULL,

    contact VARCHAR(15) NOT NULL,

    password VARCHAR(255) NOT NULL

);

-- ============================================
-- DOCTOR TABLE
-- ============================================

CREATE TABLE doctb (

    username VARCHAR(50) PRIMARY KEY,

    password VARCHAR(255) NOT NULL,

    email VARCHAR(100),

    spec VARCHAR(100),

    docFees INT,

    contact VARCHAR(15)

);

INSERT INTO doctb
(username,password,email,spec,docFees,contact)
VALUES

('Dr. John',
'doctor123',
'john@gmail.com',
'Cardiologist',
500,
'9876543210'),

('Dr. Smith',
'doctor123',
'smith@gmail.com',
'Dermatologist',
400,
'9876543211'),

('Dr. David',
'doctor123',
'david@gmail.com',
'Neurologist',
700,
'9876543212'),

('Dr. Sarah',
'doctor123',
'sarah@gmail.com',
'Orthopedic',
600,
'9876543213');

-- ============================================
-- APPOINTMENT TABLE
-- ============================================

CREATE TABLE appointmenttb (

    ID INT AUTO_INCREMENT PRIMARY KEY,

    pid INT,

    fname VARCHAR(50),

    lname VARCHAR(50),

    gender VARCHAR(20),

    email VARCHAR(100),

    contact VARCHAR(15),

    doctor VARCHAR(100),

    docFees INT,

    appdate DATE,

    apptime TIME,

    userStatus INT DEFAULT 1,

    doctorStatus INT DEFAULT 1

);

-- ============================================
-- PRESCRIPTION TABLE
-- ============================================

CREATE TABLE prestb (

    ID INT,

    pid INT,

    doctor VARCHAR(100),

    fname VARCHAR(50),

    lname VARCHAR(50),

    appdate DATE,

    apptime TIME,

    disease TEXT,

    allergy TEXT,

    prescription TEXT

);

-- ============================================
-- SAMPLE PATIENTS
-- ============================================

INSERT INTO patreg
(fname,lname,gender,email,contact,password)
VALUES

('Uzaam',
'Shaad',
'Male',
'uzaam@gmail.com',
'9876500000',
'123456'),

('Rahul',
'Kumar',
'Male',
'rahul@gmail.com',
'9876500001',
'123456'),

('Priya',
'Sharma',
'Female',
'priya@gmail.com',
'9876500002',
'123456');

-- ============================================
-- SAMPLE APPOINTMENTS
-- ============================================

INSERT INTO appointmenttb
(pid,fname,lname,gender,email,contact,doctor,docFees,appdate,apptime,userStatus,doctorStatus)
VALUES

(1,
'Uzaam',
'Shaad',
'Male',
'uzaam@gmail.com',
'9876500000',
'Dr. John',
500,
'2026-08-01',
'10:00:00',
1,
1),

(2,
'Rahul',
'Kumar',
'Male',
'rahul@gmail.com',
'9876500001',
'Dr. Smith',
400,
'2026-08-02',
'12:00:00',
1,
1);

-- ============================================
-- SAMPLE PRESCRIPTIONS
-- ============================================

INSERT INTO prestb
(ID,pid,doctor,fname,lname,appdate,apptime,disease,allergy,prescription)
VALUES

(1,
1,
'Dr. John',
'Uzaam',
'Shaad',
'2026-08-01',
'10:00:00',
'Fever',
'None',
'Paracetamol 650mg twice daily'),

(2,
2,
'Dr. Smith',
'Rahul',
'Kumar',
'2026-08-02',
'12:00:00',
'Skin Allergy',
'Dust',
'Cetirizine once daily');

-- ============================================
-- END OF DATABASE
-- ============================================
