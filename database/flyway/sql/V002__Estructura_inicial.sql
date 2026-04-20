CREATE TABLE salas (
    id_sala SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    capacidad INTEGER NOT NULL CHECK (capacidad > 0),
    tipo VARCHAR(20) NOT NULL CHECK (tipo IN ('laboratorio', 'sala', 'auditorio')),
    estado VARCHAR(20) DEFAULT 'S' CHECK (estado IN ('S', 'N')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

COMMENT ON TABLE salas IS 'Catálogo de salas, laboratorios y auditorios disponibles para reservación';

COMMENT ON COLUMN salas.id_sala IS 'Identificador único de la sala';
COMMENT ON COLUMN salas.nombre IS 'Nombre de la sala o laboratorio';
COMMENT ON COLUMN salas.capacidad IS 'Capacidad máxima de personas permitidas';
COMMENT ON COLUMN salas.tipo IS 'Tipo de sala: laboratorio, sala o auditorio';
COMMENT ON COLUMN salas.estado IS 'Indica si la sala se encuentra activo = S, inactivo = N';
COMMENT ON COLUMN salas.created_at IS 'Fecha de creación del registro';
COMMENT ON COLUMN salas.updated_at IS 'Fecha de última actualización del registro';

CREATE TABLE reservaciones (
    id_reservaciones SERIAL PRIMARY KEY,

    id_usuario BIGINT NOT NULL,
    id_sala INTEGER NOT NULL,

    fecha DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,

    estado VARCHAR(20) DEFAULT 'S' CHECK (estado IN ('S', 'N')),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT check_horas CHECK (hora_inicio < hora_fin),

     CONSTRAINT fk_reservaciones_usuario
        FOREIGN KEY (id_usuario)
        REFERENCES usuario(id_usuario)
        ON DELETE CASCADE,

    -- Llave foránea a salas
    CONSTRAINT fk_reservaciones_sala
        FOREIGN KEY (id_sala)
        REFERENCES salas(id_sala)
        ON DELETE CASCADE


);

COMMENT ON TABLE reservaciones IS 'Registro de reservaciones realizadas por los usuarios';

COMMENT ON COLUMN reservaciones.id_reservaciones IS 'Identificador único de la reservación';
COMMENT ON COLUMN reservaciones.id_usuario IS 'Identificador del usuario que realiza la reservación';
COMMENT ON COLUMN reservaciones.id_sala IS 'Identificador de la sala reservada';
COMMENT ON COLUMN reservaciones.fecha IS 'Fecha en la que se realiza la reservación';
COMMENT ON COLUMN reservaciones.hora_inicio IS 'Hora de inicio de la reservación';
COMMENT ON COLUMN reservaciones.hora_fin IS 'Hora de fin de la reservación';
COMMENT ON COLUMN reservaciones.estado IS 'Indica si la reservación se encuentra activo = S, inactivo = N';
COMMENT ON COLUMN reservaciones.created_at IS 'Fecha de creación del registro';
COMMENT ON COLUMN reservaciones.updated_at IS 'Fecha de última actualización del registro';

CREATE INDEX idx_reservaciones_sala_fecha
ON reservaciones(id_sala, fecha);


INSERT INTO salas (nombre, capacidad, tipo) VALUES
('Laboratorio Redes', 30, 'laboratorio'),
('Laboratorio Programación', 25, 'laboratorio'),
('Sala de Estudio 1', 10, 'sala'),
('Sala de Estudio 2', 12, 'sala'),
('Sala de Juntas', 15, 'sala'),
('Auditorio Principal', 100, 'auditorio'),
('Auditorio Secundario', 60, 'auditorio'),
('Laboratorio Electrónica', 20, 'laboratorio'),
('Sala Multimedia', 18, 'sala'),
('Laboratorio IA', 22, 'laboratorio');

