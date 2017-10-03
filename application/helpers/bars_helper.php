<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if(!isset($_SESSION)){
    session_start();
}


if (!function_exists('helper')) {
	function helper(){

		$CI = & get_instance();
        $base_url = config_item('base_url');
        $nombre = $CI->session->userdata("nombre");
        $tipo = $CI->session->userdata("tipo");

		return '<div class="page-header-inner container">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="' . $base_url . '">
			<img src="assets/logo.png" alt="logo"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
			<img alt="" src="assets/img/sidebar_inline_toggler_icon_blue.jpg"/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->

				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="assets/img/avatar.png"/>
					<span class="username username-hide-on-mobile">
					'.$nombre.' </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<!--<li>
							<a href="extra_profile.html">
							<i class="icon-user"></i> Perfil </a>
						</li>

						<li class="divider">-->
						</li>
						<li>
							<a href="autenticacion/cerrar_sesion">
							<i class="icon-logout"></i> Salir </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
		</div>
		<div id="loader" class="modal fade modal-overflow" role="dialog"  data-backdrop="static">
	       <div class="modal-dialog modal-sm">
	           <div class="modal-content">
	               <div class="modal-body" style="background-color: #fff; color: blue;">
	                   <center><img src="assets/img/ajax-modal-loading.gif"></center>
	                   <center><h2>Cargando...</h2></center>
	               </div>
	           </div>
	        </div>
       	</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>';
	}
}

