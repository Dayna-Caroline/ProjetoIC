function marca(source) {
    checkboxes = document.getElementsByName('check_list[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }