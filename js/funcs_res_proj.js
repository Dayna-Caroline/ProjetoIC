function marca(source) {
    checkboxes = document.getElementsByName('check_list_restaurar[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }
  
  function verifica() {
  
    checkboxes = document.getElementsByName('check_list_restaurar[]');
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
  
    if(a==0) {
      document.getElementById('restaura').disabled = true;
      document.getElementById('restaura').style.cursor = "default";
    }
    else{
      document.getElementById('restaura').disabled = false;
      document.getElementById('restaura').style.cursor = "pointer";
    }
    
  }