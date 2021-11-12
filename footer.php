<!--=============================================
=            Include JavaScript files           =
==============================================-->

<!-- jQuery V3.4.1 -->
<script src="./js/jquery-3.4.1.min.js" ></script>

<!-- popper -->
<script src="./js/popper.min.js" ></script>

<!-- Bootstrap V4.3 -->
<script src="./js/bootstrap.min.js" ></script>

<!-- jQuery Custom Content Scroller V3.1.5 -->
<script src="./js/jquery.mCustomScrollbar.concat.min.js" ></script>

<!-- Bootstrap Material Design V4.0 -->
<script src="./js/bootstrap-material-design.min.js" ></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

<script src="./js/main.js" ></script>

<script type="text/javascript" src="./js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/jquery.jframe.js"></script>



<script>


//var y = jQuery.noConflict();

$(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase bt_plus y llamo a la funcion addField
		$(".bt_plus").each(function (el){
			$(this).val('+').bind("click",addField);
									 });
							});


function addField(){
    // ID del elemento div quitandole la palabra "div_" de delante. Pasi asi poder aumentar el número. Esta parte no es necesaria pero yo la utilizaba ya que cada campo de mi formulario tenia un autosuggest , así que dejo como seria por si a alguien le hace falta.

    var clickID = parseInt($(this).parent('div').attr('id').replace('div_',''));

    // Genero el nuevo numero id
    var newID = (clickID+1);

    // Creo un clon del elemento div que contiene los campos de texto
    ynewClone = $('#div_'+clickID).clone(true);

    //Le asigno el nuevo numero id
    ynewClone.attr("id",'div_'+newID);

    //Asigno nuevo id al primer campo input dentro del div y le borro cualquier valor que tenga asi no copia lo ultimo que hayas escrito.(igual que antes no es necesario tener un id)
    ynewClone.children("input").eq(0).attr("id",'cod_'+newID).val('');
    ynewClone.children("input").eq(1).attr("id",'productos_'+newID).val('');
    ynewClone.children("div").eq(0).attr("id",'lista_'+newID).val('');

    //Borro el valor del segundo campo input(este caso es el campo de cantidad)
    ynewClone.children("input").eq(2).val('');

    //Borro el valor del segundo campo input(este caso es el campo de precio)
    ynewClone.children("input").eq(3).val('');

    //Asigno nuevo id al boton

    ynewClone.children("input").eq(4).attr("id",newID);


    //Inserto el div clonado y modificado despues del div original
    ynewClone.insertAfter($('#div_'+clickID));

    //Cambio el signo "+" por el signo "-" y le quito el evento addfield
    $("#"+clickID).val('-').unbind("click",addField);

    //Ahora le asigno el evento delRow para que borre la fial en caso de hacer click
    $("#"+clickID).bind("click",delRow);

    }


    function delRow() {
      // Funcion que destruye el elemento actual una vez echo el click
      $(this).parent('div').remove();
      sumar_cantidad();
    }



function buscar_producto(str){

  //var z = jQuery.noConflict();
	var elemento = event.srcElement ? event.srcElement : event.target;
    var id = elemento.id;
    var x=id.split("_");
	//var idx=parseInt(x[1])+1;
	document.getElementById('lista_'+x[1]).style.display='block';
		var c=str.split(" ");

		str=c[0];
		if(c[1])
		str+="_"+c[1];
		if(c[2])
		str+="_"+c[2];
		if(c[3])
		str+="_"+c[3];

	if (str.length==0)
    {
    document.getElementById("lista_"+x[1]).innerHTML="";
    return;
    }

		var url="buscar_productos.php";
		url=url+"?q="+str+"&id="+x[1];
		$("#lista_"+x[1]).loadJFrame(url, function(){
         //efecto
		});

}

	function buscar_clientes(str){

	  //var z = jQuery.noConflict();
    document.getElementById('lista_clientes').style.display='block';
		var url="buscar_clientes.php";
		url=url+"?q="+str;
		$("#lista_clientes").loadJFrame(url, function(){
         //efecto
		});

    if (str.length==0)
      {
      document.getElementById("nombre_cliente").innerHTML="";
      document.getElementById("lista_clientes").style.display='none';
      document.getElementById("etiqueta").style.display='none';
      return;
      }

	}

  function agregar(id){

  //aquí instanciamos al componente div
     var padre = document.getElementById("nombre_cliente");
     //aquí agregamos el componente de tipo input
     var input = document.createElement("INPUT");

     //aquí indicamos que es un input de tipo text
     input.type = 'text';
  	 input.className = "form-control";
  	 input.name = "nombre";
  	 input.value = id;

     //y por ultimo agreamos el componente creado al padre
     padre.appendChild(input);
  	 document.getElementById("etiqueta").style.display='block';
  }

function sumar_cantidad(){
  var total=0;
  var precios = document.getElementsByName('precios[]');
  var cantidad = document.getElementsByName('cantidad[]');

  for (var i = 0; i < precios.length; i++) {
     if(parseInt(cantidad[i].value)>0)
        total +=parseFloat(precios[i].value)*parseFloat(cantidad[i].value);

  }
     document.getElementById('pago_total').value=total;//al final colocamos la suma en algún input.

}

function tipo_pago(){

  var myselect = document.getElementById("item_estado");
    if(myselect.options[myselect.selectedIndex].value==0||myselect.options[myselect.selectedIndex].value==1){
       document.getElementById("referencia_pago").style.display='block';
			 document.getElementById("tipo_banco_referencia").style.display='block';
     }
    else {
      document.getElementById("referencia_pago").style.display='none';
			document.getElementById("tipo_banco_referencia").style.display='none';

    }


}



  </script>
<?php mysqli_close($link); ?>
</body>
</html>
