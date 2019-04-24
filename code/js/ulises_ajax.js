function getRequestObject() {
  // Asynchronous objec created, handles browser DOM differences

  if(window.XMLHttpRequest) {
    // Mozilla, Opera, Safari, Chrome, IE 7+
    return (new XMLHttpRequest());
  }
  else if (window.ActiveXObject) {
    // IE 6-
    return (new ActiveXObject("Microsoft.XMLHTTP"));
  } else {
    // Non AJAX browsers
    return(null);
  }
}

function selectValueModificar() {
   var list=document.getElementById("list");
   var userInput=document.getElementById("productos_search");
   var ajaxResponse=document.getElementById('searchResults');
   userInput.value=list.options[list.selectedIndex].text;
   ajaxResponse.style.visibility="hidden";
   userInput.focus();
}

function sendRequestBebidas(){
   $.get( "controller_bebidas.php", { pattern: document.getElementById('bebidas_search').value })
          .done(function( data ) {
              var ajaxResponse = document.getElementById('contenido');
              ajaxResponse.innerHTML = data;
              ajaxResponse.style.visibility = "visible";
<<<<<<< HEAD
          })
          .fail(function(data) {
              var ajaxResponse = document.getElementById('contenido');
              ajaxResponse.innerHTML = "<div class\"container\"><h6 class=\"center\">No existe bebida con ese nombre</h6></div>";
              ajaxResponse.style.visibility = "visible";
        });
=======
          });
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
}

function sendRequestComidas(){
   $.get( "controller_comidas.php", { pattern: document.getElementById('comidas_search').value })
          .done(function( data ) {
              var ajaxResponse = document.getElementById('contenido');
              ajaxResponse.innerHTML = data;
              ajaxResponse.style.visibility = "visible";
<<<<<<< HEAD
          })
          .fail(function(data) {
              var ajaxResponse = document.getElementById('contenido');
              ajaxResponse.innerHTML = "<div class\"container\"><h6 class=\"center\">No existe comida con ese nombre</h6></div>";
              ajaxResponse.style.visibility = "visible";
        });
=======
          });
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
}

function sendRequestPostres(){
   $.get( "controller_postres.php", { pattern: document.getElementById('postres_search').value })
          .done(function( data ) {
              var ajaxResponse = document.getElementById('contenido');
              ajaxResponse.innerHTML = data;
              ajaxResponse.style.visibility = "visible";
<<<<<<< HEAD
          })
          .fail(function(data) {
              var ajaxResponse = document.getElementById('contenido');
              ajaxResponse.innerHTML = "<div class\"container\"><h6 class=\"center\">No existe postre con ese nombre</h6></div>";
              ajaxResponse.style.visibility = "visible";
        });
=======
          });
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
}

function cambiarDisponibilidadBebidas(idProducto,num) {
    M.toast({html: 'Actualizando Disponibilidad', classes: 'rounded', displayLength:1500});
    var aux = (num) ? 0 : 1;
    $.get( "controller_disponibilidad.php", {pattern:idProducto, available:aux})
        .done(function( data ) {
              M.toast({html: 'Disponibilidad Actualizada', classes: 'rounded',displayLength:1500});
          })
    ;

    sendRequestBebidas();
}

function cambiarDisponibilidadComidas(idProducto,num) {
    M.toast({html: 'Actualizando Disponibilidad', classes: 'rounded', displayLength:1500});
    var aux = (num) ? 0 : 1;
    $.get( "controller_disponibilidad.php", {pattern:idProducto, available:aux})
        .done(function( data ) {
            M.toast({html: 'Disponibilidad Actualizada', classes: 'rounded',displayLength:1500});
          })
    ;
    sendRequestComidas();
}

function cambiarDisponibilidadPostres(idProducto,num) {
    M.toast({html: 'Actualizando Disponibilidad', classes: 'rounded', displayLength:1500});
    var aux = (num) ? 0 : 1;
    $.get( "controller_disponibilidad.php", {pattern:idProducto, available:aux})
        .done(function( data ) {
            M.toast({html: 'Disponibilidad Actualizada', classes: 'rounded',displayLength:1500});
          })
    ;
    sendRequestPostres();
}

