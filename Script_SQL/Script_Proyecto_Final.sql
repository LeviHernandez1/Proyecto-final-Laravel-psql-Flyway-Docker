
SELECT * FROM usuario;

SELECT * FROM roles;

SELECT * FROM bitacora;

-- Tablas creadas desde  para el proyecto final V003__Sistema_Eventos.sql

SELECT * FROM eventos;
SELECT * FROM sesiones;
SELECT * FROM registro_asistentes;
SELECT * FROM inscripciones;
SELECT * FROM roles;

SELECT * FROM flyway_schema_history;

-- Incertamos datos
-- Insertar Eventos de prueba
INSERT INTO eventos (nombre, fecha, lugar, capacidad) VALUES
('Congreso de Ingeniería Civil UNAM', '2026-05-15', 'Auditorio Javier Barros Sierra', 300),
('Taller de Laravel y Livewire', '2026-06-01', 'Laboratorio de Cómputo DGTIC', 40),
('Seminario de Estructuras Resilientes', '2026-07-10', 'Sala de Videoconferencias', 100);

-- Insertar Sesiones para el primer evento
INSERT INTO sesiones (id_evento, fecha, horario, ponente) VALUES
(1, '2026-05-15', '09:00:00', 'Ing. Levi Hernández'),
(1, '2026-05-15', '11:30:00', 'Dra. Elena García');

-- Insertar un Asistente de prueba
INSERT INTO registro_asistentes (nombre_asistente, email, password, role) VALUES
('Usuario Prueba', 'prueba@ejemplo.com', 'password_hash_aqui', 'Asistente');

/* Consulta de permisos */
SELECT r.name as rol, p.name as permiso 
FROM roles r
JOIN role_has_permissions rhp ON r.id = rhp.role_id
JOIN permissions p ON p.id = rhp.permission_id;