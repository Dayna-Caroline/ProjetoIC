document.addEventListener('DOMContentLoaded', function() {
  setInterval(function(){ 
    let b = document.getElementById('conteudo');
    let cons = window.getComputedStyle(b, null).getPropertyValue("width");
    if(cons>"823px"){
      let newValue = window.getComputedStyle(b, null).getPropertyValue("height");
      document.getElementById('aba').style.height = newValue;
    }
  }, 500);
}, false);