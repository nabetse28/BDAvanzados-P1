CREATE DATABASE Cartago_courierTEC
GO
USE Cartago_courierTEC
GO


CREATE TABLE Cliente(
CedulaCliente INT NOT NULL,
IdSucursalCliente INT NOT NULL,
NombreCliente VARCHAR(100) NOT NULL,
ApellidosCliente VARCHAR(100) NOT NULL,
NumeroCuentaCliente BIGINT NOT NULL,
TelefonoCliente INT NOT NULL,
IdTipoCliente INT NOT NULL,
ProvinciaCliente VARCHAR(100) NOT NULL,
CorreoCliente VARCHAR(100),
ContrasenaCliente VARCHAR(100)
PRIMARY KEY (CedulaCliente)
);

CREATE TABLE Paquete(
IdPaquete INT PRIMARY KEY IDENTITY(1,1),
IdSucursal INT not null,
FechaRecepcion DATE not null,
FechaRetiro DATE,
CedulaCliente INT not null,
IdCategoriaPaquete INT not null,
IdTipoPaquete INT not null,
Descripcion VARCHAR(200),
PesoPaquete FLOAT not null,
ValorPaquete INT not null,
MontoPagar INT not null,
);


CREATE TABLE CategoriaPaquete(
IdCategoriaPaquete int primary key identity(1,1),
CategoriaPaquete varchar(100) not null
);

CREATE TABLE TipoPaquete(
IdTipoPaquete INT PRIMARY KEY IDENTITY(1,1),
IdCategoriaPaquete INT not null,
TipoPaquete VARCHAR(100) not null
);

CREATE TABLE TipoCliente(
IdTipoCliente INT PRIMARY KEY IDENTITY(1,1),
TipoCliente VARCHAR(20) not null
);

ALTER TABLE Cliente
ADD CONSTRAINT FK_Cliente_TipoCliente_IdTipoCliente
FOREIGN KEY (IdTipoCliente) REFERENCES TipoCliente(IdTipoCliente)

ALTER TABLE Paquete
ADD CONSTRAINT FK_Paquete_Cliente_CedulaCliente
FOREIGN KEY (CedulaCliente) REFERENCES Cliente(CedulaCliente)

ALTER TABLE Paquete
ADD CONSTRAINT FK_Paquete_CategoriaPaquete_IdCategoriaPaquete
FOREIGN KEY (IdCategoriaPaquete) REFERENCES CategoriaPaquete(IdCategoriaPaquete)

ALTER TABLE Paquete
ADD CONSTRAINT FK_Paquete_TipoPaquete_IdTipoPaquete
FOREIGN KEY (IdTipoPaquete) REFERENCES TipoPaquete(IdTipoPaquete)

ALTER TABLE TipoPaquete
ADD CONSTRAINT FK_TipoPaquete_CategoriaPaquete_IdCategoriaPaquete
FOREIGN KEY (IdCategoriaPaquete) REFERENCES CategoriaPaquete(IdCategoriaPaquete)

INSERT INTO CategoriaPaquete VALUES 
('Regular'),
('Especial')

INSERT INTO TipoPaquete VALUES 
(1,'Electronica'),
(1,'Ropa'),
(1,'Juguetes'),
(2,'Hogar,'),
(2,'Comida'),
(2,'Baterias'),
(2,'Quimicos'),
(2,'Herramientas')

INSERT INTO TipoCliente VALUES 
('Bronce'),
('Oro'),
('Platino')

INSERT INTO Cliente VALUES 
(497437624,2,'Roy','Solano',2920789357249069,76370512,1,'Cartago','roy.solano@gmail.com','roy.solano'),
(393517225,2,'Pablo','Ortega',2989286775470136,62346965,1,'Cartago','pablo.ortega@gmail.com','pablo.ortega'),
(312222665,2,'Mateo','Astua',2037092530030187,77155065,1,'Limon','mateo.astua@gmail.com','mateo.astua')

INSERT INTO Paquete VALUES
(2,'2018-09-12',null,497437624,1,1,'Celular OnePlus 6',2,400000,430000),
(2,'2018-09-12','2018-09-13',497437624,2,8,'LLaves Inglesas',5,8000,12000),
(2,'2018-09-12','2018-09-13',393517225,1,2,'Blusa blanca',0.5,11000,15000),
(2,'2018-09-17','2018-09-17',312222665,2,6,'Bateria de Litio',3,21000,24500)
GO

-- Procedimiento almacenado utilizado para registrar un cliente de la sucursal de Cartago
CREATE PROCEDURE SP_INSERT_CLIENTE_SUCURSAL
@CedulaCliente AS INT,
@NombreCliente AS VARCHAR(100),
@ApellidosCliente AS VARCHAR(100),
@NumeroCuentaCliente AS BIGINT,
@TelefonoCliente AS INT,
@IdTipoCliente AS INT,
@ProvinciaCliente AS VARCHAR(100),
@UsuarioCliente AS VARCHAR(100),
@ContraseñaCliente VARCHAR(100)
AS
INSERT INTO Cliente VALUES 
(@CedulaCliente,2,@NombreCliente,@ApellidosCliente,@NumeroCuentaCliente,
@TelefonoCliente,@IdTipoCliente,@ProvinciaCliente,@UsuarioCliente,@ContraseñaCliente)
INSERT INTO [RONNY\PRUEBAS].Central_courierTec.dbo.Cliente VALUES 
(@CedulaCliente,2,@NombreCliente,@ApellidosCliente,@NumeroCuentaCliente,
@TelefonoCliente,@IdTipoCliente,@ProvinciaCliente,@UsuarioCliente,@ContraseñaCliente)
GO


