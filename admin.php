<?php
/** Se agrega la libreria PHPExcel */
require_once '../lib/PHPExcel/PHPExcel.php';
                    		
$showLogin = false;
$showForm = false;
$showError = false;
$showMessage = "";
$showTable = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'sqlscriphp.php';
    $user = $_POST['user'];
    $password = $_POST['password'];
    if (isset($user) && isset($password)) {
        if ($user == "admin") {
            if ($password == "Rt58K8hs$" || $password == md5("Rt58K8hs$")) {
                if (isset($_POST['auxilio'])) {
                    $sqlAuxilios = 'SELECT `lista_insc`.*, `user_insc`.`cedula` AS "user_documento", `user_insc`.`nombres` AS "user_nombres", `user_insc`.`apellidos` AS "user_apellidos", `aux_beneficiarios`.`documento_id` AS "beneficiario_documento", `aux_beneficiarios`.`nombres` AS "beneficiario_nombre" FROM `lista_insc` LEFT JOIN `user_insc` ON `user_insc`.`id` = `lista_insc`.`users_id` LEFT JOIN `aux_beneficiarios` ON `aux_beneficiarios`.`id` = `lista_insc`.`beneficiarios_id`';
                    $auxilios = array();
                    $auxilio_filter = $_POST['auxilio'];
                    $auxilios_count = 0;
                    if ($auxilio_filter !== "TODOS") {
                        $sqlAuxilios = $sqlAuxilios.' WHERE `lista_insc`.`auxilio` = "'.$auxilio_filter.'"';
                    }
                    /* Consultas de selección que devuelven un conjunto de resultados */
                    if ($result = mysqli_query($con, $sqlAuxilios)) {
                        $auxilios_count = mysqli_num_rows($result);
                        if ($auxilios_count <= 0) {
                            mysqli_close($con);
                            $showTable = false;
                            $showForm = true;
                        } else {
                    		// Se crea el objeto PHPExcel
                    		$objPHPExcel = new PHPExcel();
                    
                    		// Se asignan las propiedades del libro
                    		$objPHPExcel->getProperties()->setCreator("Fedef-co") //Autor
                    							 ->setLastModifiedBy("Fedef-co") //Ultimo usuario que lo modific贸
                    							 ->setTitle("Reporte Excel con PHP y MySQL")
                    							 ->setSubject("Reporte Excel con PHP y MySQL")
                    							 ->setDescription("FEDEF Reporte de solicitudes auxilio educativo")
                    							 ->setKeywords("reporte")
                    							 ->setCategory("Reporte excel");
                    
                    		$tituloReporte = "FEDEF Reporte solicitudes auxilio educativo";
                    		$titulosColumnas = array('ID', 'Asociado Id', 'Asociado Nombre', 'Telefono', 'Correo', 'Auxilio', 'Beneficiario ID', 'Beneficiario Nombre', 'Soporte', 'Desembolso', 'Fecha Solicitud');
                    		
                    		$objPHPExcel->setActiveSheetIndex(0)
                            		    ->mergeCells('A1:K1');
                    						
                    		// Se agregan los titulos del reporte
                    		$objPHPExcel->setActiveSheetIndex(0)
                    					->setCellValue('A1', $tituloReporte)
                            		    ->setCellValue('A3', $titulosColumnas[0])
                    		            ->setCellValue('B3', $titulosColumnas[1])
                            		    ->setCellValue('C3', $titulosColumnas[2])
                                		->setCellValue('D3', $titulosColumnas[3])
                    					->setCellValue('E3', $titulosColumnas[4])
                    					->setCellValue('F3', $titulosColumnas[5])
                    					->setCellValue('G3', $titulosColumnas[6])
                    					->setCellValue('H3', $titulosColumnas[7])
                    					->setCellValue('I3', $titulosColumnas[8])
                    					->setCellValue('J3', $titulosColumnas[9])
                    					->setCellValue('K3', $titulosColumnas[10]);
                    					
                    		
                    		//Se agregan los datos de los alumnos
                    		$i = 4;
                    		while ($fila = mysqli_fetch_assoc($result)) {
                    		    $auxilios[] = $fila;
                    			$objPHPExcel->setActiveSheetIndex(0)
                            		    ->setCellValue('A'.$i,  $fila['id'])
                    		            ->setCellValue('B'.$i,  $fila['user_documento'])
                            		    ->setCellValue('C'.$i,  $fila['user_nombres'])
                    					->setCellValue('D'.$i,  $fila['telefono'])
                    					->setCellValue('E'.$i,  $fila['email'])
                    					->setCellValue('F'.$i,  $fila['auxilio'])
                    					->setCellValue('G'.$i,  $fila['beneficiario_documento'])
                    					->setCellValue('H'.$i,  $fila['beneficiario_nombre'])
                    					->setCellValue('I'.$i,  $fila['soporte'])
                    					->setCellValue('J'.$i,  $fila['desembolso'])
                    					->setCellValue('K'.$i,  $fila['fecha']);
                    					$i++;
                    		}
                    		
                    		$estiloTituloReporte = array(
                            	'font' => array(
                    	        	'name'      => 'Footlight MT Light',
                        	        'bold'      => true,
                            	    'italic'    => false,
                                    'strike'    => false,
                                   	'size' =>11,
                    	            	'color'     => array(
                        	            	'rgb' => '0074CA'
                            	       	)
                                ),
                    	        'fill' => array(
                    				//'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
                    				'color'	=> array('argb' => 'FF220835')
                    			),
                                'borders' => array(
                                   	'allborders' => array(
                                    	'style' => PHPExcel_Style_Border::BORDER_NONE                    
                                   	)
                                ), 
                                'alignment' =>  array(
                            			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            			'rotation'   => 0,
                            			'wrap'          => TRUE
                        		)
                            );
                    
                    		$estiloTituloColumnas = array(
                                'font' => array(
                                    'name'      => 'Arial',
                                    'bold'      => false,                          
                                    'color'     => array(
                                        'rgb' => 'FFFFFF'
                                    )
                                ),
                                'fill' 	=> array(
                    				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                    				'rotation'   => 0,
                            		'startcolor' => array(
                                		'rgb' => '85bef9'
                            		),
                            		'endcolor'   => array(
                                		'argb' => 'FF85bef9'
                            		)
                    			),
                                'borders' => array(
                                	'top'     => array(
                                        'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                                        'color' => array(
                                            'rgb' => '143860'
                                        )
                                    ),
                                    'bottom'     => array(
                                       'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                                        'color' => array(
                                            'rgb' => '143860'
                                        )
                                    )
                                ),
                    			'alignment' =>  array(
                            			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            			'wrap'          => false
                        		));
                    			
                    		$estiloInformacion = new PHPExcel_Style();
                    		$estiloInformacion->applyFromArray(
                    			array(
                               		'font' => array(
                                   	'name'      => 'Arial',               
                                   	'color'     => array(
                                       	'rgb' => '000000'
                                   	)
                               	),
                               	'fill' 	=> array(
                    				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
                    				'color'		=> array('argb' => 'FFf6f7f9')
                    			),
                               	'borders' => array(
                                   	'left'     => array(
                                       	'style' => PHPExcel_Style_Border::BORDER_THIN ,
                    	                'color' => array(
                        	            	'rgb' => 'f6f7f9'
                                       	)
                                   	)             
                               	)
                            ));
                    		 
                    		$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($estiloTituloReporte);
                    		$objPHPExcel->getActiveSheet()->getStyle('A3:K3')->applyFromArray($estiloTituloColumnas);		
                    		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:K".($i-1));
                    				
                    		for($i = 'A'; $i <= 'K'; $i++){
                    			$objPHPExcel->setActiveSheetIndex(0)			
                    				->getColumnDimension($i)->setAutoSize(TRUE);
                    		}
                    		
                    		// Se asigna el nombre a la hoja
                    		$objPHPExcel->getActiveSheet()->setTitle('Solicitudes');
                    
                    		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
                    		$objPHPExcel->setActiveSheetIndex(0);
                    		// Inmovilizar paneles 
                    		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
                    		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
                    
                    		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    		$objWriter->save('Reporte.xlsx');
                    		
                            $showTable = true;
                            $showForm = true;
                        }
                    } else {
                        mysqli_close($con);
                        $showError = true;
                        $showMessage = "Error de conexión con el servidor, intentelo más tarde";
                        $showForm = true;
                    }
                    
                }
                $showForm = true;
            } else {
                $showLogin = true;
                $showError = true;
                $showMessage = "Contraseña incorrecta";
            }
        } else {
            $showLogin = true;
            $showError = true;
            $showMessage = "Usuario incorrecto";
        }
    } else {
        $showLogin = true;
        $showError = true;
        $showMessage = "Debe ingresar la cedula y la contraseña";
    }
} else {
    $showLogin = true;
} 
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <!-- Meta, title, CSS, favicons, etc. -->
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Modulo Inscripción Delegados 2020</title>

    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <style>

    </style>
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <style>
    table thead th {
        text-align: center;
        min-width: 50px;
    }
    
    table tbody th {
        text-align: center;
        color: #636363;
    }
    table tbody th tr {
        margin: 5px;
    }
    </style>
