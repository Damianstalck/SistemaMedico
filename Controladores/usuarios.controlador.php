<?php
class ControladorUsuarios{
  /**
   * INGRESO DE USUARIOS
   */
     static public function ctrIngresoUsuario(){

      if(isset($_POST["ingUsuario"])){
        if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
  			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])){
           $tabla = "usuarios";

           $item = "userUsuario";
           $valor = $_POST["ingUsuario"];

           $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

          if($respuesta["userUsuario"] == $_POST["ingUsuario"] && $respuesta["passUsuario"] == $_POST["password"]){

             //echo '<div class="alert -success">Bienvenido al Sistema</div>';
            $_SESSION["iniciarsesion"] = "ok";
            $_SESSION["nombreUsuario"] = $respuesta["userUsuario"];

            echo '<script>

              window.location = "inicio";

            </script>';

           }else{
             echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
           }
         }
       }
    }

  /**
   * REGISTRO DE USUARIOS
   */
   static public function ctrCrearUsuario(){
    if(isset($_POST["nuevoUsuario"])){

        if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoUsuario"]) &&
          preg_match('/^[a-zA-Z0-9]/', $_POST["nuevoPassword"])  &&
           preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevaCedulap"])&&
           preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoEstado"])){
          /*
          VALIDACION DE IMAGEN
          */
          if(isset($_FILES["nuevaFoto"]["tmp_name"])){
            list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
            var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"]));
            $nuevoAncho = 500;
            $nuevoAlto = 500;

            //CREAR DIRECTORIO DE LA IMAGEN

            $directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
            mkdir($directorio, 0777);



          }

           // $tabla = "usuarios";


           // $datos = array("arr_usuario" => $_POST["nuevoUsuario"],
           //              "arr_password" => $_POST["nuevoPassword"],
           //              "arr_rol" => $_POST["nuevoRol"],
           //              "arr_cedulap" => $_POST["nuevaCedulap"],
           //              "arr_estado" => $_POST["nuevoEstado"]);
          

           // $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

           // if($respuesta == "ok"){
            
           //  echo '<script> 
           //  Swal.fire({
           //  title: "Confirmacion!",
           //  text: "Los datos del nuevo usuario fueron ingresados.",
           //  icon: "success",
           // confirmButtonText: "Ok"}).then((result)=>{

           //  if(result.value){
           //    window.location = "usuarios";
           //  }


           //  });
           //  </script>';

            
          //ALGORITMO PARA FUTURAS COMPROBACIONES DE INGRESO A DE DATOS A LA BD 
           // }else if($respuesta == "error"){
            
           //  echo '<br><script> 
           //  Swal.fire({
           //  title: "Error!",
           //  text: "No se pudieron ingresar los datos a la base de datos, intentelo denuevo.",
           //  icon: "error",
           // confirmButtonText: "Ok"}).then((result)=>{

           //  if(result.value){
           //    window.location = "usuarios";
           //  }


           //  });
           //  </script>';

           // }
            
           

         

          }else{
            
            echo '<br><script> 
            Swal.fire({
            title: "Error!",
            text: "Usted ha ingresado caracteres especiales no permitidos.",
            icon: "error",
           confirmButtonText: "Ok"}).then((result)=>{

            if(result.value){
              window.location = "usuarios";
            }


            });
            </script>';


          }

          
         }
       }

   }
 

