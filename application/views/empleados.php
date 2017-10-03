
<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Listado de Empleados</title>
<link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon.png"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/css/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="<?= base_url(); ?>assets/css/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/css/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?= base_url(); ?>assets/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?= base_url(); ?>assets/css/light.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/sweetalert-master/dist/sweetalert.css" rel="stylesheet" type="text/css"/>



<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<style>
        video { border: 1px solid #ccc; display: block; margin: 0 0 20px 0; }
        #canvas { margin-top: 20px; border: 1px solid #ccc; display: none; }
        .grandes
{
	font-size: 20px;
	height: 50px;
}

</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content page-boxed page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<?= helper()?>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<div class="page-sidebar navbar-collapse collapse">
				<?= main_menu()?>
			</div>
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper" ng-app="MyApp">
			<div class="page-content" ng-controller="AppCtrl">

				
				
				<div class="col-md-12">
					<center><h2>Listado de Empleados</h2></center>
				</div>

				<!--Contenido-->
				

				        <!-- Load jQuery and bootstrap datepicker scripts -->
						<script src="<?= base_url(); ?>assets/js/bootstrap/js/jquery-1.9.1.min.js"></script>
					
						<div class="col-md-12">
					 		<input type="text" placeholder="Buscar" ng-model="buscar" class="form-control valida ng-pristine ng-valid ng-valid-maxlength ng-touched input-small margin-bottom-10">
					 	</div>

			            <div class="col-md-12" ng-show="datos.length > 0">


			               <table class="table table-striped table-bordered table-hover text-center" id="sample_1">
			                        <thead>
			                            <tr>
			                                <th class="text-center col-md-1">
			                                    No. Empleado
			                                </th>
			                                <th class="text-center col-md-3">
			                                    Empleado
			                                </th>
			                                <th class="text-center col-md-3">
			                                    Depertamento
			                                </th>
			                                <th class="text-center col-md-1">
			                                   	Entrada
			                                </th>
			                                <th class="text-center col-md-1">
			                                   	Salida
			                                </th>	
			                                <th class="text-center col-md-1">
			                                	Editar
			                                </th>
			                                <th class="text-center col-md-1">	
			                                	Eliminar
			                                </th>		                   
			                                <th class="text-center col-md-1">	
			                                	Bloqueo
			                                </th>		                   			                                             
			                            </tr>
			                        </thead>
			                        <tbody style="font-size: 11px;">      
			                            <tr ng-repeat="datos in datos|filter:buscar">
			                                <td class="text-center bold">
			                                    {{datos.numero }}
			                                </td>
			                                <td class="text-center">
			                                    {{datos.nombre}}
			                                </td>
			                                <td>
			                                    {{datos.departamento}} 
			                                </td>
			                                <td>
			                                    {{datos.hora_entrada}}
			                                </td>
			                                <td>
			                                    {{datos.hora_salida}}
			                                </td>
			                                <td>
			                                    <button type="button" class="btn blue" ng-click="modificar(datos.numero)"><i class="icon-pencil"></i></i></button>
			                                </td>
			                                <td>
			                                    <button type="button" class="btn red"  ng-click="borrar(datos.numero)"><i class="icon-close"></i></button>
			                                </td>
			                                <td>
												<select ng-model="datos.activo" ng-change="bloqueo(datos.numero, datos.activo)">
												  <option value="B">Bloqueado</option>
												  <option value="S">Activo</option>
												</select>			                                    
			                                </td>			                                
			                            </tr>

			                        </tbody>
			                    </table>
			                  

							
			            </div>					    
					 </div>   

				<!--Contenido-->
			</div>
		</div>
		<!-- END CONTENT -->
		
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

	
<!-- 	<script src="<?= base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script> -->
	<script src="<?= base_url(); ?>assets/js/angular.min.js"></script>
 	<script src="<?= base_url(); ?>assets/js/jquery-migrate.min.js" type="text/javascript"></script> 
	<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<!-- 	<script src="<?= base_url(); ?>assets/js/jquery-ui/jquery-ui.min.js" type="text/javascript"></script> -->
 	<script src="<?= base_url(); ?>assets/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
 	<script src="<?= base_url(); ?>assets/js/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.slimscroll.min.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/jquery.blockui.min.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/jquery.cokie.min.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/uniform/jquery.uniform.min.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> 
	<!-- END CORE PLUGINS -->
 	<script src="<?= base_url(); ?>assets/js/metronic.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/layout.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/quick-sidebar.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/demo.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/sweetalert-master/dist/sweetalert-dev.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/scripts/empleados.js" type="text/javascript"></script> 

	
	<script>
		jQuery(document).ready(function() {    
			Metronic.init(); // init metronic core components
			Layout.init(); // init current layout
			QuickSidebar.init(); // init quick sidebar
			Demo.init(); // init demo features
			$(".group-menu").css("display","none");
			$("#men_empleado").css("display","block"); 
		});
	</script>
	<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
	</html>