<?php
require_once 'sqlscriphp.php';
$id = $_GET['user'];
$sqlAsociado = "SELECT * FROM aux_users WHERE cedula = ".$id." AND password = '".$_GET['data']."'";
$asociado = array();
$beneficiarios = array();
$showForm = false;
$showAlert = false;
/* Consultas de selección que devuelven un conjunto de resultados */
if ($result = mysqli_query($con, $sqlAsociado)) {
    if (mysqli_num_rows($result) <= 0) {
        mysqli_close($con);
        header('Location: login.php');
    }
    /* obtener el array asociativo */
    while ($fila = mysqli_fetch_assoc($result)) {
        $asociado = $fila;
    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($result);

    /* $sqlBeneficiarios = "SELECT * FROM aux_beneficiarios WHERE users_id = ".$asociado['id'];
    if ($result = mysqli_query($con, $sqlBeneficiarios)) {
        // obtener el array asociativo
        while ($fila = mysqli_fetch_assoc($result)) {
            $sqlActivo = "SELECT * FROM aux_auxilio WHERE beneficiarios_id = ".$fila['id'];
            if ($resultActivo = mysqli_query($con, $sqlActivo)) {
                if (mysqli_num_rows($resultActivo) <= 0) {
                    $beneficiarios[] = $fila;
                }
            } else {
                mysqli_close($con);
            }
        }
        // liberar el conjunto de resultados
        mysqli_free_result($result);
        mysqli_close($con);
        
        if (count($beneficiarios) <= 0) {
            $showAlert = true;
        } else {
            $showForm = true;
        }
    } else {
        mysqli_close($con);
        header('Location: login.php');
    } */
    $showForm = true;
} else {
    mysqli_close($con);
    header('Location: login.php');
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
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>    
    <script type="text/javascript" src="jquery-ui-1.8.4.custom.min.js"></script>
        <script>
		//agrega un paquete
		function agregarPaq()
		{
			for(n=1;n<=10;n++)
			{
				if(document.getElementById("divFila["+n+"]").style.display=="none")
				{
					document.getElementById("divFila["+n+"]").style.display="";
					return;
				}
			}
		}
		function buscaAsociado(i, cedula) 
		{
			$("#campoAsociado_"+i).load('consultas_dependientes.php?cedula='+cedula+'&i='+i);
		}
     </script>
    <!-- Custom Theme Style -->
    <link href="/build/css/custom.min.css" rel="stylesheet">
</head>
<body class="nav-md">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <?php if ($showAlert) { ?>
                                    <div class="x_title">
                                        <h2>INSCRIPCIÓN DELEGADOS ASAMBLEA 2020 COOPROFESORESUN:</h2>
                                        <br><br>
                                        Estimado(a) Asociado(a)
                                        <br>
                                        Su inscripción  ha sido recibida para su validación, en el momento en que se finalice el proceso nos comunicaremos para informarle. Gracias.
                                        <a href="https://www.cooprofesoresun.coop" class="btn btn-success">Salir</a>
                                    </div>
                                    <?php } ?>
                                    <?php if ($showForm) { ?>
                                    <div class="x_title">
                                        <h2>INSCRIPCIÓN DELEGADOS ASAMBLEA 2020 COOPROFESORESUN</h2>
                                        <br><br>
                                        Estimado(a) Asociado(a)
                                        <br>
                                        En el siguiente formulario podrá realizar la inscripción de los integrantes que conformaran la plancha, es importante que tenga en cuenta que los primeros campos corresponden al asociado(a) que inscribe la plancha, luego estarán los campos para incluir los números de cedula de cada uno de los integrantes, recuerde que debe cargar los documentos requeridos.

                                    </div>
                                    <div class="x_content">
                                        <br>
                                        <form class="form-horizontal form-label-left input_mask" method="post" action="insert.php" id="form1" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre Completo asociado(a) que inscribe plancha <span class="required">*</span></label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input name="nombre" value="<?php echo $asociado['nombres'].' '.$asociado['apellidos'] ?>" class="date-picker form-control col-md-7 col-xs-12" type="text" readonly>
                                                </div>
                                                <input name="user_id" value="<?php echo $asociado['id'] ?>" class="date-picker form-control col-md-7 col-xs-12" type="hidden">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Celular <span class="required">*</span></label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input name="celular" class="date-picker form-control col-md-7 col-xs-12" pattern="[0-9]{10}"
                                                           required type="tel" title="10 Dígitos"
                                                           oninvalid="setCustomValidity('Ingrese un número de celular correcto')"
                                                           oninput="setCustomValidity('')"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo <span class="required">*</span></label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input name="correo" id="correo" class="date-picker form-control col-md-7 col-xs-12" required type="email">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirmaci&oacute;n de correo <span class="required">*</span></label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input name="correo_confirmar" id="correo_confirmar" class="date-picker form-control col-md-7 col-xs-12" required type="email">
                                                </div>
                                                <p style="color: red;" id="correo_error"></p>
                                            </div>
                                                                                <?php
                                           for($i=1;$i<=10;$i++)
										   {
											   
											 if($i==1)
											 {
												$dispPaq = ""; 
											 }
											 else
											 {
												$dispPaq = "none"; 
											 }
											 ?>
                                             <table cellpadding="2" cellspacing="2" width="100%" border="0" id="divFila[<?=$i;?>]" style="display:<?=$dispPaq;?>;">
                                               <tr>
                                                <th width="100%" colspan="4" bgcolor="#CCCCCC" style="color:#FFF"><strong>INTEGRANTE # <?=$i;?></strong></th>     
                                               </tr>                                               
                                               <tr>
                                                <th align="center" width="27%"><strong>Cédula</strong></th>                                            
                                                <th align="center" width="22%"><strong>Nombre</strong></th>  
                                                <th align="center" width="23%"><strong>Celular</strong></th>                                            
                                                <th align="center" width="28%"><strong>Correo</strong></th> 
                                               </tr> 
                                               <tr>
                                                <td align="center" width="27%"><input type="text" name="cedula[<?=$i;?>]"  id="cedula[<?=$i;?>]" 
                                                    class="date-picker form-control col-md-7 col-xs-12" onBlur="buscaAsociado(<?=$i;?>, this.value)" required></td>
                                                <td align="center" width="22%">
                                                 <div id="campoAsociado_<?=$i;?>">
                                                  <input type="text" name="nombre[<?=$i;?>]"  id="nombre[<?=$i;?>]" class="date-picker form-control col-md-7 col-xs-12">
                                                 </div>
                                                </td>
                                                <td align="center" width="23%"><input name="celular[<?=$i;?>]"  id="celular[<?=$i;?>]" class="date-picker form-control col-md-7 col-xs-12" pattern="[0-9]{10}" required type="tel" title="10 Dígitos" oninvalid="setCustomValidity('Ingrese un número de celular correcto')" oninput="setCustomValidity('')"></td>
                                                <td align="center"><input name="correo[<?=$i;?>]"  id="correo[<?=$i;?>]"  class="date-picker form-control col-md-7 col-xs-12" required type="email"></td>
                                               </tr>
                                               <tr>
												<th align="center" width="27%"><strong>Adjuntar copia cédula(PDF,PNG,JPG)</strong></th>                                            
												<th align="center" width="22%"><strong>Adjuntar foto inscripción plancha(PDF,PNG,JPG)</strong></th>  
												<th align="center" width="23%" colspan="2"><strong>Adjuntar constancia acreditación curso economía solidaria(PDF,PNG,JPG)</strong></th>                                            
											   </tr> 
                                               <tr>
                                                <td align="center" width="27%"><input class="date-picker form-control col-md-7 col-xs-12" accept=".pdf,.jpg,.png,.jpeg" type="file" mutliple="true" name="soporte1[<?=$i;?>]" required/></td>
                                                <td align="center" width="22%"><input class="date-picker form-control col-md-7 col-xs-12" accept=".pdf,.jpg,.png,.jpeg" type="file" mutliple="true" name="soporte2[<?=$i;?>]" /></td>
                                                <td colspan="2" align="center"><input class="date-picker form-control col-md-7 col-xs-12" accept=".pdf,.jpg,.png,.jpeg" type="file" mutliple="true" name="soporte3[<?=$i;?>]"/></td>
                                               </tr>
                                               <tr>
                                                <td colspan="4" width="100%"><hr width="100%"></td>
                                               </tr>
											  </table><?php
										  }?>
                                             <table cellpadding="2" cellspacing="2" width="100%" border="0">
                                               <tr>
                                                <td colspan="4" bgcolor="#00CC66" style="color:#FFF; font-size:14px; cursor:pointer;" valign="middle" onClick="agregarPaq()">+&nbsp;Agregar Aspirante</strong></td>
                                               </tr> 
                                             </table> 
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Archivo copias de cedulas (PDF, JPG, PNG):</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input class="date-picker form-control col-md-7 col-xs-12" accept=".pdf,.jpg,.png,.jpeg" type="file" mutliple="true" name="soporte" required/>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Archivo formato Inscripción plancha diligenciado (PDF, JPG, PNG):</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input class="date-picker form-control col-md-7 col-xs-12" accept=".pdf,.jpg,.png,.jpeg" type="file" mutliple="true" name="soporte" required/>
                                                </div>
                                            </div
                                             ><div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Archivo fotos candidatos fondo blanco (PDF, JPG, PNG):</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input class="date-picker form-control col-md-7 col-xs-12" accept=".pdf,.jpg,.png,.jpeg" type="file" mutliple="true" name="soporte" required/>
                                                </div>
                                            </div
                                             ><div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Archivo constancias acreditación curso economía solidaria (PDF, JPG, PNG):</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input class="date-picker form-control col-md-7 col-xs-12" accept=".pdf,.jpg,.png,.jpeg" type="file" mutliple="true" name="soporte" required/>
                                                </div>
                                            </div

                                            ></div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <a href="condiciones.html" target="_blank" onclick="window.open(this.href, this.target, 'width=300,height=400'); return false;">
                                                        <label class="login-form" id="login-form" for="telefono">Consulte aquí los términos y condiciones</label></a>
                                                    <br>
                                                    <input name="terminos" required type="checkbox"> Acepto los términos y condiciones
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                    <button type="submit" class="btn btn-success">Enviar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php } ?>
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
<!-- FastClick -->
<script src="/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="/vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="/vendors/iCheck/icheck.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="/js/moment/moment.min.js"></script>
<script src="/js/datepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="/vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="/vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="/vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="/vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="/vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="/vendors/starrr/dist/starrr.js"></script>

<!-- Custom Theme Scripts -->
<script src="/build/js/custom.min.js"></script>

<!-- bootstrap-daterangepicker -->
<script>
    $(document).ready(function() {
        $('#birthday').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4"
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>
<!-- /bootstrap-daterangepicker -->

<!-- Disable cut copy and paste -->
<script type="text/javascript">
$(document).ready(function () {
    //Disable full page
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
    
    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        return false;
    });
});
</script>
<!-- /Disable cut copy and paste -->

<!-- bootstrap-wysiwyg -->
<script>
    $(document).ready(function() {
        function initToolbarBootstrapBindings() {
            var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                    'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                    'Times New Roman', 'Verdana'
                ],
                fontTarget = $('[title=Font]').siblings('.dropdown-menu');
            $.each(fonts, function(idx, fontName) {
                fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
            });
            $('a[title]').tooltip({
                container: 'body'
            });
            $('.dropdown-menu input').click(function() {
                return false;
            })
                .change(function() {
                    $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                })
                .keydown('esc', function() {
                    this.value = '';
                    $(this).change();
                });

            $('[data-role=magic-overlay]').each(function() {
                var overlay = $(this),
                    target = $(overlay.data('target'));
                overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
            });

            if ("onwebkitspeechchange" in document.createElement("input")) {
                var editorOffset = $('#editor').offset();

                $('.voiceBtn').css('position', 'absolute').offset({
                    top: editorOffset.top,
                    left: editorOffset.left + $('#editor').innerWidth() - 35
                });
            } else {
                $('.voiceBtn').hide();
            }
        }

        function showErrorAlert(reason, detail) {
            var msg = '';
            if (reason === 'unsupported-file-type') {
                msg = "Unsupported format " + detail;
            } else {
                console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }

        initToolbarBootstrapBindings();

        $('#editor').wysiwyg({
            fileUploadError: showErrorAlert
        });

        window.prettyPrint;
        prettyPrint();
    });
</script>
<!-- /bootstrap-wysiwyg -->

<!-- Select2 -->
<script>
    $(document).ready(function() {
        $(".select2_single").select2({
            placeholder: "Seleccione",
            allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
            maximumSelectionLength: 4,
            placeholder: "With Max Selection limit 4",
            allowClear: true
        });
    });
</script>
<!-- /Select2 -->

<!-- jQuery Tags Input -->
<script>
    function onAddTag(tag) {
        alert("Added a tag: " + tag);
    }

    function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
    }

    function onChangeTag(input, tag) {
        alert("Changed a tag: " + tag);
    }

    $(document).ready(function() {
        $('#tags_1').tagsInput({
            width: 'auto'
        });

        $('#correo').blur(function () {
            if ($('#correo').val() !== $('#correo_confirmar').val()) {
                $('#correo_error').html('los correos no coinciden');
            } else {
                $('#correo_error').html('');
            }
        });

        $('#correo_confirmar').blur(function () {
            if ($('#correo').val() !== $('#correo_confirmar').val()) {
                $('#correo_error').html('los correos no coinciden');
            } else {
                $('#correo_error').html('');
            }
        });
    });
</script>
<!-- /jQuery Tags Input -->

<!-- Parsley -->
<script>
    $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
            validateFront();
        });
        $('#demo-form .btn').on('click', function() {
            $('#demo-form').parsley().validate();
            validateFront();
        });
        var validateFront = function() {
            if (true === $('#demo-form').parsley().isValid()) {
                $('.bs-callout-info').removeClass('hidden');
                $('.bs-callout-warning').addClass('hidden');
            } else {
                $('.bs-callout-info').addClass('hidden');
                $('.bs-callout-warning').removeClass('hidden');
            }
        };
    });

    $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
            validateFront();
        });
        $('#demo-form2 .btn').on('click', function() {
            $('#demo-form2').parsley().validate();
            validateFront();
        });
        var validateFront = function() {
            if (true === $('#demo-form2').parsley().isValid()) {
                $('.bs-callout-info').removeClass('hidden');
                $('.bs-callout-warning').addClass('hidden');
            } else {
                $('.bs-callout-info').addClass('hidden');
                $('.bs-callout-warning').removeClass('hidden');
            }
        };
    });
    try {
        hljs.initHighlightingOnLoad();
    } catch (err) {}
