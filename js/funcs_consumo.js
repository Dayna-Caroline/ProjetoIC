function marca(source) {
    checkboxes = document.getElementsByName('check_list[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }
  
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
