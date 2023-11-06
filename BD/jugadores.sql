
CREATE TABLE usuarios (
    usuario VARCHAR(50) NOT NULL,
    contraseña VARCHAR(50) NOT NULL,
    rol VARCHAR(50) NOT NULL,
    PRIMARY KEY (usuario)
);


CREATE TABLE jugadores (
    id INT AUTO_INCREMENT,
    nombre VARCHAR(100),
    valor INT,
    posición VARCHAR(50),
    goles INT,
    nombre_imagen VARCHAR(100),
    imagen BLOB,
    PRIMARY KEY (id)
);
INSERT INTO usuarios (usuario, contraseña, rol) VALUES
    ('hugoM', 'FernandoTorres16', 'admin'),
    ('ana', 'anitaVita', 'invitado'),
    ('DaniRome', 'BayWatch21', 'invitado'),
    ('papaAlfre', 'cocococo', 'admin');