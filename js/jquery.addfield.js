var y = jQuery.noConflict();

y(document).ready(function() {
	//ACA le asigno el evento click a cada boton de la clase bt_plus y llamo a la funcion addField
		y(".bt_plus").each(function (el){
			y(this).bind("click",addField);
									 });
							});


function addField(){
// ID del elemento div quitandole la palabra "div_" de delante. Pasi asi poder aumentar el número. Esta parte no es necesaria pero yo la utilizaba ya que cada campo de mi formulario tenia un autosuggest , así que dejo como seria por si a alguien le hace falta.

var clickID = parseInt(y(this).parent('div').attr('id').replace('div_',''));

// Genero el nuevo numero id
var newID = (clickID+1);

// Creo un clon del elemento div que contiene los campos de texto
ynewClone = y('#div_'+clickID).clone(true);

//Le asigno el nuevo numero id
ynewClone.attr("id",'div_'+newID);

//Asigno nuevo id al primer campo input dentro del div y le borro cualquier valor que tenga asi no copia lo ultimo que hayas escrito.(igual que antes no es necesario tener un id)
ynewClone.children("input").eq(0).attr("id",'materiales_'+newID).val('');

ynewClone.children("div").eq(0).attr("id",'lista_'+newID).val('');

//Borro el valor del segundo campo input(este caso es el campo de cantidad)
ynewClone.children("input").eq(1).val('');

//Borro el valor del segundo campo input(este caso es el campo de precio)
ynewClone.children("input").eq(2).val('');

ynewClone.children("input").eq(3).val('');

//Asigno nuevo id al boton
ynewClone.children("input").eq(1).attr("id",newID)

//Inserto el div clonado y modificado despues del div original
ynewClone.insertAfter(y('#div_'+clickID));

//Cambio el signo "+" por el signo "-" y le quito el evento addfield
y("#"+clickID).val('-').unbind("click",addField);

//Ahora le asigno el evento delRow para que borre la fial en caso de hacer click
y("#"+clickID).bind("click",delRow);

}


function delRow() {
// Funcion que destruye el elemento actual una vez echo el click
y(this).parent('div').remove();

}
