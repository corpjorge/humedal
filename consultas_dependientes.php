<?php
require_once 'sqlscriphp.php';
$id = $_GET['cedula'];
$zona = $_GET['zona'];
$i = $_GET['i'];
$cedulaCabezaLista = $_GET['cedulaCabezaLista'];
$sqlAsociado = "SELECT * FROM user_insc WHERE cedula = ".$id;
$asociado = array();
$beneficiarios = array();  
 
/* Consultas de selección que devuelven un conjunto de resultados */
if ($result = mysqli_query($con, $sqlAsociado)) 
{
    if (mysqli_num_rows($result) <= 0) 
	{?>
     <input type="text" name="nombreInt[<?=$i;?>]"  id="nombreInt[<?=$i;?>]" value="" class="date-picker form-control col-md-7 col-xs-12" required readonly>	
	  <p style="color: red;">USUARIO NO EXISTE</p>
	 <script>
      document.getElementById('cedulaInt[<?=$i;?>]').value="";
     </script>
	 <?php
    }
    /* obtener el array asociativo */
    while ($fila = mysqli_fetch_assoc($result)) 
	{
        $asociado = $fila;
    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($result);
    
} else {?>

  <input type="text" name="nombreInt[<?=$i;?>]"  id="nombreInt[<?=$i;?>]" value="" class="date-picker form-control col-md-7 col-xs-12" required readonly>
  
<?php }


if($asociado['id']>0)
{
    
if($cedulaCabezaLista == $asociado['cedula']){
    
     ?>
     <input type="text" name="nombreInt[<?=$i;?>]"  id="nombreInt[<?=$i;?>]" value="" class="date-picker form-control col-md-7 col-xs-12" required readonly>	
	  <p style="color: red;">EL USUARIO NO PUEDE SER EL MISMO QUE EL CABEZA DE LISTA</p>
	 <script>
      document.getElementById('cedulaInt[<?=$i;?>]').value="";
     </script>  
	 <?php
	 
	 return;
	 
    
}else if($asociado['valida']==1)  { 
     
     if($zonaAsociado = str_replace(' ', '', $asociado['apellidos']) == $zona ){
        
 ?>
 
    <input type="text" name="nombreInt[<?=$i;?>]"  id="nombreInt[<?=$i;?>]" value="<?=$asociado['nombres'];?>" class="date-picker form-control col-md-7 col-xs-12" required readonly> 
 
 
<?php

    }else{
        
        ?>
     <input type="text" name="nombreInt[<?=$i;?>]"  id="nombreInt[<?=$i;?>]" value="" class="date-picker form-control col-md-7 col-xs-12" required readonly>	
	  <p style="color: red;">USUARIO NO CORRESPONDE A ZONA ELECTORAL</p>
	 <script>
      document.getElementById('cedulaInt[<?=$i;?>]').value="";
     </script>  
	 <?php
        
        
        
             
             
         }
    } else  { ?>

  <input type="text" name="nombreInt[<?=$i;?>]"  id="nombreInt[<?=$i;?>]" value="" class="date-picker form-control col-md-7 col-xs-12" required readonly>
  <p style="color: red;">USUARIO YA SE ENCUENTRA REGISTRADO EN OTRA PLANCHA</p>
  <script>
   document.getElementById('cedulaInt[<?=$i;?>]').value="";
  </script>
  
<?php 

    } 
 } 
 
?>