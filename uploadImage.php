<?php
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$targetDir = getcwd()."/uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $cli = mysqli_real_escape_string($link,$targetDir . $fileName);
$fileType = pathinfo($targetDir . $fileName,PATHINFO_EXTENSION);
$clienteId = explode("@", $_POST['clientes'])[1];
$desc = $_POST['descImg'];


//print $targetFilePath;
//print $fileName;
//print $fileType;
//print $_FILES["file"]["name"];
if(!empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf','JPG','PNG','JPEG','GIF','PDF');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
			$insert = "INSERT INTO imagenes (rutaArchivo,descripcion, fechaHora, idCli) VALUES ('$fileName','$desc', NOW(), $clienteId)";
			//print '<br>';
			//print $insert;
			
			mysqli_query($link,$insert);
            //print '<script>alert("La imagen fue subida con exito");</script>';
			Print '<script>window.location.assign("historia.php?insupddelimg=agregada");</script>';
        }else{
          
			print '<script>alert("Hubo un error, intente de nuevo");</script>';
			print '<script>history.back()</script>';
        }
    }else{
		print '<script>alert("Solo formatos JPG, JPEG, PNG, GIF, y PDF son permitidos");</script>';
       print '<script>history.back()</script>';
    }
}else{
   print '<script>alert("Seleccione un archivo...");</script>';
   print '<script>history.back()</script>';
}

?>