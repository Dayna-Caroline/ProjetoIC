function marca(source) {
    checkboxes = document.getElementsByName('check_list[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }

document.addEventListener('DOMContentLoaded', function() {
  setInterval(function(){ 
    let b = document.getElementById('conteudo');
    let cons = window.getComputedStyle(b, "").getPropertyValue("width");
    if(cons>"823px"){
      let newValue = window.getComputedStyle(b, "").getPropertyValue("height");
      document.getElementById('aba').style.height = newValue;
    }
    else{
      document.getElementById('aba').style.height = "120px";
    }
  }, 500);
}, false);
  
  function verifica() {
    checkboxes = document.getElementsByName('check_list[]');
    marcatodos = document.getElementById('marcatodos');

    let a=0;

    checkboxes.forEach(element => {
      if(element.checked==true){a++;}
    });

    if(a < checkboxes.length ){
      marcatodos.checked = false;
    }

    else{
      marcatodos.checked = true;
    }
  
    checkboxes.forEach(element => {
      if(element.checked==true){a++;}
    });
  
    if(a==0) {
      document.getElementById('arquiva').disabled = true;
      document.getElementById('arquiva').style.cursor = "default";
    }
    else{
      document.getElementById('arquiva').disabled = false;
      document.getElementById('arquiva').style.cursor = "pointer";
    }
}
