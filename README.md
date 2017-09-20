
Sistema de Registro de Asistencias


Requerimientos de software:


PHP
Servidor HTTP Apache
Base de datos MySQL


Requerimientos de hardware:

Computadora equipada con webcam.


A.- Instalación y configuración de la base de datos:

A1.- Crear el usuario de base de datos MySQL y especificar su contraseña. Una vez hecho esto, montar la base de datos en 
MySQL a partir del archivo dump (.sql) que se proporciona y conceder los permisos correspondientes de lectura y escritura 
para la base de datos recién creada para este usuario.


A2.- Tabla usuario : se encuentra vacía y se debe agregar manualmente el registro del usuario administrador del sistema. 
Los valores de las columnas son:

	id_user → 1

	nombre → administrador (o el login que se desee asignar)

	tipo →	 A (A = Administrador, C = Capturista, O = Operador)

	usuario → administrador (o el nombre de usuario a asignar)

	password → el equivalente a la cadena deseada en encriptación MD5

	activo → S (S = Si, N = No)

	fecha_creacion → 0000-00-00 00:00:00 (o poner la fecha y hora actuales si se desea 	apegándose al 
  formato YYYY-MM-DD hh:mm:ss)

	fecha_modificacion → 0000-00-00 00:00:00 (poner la fecha y hora actuales si se desea 	apegándose al 
  formato YYYY-MM-DD hh:mm:ss)

Los demás usuarios del sistema deberán ser agregados manualmente de la manera descrita, no dentro del sistema.

A3.- Tabla calendario: no debe ser modificada, esta tabla proporciona información acerca de las fechas válidas 
en las que los empleados pueden registrar movimientos. Comprende del Viernes 1 de Enero de 2016 al Jueves 20 de Febrero 
de 2025. Excluye Sábados y Domingos. En su campo dia_semana asigna de la siguiente manera:
 
	0 = Lunes 
	1 = Martes 
	2 = Miércoles 
	3 = Jueves 
	4 = Viernes

A4.- Tabla checadores: agregar manualmente un registro con los datos de la computadora donde se instalará el sistema. Los 
valores de las columnas son:


	id_checador → 1

	IP → La IP de la computadora dónde se instalará el sistema.

	Lugar → Lugar u oficina donde se encuentra físicamente la computadora.

	Observaciones → Información adicional.

	activo → S (S = Si, N = No)

	fecha_creacion → 0000-00-00 00:00:00 (o poner la fecha y hora actuales si se desea 	apegandose al 
  	formato YYYY-MM-DD hh:mm:ss)

	fecha_modificacion → 0000-00-00 00:00:00 (poner la fecha y hora actuales si se desea 	apegandose al 
  	formato YYYY-MM-DD hh:mm:ss)


A5.- Tabla checar: se encuentra vacía y es para uso de los procesos del sistema. Almacena automáticamente las checadas de 
los empleados.

A6.- Tabla departamentos: se encuentra vacía y se deben agregar manualmente los departamentos u oficinas a los cuales 
pertenecen los empleados que registren en el sistema. Los valores de las columnas son:


	idDepartamento → 1

	Descripcion → El nombre del departamento u oficina.

	Activo → S (S = Si, N = No)

	Fecha_creacion → 0000-00-00 00:00:00 (o poner la fecha y hora actuales si se desea apegándose al formato 	
  	YYYY-MM-DD hh:mm:ss)


A7.- Tabla empleados: se encuentra vacía y es para uso para los procesos del sistema. Almacena los datos de los empleados 
que registran en el sistema, quienes serán agregados dentro del sistema en la interfaz correspondiente.

A8.- Tabla tbl_log: se encuentra vacía y es para uso para los procesos del sistema. Almacena las incidencias de los 
empleados que registran en el sistema, que serán agregadas automáticamente dentro del sistema.


B.- Instalar los archivos fuente del sistema:

B1.- Dentro del directorio del servidor HTTP Apache, copiar los directorios de los archivos fuente, de manera que el 
nombre del directorio raíz corresponda al recurso que se desea accesar por medio de la URL. Por ejemplo: si se nombra 
al directorio checador, la URL para  accesar al recurso será http://nombre_del_servidor/checador

B2.- Dentro del directorio raíz, entrar a /application/config/config.php, y abrirlo con un editor de texto. Buscar la 
línea $config['base_url'] y especificar la URL con la que se accederá a la aplicación web. Por ejemplo: 

	$config['base_url'] = 'http://nombre_del_servidor/checador'

B3.- Dentro del mismo directorio, abrir el archivo database.php. Buscar la línea 'hostname'  y especificar la IP de la 
computadora que tiene instalada la base de datos MySQL. Por ejemplo:

	hostname' => '192.168.2.3'

	hostname' => 'localhost' (si es base de datos local)

B4.- En el mismo archivo database.php, buscar la línea 'username' y especificar el nombre de usuario de base de datos 
que se especificó en el paso A1. Por ejemplo:

	'username' => 'nombre_de_usuario_bd'

B5.- En el archivo database.php, buscar la línea 'password' y especificar la contraseña de la base de datos que se 
especificó en el paso A1. Por ejemplo:

	'password' => 'contraseña_bd'

B6.- En el archivo database.php, buscar la línea 'database' y especificar el nombre de la base de datos con que se creó 
a partir del archivo dump (.sql) en el paso A1. Por ejemplo:

	'database' => 'nombre_bd_mysql'


C.- Entrar al sistema:

C1.- Abrir un navegador de internet (se recomienda usar Mozilla Firefox) y en la barra de direcciones abrir la URL 
que quedó configurada en el paso B2.

C2.- En la pantalla principal del sistema, entrar con los datos del usuario administrador agregado en el paso A2.

C3.- Si todo está correcto, se debe mostrar la pantalla principal del checador. Especifique que el navegador si puede 
tener acceso a la webcam instalada en el equipo (si es que solicita confirmación).
