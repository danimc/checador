
<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Bitacora de Modificaciones</title>
<link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon.png"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
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
						<div class="form-group col-md-12">
								<div class="col-md-12">
									<label class="lead">Fecha a Mostrar</label>
								</div>
							
								<div class="col-md-4">
									<input  type="text" placeholder="Fecha Inicial"  id="fechadatos" class="form-control ">	
								</div>
								<div class="col-md-5">
									<button id="traer_log" class="btn green-haze" ng-click="traer();">Traer Modificaciones</button>
								</div>	
								<div class="col-md-3">
									<button id="print_report" class="btn btn-primary">Imprimir Reporte</button>
								</div>								
						</div>

				        <!-- Load jQuery and bootstrap datepicker scripts -->
						<script src="<?= base_url(); ?>assets/js/bootstrap/js/jquery-1.9.1.min.js"></script>
						<script src="<?= base_url(); ?>assets/js/bootstrap/js/bootstrap-datepicker.js"></script>
				        <script type="text/javascript">
				            // When the document is ready
				            $(document).ready(function () {
				                
				                $('#fechadatos').datepicker({
				                    format: "yyyy/mm/dd"
				                });  

				            });
				        </script>
					
						
					 

			            <div class="col-md-12" ng-show="datos.length > 0">


			               <table class="table table-striped table-bordered table-hover text-center" id="sample_1">
			                        <thead>
			                            <tr>
			                                <th class="text-center col-md-1">
			                                    No. Regitro
			                                </th>
			                                <th class="text-center col-md-3">
			                                    Empleado
			                                </th>
			                                <th class="text-center col-md-2">
			                                    Accion
			                                </th>
			                                <th class="text-center col-md-2">
			                                   	Usuario
			                                </th>
			                                <th class="text-center col-md-2">
			                                   	Observaciones
			                                </th>			                                
			                                <th class="text-center col-md-1">
			                                   	Fecha Checada
			                                </th>			                                
			                                <th class="text-center col-md-1">
			                                   	Fecha Modificacion
			                                </th>
			                            </tr>
			                        </thead>
			                        <tbody style="font-size: 11px;">      
			                            <tr ng-repeat="datos in datos">
			                                <td class="text-center bold">
			                                    {{datos.IdLog }}
			                                </td>
			                                <td class="text-center">
			                                    {{datos.empleado}}
			                                </td>
			                                <td>
			                                    {{datos.Accion}} 
			                                </td>
			                                <td>
			                                    {{datos.usuario}}
			                                </td>
			                                <td>
			                                    {{datos.observaciones}}
			                                </td>
			                                <td>
			                                    {{datos.fecha_modificacion}}
			                                </td>			                                			                                
			                                <td>
			                                    {{datos.FechaCreacion}}
			                                </td>
			                            </tr>

			                        </tbody>
			                    </table>
			                  

							

							<!-- Modal -->
							<div id="myModal" class="modal fade" role="dialog">
							  <div class="modal-dialog">

							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">Ingresar Nueva Hora</h4>
							      </div>
							      <div class="modal-body">
							      	<input type="text" id="id_entrada" class="form-control input-large grandes" style="display:none" ng_model="id_entrada">
							        <input maxlength="10" type="text" placeholder="Hora" id="hchecada" class="form-control input-large grandes" ng_model="hora">
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							        <button type="button" class="btn btn-success" ng-click="cambiar();">Guardar</button>
							      </div>
							    </div>

							  </div>
							</div>
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
 	<script src="<?= base_url(); ?>assets/js/jquery.typeahead.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/metronic.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/layout.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/quick-sidebar.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/demo.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/sweetalert-master/dist/sweetalert-dev.js" type="text/javascript"></script> 
 	<script src="<?= base_url(); ?>assets/js/scripts/log.js" type="text/javascript"></script> 

	
	<script>
		jQuery(document).ready(function() {    
			Metronic.init(); // init metronic core components
			Layout.init(); // init current layout
			QuickSidebar.init(); // init quick sidebar
			Demo.init(); // init demo features
			$(".group-menu").css("display","none");
			$("#men_administra").css("display","block");
		});
	</script>
	<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
	</html>