function sendModificarProducto(){
    $.get( "controller_modificar_producto.php", { pattern: document.getElementById('productos_search').value })
          .done(function( data ) {
              var ajaxResponse = document.getElementById('searchResults');
              ajaxResponse.innerHTML = data;
              ajaxResponse.style.visibility = "visible";
          });

}

function modifcarDatosProducto(id){
    $.get( "modificar_producto.php", { pattern: id })
          .done(function( data ) {
              var ajaxResponse = document.getElementById('searchResults');
              ajaxResponse.innerHTML = data;
              ajaxResponse.style.visibility = "visible";
          });
}

function modifcarProductoUnico(id){
    $.get( "modificar_producto.php", { pattern: id })
          .done(function( data ) {
              var ajaxResponse = document.getElementById('searchResults');
              ajaxResponse.innerHTML = data;
              ajaxResponse.style.visibility = "visible";
          });
}


function validarNombre(){
           var name = document.getElementById("nombre").value;
            var numbers=/[0-9]/;
            if(name=="") document.getElementById("namePWrong").innerHTML="** Favor de ingresar el nombre del producto";
            else if(numbers.test(name)) document.getElementById("namePWrong").innerHTML="** El nombre no debe de contener numeros";
            else if(name=="" || name.length<2 || name.length>30 ) document.getElementById("namePWrong").innerHTML="** El nombre debe de contener entre 2 a 30 caracteres";
            else document.getElementById("namePWrong").innerHTML="";
<<<<<<< HEAD
}
=======
       }
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e

       function validarDescripcion(){
           var descripcion = document.getElementById("descripcion").value;
            if(descripcion=="") document.getElementById("descriptionWrong").innerHTML="** Favor de ingresar la descripción del producto";
            else if(descripcion=="" || descripcion.length<5 || descripcion.length>100)document.getElementById("descriptionWrong").innerHTML="** La descripción debe de contener entre 5 y 100 caracteres";
            else document.getElementById("descriptionWrong").innerHTML="";
       }

       function validarPrecio(){
           var precio = document.getElementById("precio").value;
           var aux=precio.toString();
           var characters=/[%&%*?¿#@$]/;
           var min=/[a-z]/;
           var may=/[A-Z]/;
           var decimal=/[.]/;
<<<<<<< HEAD
           if(precio=="") document.getElementById("priceWrong").innerHTML="** Favor de ingresar el precio del producto";
           else if(decimal.test(aux)) document.getElementById("priceWrong").innerHTML="** El precio solo puede incluir números enteros";
           else if(characters.test(aux) || min.test(aux) || may.test(aux)) document.getElementById("priceWrong").innerHTML="** El precio solo puede incluir números";
           else if (precio<=0 || precio>100) document.getElementById("priceWrong").innerHTML="** El precio debe ser mayor a 0 y menor o igual a 100";
           else document.getElementById("priceWrong").innerHTML="";
=======
            if(precio=="") document.getElementById("priceWrong").innerHTML="** Favor de ingresar el precio del producto";
            else if(decimal.test(aux)) document.getElementById("priceWrong").innerHTML="** El precio solo puede incluir números enteros";
            else if(characters.test(aux) || min.test(aux) || may.test(aux)) document.getElementById("priceWrong").innerHTML="** El precio solo puede incluir números";
            else if (precio<=0 || precio>100) document.getElementById("priceWrong").innerHTML="** El precio debe ser mayor a 0 y menor o igual a 100";
            else document.getElementById("priceWrong").innerHTML="";
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
       }

        function insertProducto() {
            var name = document.getElementById("nombre").value;
            var numbers=/[0-9]/;
            var submit=0;
            if(name==""){
                submit=1;
            }
            else if(numbers.test(name)){
                submit=1;
            }
            else if(name=="" || name.length<2 || name.length>30 ){
                submit=1;
            }
            var descripcion = document.getElementById("descripcion").value;
            if(descripcion==""){
                submit=1;
            }
            else if(descripcion=="" || descripcion.length<5 || descripcion.length>100){
                submit=1;
            }
            var precio = document.getElementById("precio").value;
            var aux=precio.toString();
            var characters=/[%&%*?¿#@$]/;
            var min=/[a-z]/;
            var may=/[A-Z]/;
            var decimal=/[.]/;
            if(precio==""){
                submit=1;
            }
            else if(decimal.test(aux)){
                submit=1;
            }
            else if(characters.test(aux) || min.test(aux) || may.test(aux)){
                submit=1;
            }
            else if (precio<=0 || precio>100){
                submit=1;
            }
            if(submit){
                document.getElementById("submitWrong").innerHTML="** No se pudo agregar el producto por falta de datos correctos";
                return false;
            }else{
                var categoria = document.getElementById("categorias");
                var cat = categoria.options[categoria.selectedIndex].value;
                if(cat == ""){
                    cat=-1;
                    document.getElementById("submitWrong").innerHTML="** No se pudo agregar el producto porque no se a selecionado la categoría";
                    return false;
                }
                if(cat!=-1){
                    document.getElementById("submitWrong").innerHTML="";
<<<<<<< HEAD
                    $.get( "../php/insertar_producto.php", { nombre: name,des:descripcion,price:precio,cate:cat })
                          .done(function( data ) {
                              M.toast({html: 'Producto Agregado al Catálogo', classes: 'rounded',displayLength:1500});
                              setTimeout(changeView(1),1050);
=======
                    $.get( "insertar_producto.php", { nombre: name,des:descripcion,price:precio,cate:cat })
                          .done(function( data ) {
                              M.toast({html: 'Producto Agregado al Sistema', classes: 'rounded',displayLength:1500});
                              document.getElementById("nombre").value="";
                              document.getElementById("descripcion").value="";
                              document.getElementById("precio").value="";
                              categoria.options[categoria.selectedIndex].value="";
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
                          })
                          .fail(function(data) {
                                M.toast({html: 'El Producto NO se Agregó ', classes: 'rounded',displayLength:1500});
                          });
                }
            }
        }

function updateProducto() {
            var idP=document.getElementById("idp").value;
            var submit=0;
            var descripcion = document.getElementById("descripcion").value;
            if(descripcion==""){
                submit=1;
            }
            else if(descripcion=="" || descripcion.length<5 || descripcion.length>100){
                submit=1;
            }
            var precio = document.getElementById("precio").value;
            var aux=precio.toString();
            var characters=/[%&%*?¿#@$]/;
            var min=/[a-z]/;
            var may=/[A-Z]/;
            var decimal=/[.]/;
            if(precio==""){
                submit=1;
            }
            else if(decimal.test(aux)){
                submit=1;
            }
            else if(characters.test(aux) || min.test(aux) || may.test(aux)){
                submit=1;
            }
            else if (precio<=0 || precio>100){
                submit=1;
            }
            if(submit){
                document.getElementById("updateWrong").innerHTML="** No se pudo agregar el producto por falta de datos correctos";
                return false;
            }else{
                var categoria = document.getElementById("categorias");
                var cat = categoria.options[categoria.selectedIndex].value;
                if(cat == ""){
                    cat=-1;
                    document.getElementById("updateWrong").innerHTML="** No se pudo agregar el producto porque no se a selecionado la categoría";
                    return false;
                }
                if(cat!=-1){
                    document.getElementById("updateWrong").innerHTML="";
                    $.get( "update_producto.php", { id:idP,des:descripcion,price:precio,categoria:cat })
                          .done(function( data ) {
                              M.toast({html: 'Producto Actualizado Exitosamente', classes: 'rounded',displayLength:3000});
                          })
                          .fail(function() {
                                M.toast({html: 'Producto NO Actualizado', classes: 'rounded',displayLength:3000});
                          });
                }
            }
        }


<<<<<<< HEAD
    function changeView(opcion){
        if(opcion==1){
            window.location='producto.php';
        }else if(opcion==2){
            window.location='modificarUsuario.php';
        }else if(opcion==3){
            window.location='inicio.php';
        }else if (opcion==4){
            window.location='logout.php';
        }
            
=======
    function changeView(){
         window.location='producto.php';
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
     }

     function eliminarProducto() {
     var id=document.getElementById("idp").value;
     $.get( "eliminar_producto.php", { pattern: id })
        .done(function( data ) {
              M.toast({html: 'Producto Eliminado Exitosamente', classes: 'rounded',displayLength:1000});
<<<<<<< HEAD
              setTimeout(changeView(1),1050);
          })
        .fail(function(data) {
              M.toast({html: 'Producto NO Eliminado', classes: 'rounded',displayLength:3000});
        });
     }

     function reactivarProducto(){
         var id=document.getElementById("idp").value;
         $.get( "eliminar_producto.php", { pattern: id, type:2 })
            .done(function( data ) {
                  M.toast({html: 'Producto Activado Exitosamente', classes: 'rounded',displayLength:1000});
                  setTimeout(changeView(1),1050);
              })
            .fail(function(data) {
                  M.toast({html: 'Producto NO Activado', classes: 'rounded',displayLength:3000});
            });
     }



  function sendRequest(){
   request=getRequestObject();
   if(request!=null)
   {
     var userInput = document.getElementById('userInput');
     var url='controller.php?pattern='+userInput.value;
     request.open('GET',url,true);
     request.onreadystatechange =
            function() {
                if((request.readyState==4)){
                    // Asynchronous response has arrived
                    var ajaxResponse=document.getElementById('ajaxResponse');
                    ajaxResponse.innerHTML=request.responseText;
                    ajaxResponse.style.visibility="visible";
                    M.AutoInit();
                }
            };
     request.send(null);
   }
}

function sendModificarUsuariosAct(){
    $.get( "controller_modificar_usuarios.php", { pattern: document.getElementById('usuarios_act_search').value, type:1 })
          .done(function( data ) {
              var ajaxResponse = document.getElementById('searchResultsUsersAct');
              ajaxResponse.innerHTML = data;
              ajaxResponse.style.visibility = "visible";
          });
}

function updateUsuarioAct() {
            var rol = document.getElementById("roles");
            var opcion = rol.options[rol.selectedIndex].value;
            if(opcion == "" || opcion==null){
                opcion=-1;
                document.getElementById("updateWrong").innerHTML="** No se pudo agregar el producto porque no se a selecionado el rol";
                return false;
            }
            if(opcion!=-1){
                document.getElementById("updateWrong").innerHTML="";
                $.get( "controller_modificar_usuarios.php", { type:2, id:document.getElementById('idU').value, rol:opcion })
                      .done(function( data ) {
                          M.toast({html: 'Usuario Actualizado Exitosamente', classes: 'rounded',displayLength:3000});
                          setTimeout(changeView(2),4500);
                      })
                      .fail(function(data) {
                            M.toast({html: 'Usuario NO Actualizado', classes: 'rounded',displayLength:3000});
                            setTimeout(changeView(2),4500);
                      });
            }
}

function validarNombreUsuario(){
     var name = document.getElementById("nameU").value;
            var numbers=/[0-9]/;
            if(name==""){
                document.getElementById("nameWrong").innerHTML="** Favor de ingresar su nombre";
                return false;
            }
            if(numbers.test(name)){
                document.getElementById("nameWrong").innerHTML="** El nombre no debe de contener números";
                return false;
            }
            if(name=="" || name.length<3 || name.length>50 ){
                document.getElementById("nameWrong").innerHTML="** El nombre debe de contener entre 3 a 50 caracteres";
                return false;
            }
            document.getElementById("nameWrong").innerHTML=" ";
            return true;
}

function validarApellidoPUsuario(){
            var name = document.getElementById("apellidoP").value;
            var numbers=/[0-9]/;
            if(name==""){
                document.getElementById("apellidoPWrong").innerHTML="** Favor de ingresar su apellido paterno";
                return false;
            }
            if(numbers.test(name)){
                document.getElementById("apellidoPWrong").innerHTML="** El apellido no debe de contener números";
                return false;
            }
            if(name=="" || name.length<3 || name.length>50 ){
                document.getElementById("apellidoPWrong").innerHTML="** El apellido debe de contener entre 3 a 50 caracteres";
                return false;
            }
            document.getElementById("apellidoPWrong").innerHTML=" ";
            return true;
}

function validarApellidoMUsuario(){
            var name = document.getElementById("apellidoM").value;
            var numbers=/[0-9]/;
            if(name==""){
                document.getElementById("apellidoMWrong").innerHTML="** Favor de ingresar su apellido materno";
                return false;
            }
            if(numbers.test(name)){
                document.getElementById("apellidoMWrong").innerHTML="** El apellido no debe de contener numeros";
                return false;
            }
            if(name=="" || name.length<3 || name.length>50 ){
                document.getElementById("apellidoMWrong").innerHTML="** El apellido debe de contener entre 3 a 50 caracteres";
                return false;
            }
            document.getElementById("apellidoMWrong").innerHTML=" ";
            return true;
}

function validarTelefono(){
    var tel = document.getElementById("telefono").value;
    var aux=tel.toString();
    var characters=/[%&%*?¿#@$]/;
    var min=/[a-z]/;
    var may=/[A-Z]/;
    var decimal=/[.]/;
    if(tel==""){
        document.getElementById("telWrong").innerHTML="** Favor de ingresar su número de celular";
        return false;
    }
    if(decimal.test(aux) || characters.test(aux) || min.test(aux) || may.test(aux)){
        document.getElementById("telWrong").innerHTML="** El número de celular solo puede incluir números";
        return false;
    }
    if (aux.length!=10){
        document.getElementById("telWrong").innerHTML="** El número de celular debe de tener exactamente 10 dígitos";
        return false;
    }
    document.getElementById("telWrong").innerHTML=" ";
    return true;

}

function validarCorreo(){
    var correo = document.getElementById("correo").value;
    var chars=/[@]/;
    if(correo==""){
        document.getElementById("correoWrong").innerHTML="** Favor de ingresar su correo electrónico";
        return false;
    }
    if(!(chars.test(correo)) || correo.length<10){
        document.getElementById("correoWrong").innerHTML="** Favor de ingresar un correo electrónico válido";
        return false;
    }
    document.getElementById("correoWrong").innerHTML=" ";
    return true;
}

function guardarDatosUsuario(){
    var idu=document.getElementById("idU").value;
    var name = document.getElementById("nameU").value;
    var ap = document.getElementById("apellidoP").value;
    var am = document.getElementById("apellidoM").value;
    var tel = document.getElementById("telefono").value;
    var mail = document.getElementById("correo").value;
    if(validarNombreUsuario() && validarApellidoPUsuario() && validarApellidoMUsuario() && validarTelefono() && validarCorreo()){
        document.getElementById("saveWrong").innerHTML=" ";
        $.get( "controller_modificar_usuarios.php", { type:6, id:idu ,nombre:name, aP:ap, aM:am, telefono:tel, correo:mail })
                      .done(function( data ) {
                          M.toast({html: 'Tus Datos han sido Actualizados Exitosamente', classes: 'rounded',displayLength:2000});
                          setTimeout(changeView(3),2500);
                      })
                      .fail(function(data) {
                            M.toast({html: 'Tus Datos no han sido Actualizados Exitosamente', classes: 'rounded',displayLength:2000});
                            setTimeout(changeView(3),2500);
                      });
    }else{
        document.getElementById("saveWrong").innerHTML="** No se pueden actualizar los datos porque son erróneos";
        return false;
    }
}

function sendRequestDeudores(){
   $.get( "controller_deudores.php", { pattern: document.getElementById('deudores_search').value })
          .done(function( data ) {
              var ajaxResponse = document.getElementById('contenido');
              ajaxResponse.innerHTML = data;
              ajaxResponse.style.visibility = "visible";
          })
          .fail(function(data) {
              var ajaxResponse = document.getElementById('contenido');
              ajaxResponse.innerHTML = "<div class\"container\"><h6 class=\"center\">No existe bebida con ese nombre</h6></div>";
              ajaxResponse.style.visibility = "visible";
        });
}

=======
              setTimeout(changeView,1050);
          });

     }
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
