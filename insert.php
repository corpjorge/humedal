<?php
require_once 'sqlscriphp.php';
ini_set('date.timezone','America/Bogota');
error_reporting(0);

$user         = strip_tags(isset($_POST['user_id'])) 		 ? strip_tags($_POST['user_id'])      : '';
$nombre   	  = strip_tags(isset($_POST['nombre'])) 		 ? strip_tags($_POST['nombre'])       : '';
$celular 	  = strip_tags(isset($_POST['celular'])) 	     ? strip_tags($_POST['celular'])      : '';
$correo   	  = strip_tags(isset($_POST['correo'])) 		 ? strip_tags($_POST['correo'])       : '';
$fecha 		 = date("Y/m/j");
$hora 		 = date("H:i:s");

if ($user == "" || $celular == "" || $correo  == "")	
{
    echo"<script type=\"text/javascript\">alert('se ha producido un error, vuelva a intentarlo'); window.location='inscripcion.php';</script>";
} 
else
{
    if($_FILES['constacia1']['size'] > 200000){
        echo '
            <script>
            alert("Archivo demasiando grande excede el tamaño");
            window.history.back();
            </script>';
            return;
    }
   if($_FILES['constacia2']['size'] > 200000){
        echo '
            <script>
            alert("Archivo demasiando grande excede el tamaño");
            window.history.back();
            </script>';
            return;
    }
    
    if($_FILES['constacia3']['size'] > 200000){
        echo '
            <script>
            alert("Archivo demasiando grande excede el tamaño");
            window.history.back();
            </script>';
            return;
    }
    
    if($_FILES['constacia4']['size'] > 200000){
        echo '
            <script>
            alert("Archivo demasiando grande excede el tamaño");
            window.history.back();
            </script>';
            return;
    }
    
    if($_FILES['constacia5']['size'] > 200000){
        echo '
            <script>
            alert("Archivo demasiando grande excede el tamaño");
            window.history.back();
            </script>';
            return;
    }
    
     
    
    
    for($i=1;$i<=10;$i++)
	{
	    
	   
	   if($_FILES['soporte1']['size'][$i] > 200000){
            echo '
                <script>
                alert("Archivo demasiando grande excede el tamaño");
                window.history.back();
                </script>';
                return;
        }
        
        if($_FILES['soporte2']['size'][$i] > 200000){
            echo '
                <script>
                alert("Archivo demasiando grande excede el tamaño");
                window.history.back();
                </script>';
                return;
        }
        
        if($_FILES['soporte3']['size'][$i] > 200000){
            echo '
                <script>
                alert("Archivo demasiando grande excede el tamaño");
                window.history.back();
                </script>';
                return;
        }
        
        if($_FILES['soporte4']['size'][$i] > 200000){
            echo '
                <script>
                alert("Archivo demasiando grande excede el tamaño");
                window.history.back();
                </script>';
                return;
        }
        
        if($_FILES['soporte5']['size'][$i] > 200000){
            echo '
                <script>
                alert("Archivo demasiando grande excede el tamaño");
                window.history.back();
                </script>';
                return;
        }
	    
	} 
    
    mkdir("subidas/".$user, 0700); 
    $ruta_archivoc="subidas/".$user; 
    
    $pathFoto = $_FILES['foto']['name'];
	$extFoto = pathinfo($path0, PATHINFO_EXTENSION);
    
    $path1 = $_FILES['constacia1']['name'];
	$ext1 = pathinfo($path1, PATHINFO_EXTENSION);
	
	$path2 = $_FILES['constacia2']['name'];
	$ext2 = pathinfo($path2, PATHINFO_EXTENSION);
	
	$path3 = $_FILES['constacia3']['name'];
	$ext3 = pathinfo($path3, PATHINFO_EXTENSION);
	
	$path4 = $_FILES['constacia4']['name'];
	$ext4 = pathinfo($path4, PATHINFO_EXTENSION);
	
	$path5 = $_FILES['constacia5']['name'];
	$ext5 = pathinfo($path5, PATHINFO_EXTENSION);
	
	$destinoFoto = "";
	$ndestinoFoto = "";
	
	$destino1 = "";
	$ndestino1 = "";
	
	$destino2 = "";
	$ndestino2 = "";
	
	$destino3 = "";
	$ndestino3 = "";
	
	$destino4 = "";
	$ndestino4 = "";
	
	$destino5 = "";
	$ndestino5 = "";
	
	if($pathFoto<>"")
	{
	   $destinoFoto = $ruta_archivoc."/".$pathFoto;
	   copy($_FILES['constacia1']['tmp_name'],$destinoFoto);
	   $ndestinoFoto = $ruta_archivoc."/plancha_".$pathFoto;
       rename($destinoFoto, $ndestinoFoto);
	}
	
	if($path1<>"")
	{
	   $destino1 = $ruta_archivoc."/".$path1;
	   copy($_FILES['constacia1']['tmp_name'],$destino1);
	   $ndestino1 = $ruta_archivoc."/plancha_".$path1;
       rename($destino1, $ndestino1);
	}
	
	if($path2<>"")
	{
	   $destino2 = $ruta_archivoc."/".$path2;
	   copy($_FILES['constacia2']['tmp_name'],$destino2);
	   $ndestino2 = $ruta_archivoc."/plancha_".$path2;
       rename($destino2, $ndestino2);
	}
	
	if($path3<>"")
	{
	   $destino3 = $ruta_archivoc."/".$path3;
	   copy($_FILES['constacia3']['tmp_name'],$destino3);
	   $ndestino3 = $ruta_archivoc."/plancha_".$path3;
       rename($destino3, $ndestino3);
	}
	
	if($path4<>"")
	{
	   $destino4 = $ruta_archivoc."/".$path4;
	   copy($_FILES['constacia4']['tmp_name'],$destino4);
	   $ndestino4 = $ruta_archivoc."/plancha_".$path4;
       rename($destino4, $ndestino4);
	}

	
    $sqlInsertCan = "INSERT INTO `cand_insc`(`cedula`, `nombre`, `telefono`, `correo`, `fecha`, `soporte1` , `soporte2` , `soporte3` , `soporte4` , `foto`)
									 VALUES ($user, '$nombre', '$celular', '$correo', NOW(), '$ndestino1' , '$ndestino2' , '$ndestino3' , '$ndestino4' , '$ndestinoFoto')";
    mysqli_query($con, $sqlInsertCan);
	
	for($i=1;$i<=10;$i++)
	{
     $cedulaInt = $_POST['cedulaInt'][$i];
	 $nombreInt = $_POST['nombreInt'][$i];
	 $celularInt = $_POST['celularInt'][$i];
	 $correoInt = $_POST['correoInt'][$i];	 
	 
	 if($cedulaInt<>"")
	 {
	  $path1 = $_FILES['soporte1']['name'][$i];
	  $ext1 = pathinfo($path1, PATHINFO_EXTENSION);
	 
	  $path2 = $_FILES['soporte2']['name'][$i];
	  $ext2 = pathinfo($path2, PATHINFO_EXTENSION);

	  $path3 = $_FILES['soporte3']['name'][$i];
	  $ext3 = pathinfo($path3, PATHINFO_EXTENSION);
	  
      $path4 = $_FILES['soporte4']['name'][$i];
	  $ext4 = pathinfo($path4, PATHINFO_EXTENSION);
	  
	  $path5 = $_FILES['soporte5']['name'][$i];
	  $ext5 = pathinfo($path5, PATHINFO_EXTENSION);
	  
      $destinoFoto = "";
      $ndestinoFoto = "";
        
      $destino1 = "";
      $ndestino1 = "";
      
      $destino2 = "";
      $ndestino2 = "";
        
      $destino3 = "";
      $ndestino3 = "";
        
      $destino4 = "";
      $ndestino4 = "";
        
      $destino5 = "";
      $ndestino5 = "";
	  
      if($path1<>"")
	  {
	   $destino1 = $ruta_archivoc."/".$path1;
	   copy($_FILES['soporte1']['tmp_name'][$i],$destino1);
	   $ndestino1 = $ruta_archivoc."/Adj1_".$i."_".$path1;
       rename($destino1, $ndestino1);

	  }
      if($path2<>"")
	  {
	   $destino2 = $ruta_archivoc."/".$path2;
	   copy($_FILES['soporte2']['tmp_name'][$i],$destino2);
	   $ndestino2 = $ruta_archivoc."/Adj2_".$i."_".$path2;
       rename($destino2, $ndestino2);
	  }
      if($path3<>"")
	  {
	   $destino3 = $ruta_archivoc."/".$path3;
	   copy($_FILES['soporte3']['tmp_name'][$i],$destino3); 
	   $ndestino3 = $ruta_archivoc."/Adj3_".$i."_".$path3;
       rename($destino3, $ndestino3);
	  }
	  
	  if($path4<>"")
	  {
	   $destino4 = $ruta_archivoc."/".$path4;
	   copy($_FILES['soporte4']['tmp_name'][$i],$destino4); 
	   $ndestino4 = $ruta_archivoc."/Adj4_".$i."_".$path4;
       rename($destino4, $ndestino4);
	  }
	  
	  if($path5<>"")
	  {
	   $destino5 = $ruta_archivoc."/".$path5;
	   copy($_FILES['soporte5']['tmp_name'][$i],$destino5); 
	   $ndestino5 = $ruta_archivoc."/Adj5_".$i."_".$path5;
       rename($destino5, $ndestino5);
	  } 

      $sqlInsert = "INSERT INTO `lista_insc`(`users_id`, `telefono`, `email`, `beneficiario_identificacion`, `soporte1`, `soporte2`, `soporte3`, `soporte4`, `soporte5` , `fecha`)
									 VALUES ($user, '$celularInt', '$correoInt', '$cedulaInt', '$ndestino1', '$ndestino2', '$ndestino3' , '$ndestino4' , '$ndestino5', NOW())";
      mysqli_query($con, $sqlInsert);
      
      
      
      $sqlInsertUpdate = "UPDATE `user_insc` SET `valida` = '2' WHERE `user_insc`.`cedula` =".$cedulaInt;
      mysqli_query($con, $sqlInsertUpdate);  
      
	 }
	 
	 $sqlInsertUpdate = "UPDATE `user_insc` SET `valida` = '2' WHERE `user_insc`.`id` =".$user;
     mysqli_query($con, $sqlInsertUpdate);
	 
	}
	
	header('Location: form_fin.php');
    mysqli_close($con);
}
?>