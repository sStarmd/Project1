-- Tabla de Usuarios
CREATE TABLE Usuarios (
    Id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(200) NOT NULL,
    contraseña VARCHAR(250) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    perfil ENUM('director', 'instructor', 'seladores', 'otros') NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado_cuenta ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo'
);

-- Tabla de Ambientes
CREATE TABLE Ambientes (
    Id_ambiente INT AUTO_INCREMENT PRIMARY KEY,
    nombre_ambiente VARCHAR(100) NOT NULL,
    disponible BOOLEAN NOT NULL DEFAULT TRUE
);

-- Tabla de Registro de Entrada
CREATE TABLE registro_entrada (
    id_registro INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora_entrada DATETIME DEFAULT CURRENT_TIMESTAMP,
    nombre_completo_sale VARCHAR(200),
    nombre_completo_entra VARCHAR(200),
    perfil_entra ENUM('director', 'instructor', 'seladores', 'otros'),
    novedades TEXT,
    id_usuario INT,
    id_ambiente INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(Id_usuario),
    FOREIGN KEY (id_ambiente) REFERENCES Ambientes(Id_ambiente)
);

-- Insertar datos de ejemplo
INSERT INTO Usuarios (nombre_completo, contraseña, correo, perfil) VALUES 
('Juan Pérez', '123456', 'juan@example.com', 'instructor'),
('María García', 'password', 'maria@example.com', 'director'),
('Pedro López', 'pass123', 'pedro@example.com', 'seladores');

INSERT INTO Ambientes (nombre_ambiente, disponible) VALUES 
('Sala de Reuniones', TRUE),
('Aula 1', TRUE),
('Aula 2', FALSE);

INSERT INTO registro_entrada (nombre_completo_sale, id_usuario, id_ambiente, novedades) VALUES 
('Ana Gómez', 1, 1, 'Sin novedades');
