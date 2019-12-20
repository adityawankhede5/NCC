# NCC

Admin Credentials table:
CREATE TABLE admincred (
	  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email TEXT NOT NULL,
    password TEXT NOT NULL
);

Admin email and password:
INSERT INTO admincred (email, password) VALUES ('nccadmin@nitj.ac.in', 'adminpassword');

Events table
CREATE TABLE events (
	  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date VARCHAR(255),
    beginat VARCHAR(255),
    endat VARCHAR(255),
    venue VARCHAR(255),
    brief VARCHAR(255),
    description TEXT,
    image TEXT
);

Albums table:
CREATE TABLE albums (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    date VARCHAR(255),
    location TEXT,
    imagecount INT
);
