<?php
$showForm = false;
$showError = false;
$showMessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'sqlscriphp.php';
    $id = $_POST['cedula'];
    $password = $_POST['password'];
    if (isset($id) || isset($password)) {
        $sqlAsociado = "SELECT * FROM user_insc WHERE cedula = ".$id." AND password = '".$password."'";
        $asociado = array();
        /* Consultas de selección que devuelven un conjunto de resultados Usuario o contraseña incorrecta */
        if ($result = mysqli_query($con, $sqlAsociado)) {
            if (mysqli_num_rows($result) <= 0) {
                mysqli_close($con);
                $showError = true;
                $showMessage = "Datos incorrectos. Gracias.";
                $showForm = true;
            } else {
                /* obtener el array asociativo */
                while ($fila = mysqli_fetch_assoc($result)) {
                    $asociado = $fila;
                }
                /* liberar el conjunto de resultados */
                mysqli_free_result($result);
                
                mysqli_close($con);
                if ($asociado['valida'] == 2) {
                    $showMessage = "Estimado(a) Asociado(a) Su acceso no puede ser procesado porque ya se encuentra inscrito. Gracias.";
                } else if ($asociado['valida'] == 3) {
                    $showMessage = "no tienen auxilio vigente y le aparecerá un anuncio";
                } else if ($asociado['valida'] == 4) {
                    $showMessage = "no tienen auxilio vigente ni lo pueden solicitar porque no cumplen la condición de un año de antigüedad";
                } else {
                    header('Location: inscripcion.php?user='.$asociado['cedula'].'&data='.$asociado['password']);
                }
                $showError = true;
                $showForm = true;
            }
        } else {
            mysqli_close($con);
            $showError = true;
            $showMessage = "Error de conexión con el servidor, intentelo más tarde";
            $showForm = true;
        }
        $showForm = true;
    } else {
        $showError = true;
        $showMessage = "Debe ingresar la cedula y la contraseña";
        $showForm = true;
    }
} else {
    $showForm = true;
} 

if ($showForm) { ?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <!-- Meta, title, CSS, favicons, etc. -->
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inscripción Delegados 2021</title>

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
    <link href="/build/css/custom.min.css" rel="stylesheet">
</head>
       </div>
           <div align="center" style="padding-top:50px;">
        <p><h1>INGRESO INSCRIPCIÓN DELEGADOS ASAMBLEA 2021</h1</p>
        </div> 
    
</div>
<body class="nav-md">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-xs-12">
            <div class="row center">
                <div class="col-md-4 col-sm-8 col-xs-12" style="margin: auto; float: inherit; margin-top: 20px;">
                    <div class="x_panel">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <br>
                                        <form class="form-horizontal form-label-left input_mask" method="post" action="login.php" id="form1">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">C&eacute;dula</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input name="cedula" class="date-picker form-control col-md-7 col-xs-12" required type="text">
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
                                                    <button type="submit" class="btn btn-success">Ingresar a Inscripción</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
 </div>
        <div align="center" style="padding-top:300px;">
         <img src="images/logo1.png">
         <p>2012 - 2021 Todos los derechos reservados. FYCLS INGENIERÍA</p>
        </div>      
    </div>
</body>
</html>
<?php } ?>