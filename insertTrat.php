<?php
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (101,'Consulta p/solucionar un p/especifico', 'Consultas', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (102,'Consulta control periodico, ref.motiv', 'Consultas', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (104,'Consulta fuera de horario', 'Consultas', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (105,'Consulta fuera de horario extraccion a pedido', 'Consultas', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (105,'Consulta a domicilio o centro hospitalario', 'Consultas', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (201,'Educacion para la salud, control de placa, tecnica de cepillado. control de dieta', 'Odontologia Preventiva', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (202,'Fluor topico de alta concentracion', 'Odontologia Preventiva', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (203,'Sellante de fisura por pieza', 'Odontologia Preventiva', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (204,'Tecnica de Massier por cuadrante', 'Odontologia Preventiva', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (205,'Remineralizantes de esmalte (barniz, cariostatico) por pieza', 'Odontologia Preventiva', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (301,'Tratamiento pulpar en dientes caducos c.p/v', 'Odontopediatria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (302,'Tratamiento pulpar en dientes caducos c.p/n', 'Odontopediatria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (305,'Resina de pto. combinada con sellante de', 'Odontopediatria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (309,'Corona de acero prefrabricada', 'Odontopediatria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (310,'Corona estampada', 'Odontopediatria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (401,'Extraccion simple', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (412,'Extraccion con odontoseccion', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (402,'Extraccion a colgajo (consecutiva a la complicacion de extraccion simple)', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (403,'Extraccion a retenido submucoso', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (404,'Extraccion retenido intraoseo en p / normal', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (406,'Regularizacion alveolar (hasta 3 piezas)', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (407,'Regularizacion alveolar (mas 3 piezas)', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (408,'Frenectomia)', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (409,'Descubierta submucosa', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (410,'Apicectomia (sin endodoncia)', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (411,'Reimplante (sin endodoncia)', 'Cirugia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (501,'Proteccion pulpar directa', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (502,'Biopulpotomia', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (503,'Necropulpotomia', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (516,'Necropulpotomia con obturacion de un conducto', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (521,'Biopulpotomia y necrosis sin foco unirradicular', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (518,'Biopulpotomia y necrosis sin foco birradicular', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (519,'Biopulpotomia y necrosis sin foco en primer molar', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (520,'Biopulpotomia y necrosis sin foco en segundo molar', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (506,'Necrosis con foco apical en anteriores', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (509,'Necrosis con foco apical en premolares', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (512,'Necrosis con foco apical en primer molar', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (522,'Necrosis con foco apical en segundo molar', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (517,'Desobturar un conducto', 'Endodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (601,'Amalgama de punto', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (602,'Amalgama simple', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (603,'Amalgama compuesta', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (622,'Amalgama compleja', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (604,'Ionomero sin tallado', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (605,'Restauracion plastica estetica de punto', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (606,'Restauracion plastica estetica simple', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (607,'Restauracion plastica estetica compuesta', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (608,'Restauracion plastica estetica compleja', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (610, 'Incrustacion', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (633,'Incrustacion a perno', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (612,'Perno muñon METALICO', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (643,'Perno muñon en fibra', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (645,'Perno prefabricado', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (630,'Block de resistencia articulado', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (634,'Jacket de acrilico', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (636,'Incrustacion o carilla de ceromero', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (644,'Jacket o corona de ceromero', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (635,'Jacket o corona de ceramo-metalica', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (642,'Jacket o corona de ceramo-metalica a perno', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (640,'Jacket o corona ceramica libre de metal', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (639,'Veener', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (638,'Veener a perno', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (619,'Placa neuro mio relajante', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (631,'Cementado', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (632,'Construccion de provisorio', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (623,'Remocion de incrustracion', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (627,'Blanqueamiento en arcada superior e inferior', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (629,'Blanqueamiento unimaxilar', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (628,'Blanqueamiento no vital (por pieza)', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (637,'Protectores bucales para deportes', 'Operatoria', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (701,'Profilaxis y enseñanza de higiene especifica', 'Periodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (702,'Raspaje subginginal y curetaje (c. 3 piezas)', 'Periodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (703,'Detartraje supragingival (por arcada)', 'Periodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (704,'Gingivectomia', 'Periodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (705,'Presentacion del caso, diagnostico', 'Periodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (706,'Tratamiento quirurgico de blosa por pieza', 'Periodoncia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (812,'Protesis completa superior (*)', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (814,'Protesis completa inferior (*)', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (830,'Rebasado clinico', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (831,'Rebasado con etapa del laboratorio', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (829,'Protesis inmediata (Sin acto quirurgico ni rebasado)', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (804,'Protesis parcial en acrilico 4 piezas', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (805,'Cada pieza adicional', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (832,'Parcial esqueleto cr-co dentosoportada', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (821,'Parcial esqueleto cr-co a extremo libre', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (835,'Protesis Cr-Co combinado con poliamida', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (822,'Protesis flexible', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (818,'Compostura y agregado clinico (sin lab.)', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (833,'Agregado que requiere laboratorio', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (834,'Compostura que requiere laboratorio', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (825,'Protesis fija retenedor de metal o metal-acrilico', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (828,'Protesis fija tramo intermedio metal-acrilico', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (824,'Protesis fija retenedor ceromero sobre fibra de vidrio', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (827,'Protesis fija tramo intermedio ceromero sobre fibra de vidrio', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (823,'Protesis fija retenedor ceramica', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (826,'Protesis fija tramo intermedio ceramica', 'Prostodoncia fija y removible', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (901,'Radiografia simple', 'Radiologia', 100)"); // inserts value into table users
mysqli_query($link,"insert into tipostrat (id, nombre, categoria, precio) values (902,'Radiografia Bite Wing (2 placas)', 'Radiologia', 100)"); // inserts value into table users
Print '<script>window.location.assign("inicio.php");</script>';
?>