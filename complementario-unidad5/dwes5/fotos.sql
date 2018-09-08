create database fotos;
create user fotos identified by 'afotos';
use fotos;
grant all on fotos.* to fotos;

--
-- Base de datos: fotos
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla fotos
--

CREATE TABLE fotos (
  codigo char(4) NOT NULL,
  descripcion varchar(75) DEFAULT NULL,
  baja varchar(45) NOT NULL,
  alta varchar(45) NOT NULL,
  precio decimal(7,2) NOT NULL
) ENGINE=InnoDB ;

--
-- Volcado de datos para la tabla fotos
--

INSERT INTO fotos (codigo, descripcion, baja, alta, precio) VALUES
('F001', 'Foto 1 de Soria', 'imagenes/soria1muestra.jpg', '../../recursos/tema05/soria1.jpg', '19.35'),
('F002', 'Foto 2 de Soria', 'imagenes/soria2muestra.jpg', '../../recursos/tema05/soria2.jpg', '21.00'),
('F003', 'Foto 3 de Soria', 'imagenes/soria3muestra.jpg', '../../recursos/tema05/soria3.jpg', '11.25'),
('F004', 'Foto 4 de Soria', 'imagenes/soria4muestra.jpg', '../../recursos/tema05/soria4.jpg', '16.00'),
('F005', 'Foto 5 de Soria', 'imagenes/soria5muestra.jpg', '../../recursos/tema05/soria5.jpg', '16.00'),
('F006', 'Foto 6 de Soria', 'imagenes/soria6muestra.jpg', '../../recursos/tema05/soria6.jpg', '19.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla lineas
--

CREATE TABLE lineas (
  identificacion char(26) NOT NULL,
  codigo char(4) NOT NULL
) ENGINE=InnoDB ;

--
-- Volcado de datos para la tabla lineas
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla ventas
--

CREATE TABLE ventas (
  identificacion char(26) NOT NULL,
  nif char(9) NOT NULL,
  nombre varchar(75) NOT NULL,
  direccion varchar(75) NOT NULL,
  confirmado char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB  ;


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla fotos
--
ALTER TABLE fotos
  ADD PRIMARY KEY (codigo);

--
-- Indices de la tabla lineas
--
ALTER TABLE lineas
  ADD PRIMARY KEY (identificacion,codigo),
  ADD KEY identificacion (identificacion),
  ADD KEY codigo (codigo);

--
-- Indices de la tabla ventas
--
ALTER TABLE ventas
  ADD PRIMARY KEY (identificacion);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla lineas
--
ALTER TABLE lineas
  ADD CONSTRAINT lineas_ibfk_1 FOREIGN KEY (identificacion) REFERENCES ventas (identificacion) ON DELETE CASCADE,
  ADD CONSTRAINT lineas_ibfk_2 FOREIGN KEY (codigo) REFERENCES fotos (codigo);

