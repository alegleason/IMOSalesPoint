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
          });
}

function sendRequestComidas(){
   $.get( "controller_comidas.php", { pattern: document.getElementById('comidas_search').value })
          .done(function( data ) {
              var ajaxResponse = document.getElementById('contenido');
              ajaxResponse.innerHTML = data;
              ajaxResponse.style.visibility = "visible";
          });
}

function sendRequestPostres(){
   $.get( "controller_postres.php", { pattern: document.getElementById('postres_search').value })
          .done(function( data ) {
              var ajaxResponse = document.getElementById('contenido');
              ajaxResponse.innerHTML = data;
              ajaxResponse.style.visibility = "visible";
          });
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
       }

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
            if(precio=="") document.getElementById("priceWrong").innerHTML="** Favor de ingresar el precio del producto";
            else if(decimal.test(aux)) document.getElementById("priceWrong").innerHTML="** El precio solo puede incluir números enteros";
            else if(characters.test(aux) || min.test(aux) || may.test(aux)) document.getElementById("priceWrong").innerHTML="** El precio solo puede incluir números";
            else if (precio<=0 || precio>100) document.getElementById("priceWrong").innerHTML="** El precio debe ser mayor a 0 y menor o igual a 100";
            else document.getElementById("priceWrong").innerHTML="";
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
                    $.get( "insertar_producto.php", { nombre: name,des:descripcion,price:precio,cate:cat })
                          .done(function( data ) {
                              M.toast({html: 'Producto Agregado al Sistema', classes: 'rounded',displayLength:1500});
                              document.getElementById("nombre").value="";
                              document.getElementById("descripcion").value="";
                              document.getElementById("precio").value="";
                              categoria.options[categoria.selectedIndex].value="";
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


    function changeView(){
         window.location='producto.php';
     }

     function eliminarProducto() {
     var id=document.getElementById("idp").value;
     $.get( "eliminar_producto.php", { pattern: id })
        .done(function( data ) {
              M.toast({html: 'Producto Eliminado Exitosamente', classes: 'rounded',displayLength:1000});
              setTimeout(changeView,1050);
          });

     }