</head>
<body class="nav-md">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-xs-12">
            <div class="row center">
                <?php if ($showLogin) { ?>
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin: auto; float: inherit; margin-top: 20px;">
                    <div class="x_panel">
                        <div class="x_content">
                            <br>
                            <form class="form-horizontal form-label-left input_mask" method="post" action="admin.php" id="form1">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="user" class="date-picker form-control col-md-7 col-xs-12" required type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Contrase&ntilde;a</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="password" class="date-picker form-control col-md-7 col-xs-12" required type="password">
                                    </div>
                                </div>
                                
                                <?php if ($showError) { ?>
                                <p style="color: red; text-align: center;"><?php echo $showMessage; ?></p>
                                <?php } ?>

                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($showForm) { ?>
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin: auto; float: inherit; margin-top: 20px;">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="x_title">
                                <h2>Administrador Auxilio Educativo</h2>
                                <br><br>
                                En el siguiente formulario podrá realizar la busqueda y descarga de las solicitudes.
            
                            </div>
                            <div class="x_content">
                                <br>
                                <form class="form-horizontal form-label-left input_mask" method="post" action="admin.php" id="form1" enctype="multipart/form-data">
                                    <input type="hidden" name="user" value="<?php echo $user; ?>">
                                    <input type="hidden" name="password" value="<?php echo md5("Rt58K8hs$"); ?>">
            
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de auxilio <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="auxilio" class="date-picker form-control col-md-7 col-xs-12" tabindex="-1" required>
                                                <option value="TODOS" <?php if($auxilio_filter == 'TODOS') { echo 'selected'; } ?> >TODOS</option>
                                                <option value="BECAS PRIMARIA" <?php if($auxilio_filter == 'BECAS PRIMARIA') { echo 'selected'; } ?> >BECAS PRIMARIA</option>
                                                <option value="GUARDERIA HIJOS DE ASOCIADOS" <?php if($auxilio_filter == 'GUARDERIA HIJOS DE ASOCIADOS') { echo 'selected'; } ?> >GUARDERIA HIJOS DE ASOCIADOS</option>
                                                <option value="PREESCOLAR" <?php if($auxilio_filter == 'PREESCOLAR') { echo 'selected'; } ?> >PREESCOLAR</option>
                                                <option value="BACHILLERATO HIJOS DE ASOCIADOS" <?php if($auxilio_filter == 'BACHILLERATO HIJOS DE ASOCIADOS') { echo 'selected'; } ?> >BACHILLERATO HIJOS DE ASOCIADOS</option>
                                                <option value="BACHILLERATO ASOCIADOS" <?php if($auxilio_filter == 'BACHILLERATO ASOCIADOS') { echo 'selected'; } ?> >BACHILLERATO ASOCIADOS</option>
                                                <option value="EDUCACION ESPECIAL" <?php if($auxilio_filter == 'EDUCACION ESPECIAL') { echo 'selected'; } ?> >EDUCACION ESPECIAL</option>
                                                <option value="UNIVERSIDAD HIJOS DE ASOCIADOS" <?php if($auxilio_filter == 'UNIVERSIDAD HIJOS DE ASOCIADOS') { echo 'selected'; } ?> >UNIVERSIDAD HIJOS DE ASOCIADOS</option>
                                                <option value="UNIVERSIDAD ASOCIADOS" <?php if($auxilio_filter == 'UNIVERSIDAD ASOCIADOS') { echo 'selected'; } ?> >UNIVERSIDAD ASOCIADOS</option>
                                                <option value="OTROS CURSOS ASOCIADOS" <?php if($auxilio_filter == 'OTROS CURSOS ASOCIADOS') { echo 'selected'; } ?> >OTROS CURSOS ASOCIADOS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                                <?php if ($auxilio_filter != "") { ?>
                                <h3>Se han encontrado (<?php echo $auxilios_count; ?>) resultados para el tipo de auxilio: <?php echo $auxilio_filter;?> </h3>
                                <?php } ?>
                                <?php if ($showTable) { ?>
                                <a href="<? echo 'https://www.fedef-co.com/modulos/Fedef/production/auxilio/Reporte.xlsx'; ?>"  class="btn btn-success">Descargar</a>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <table border="1">
                                            <thead style="color: #000; text-align: center; font-size: 14px;">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Asociado Id</th>
                                                    <th>Asociado Nombre</th>
                                                    <th>Tel&eacute;fono</th>
                                                    <th>Correo</th>
                                                    <th>Auxilio</th>
                                                    <th>Beneficiario Id</th>
                                                    <th>Beneficiario Nombre</th>
                                                    <th>Soporte</th>
                                                    <th>Desembolso</th>
                                                    <th>Fecha Solicitud</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($auxilios as $auxilio) { ?>
                                                <tr>
                                                    <th><?php echo $auxilio['id'] ?></th>
                                                    <th><?php echo $auxilio['user_documento'] ?></th>
                                                    <th><?php echo $auxilio['user_nombres'] ?></th>
                                                    <th><?php echo $auxilio['telefono'] ?></th>
                                                    <th><?php echo $auxilio['email'] ?></th>
                                                    <th><?php echo $auxilio['auxilio'] ?></th>
                                                    <th><?php echo $auxilio['beneficiario_documento'] ?></th>
                                                    <th><?php echo $auxilio['beneficiario_nombre'] ?></th>
                                                    <th><a target="_blank" href=<?php echo 'https://www.fedef-co.com/modulos/Fedef/production/auxilio/'.$auxilio['soporte'] ?>><?php echo $auxilio['soporte']; ?></a></th>
                                                    <th><?php echo $auxilio['desembolso'] ?></th>
                                                    <th><?php echo $auxilio['fecha'] ?></th>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>