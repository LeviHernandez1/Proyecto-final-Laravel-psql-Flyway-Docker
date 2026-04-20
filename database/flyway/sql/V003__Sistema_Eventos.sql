-- Tabla de Eventos 
CREATE TABLE eventos (
    id_evento SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    lugar VARCHAR(255) NOT NULL,
    capacidad INTEGER NOT NULL CHECK (capacidad > 0),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
COMMENT ON TABLE eventos IS 'Catálogo de eventos y conferencias disponibles';
COMMENT ON COLUMN eventos.id_evento IS 'Identificador único del evento';
COMMENT ON COLUMN eventos.nombre IS 'Nombre o título de la conferencia';

-- Tabla de sesiones 
CREATE TABLE sesiones (
    id_sesion SERIAL PRIMARY KEY,
    id_evento INTEGER NOT NULL,
    fecha DATE NOT NULL,
    horario TIME NOT NULL, -- Hora de inicio solicitado
    ponente VARCHAR(100) NOT NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_evento FOREIGN KEY (id_evento) 
    REFERENCES eventos(id_evento) ON DELETE CASCADE
);
COMMENT ON TABLE sesiones IS 'Desglose de ponencias y horarios por evento';
COMMENT ON COLUMN sesiones.horario IS 'Hora programada para el inicio de la sesión';

-- Registro de asistentes para inscripciones a eventos
CREATE TABLE registro_asistentes (
    id_asistente SERIAL PRIMARY KEY,
    nombre_asistente VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'Invitado' CHECK (role IN ('Invitado', 'Asistente', 'Organizador')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
COMMENT ON TABLE registro_asistentes IS 'Usuarios registrados en el sistema: invitados, asistentes y organizadores';
COMMENT ON COLUMN registro_asistentes.role IS 'Rol del usuario para control de acceso';

-- Tabla de Inscripciones para que los usuarios pueda inscribirse a eventos
CREATE TABLE inscripciones (
    id_inscripcion SERIAL PRIMARY KEY,
    id_asistente INTEGER NOT NULL,
    id_evento INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_asistente FOREIGN KEY (id_asistente) REFERENCES registro_asistentes(id_asistente) ON DELETE CASCADE,
    CONSTRAINT fk_evento_inscrito FOREIGN KEY (id_evento) REFERENCES eventos(id_evento) ON DELETE CASCADE,
    UNIQUE(id_asistente, id_evento) -- Evita duplicados
);
COMMENT ON TABLE inscripciones IS 'Relación de asistencia de usuarios a eventos específicos';


-- Índices para optimizar el Calendario y Búsquedasde eventos
CREATE INDEX idx_eventos_fecha ON eventos(fecha);
CREATE INDEX idx_sesiones_evento ON sesiones(id_evento);