-- Procedimiento almacenado utilizado para registrar paquetes en la sucursal de Cartago
CREATE PROCEDURE SP_CREAR_PAQUETE
@FechaRecepcion AS DATE,
@CedulaCliente AS INT,
@IdCategoriaPaquete AS INT,
@IdTipoPaquete AS INT,
@Descripcion AS VARCHAR(200),
@PesoPaquete AS INT,
@ValorPaquete AS INT,
@MontoPagar AS INT
AS
INSERT INTO Paquete VALUES
(2,@FechaRecepcion,NULL,@CedulaCliente,@IdCategoriaPaquete,@IdTipoPaquete,
@Descripcion,@PesoPaquete,@ValorPaquete,@MontoPagar)
INSERT INTO [RONNY\PRUEBAS].Central_courierTec.dbo.Paquete 
(IdSucursal, FechaRecepcion, FechaRetiro, CedulaCliente, IdCategoriaPaquete, 
IdTipoPaquete, Descripcion, PesoPaquete, ValorPaquete, MontoPagar) VALUES
(2,@FechaRecepcion,NULL,@CedulaCliente,@IdCategoriaPaquete,@IdTipoPaquete,
@Descripcion,@PesoPaquete,@ValorPaquete,@MontoPagar)
GO


-- Procedimiento almacenado que la cantidad de dinero recaudado en la sucursal
CREATE PROCEDURE SP_DINERO_RECAUDADO
AS
SELECT SUM(P.MontoPagar) AS Monto FROM Paquete P
GO


-- Procedimeinto almacenado que muesta la cantidad de paquetes según un cliente
-- específico para un rango de fechas específico
CREATE PROCEDURE SP_CANTIDAD_PAQUETES_PERIODO
@FECHA_INICIAL AS DATE,
@FECHA_FINAL AS DATE
AS 
SELECT C.CedulaCliente, C.NombreCliente, C.ApellidosCliente, COUNT(P.FechaRetiro) AS Cantidad 
FROM Cliente C 
INNER JOIN Paquete P ON P.CedulaCliente = C.CedulaCliente
WHERE (P.FechaRetiro BETWEEN @FECHA_INICIAL AND @FECHA_FINAL)  
GROUP BY C.CedulaCliente, C.NombreCliente, C.ApellidosCliente
ORDER  BY Cantidad DESC
GO


-- Procedimiento almacenado que muestra un listado de la descripcion y 
-- fecha de retiro de los paquetes pertenecientes a un cliente específico
CREATE PROCEDURE SP_DESCRIPCION_FECHARETIRO_PAQUETES_CLIENTE
@CEDCLIENTE AS INT
AS
SELECT P.Descripcion,P.FechaRetiro FROM Paquete P WHERE (P.CedulaCliente=@CEDCLIENTE)
GO 


-- Procedimiento almacenado que muestra el monto promedio pagado por paquete 
-- por cliente para un periodo de fechas específico
CREATE PROCEDURE SP_MONTOPROMEDIO_PAQUETES_PERIODO
@FECHA_INICIAL AS DATE,
@FECHA_FINAL AS DATE
AS 
SELECT C.CedulaCliente, C.NombreCliente, C.ApellidosCliente, AVG(P.MontoPagar) AS Promedio 
FROM Cliente C INNER JOIN Paquete P ON P.CedulaCliente = C.CedulaCliente
WHERE (P.FechaRetiro BETWEEN @FECHA_INICIAL AND @FECHA_FINAL)  
GROUP BY C.CedulaCliente, C.NombreCliente, C.ApellidosCliente
ORDER  BY Promedio DESC
GO


-- Procedimiento almacenado que muestra el monto del paquete para un 
-- tipo de paquete específico para un periodo en particular
CREATE PROCEDURE SP_MONTOPAQUETE_PERIODO
@IDTIPOPAQUETE AS INT,
@FECHA_INICIAL AS DATE,
@FECHA_FINAL AS DATE
AS
SELECT T.TipoPaquete, SUM(P.MontoPagar) AS Monto 
FROM Paquete P INNER JOIN  TipoPaquete T 
ON (T.IdTipoPaquete=@IDTIPOPAQUETE and P.IdTipoPaquete=@IDTIPOPAQUETE)
WHERE (P.FechaRetiro BETWEEN @FECHA_INICIAL AND @FECHA_FINAL)
GROUP BY T.TipoPaquete
ORDER  BY MONTO DESC
GO


-- Procedimiento almacenado ejecutado por un empleado para realiza la venta de un producto que el 
-- cliente llega a retirar a la sucursal
CREATE PROCEDURE SP_VENTA
@IDPAQUETE AS INT
AS 
UPDATE Paquete SET FechaRetiro=CONVERT(date, getdate()) WHERE (IdPaquete=@IDPAQUETE)
GO