// JavaScript Document
function bdDateToString(cadena){
	var aux = cadena.split('/');
	var result;
	aux = aux.reverse();
	aux[0]="20"+aux[0];
	result = aux.join('-');
	return result;
}