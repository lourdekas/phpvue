<?php
	require "conexion.php";
	$user = new ApptivaDB();
//accion = mostrar, insertar, editar y eliminar
//$accion ="mostrar";
$res=array("error"=>false);
	if(isset($_GET["accion"])) 
		$accion = $_GET["accion"];
	

switch ($accion) {
	case 'mostrar':
		$u= $user->buscar("paisajes","1"); // retorna todos los registros
		if($u):
			$res['paisajes']=$u;
			$res['mensaje']="exito";
		else:
			$res['mensaje']="Aun no hay registros";
			$res['error']=true;
		endif;
		break;
	case 'insertar':
		$nombre = $_POST["nombre"];
		$descripcion = $_POST["descripcion"];
		$foto = $_FILES["foto"]["name"];

		$target_dir = "img/";
		$target_file = $target_dir.basename($foto);
		move_uploaded_file($_FILES["foto"]["tmp_name"],$target_file);


		$data= "'".$nombre."','".$descripcion."','".$foto."'";

		$u= $user->insertar("paisajes",$data);

		if($u):
			$res['mensaje']="inserción con éxito";
		else:
			$res['mensaje']="Aun no hay registros";
			$res['error']=true;
		endif;
		break;	
	case 'editar':
		$id = $_POST["eid"];
		$nombre = $_POST["enombre"];
		$descripcion = $_POST["edescripcion"];
		$foto ="";

		if(isset($_FILES["efoto"]["name"])):
		
			$foto = $_FILES["efoto"]["name"];

		    $target_dir = "img/";
		    $target_file = $target_dir.basename($foto);
		    move_uploaded_file($_FILES["efoto"]["tmp_name"],$target_file);
		    $foto =", foto='".$_FILES["efoto"]["name"]."'";
		endif;
		
		$data= "nombre='".$nombre."',descripcion='".$descripcion."'".$foto;

		$u= $user->actualizar("paisajes",$data,"id=".$id);

		if($u):
			$res['mensaje']="edición con éxito";
		else:
			$res['mensaje']="Aun no hay registros";
			$res['error']=true;
		endif;
		break;
	case 'eliminar':
		$id = $_POST["did"];
		$u= $user->borrar("paisajes","id=".$id);

		if($u):
			$res['mensaje']="Eliminación con éxito";
		else:
			$res['mensaje']="Aun no hay registros";
			$res['error']=true;
		endif;
		break;
	default:
		# code...
		break;
}
// nos retorna json
echo json_encode($res);
die();
?>