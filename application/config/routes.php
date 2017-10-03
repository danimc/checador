<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['principal'] = "principal";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['agregar_empleado'] = "agregarempleado";
$route['modificar_empleado'] = "modificarempleado";
$route['contrasena_empleado'] = "contrasenaempleado";
$route['bitacora'] = "log";
$route['reportes_sistema'] = "reportes";
$route['reportes_sistema_consulta'] = "reportes_consulta";
$route['imprimir_historial'] = "a_test/create_pdf";
$route['imprimir_bitacora'] = "b_test/create_pdf";
$route['imprimir'] = "c_test/create_pdf";
$route['imprimir_detalle'] = "d_test/create_pdf";
$route['imprimir_semanal'] = "e_test/create_pdf";
$route['detalle_checadas'] = "detalle_checadas";
$route['checadas_semanales'] = "checadas_semanales";
$route['total_registros'] = "total_registros";
$route['imprimir_total_registros'] = "f_test/create_pdf";