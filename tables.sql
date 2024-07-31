CREATE DATABASE learning;

use learning;

CREATE TABLE courses (
	cid INT AUTO_INCREMENT PRIMARY KEY,
	cname VARCHAR(100)
);

CREATE TABLE subjects (
	sjid INT AUTO_INCREMENT PRIMARY KEY,
	cid INT NULL,
	sjname VARCHAR(100),
	type ENUM('core', 'elective'),
	FOREIGN KEY (cid) REFERENCES courses (cid)
);

CREATE TABLE lessons (
	lid INT AUTO_INCREMENT PRIMARY KEY,
	sjid INT,
	ltitle VARCHAR(100),
	ltype ENUM('video', 'PDF', 'docx'),
	lcontent TEXT,
	lform INT,
	FOREIGN KEY (sjid) REFERENCES subjects (sjid)
);

CREATE TABLE staff (
	stid INT AUTO_INCREMENT PRIMARY KEY,
	stfname VARCHAR(20),
	stlname VARCHAR(20),
	stemail VARCHAR(255),
	stpassword TEXT,
	sjid INT NULL,
	strole ENUM('admin', 'teacher'),
	FOREIGN KEY (sjid) REFERENCES subjects (sjid)
);

CREATE TABLE students (
	sid INT AUTO_INCREMENT PRIMARY KEY,
	sfname VARCHAR(20),
	slname VARCHAR(20),
	semail VARCHAR(255),
	cid INT,
	form INT,
	password TEXT,
	FOREIGN KEY (cid) REFERENCES courses (cid)
);

