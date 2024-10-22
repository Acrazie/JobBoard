create database if not exists bddRMM default character set utf8 collate utf8_general_ci;
use bddRMM;

set foreign_key_checks =0;

CREATE TABLE advertisements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(31) NOT NULL,
  description VARCHAR(127) NOT NULL,
  salaries DECIMAL(10, 2) NOT NULL,
  location VARCHAR(63) NOT NULL,
  working_hours VARCHAR(255),
  status VARCHAR(15) NOT NULL,
  type VARCHAR(15) NOT NULL,
  email VARCHAR(255) NOT NULL,
  date DATETIME NOT NULL,
  company_id INT NOT NULL
);

CREATE TABLE companies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(31) NOT NULL,
  sirene VARCHAR(31) UNIQUE NOT NULL
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(63) NOT NULL,
  first_name VARCHAR(31) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  phone VARCHAR(11) NOT NULL,
  password VARCHAR(255) NOT NULL,
  job_title VARCHAR(63),
  profil VARCHAR(31) NOT NULL
);

CREATE TABLE jobsforusers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  userId INT NOT NULL,
  name VARCHAR(63) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(11) NOT NULL,
  message VARCHAR(511),
  advertisementId INT NOT NULL
);
set foreign_key_checks =1;
ALTER TABLE advertisements ADD CONSTRAINT fk_advertisements_company FOREIGN KEY (company_id) REFERENCES companies(id);
ALTER TABLE jobsforusers ADD CONSTRAINT fk_jobsforusers_user FOREIGN KEY (userId) REFERENCES users(id);
ALTER TABLE jobsforusers ADD CONSTRAINT fk_jobsforusers_advertisement FOREIGN KEY (advertisementId) REFERENCES advertisements(id);