// JavaScript Document
function imgToUrl(){
var archivo = document.getElementById("imagen").files[0];
  var reader = new FileReader();
  if (file) {
    reader.readAsDataURL(archivo );
    reader.onloadend = function () {
      document.getElementById("imagen").value = reader.result;
    }
  }
}