</script>
<!-- /Parsley -->

<!-- Autosize -->
<script>
    $(document).ready(function() {
        autosize($('.resizable_textarea'));
    });
</script>
<!-- /Autosize -->

<!-- jQuery autocomplete -->
<script>
    $(document).ready(function() {
        var countries = { AD:"Andorra",A2:"Andorra Test",AE:"United Arab Emirates",AF:"Afghanistan",AG:"Antigua and Barbuda",AI:"Anguilla",AL:"Albania",AM:"Armenia",AN:"Netherlands Antilles",AO:"Angola",AQ:"Antarctica",AR:"Argentina",AS:"American Samoa",AT:"Austria",AU:"Australia",AW:"Aruba",AX:"Åland Islands",AZ:"Azerbaijan",BA:"Bosnia and Herzegovina",BB:"Barbados",BD:"Bangladesh",BE:"Belgium",BF:"Burkina Faso",BG:"Bulgaria",BH:"Bahrain",BI:"Burundi",BJ:"Benin",BL:"Saint Barthélemy",BM:"Bermuda",BN:"Brunei",BO:"Bolivia",BQ:"British Antarctic Territory",BR:"Brazil",BS:"Bahamas",BT:"Bhutan",BV:"Bouvet Island",BW:"Botswana",BY:"Belarus",BZ:"Belize",CA:"Canada",CC:"Cocos [Keeling] Islands",CD:"Congo - Kinshasa",CF:"Central African Republic",CG:"Congo - Brazzaville",CH:"Switzerland",CI:"Côte d’Ivoire",CK:"Cook Islands",CL:"Chile",CM:"Cameroon",CN:"China",CO:"Colombia",CR:"Costa Rica",CS:"Serbia and Montenegro",CT:"Canton and Enderbury Islands",CU:"Cuba",CV:"Cape Verde",CX:"Christmas Island",CY:"Cyprus",CZ:"Czech Republic",DD:"East Germany",DE:"Germany",DJ:"Djibouti",DK:"Denmark",DM:"Dominica",DO:"Dominican Republic",DZ:"Algeria",EC:"Ecuador",EE:"Estonia",EG:"Egypt",EH:"Western Sahara",ER:"Eritrea",ES:"Spain",ET:"Ethiopia",FI:"Finland",FJ:"Fiji",FK:"Falkland Islands",FM:"Micronesia",FO:"Faroe Islands",FQ:"French Southern and Antarctic Territories",FR:"France",FX:"Metropolitan France",GA:"Gabon",GB:"United Kingdom",GD:"Grenada",GE:"Georgia",GF:"French Guiana",GG:"Guernsey",GH:"Ghana",GI:"Gibraltar",GL:"Greenland",GM:"Gambia",GN:"Guinea",GP:"Guadeloupe",GQ:"Equatorial Guinea",GR:"Greece",GS:"South Georgia and the South Sandwich Islands",GT:"Guatemala",GU:"Guam",GW:"Guinea-Bissau",GY:"Guyana",HK:"Hong Kong SAR China",HM:"Heard Island and McDonald Islands",HN:"Honduras",HR:"Croatia",HT:"Haiti",HU:"Hungary",ID:"Indonesia",IE:"Ireland",IL:"Israel",IM:"Isle of Man",IN:"India",IO:"British Indian Ocean Territory",IQ:"Iraq",IR:"Iran",IS:"Iceland",IT:"Italy",JE:"Jersey",JM:"Jamaica",JO:"Jordan",JP:"Japan",JT:"Johnston Island",KE:"Kenya",KG:"Kyrgyzstan",KH:"Cambodia",KI:"Kiribati",KM:"Comoros",KN:"Saint Kitts and Nevis",KP:"North Korea",KR:"South Korea",KW:"Kuwait",KY:"Cayman Islands",KZ:"Kazakhstan",LA:"Laos",LB:"Lebanon",LC:"Saint Lucia",LI:"Liechtenstein",LK:"Sri Lanka",LR:"Liberia",LS:"Lesotho",LT:"Lithuania",LU:"Luxembourg",LV:"Latvia",LY:"Libya",MA:"Morocco",MC:"Monaco",MD:"Moldova",ME:"Montenegro",MF:"Saint Martin",MG:"Madagascar",MH:"Marshall Islands",MI:"Midway Islands",MK:"Macedonia",ML:"Mali",MM:"Myanmar [Burma]",MN:"Mongolia",MO:"Macau SAR China",MP:"Northern Mariana Islands",MQ:"Martinique",MR:"Mauritania",MS:"Montserrat",MT:"Malta",MU:"Mauritius",MV:"Maldives",MW:"Malawi",MX:"Mexico",MY:"Malaysia",MZ:"Mozambique",NA:"Namibia",NC:"New Caledonia",NE:"Niger",NF:"Norfolk Island",NG:"Nigeria",NI:"Nicaragua",NL:"Netherlands",NO:"Norway",NP:"Nepal",NQ:"Dronning Maud Land",NR:"Nauru",NT:"Neutral Zone",NU:"Niue",NZ:"New Zealand",OM:"Oman",PA:"Panama",PC:"Pacific Islands Trust Territory",PE:"Peru",PF:"French Polynesia",PG:"Papua New Guinea",PH:"Philippines",PK:"Pakistan",PL:"Poland",PM:"Saint Pierre and Miquelon",PN:"Pitcairn Islands",PR:"Puerto Rico",PS:"Palestinian Territories",PT:"Portugal",PU:"U.S. Miscellaneous Pacific Islands",PW:"Palau",PY:"Paraguay",PZ:"Panama Canal Zone",QA:"Qatar",RE:"Réunion",RO:"Romania",RS:"Serbia",RU:"Russia",RW:"Rwanda",SA:"Saudi Arabia",SB:"Solomon Islands",SC:"Seychelles",SD:"Sudan",SE:"Sweden",SG:"Singapore",SH:"Saint Helena",SI:"Slovenia",SJ:"Svalbard and Jan Mayen",SK:"Slovakia",SL:"Sierra Leone",SM:"San Marino",SN:"Senegal",SO:"Somalia",SR:"Suriname",ST:"São Tomé and Príncipe",SU:"Union of Soviet Socialist Republics",SV:"El Salvador",SY:"Syria",SZ:"Swaziland",TC:"Turks and Caicos Islands",TD:"Chad",TF:"French Southern Territories",TG:"Togo",TH:"Thailand",TJ:"Tajikistan",TK:"Tokelau",TL:"Timor-Leste",TM:"Turkmenistan",TN:"Tunisia",TO:"Tonga",TR:"Turkey",TT:"Trinidad and Tobago",TV:"Tuvalu",TW:"Taiwan",TZ:"Tanzania",UA:"Ukraine",UG:"Uganda",UM:"U.S. Minor Outlying Islands",US:"United States",UY:"Uruguay",UZ:"Uzbekistan",VA:"Vatican City",VC:"Saint Vincent and the Grenadines",VD:"North Vietnam",VE:"Venezuela",VG:"British Virgin Islands",VI:"U.S. Virgin Islands",VN:"Vietnam",VU:"Vanuatu",WF:"Wallis and Futuna",WK:"Wake Island",WS:"Samoa",YD:"People's Democratic Republic of Yemen",YE:"Yemen",YT:"Mayotte",ZA:"South Africa",ZM:"Zambia",ZW:"Zimbabwe",ZZ:"Unknown or Invalid Region" };

        var countriesArray = $.map(countries, function(value, key) {
            return {
                value: value,
                data: key
            };
        });

        // initialize autocomplete with custom appendTo
        $('#autocomplete-custom-append').autocomplete({
            lookup: countriesArray,
            appendTo: '#autocomplete-container'
        });
    });
</script>
<!-- /jQuery autocomplete -->

<!-- Starrr -->
<script>
    $(document).ready(function() {
        $(".stars").starrr();

        $('.stars-existing').starrr({
            rating: 4
        });

        $('.stars').on('starrr:change', function (e, value) {
            $('.stars-count').html(value);
        });

        $('.stars-existing').on('starrr:change', function (e, value) {
            $('.stars-count-existing').html(value);
        });
    });
</script>
<!-- /Starrr -->
</body>
</html>