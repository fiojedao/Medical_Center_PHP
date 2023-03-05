

CREATE DATABASE medical_center;

USE medical_center;

-- Tabla para gestionar los tipos de usuario
CREATE TABLE user_types (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  type_name VARCHAR(100) NOT NULL,
  description VARCHAR(255) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla para gestionar los usuarios
CREATE TABLE users_auth (
  user_id VARCHAR(45) NOT NULL PRIMARY KEY,
  username VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  user_type_id INT NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_type_id) REFERENCES user_types(id)
);

CREATE TABLE users (
  user_id VARCHAR(45) NOT NULL PRIMARY KEY,
  name VARCHAR(45) NOT NULL,
  lastname_one VARCHAR(45) NOT NULL,
  lastname_two VARCHAR(45) NOT NULL,
  genre VARCHAR(20) NOT NULL,
  direccion VARCHAR(255) NOT NULL,
  date_of_bith DATETIME NOT NULL,
  contact VARCHAR(20) NOT NULL,
  emergency_contact VARCHAR(20) NOT NULL,
  blood_type VARCHAR(15) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users_auth(user_id)
);

-- Tabla para gestionar la autenticación de los usuarios
CREATE TABLE user_sessions (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id VARCHAR(45) NOT NULL,
  session_token VARCHAR(100) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users_auth(user_id)
);

-- Tabla para gestionar las preferencias de los usuarios
CREATE TABLE user_preferences (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id VARCHAR(45) NOT NULL,
  preference_name VARCHAR(100) NOT NULL,
  preference_value VARCHAR(100),
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users_auth(user_id)
);

CREATE TABLE medical_specialities (
  code_id VARCHAR(20) NOT NULL,
  name VARCHAR(50) NOT NULL,
  description VARCHAR(250) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (code_id)
);

-- Tabla para gestionar los médicos
CREATE TABLE doctors (
  doctor_id VARCHAR(45) NOT NULL,
  name VARCHAR(100) NOT NULL,
  medical_specialities_code VARCHAR(20) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (doctor_id),
  FOREIGN KEY (medical_specialities_code) REFERENCES medical_specialities(code_id)
);


-- Tabla para gestionar las enfermedades
CREATE TABLE diseases (
  code_id VARCHAR(20) NOT NULL,
  name VARCHAR(100) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (code_id)
);

-- Tabla para gestionar las alergias
CREATE TABLE allergies (
  code_id VARCHAR(20) NOT NULL,
  name VARCHAR(100) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (code_id)
);

-- Tabla para gestionar los registros médicos
CREATE TABLE medical_records (
  medical_records_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id VARCHAR(45),
  doctor_id VARCHAR(45),
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT user_id FOREIGN KEY (user_id) REFERENCES users(user_id),
  CONSTRAINT doctor_id FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id)
);

CREATE TABLE medical_record_diseases (
  user_id VARCHAR(45) NOT NULL,
  medical_record_id INT NOT NULL,
  diseases_code_id VARCHAR(20) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT medical_record_id_diseases FOREIGN KEY (medical_record_id) REFERENCES medical_records(medical_records_id),
  CONSTRAINT diseases_code_id FOREIGN KEY (diseases_code_id) REFERENCES diseases(code_id)
);

CREATE TABLE medical_record_allergies (
  user_id VARCHAR(45) NOT NULL,
  medical_record_id INT NOT NULL,
  allergies_code_id VARCHAR(20) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT medical_record_id_allergies FOREIGN KEY (medical_record_id) REFERENCES medical_records(medical_records_id),
  CONSTRAINT allergies_code_id FOREIGN KEY (allergies_code_id) REFERENCES allergies(code_id)
);

-- Gestiona los registro de medicamentos que utilizara stock
CREATE TABLE medications (
  code VARCHAR(100) PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  dose VARCHAR(255) NOT NULL,
  type VARCHAR(255) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Contiene la información de los medicamentos en existencia
CREATE TABLE stock (
  id INT AUTO_INCREMENT PRIMARY KEY,
  medications_code VARCHAR(100) NOT NULL,
  lot VARCHAR(50) NOT NULL,
  expiration_date DATE NOT NULL,
  description VARCHAR(255) NOT NULL,
  entry_date VARCHAR(255) NOT NULL,
  amount INT NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (medications_code) REFERENCES medications(code)
);

-- Tabla para gestionar los medicamentos
CREATE TABLE medications_user (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  medical_records_id INT NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  medications_code INT NOT NULL,
  stock_id INT NOT NULL,
  FOREIGN KEY (medical_records_id) REFERENCES medical_records(medical_records_id),
  FOREIGN KEY (stock_id) REFERENCES stock(id)
);

-- Tabla para gestionar las cirugias

CREATE TABLE surgeries (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  date DATETIME NOT NULL,
  medical_records_id INT NOT NULL,
  doctor_id VARCHAR(45) NOT NULL,
  status CHAR NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (medical_records_id) REFERENCES medical_records(medical_records_id),
  FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id)
);

-- Tabla para gestionar las citas
CREATE TABLE appointments (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  date DATETIME NOT NULL,
  description VARCHAR(100),
  medical_records_id INT NOT NULL,
  consulting_room VARCHAR(50),
  status CHAR NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (medical_records_id) REFERENCES medical_records(medical_records_id)
);

-- Tabla intermedia para relacionar médicos con citas
CREATE TABLE appointment_doctors (
  appointment_id INT NOT NULL,
  doctor_id VARCHAR(45) NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (appointment_id, doctor_id),
  FOREIGN KEY (appointment_id) REFERENCES appointments(id),
  FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id)
);

-- Tabla consulta medica
CREATE TABLE general_consult (
  id_consult INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  doctor_id VARCHAR(45) NOT NULL,
  description VARCHAR(255) NOT NULL,
  price DECIMAL NOT NULL,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id)
);

CREATE TABLE appointments_times (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  appointments_id INT NOT NULL,
  init_datetime DATETIME NOT NULL,
  end_datetime DATETIME NOT NULL,
  created_date DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  updated_date DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  FOREIGN KEY (appointments_id) REFERENCES appointments(id)
);

/*
-- Indices para mejorar la eficiencia en las búsquedas
CREATE INDEX idx_users_auth_username ON users_auth (username);
CREATE INDEX idx_user_sessions_user_id ON user_sessions (user_id);
CREATE INDEX idx_user_preferences_user_id ON user_preferences (user_id);
CREATE INDEX idx_medical_records_user_id ON medical_records (user_id);
CREATE INDEX idx_allergies_medical_records_id ON allergies (medical_records_id);
CREATE INDEX idx_diseases_medical_records_id ON diseases (medical_records_id);
CREATE INDEX idx_medications_user_medical_records_id ON medications_user (medical_records_id);
CREATE INDEX idx_surgeries_medical_records_id ON surgeries (medical_records_id);
CREATE INDEX idx_appointments_medical_records_id ON appointments (medical_records_id);*/