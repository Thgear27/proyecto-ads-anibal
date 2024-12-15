-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: sistema_facturacion_version_tres
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `boletaemitida`
--

DROP TABLE IF EXISTS `boletaemitida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `boletaemitida` (
  `BoletaEmitidaID` int NOT NULL AUTO_INCREMENT,
  `SerieComprobanteID` int NOT NULL,
  `NumeroCorrelativo` int NOT NULL,
  `UsuarioID` int NOT NULL,
  `FechaEmision` date NOT NULL,
  `FechaVencimiento` date NOT NULL,
  `TipoPago` varchar(255) NOT NULL,
  `FormaPago` varchar(255) NOT NULL,
  `Moneda` varchar(255) NOT NULL,
  `ClienteID` int NOT NULL,
  `EstadoDocumento` varchar(255) NOT NULL,
  `OpInafecta` double NOT NULL,
  `OpExonerada` double NOT NULL,
  `OpGratuita` double NOT NULL,
  `OpGravada` double NOT NULL,
  `TotalIGV` double NOT NULL,
  `DescuentoGlobal` double NOT NULL,
  `ImporteTotal` double NOT NULL,
  `Observaciones` varchar(255) NOT NULL,
  PRIMARY KEY (`BoletaEmitidaID`),
  UNIQUE KEY `BoletaEmitidaID` (`BoletaEmitidaID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boletaemitida`
--

LOCK TABLES `boletaemitida` WRITE;
/*!40000 ALTER TABLE `boletaemitida` DISABLE KEYS */;
INSERT INTO `boletaemitida` VALUES (1,4,1,2,'2024-10-20','2024-10-20','Al contado','Efectivo','PEN',1,'Emitida',0,0,0,1680,302.4,0,1982.4,'Venta de productos gravados'),(2,4,2,2,'2024-10-21','2024-10-21','Al contado','Efectivo','PEN',2,'Emitida',0,0,0,186,33.5,0,219.5,'Venta de productos gravados'),(3,4,3,2,'2024-10-22','2024-10-22','Al contado','Efectivo','PEN',3,'Emitida',0,0,0,2220,394.8,0,2614.8,'Venta de productos gravados');
/*!40000 ALTER TABLE `boletaemitida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boletaemitidadetalles`
--

DROP TABLE IF EXISTS `boletaemitidadetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `boletaemitidadetalles` (
  `BoletaEmitidaDetallesID` int NOT NULL AUTO_INCREMENT,
  `BoletaEmitidaID` int NOT NULL,
  `ProductoDetallesID` int NOT NULL,
  `Cantidad` int NOT NULL,
  `PrecioUnitarioVenta` double NOT NULL,
  `ValorUnitarioVenta` double NOT NULL,
  `Descuento` double NOT NULL,
  `Total` double NOT NULL,
  PRIMARY KEY (`BoletaEmitidaDetallesID`),
  UNIQUE KEY `BoletaEmitidaDetallesID` (`BoletaEmitidaDetallesID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boletaemitidadetalles`
--

LOCK TABLES `boletaemitidadetalles` WRITE;
/*!40000 ALTER TABLE `boletaemitidadetalles` DISABLE KEYS */;
INSERT INTO `boletaemitidadetalles` VALUES (1,1,1,10,184.08,156,0,1840.8),(2,1,2,20,7.08,6,0,141.6),(3,2,3,50,3.54,3,0,177),(4,2,4,10,4.25,3.6,0,42.5),(5,3,5,5,14.16,12,0,70.8),(6,3,6,100,25.44,21.6,0,2544);
/*!40000 ALTER TABLE `boletaemitidadetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `ClienteID` int NOT NULL AUTO_INCREMENT,
  `TipoDocumentoIdentidad` varchar(255) NOT NULL,
  `NumeroDocumentoIdentidad` varchar(255) NOT NULL,
  `NombreCompletoORazonSocial` varchar(255) NOT NULL,
  `Telefono` int NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `FechaRegistro` date NOT NULL,
  PRIMARY KEY (`ClienteID`),
  UNIQUE KEY `ClienteID` (`ClienteID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'DNI','45678912','Juan Carlos Gonzales Ramos',998765432,'juangonzales@gmail.com','AV. PRIMAVERA 300, LIMA','2024-10-21'),(2,'DNI','87654321','María Fernanda Torres Vega',987123456,'mariatorres@gmail.com','CALLE BELEN 128, MIRAFLORES','2024-10-20'),(3,'DNI','65432198','José Manuel Castro Vargas',912345678,'josecastro@gmail.com','JR. PUNO 789, SAN BORJA','2024-10-19'),(4,'DNI','12345678','Carla Andrea Silva Quispe',965432187,'carla.silva@gmail.com','CALLE MORALES 425, LA MOLINA','2024-10-18'),(5,'RUC','20546781234','CONSTRUCTORA EL SOL S.A.C.',912345123,'contacto@constructorelsol.com','JR. LAS PALMERAS 530, SAN ISIDRO','2024-10-17'),(6,'RUC','20487654321','INGENIERÍA GLOBAL PERÚ S.A.',921345678,'ventas@globalperu.com','AV. LOS INGENIEROS 150, SAN MIGUEL','2024-10-16'),(7,'RUC','20345678123','PROYEC CONTRATISTAS GENERALES S.A.',987654321,'ventas@proyec.com','AV. LA MARINA 2050, PUEBLO LIBRE','2024-10-15');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprobanterecibido`
--

DROP TABLE IF EXISTS `comprobanterecibido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comprobanterecibido` (
  `ComprobanteRecibidoID` int NOT NULL AUTO_INCREMENT,
  `TipoComprobanteRecibido` varchar(255) NOT NULL,
  `NumeroSerieYCorrelativo` varchar(255) NOT NULL,
  `FechaEmision` date NOT NULL,
  `FechaVencimiento` date NOT NULL,
  `TipoPago` varchar(255) NOT NULL,
  `FormaPago` varchar(255) NOT NULL,
  `Moneda` varchar(255) NOT NULL,
  `ProveedorID` int NOT NULL,
  `Op.Inafecta` double NOT NULL,
  `Op.Exonerada` double NOT NULL,
  `Op.Gratuita` double NOT NULL,
  `Op.Gravada` double NOT NULL,
  `TotalIGV` double NOT NULL,
  `DescuentoGlobal` double NOT NULL,
  `ImporteTotal` double NOT NULL,
  `Observaciones` varchar(255) NOT NULL,
  `Archivo` varchar(255) NOT NULL,
  PRIMARY KEY (`ComprobanteRecibidoID`),
  UNIQUE KEY `ComprobanteRecibidoID` (`ComprobanteRecibidoID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprobanterecibido`
--

LOCK TABLES `comprobanterecibido` WRITE;
/*!40000 ALTER TABLE `comprobanterecibido` DISABLE KEYS */;
INSERT INTO `comprobanterecibido` VALUES (1,'Factura','F001-00012345','2024-11-18','2024-11-18','Al contado','Efectivo','PEN',1,0,0,0,1300,234,0,1534,'Factura de compra de pinturas y discos de corte','F001-00012345.pdf'),(2,'Factura','F002-00012346','2024-11-18','2024-11-18','Al contado','Efectivo','PEN',1,0,0,0,225,40.5,0,265.5,'Factura de compra de lijas para metal y sellador de silicona','F002-00012346.pdf'),(3,'Factura','F003-00022345','2024-11-17','2024-11-17','Al contado','Efectivo','PEN',2,0,0,0,2900,522,0,3422,'Factura de compra de cables volcánicos','F003-00022345.pdf'),(4,'Factura','F004-00022346','2024-11-17','2024-11-17','Al contado','Efectivo','PEN',2,0,0,0,2775,499.5,0,3274.5,'Factura de compra de cables volcánicos y cintas métricas','F004-00022346.pdf'),(5,'Factura','F005-00032345','2024-11-16','2024-11-16','Al contado','Efectivo','PEN',3,0,0,0,2250,405,0,2655,'Factura de compra de pinturas y discos de corte','F005-00032345.pdf'),(6,'Factura','F006-00032346','2024-11-16','2024-11-16','Al contado','Efectivo','PEN',3,0,0,0,600,108,0,708,'Factura de compra de lijas al agua','F006-00032346.pdf'),(7,'Factura','F007-00042345','2024-11-15','2024-11-15','Al contado','Efectivo','PEN',4,0,0,0,8000,1440,0,9440,'Factura de compra de amoladoras y máquinas de carga','F007-00042345.pdf'),(8,'Factura','F008-00042346','2024-11-15','2024-11-15','Al contado','Efectivo','PEN',4,0,0,0,4000,720,0,4720,'Factura de compra de taladros, llantas y bombillas LED','F008-00042346.pdf');
/*!40000 ALTER TABLE `comprobanterecibido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprobanterecibidodetalles`
--

DROP TABLE IF EXISTS `comprobanterecibidodetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comprobanterecibidodetalles` (
  `ComprobanteRecibidoDetallesID` int NOT NULL AUTO_INCREMENT,
  `ComprobanteRecibidoID` int NOT NULL,
  `ProductoDetallesID` int NOT NULL,
  `Cantidad` int NOT NULL,
  `PrecioUnitarioVenta` double NOT NULL,
  `ValorUnitarioVenta` double NOT NULL,
  `Descuento` double NOT NULL,
  `Total` double NOT NULL,
  PRIMARY KEY (`ComprobanteRecibidoDetallesID`),
  UNIQUE KEY `ComprobanteRecibidoDetallesID` (`ComprobanteRecibidoDetallesID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprobanterecibidodetalles`
--

LOCK TABLES `comprobanterecibidodetalles` WRITE;
/*!40000 ALTER TABLE `comprobanterecibidodetalles` DISABLE KEYS */;
INSERT INTO `comprobanterecibidodetalles` VALUES (1,1,1,10,153.4,130,0,1534),(2,1,2,20,5.9,5,0,118),(3,2,3,50,2.95,2.5,0,147.5),(4,2,5,10,11.8,10,0,118),(5,3,6,100,21.24,18,0,2124),(6,3,7,50,29.5,25,0,1475),(7,4,6,150,21.24,18,0,3186),(8,4,14,5,17.7,15,0,88.5),(9,5,8,30,59,50,0,1770),(10,5,9,100,8.85,7.5,0,885),(11,6,4,200,3.54,3,0,708),(12,7,10,5,377.6,320,0,1888),(13,7,11,2,5900,5000,0,11800),(14,8,12,10,413,350,0,4130),(15,8,13,4,177,150,0,708),(16,8,15,20,29.5,25,0,590);
/*!40000 ALTER TABLE `comprobanterecibidodetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizacionemitida`
--

DROP TABLE IF EXISTS `cotizacionemitida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cotizacionemitida` (
  `CotizacionEmitidaID` int NOT NULL AUTO_INCREMENT,
  `SerieComprobanteID` int NOT NULL,
  `NumeroCorrelativo` int NOT NULL,
  `UsuarioID` int NOT NULL,
  `FechaEmision` date NOT NULL,
  `FechaVencimiento` date NOT NULL,
  `TipoPago` varchar(255) NOT NULL,
  `FormaPago` varchar(255) NOT NULL,
  `Moneda` varchar(255) NOT NULL,
  `ClienteID` int NOT NULL,
  `Op.Inafecta` double NOT NULL,
  `Op.Exonerada` double NOT NULL,
  `Op.Gratuita` double NOT NULL,
  `Op.Gravada` double NOT NULL,
  `TotalIGV` double NOT NULL,
  `DescuentoGlobal` double NOT NULL,
  `ImporteTotal` double NOT NULL,
  `Observaciones` varchar(255) NOT NULL,
  `Obra` varchar(255) NOT NULL,
  PRIMARY KEY (`CotizacionEmitidaID`),
  UNIQUE KEY `CotizacionEmitidaID` (`CotizacionEmitidaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizacionemitida`
--

LOCK TABLES `cotizacionemitida` WRITE;
/*!40000 ALTER TABLE `cotizacionemitida` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotizacionemitida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizacionemitidadetalles`
--

DROP TABLE IF EXISTS `cotizacionemitidadetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cotizacionemitidadetalles` (
  `CotizacionEmitidaDetallesID` int NOT NULL AUTO_INCREMENT,
  `CotizacionEmitidaID` int NOT NULL,
  `ProductoDetallesID` int NOT NULL,
  `Cantidad` int NOT NULL,
  `PrecioUnitarioVenta` double NOT NULL,
  `ValorUnitarioVenta` double NOT NULL,
  `Descuento` double NOT NULL,
  `Total` double NOT NULL,
  PRIMARY KEY (`CotizacionEmitidaDetallesID`),
  UNIQUE KEY `CotizacionEmitidaDetallesID` (`CotizacionEmitidaDetallesID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizacionemitidadetalles`
--

LOCK TABLES `cotizacionemitidadetalles` WRITE;
/*!40000 ALTER TABLE `cotizacionemitidadetalles` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotizacionemitidadetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturaemitida`
--

DROP TABLE IF EXISTS `facturaemitida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturaemitida` (
  `FacturaEmitidaID` int NOT NULL AUTO_INCREMENT,
  `SerieComprobanteID` int NOT NULL,
  `NumeroCorrelativo` int NOT NULL,
  `UsuarioID` int NOT NULL,
  `FechaEmision` date NOT NULL,
  `FechaVencimiento` date NOT NULL,
  `TipoPago` varchar(255) NOT NULL,
  `FormaPago` varchar(255) NOT NULL,
  `Moneda` varchar(255) NOT NULL,
  `ClienteID` int NOT NULL,
  `EstadoDocumento` varchar(255) NOT NULL,
  `OpInafecta` double NOT NULL,
  `OpExonerada` double NOT NULL,
  `OpGratuita` double NOT NULL,
  `OpGravada` double NOT NULL,
  `TotalIGV` double NOT NULL,
  `DescuentoGlobal` double NOT NULL,
  `ImporteTotal` double NOT NULL,
  `Observaciones` varchar(255) NOT NULL,
  PRIMARY KEY (`FacturaEmitidaID`),
  UNIQUE KEY `FacturaEmitidaID` (`FacturaEmitidaID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturaemitida`
--

LOCK TABLES `facturaemitida` WRITE;
/*!40000 ALTER TABLE `facturaemitida` DISABLE KEYS */;
INSERT INTO `facturaemitida` VALUES (1,1,1,1,'2024-10-21','2024-10-21','Al contado','Efectivo','PEN',5,'Emitida',0,0,0,18120,3257.6,0,21377.6,'Venta de productos gravados'),(2,1,2,1,'2024-10-18','2024-10-18','Al contado','Efectivo','PEN',6,'Emitida',0,0,0,2700,486,0,3186,'Venta de productos gravados'),(3,1,3,1,'2024-10-15','2024-10-15','Al contado','Efectivo','PEN',7,'Emitida',0,0,0,1320,237.6,0,1557.6,'Venta de productos gravados');
/*!40000 ALTER TABLE `facturaemitida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturaemitidadetalles`
--

DROP TABLE IF EXISTS `facturaemitidadetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturaemitidadetalles` (
  `FacturaEmitidaDetallesID` int NOT NULL AUTO_INCREMENT,
  `FacturaEmitidaID` int NOT NULL,
  `ProductoDetallesID` int NOT NULL,
  `Cantidad` int NOT NULL,
  `PrecioUnitarioVenta` double NOT NULL,
  `ValorUnitarioVenta` double NOT NULL,
  `Descuento` double NOT NULL,
  `Total` double NOT NULL,
  PRIMARY KEY (`FacturaEmitidaDetallesID`),
  UNIQUE KEY `FacturaEmitidaDetallesID` (`FacturaEmitidaDetallesID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturaemitidadetalles`
--

LOCK TABLES `facturaemitidadetalles` WRITE;
/*!40000 ALTER TABLE `facturaemitidadetalles` DISABLE KEYS */;
INSERT INTO `facturaemitidadetalles` VALUES (1,1,10,5,452.32,384,0,2261.6),(2,1,11,2,7080,6000,0,14160),(3,1,12,10,495.6,420,0,4956),(4,2,8,30,70.8,60,0,2124),(5,2,9,100,10.62,9,0,1062),(6,3,13,4,212.4,180,0,849.6),(7,3,15,20,35.4,30,0,708);
/*!40000 ALTER TABLE `facturaemitidadetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privilegio`
--

DROP TABLE IF EXISTS `privilegio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `privilegio` (
  `PrivilegioID` int NOT NULL AUTO_INCREMENT,
  `NombrePrivilegio` varchar(255) NOT NULL,
  PRIMARY KEY (`PrivilegioID`),
  UNIQUE KEY `PrivilegioID` (`PrivilegioID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privilegio`
--

LOCK TABLES `privilegio` WRITE;
/*!40000 ALTER TABLE `privilegio` DISABLE KEYS */;
INSERT INTO `privilegio` VALUES (1,'Emitir cotizacion'),(2,'Emitir documentos comerciales'),(3,'Gestionar productos'),(4,'Generar reportes'),(5,'Gestionar usuarios');
/*!40000 ALTER TABLE `privilegio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `ProductoID` int NOT NULL AUTO_INCREMENT,
  `CodigoProducto` varchar(255) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`ProductoID`),
  UNIQUE KEY `ProductoID` (`ProductoID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'PNT-EXTR-WB-001','Pintura exterior blanca 5 galones'),(2,'DSC-CORT-MET-115','Disco de corte para metal 115 mm'),(3,'LJA-MET-60-012','Lija para metal grano 60'),(4,'AMOL-4P-750W-001','Amoladora 4 pulgadas 750W'),(5,'CARG-MACH-002','Máquina de carga industrial'),(6,'ALM-GALV-14-003','Alambre galvanizado calibre 14'),(7,'CBL-VOLC-3X4-004','Cable volcánico 3x4 mm²'),(8,'PNT-INT-WB-005','Pintura interior color blanco 1 galón'),(9,'DSC-CORT-HOR-125','Disco de corte para hormigón 125 mm'),(10,'LJA-AGUA-220-006','Lija al agua grano 220'),(11,'CBL-VOLC-3X6-007','Cable volcánico 3x6 mm²'),(12,'MAQ-TALADRO-008','Taladro industrial 800W'),(13,'SELL-SILICON-009','Sellador de silicona para exteriores'),(14,'CINT-MEDID-10M-010','Cinta métrica de 10 metros'),(15,'BULB-INDUST-011','Bombilla industrial 100W LED');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productodetalles`
--

DROP TABLE IF EXISTS `productodetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productodetalles` (
  `ProductoDetallesID` int NOT NULL AUTO_INCREMENT,
  `ProductoID` int NOT NULL,
  `UnidadMedida` varchar(255) NOT NULL,
  `ValorUnitarioCompra` double NOT NULL,
  `ValorUnitarioVenta` double NOT NULL,
  `CategoriaFiscal` varchar(255) NOT NULL,
  `ProveedorID` int NOT NULL,
  PRIMARY KEY (`ProductoDetallesID`),
  UNIQUE KEY `ProductoDetallesID` (`ProductoDetallesID`),
  KEY `ProductoID` (`ProductoID`),
  KEY `ProveedorID` (`ProveedorID`),
  CONSTRAINT `productodetalles_ibfk_1` FOREIGN KEY (`ProductoID`) REFERENCES `producto` (`ProductoID`),
  CONSTRAINT `productodetalles_ibfk_2` FOREIGN KEY (`ProveedorID`) REFERENCES `proveedor` (`ProveedorID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productodetalles`
--

LOCK TABLES `productodetalles` WRITE;
/*!40000 ALTER TABLE `productodetalles` DISABLE KEYS */;
INSERT INTO `productodetalles` VALUES (1,1,'Unidad',130,156,'Gravado',1),(2,2,'Unidad',5,6,'Gravado',1),(3,3,'Bolsa',2.5,3,'Gravado',1),(4,10,'Bolsa',3,3.6,'Gravado',1),(5,13,'Unidad',10,12,'Gravado',1),(6,7,'Metro',18,21.6,'Gravado',2),(7,11,'Metro',25,30,'Gravado',2),(8,8,'Unidad',50,60,'Gravado',3),(9,9,'Unidad',7.5,9,'Gravado',3),(10,4,'Unidad',320,384,'Gravado',4),(11,5,'Unidad',5000,6000,'Gravado',4),(12,12,'Unidad',350,420,'Gravado',4),(13,6,'Unidad',150,180,'Gravado',4),(14,14,'Unidad',15,18,'Gravado',2),(15,15,'Unidad',25,30,'Gravado',2);
/*!40000 ALTER TABLE `productodetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedor` (
  `ProveedorID` int NOT NULL AUTO_INCREMENT,
  `NumeroRUC` varchar(255) NOT NULL,
  `RazonSocial` varchar(255) NOT NULL,
  `Telefono` int NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `FechaRegistro` date NOT NULL,
  PRIMARY KEY (`ProveedorID`),
  UNIQUE KEY `ProveedorID` (`ProveedorID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'20200152837','PROVEEDORA INDUSTRIAL LIMA S.A.C.',986124589,'ventas@provlima.com','AV. INDUSTRIAL 980, LIMA','2024-10-21'),(2,'20415823746','CABLES VOLCANICOS DEL PERÚ S.A.',935124589,'info@cablesvolcanicos.com','CALLE LOS MINERALES 256, CALLAO','2024-10-20'),(3,'20354876231','INDUSTRIAS PINTURAS S.A.C.',914789321,'ventas@indpinturas.com','AV. PINTURAS 1050, SURCO, LIMA','2024-10-19'),(4,'20512346789','MAQUINARIAS Y HERRAMIENTAS PERÚ S.A.',987654321,'info@maquinariasperu.com','JR. LOS HÉROES 350, SAN MARTÍN DE PORRES, LIMA','2024-10-18');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referencianotacredito`
--

DROP TABLE IF EXISTS `referencianotacredito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `referencianotacredito` (
  `ReferenciaNotaCreditoID` int NOT NULL AUTO_INCREMENT,
  `NumeroSerie` varchar(255) NOT NULL,
  `NumeroCorrelativo` int NOT NULL,
  `FechaDocumento` date NOT NULL,
  `MotivoNotaCredito` varchar(255) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`ReferenciaNotaCreditoID`),
  UNIQUE KEY `ReferenciaNotaCreditoID` (`ReferenciaNotaCreditoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referencianotacredito`
--

LOCK TABLES `referencianotacredito` WRITE;
/*!40000 ALTER TABLE `referencianotacredito` DISABLE KEYS */;
/*!40000 ALTER TABLE `referencianotacredito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seriecomprobante`
--

DROP TABLE IF EXISTS `seriecomprobante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seriecomprobante` (
  `SerieComprobanteID` int NOT NULL AUTO_INCREMENT,
  `NumeroSerie` varchar(255) NOT NULL,
  PRIMARY KEY (`SerieComprobanteID`,`NumeroSerie`),
  UNIQUE KEY `SerieComprobanteID` (`SerieComprobanteID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seriecomprobante`
--

LOCK TABLES `seriecomprobante` WRITE;
/*!40000 ALTER TABLE `seriecomprobante` DISABLE KEYS */;
INSERT INTO `seriecomprobante` VALUES (1,'F001'),(2,'F002'),(3,'F003'),(4,'B001'),(5,'B002'),(6,'B003'),(7,'NC01'),(8,'NC02'),(9,'NC03');
/*!40000 ALTER TABLE `seriecomprobante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `UsuarioID` int NOT NULL AUTO_INCREMENT,
  `NombreUsuario` varchar(255) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `Nombres` varchar(100) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `DNI` varchar(15) DEFAULT NULL,
  `PreguntaSecreta` varchar(255) DEFAULT NULL,
  `RespuestaSecreta` varchar(255) DEFAULT NULL,
  `FechaCreacion` date NOT NULL,
  `EstadoUsuario` varchar(255) NOT NULL,
  PRIMARY KEY (`UsuarioID`),
  UNIQUE KEY `UsuarioID` (`UsuarioID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'rocaAdmin','passw0rd123','Carlos','Roca Fernández','987654321','admin@edificandolaroca.com','12345678','¿Cómo se llama tu mejor amigo/a de la infancia?','Carlos','2024-10-21','Activo'),(2,'pepeLijas','pepelij4s2024','Pepe','Lijas Ramírez','987654322','pepe@lijasmax.com','12345679','¿Cuál es el nombre de tu primera mascota?','Firulais','2024-10-21','Activo'),(3,'corteMaster','AGUMON2004','Juan','Corte Díaz','987654323','master@cortediscos.com','12345680','¿Cuál es el nombre de tu primera mascota?','Cusco','2024-10-21','Activo'),(4,'lijaKing','kinglijas2024','Luis','Rey Martínez','987654324','king@lijaspro.com','12345681','¿Cuál es tu comida favorita?','Pizza','2024-10-20','Activo'),(5,'silicoman','si1icon321','Silvia','Conam Torres','987654325','man@siliconaspro.com','12345682','¿En qué ciudad naciste?','Arequipa','2024-10-20','Activo'),(6,'pinturaMax','paintM4ster','María','Pintura López','987654326','ventas@pinturasmax.com','12345683','¿En qué ciudad naciste?','Trujillo','2024-10-20','Activo'),(7,'cableVolc','volcable2024','Pedro','Cable Gómez','987654327','info@cablesvolcanicos.com','12345684','¿En qué ciudad naciste?','Lima','2024-10-19','Activo'),(8,'discoMetal','discoM3tal','Diego','Metal Vargas','987654328','ventas@discosmetal.com','12345685','¿En qué ciudad naciste?','Tacos','2024-10-19','Activo'),(9,'amoloPro','amoloPro2024','Ana','Molo Sánchez','987654329','pro@amoladoras.com','12345686','¿En qué ciudad naciste?','Piura','2024-10-19','Activo'),(10,'soldaBoss','s0ldab0ss','Jorge','Solda Pérez','987654330','boss@soldaduras.com','12345687','¿Cuál fue el nombre de tu primer colegio?','San Pedro','2024-10-18','Activo'),(11,'nuevo_nombre_usuario','nueva_contraseña','nuevos_nombres','nuevos_apellidos','nuevo_telefono','nuevo_email','nuevo_dni','nueva_pregunta_secreta','nueva_respuesta_secreta','2024-12-11','Activo');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarioprivilegio`
--

DROP TABLE IF EXISTS `usuarioprivilegio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarioprivilegio` (
  `UsuarioPrivilegioID` int NOT NULL AUTO_INCREMENT,
  `UsuarioID` int NOT NULL,
  `PrivilegioID` int NOT NULL,
  `Habilitado` tinyint DEFAULT '0',
  PRIMARY KEY (`UsuarioPrivilegioID`),
  UNIQUE KEY `UsuarioPrivilegioID` (`UsuarioPrivilegioID`),
  KEY `PrivilegioID` (`PrivilegioID`),
  KEY `UsuarioID` (`UsuarioID`),
  CONSTRAINT `usuarioprivilegio_ibfk_1` FOREIGN KEY (`PrivilegioID`) REFERENCES `privilegio` (`PrivilegioID`),
  CONSTRAINT `usuarioprivilegio_ibfk_2` FOREIGN KEY (`UsuarioID`) REFERENCES `usuario` (`UsuarioID`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarioprivilegio`
--

LOCK TABLES `usuarioprivilegio` WRITE;
/*!40000 ALTER TABLE `usuarioprivilegio` DISABLE KEYS */;
INSERT INTO `usuarioprivilegio` VALUES (26,1,1,1),(27,1,2,1),(28,1,3,1),(29,1,4,1),(30,1,5,1),(32,2,1,0),(33,2,2,0),(34,2,3,1),(35,2,4,1),(36,2,5,0),(38,3,1,0),(39,3,2,1),(40,3,3,1),(41,3,4,0),(42,3,5,1),(44,4,1,0),(45,4,2,1),(46,4,3,0),(47,4,4,1),(48,4,5,1),(50,5,1,1),(51,5,2,1),(52,5,3,1),(53,5,4,0),(54,5,5,0),(56,6,1,0),(57,6,2,0),(58,6,3,0),(59,6,4,0),(60,6,5,0),(62,7,1,0),(63,7,2,1),(64,7,3,0),(65,7,4,0),(66,7,5,0),(68,8,1,0),(69,8,2,0),(70,8,3,0),(71,8,4,1),(72,8,5,1),(74,9,1,1),(75,9,2,0),(76,9,3,0),(77,9,4,0),(78,9,5,1),(80,10,1,1),(81,10,2,0),(82,10,3,1),(83,10,4,0),(84,10,5,0);
/*!40000 ALTER TABLE `usuarioprivilegio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-13  0:21:36
