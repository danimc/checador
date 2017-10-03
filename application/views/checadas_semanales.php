<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Checadas Semanales</title>
<link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon.png"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/css/jquery.typeahead.css" rel="stylesheet" type="text/css"/>
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
				<link href="<?= base_url(); ?>assets/css/bootstrap/css/datepicker.css" rel="stylesheet" type="text/css"/>	
				<!-- <link href="<?= base_url(); ?>assets/css/bootstrap/css/bootstrap2.css" rel="stylesheet" type="text/css"/> -->
				<!--Contenido-->

				<!--Tabs Contenido-->

								<div class="portlet light">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption">
                                            <h2><i class="icon-notebook" style="font-size: 22px;"></i>
                                            <span class="caption-subject uppercase"> Checadas Semanales </span></h2>
                                            <span class="caption-helper">Impresión y Concentrado de Información...</span>
                                        </div>

                                    </div>

                            		<div class="form-group col-md-12">
										<div class="col-md-12">
											<label class="lead">Asistencias y Faltas</label>
										</div>
										<div class="form-group col-md-7">
											<label class="lead">Nombre</label>
												<div class="typeahead-container">
										            <div class="typeahead-field">

										            <span class="typeahead-query">
										                <input id="nombre"
										                       name="q"
										                       autofocus
										                       autocomplete="off"
										                       class="input-xlarge">
										            </span>

										            </div>
										        </div>
										</div>	

										<div class="form-group col-md-5">
											<label class="lead col-md-12">Rango de Fechas</label>
												<div class="col-md-6">
													<input  type="text" placeholder="Fecha Inicial"  id="fechainicial" class="form-control ">
												</div>
												<div class="col-md-6">
													<input  type="text" placeholder="Fecha Final"  id="fechafinal" class="form-control ">
												</div>
										</div>
										<div>
											<div class="col-md-8">
													
											</div>								
											<div class="col-md-2">
												<button id="traer_historial" class="btn green-haze" ng-click="traer_historial();">Traer Checadas</button> 
											</div>
											<div class="col-md-2">
												<button id="print_checadas" class="btn btn-primary">Imprimir Reporte</button>
											</div>	
										</div>
									</div>



									<div class="col-md-12" ng-show="historial.length > 0">
						            	<div class="portlet box green" style="background-color: #5B6871!important; border-color:#5B6871">
							            	   <div class="portlet-title" style="background-color: #5B6871!important; border-color:#5B6871">
											       <div class="caption">
											           <i class="fa fa-comments"></i>Asistencias y Faltas
											       </div>
											   </div>
										 	<div class="portlet-body">								
							               		<table class="table table-striped table-bordered table-hover text-center" id="sample_2">
							                        <thead>
							                            <tr>
							                                <th class="text-center col-md-4">
							                                    Fecha
							                                </th>
							                                <th class="text-center col-md-2">
							                                    Día
							                                </th>
							                                <th class="text-center">
							                                    Hora Entrada
							                                </th>
							                                <th class="text-center">
							                                    Estatus Entrada
							                                </th>
							                                <th class="text-center">
							                                    Observacioes Entrada
							                                </th>							                                
							                                <th class="text-center">
							                                    Foto Entrada
							                                </th>
							                                <th class="text-center">
							                                    Hora Salida
							                                </th>
							                                <th class="text-center">
							                                    Estatus Salida
							                                </th>
							                                <th class="text-center">
							                                    Observaciones Salida
							                                </th>							                                
							                                <th class="text-center">
							                                    Foto Salida
							                                </th
							                            </tr>
							                        </thead>
							                        <tbody style="font-size: 11px;">      
							                            <tr ng-repeat="historial in historial">
							                                <td class="text-center bold">
							                                    {{historial.fecha }}
							                                </td>
							                                <td class="text-center">
							                                    {{historial.dia}}
							                                </td>
							                                <td>
							                                    {{historial.hora_entrada}} 
							                                </td>
							                                <td>
							                                    {{historial.estatus_entrada}}
							                                </td>
							                                <td>
							                                    {{historial.obs_entrada}}
							                                </td>							                                
							                                <td>
							                                	<a href="#" class="" data-toggle="modal" data-target="#imgModal" ng-click="imagen_function(historial.foto_entrada);">
							                                		<img ng-src='fotos/{{historial.foto_entrada}}' height="45" width="55" style="padding:2px">
							                                	</a>
							                                </td>
							                                <td>
							                                    {{historial.hora_salida}}
							                                </td>
							                                <td>
							                                    {{historial.estatus_salida}}
							                                </td>
							                                <td>
							                                    {{historial.obs_salida}}
							                                </td>							                                
							                                <td>
							                                	<a href="#" class="" data-toggle="modal" data-target="#imgModal" ng-click="imagen_function(historial.foto_salida);">
							                                		<img ng-src='fotos/{{historial.foto_salida}}' height="45" width="55" style="padding:2px">
							                                	</a>
							                                </td>							                                
							                            </tr>
							                        </tbody>
						                    	</table>
							                </div>
							            </div>
						            </div>
                    			</div>

				        <!-- Load jQuery and bootstrap datepicker scripts -->
						<script src="<?= base_url(); ?>assets/js/bootstrap/js/jquery-1.9.1.min.js"></script>
						<script src="<?= base_url(); ?>assets/js/bootstrap/js/bootstrap-datepicker.js"></script>
				        <script type="text/javascript">
				            // When the document is ready
				            $(document).ready(function () {
				                
				                $('#fechaimpresion').datepicker({
				                    format: "yyyy/mm/dd"
				                });  
				                $('#fechainicial').datepicker({
				                    format: "yyyy/mm/dd"
				                });  				                
				                $('#fechafinal').datepicker({
				                    format: "yyyy/mm/dd"
				                });  
				            });
				        </script>

								
							<!-- Modal -->

							<div id="imgModal" class="modal fade" role="dialog">
							  <div class="modal-dialog">

							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">Imagenes</h4>
							      </div>
							      <div class="modal-body">
							      	<img ng-src='fotos/{{imagen}}' width="100%" style="padding:2px">
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							        
							      </div>
							    </div>

							  </div>
							</div>

        	</div>
        </div>


				<!--Fin Tabs Contenido-->

				<!--Contenido-->

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
 	<script src="<?= base_url(); ?>assets/js/jquery.blockui.min.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/jquery.cokie.min.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/uniform/jquery.uniform.min.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> 
	<!-- END CORE PLUGINS -->
 	<script src="<?= base_url(); ?>assets/js/jquery.typeahead.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/metronic.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/layout.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/quick-sidebar.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/demo.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/sweetalert-master/dist/sweetalert-dev.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/scripts/checadas_semanales.js" type="text/javascript"></script>
 	<script src="<?= base_url(); ?>assets/js/charts_loader.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function() {    
			Metronic.init(); // init metronic core components
			Layout.init(); // init current layout
			QuickSidebar.init(); // init quick sidebar
			Demo.init(); // init demo features
			$(".group-menu").css("display","none");
			$("#men_reportes").css("display","block");
		});
	</script>

	<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
	</html>