if (!function_exists('main_menu')) {
	function main_menu() {
		$CI = & get_instance();
        $base_url = config_item('base_url');
        $usuario = $CI->session->userdata("usuario");
        $tipo = $CI->session->userdata("tipo");



        $operador = ' <!-- BEGIN SIDEBAR MENU -->
					<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
					<li class="sidebar-search-wrapper">
						<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

						<!-- END RESPONSIVE QUICK SEARCH FORM -->
					</li>
					<li class="tooltips active" data-container="body" data-placement="right" data-html="true" data-original-title="AngularJS version demo">
						<a href="' . $base_url . '">
						<i class="icon-clock"></i>
						<span class="title">
						Checador </span>
						</a>
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->';



/* <li class="nav-item start active">
                       <a class="nav-link nav-toggle" href="javascript:;">
                           <i class="glyphicon glyphicon-education"></i>
                           <span class="title">Alumnos</span>
                       </a>
                       <ul class="sub-menu" style="display: none;" id="men_alumnos">
                           <li class="nav-item start ">
                               <a class="nav-link " href="' . $base_url . 'captura_alumnos">
                                   <i class="icon-user"></i>
                                   <span class="title">Captura Alumnos</span>
                               </a>
                           </li>
                           <li class="nav-item start ">
                               <a class="nav-link " href="' . $base_url . 'listado_alumnos_escuelas">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Listado Alumnos</span>
                               </a>
                           </li>
                       </ul>
                   </li>

*/

		$admin = ' <!-- BEGIN SIDEBAR MENU -->
					<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
					<li class="sidebar-search-wrapper">
						<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

						<!-- END RESPONSIVE QUICK SEARCH FORM -->
					</li>
					<li class="tooltips active" data-container="body" data-placement="right" data-html="true" data-original-title="Pantalla Checador">
						<a href="' . $base_url . '">
						<i class="icon-clock"></i>
						<span class="title">
						Checador </span>
						</a>
					</li>
					<li class="nav-item start active">
                       <a class="nav-link nav-toggle" href="javascript:;">
                           <i class="icon-users"></i>
                           <span class="title">Empleados</span>
                       </a>
                       <ul class="sub-menu group-menu" style="display: none;" id="men_empleado">
                           <li class="nav-item start tooltips" data-original-title="Listado de Empleados">
                               <a class="nav-link " href="' . $base_url . 'empleados">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Lista de Empleados</span>
                               </a>
                           </li>
                           <li class="nav-item start tooltips" data-original-title="Agregar Empleados">
                               <a class="nav-link " href="' . $base_url . 'agregar_empleado">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Alta de Empleado</span>
                               </a>
                           </li>
                           <li class="nav-item start tooltips" data-original-title="Modificar Empleados">
                               <a class="nav-link " href="' . $base_url . 'modificar_empleado">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Modificar Empleado</span>
                               </a>
                           </li>
                       </ul>
                   </li>


					<li class="nav-item start active">
                       <a class="nav-link nav-toggle" href="javascript:;">
                           <i class="icon-note"></i>
                           <span class="title">Incidencias</span>
                       </a>
                       <ul class="sub-menu group-menu" style="display: none;" id="men_justifica">
                           <li class="nav-item start tooltips" data-original-title="Justificaciones">
                               <a class="nav-link " href="' . $base_url . 'justificaciones">
                                   <i class="icon-notebook"></i>
                                   <span class="title">justificaciones</span>
                               </a>
                           </li>
                           <li class="nav-item start tooltips" data-original-title="Justificacion de Empleado">
                               <a class="nav-link " href="' . $base_url . 'justifica_empleado">
                                   <i class="icon-notebook"></i>
                                   <span class="title">justificaciones de Empleado</span>
                               </a>
                           </li>
                           <li class="nav-item start tooltips" data-original-title="Días Económicos">
                               <a class="nav-link " href="' . $base_url . 'economicos">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Días Económicos</span>
                               </a>
                           </li>
                       </ul>
                   </li>


					<li class="nav-item start active">
                       <a class="nav-link nav-toggle" href="javascript:;">
                           <i class="icon-notebook"></i>
                           <span class="title">Reportes</span>
                       </a>
                       <ul class="sub-menu group-menu" style="display: none;" id="men_reportes">
                           <li class="nav-item start tooltips" data-original-title="Reportes de Checadas">
                               <a class="nav-link " href="' . $base_url . 'reportes_sistema">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Reportes de Checadas</span>
                               </a>
                           </li>
                           <li class="nav-item start tooltips" data-original-title="Detalles de Checadas">
                               <a class="nav-link " href="' . $base_url . 'detalle_checadas">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Detalles de Checadas</span>
                               </a>
                           </li>
                           <li class="nav-item start tooltips" data-original-title="Checadas Semanales">
                               <a class="nav-link " href="' . $base_url . 'checadas_semanales">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Checadas Semanales</span>
                               </a>
                           </li>
                          	<li class="nav-item start tooltips" data-original-title="Total de Registros">
                               <a class="nav-link " href="' . $base_url . 'total_registros">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Total de Registros</span>
                               </a>
                           </li>
                          <li class="nav-item start tooltips" data-original-title="Días Económicos">
                               <a class="nav-link " href="' . $base_url . 'dias_economicos">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Días Económicos</span>
                               </a>
                           </li>
                       </ul>
                   </li>


					<li class="nav-item start active">
                       <a class="nav-link nav-toggle" href="javascript:;">
                           <i class="icon-note"></i>
                           <span class="title">Administración</span>
                       </a>
                       <ul class="sub-menu group-menu" style="display: none;" id="men_administra">
                           <li class="nav-item start tooltips" data-original-title="Contraseñas de Empleados">
                               <a class="nav-link " href="' . $base_url . 'contrasena_empleado">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Contraseñas</span>
                               </a>
                           </li>
                           <li class="nav-item start tooltips" data-original-title="Bitacora de Cambios">
                               <a class="nav-link " href="' . $base_url . 'bitacora">
                                   <i class="icon-notebook"></i>
                                   <span class="title">Bitacora Empleado</span>
                               </a>
                           </li>
                       </ul>
                   </li>

				</ul>
				<!-- END SIDEBAR MENU -->';

		$consulta = ' <!-- BEGIN SIDEBAR MENU -->
					<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
					<li class="sidebar-search-wrapper">
						<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

						<!-- END RESPONSIVE QUICK SEARCH FORM -->
					</li>
					<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Bitacora">
						<a href="' . $base_url . 'bitacora">
						<i class="icon-note"></i>
						<span class="title">
						Bitacora </span>
						</a>
					</li>
					<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Reportes de Checadas">
						<a href="' . $base_url . 'reportes_sistema_consulta">
						<i class="icon-notebook"></i>
						<span class="title">
						Reportes de Checadas</span>
						</a>
					</li>
					<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Detalle de Checadas">
						<a href="' . $base_url . 'detalle_checadas">
						<i class="icon-notebook"></i>
						<span class="title">
						Detalles </span>
						</a>
					</li>
					<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Checadas Semanales">
						<a href="' . $base_url . 'checadas_semanales">
						<i class="icon-notebook"></i>
						<span class="title">
						Checadas Semanales </span>
						</a>
					</li>
					<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Total de Registros">
						<a href="' . $base_url . 'total_registros">
						<i class="icon-notebook"></i>
						<span class="title">
						Total de Registros </span>
						</a>
					</li>
					<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Días Econ&oacute;micos">
						<a href="' . $base_url . 'dias_economicos">
						<i class="icon-notebook"></i>
						<span class="title">
						Días Económicos </span>
						</a>
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->';


				if($tipo == 'A')
				{
					return $admin;
				}
				else if ($tipo == 'O')
				{
					return $operador;
				}
				else
				{
					return $consulta;
				}
	}
}
?>
