function editar() {
    
    document.getElementById('editar').style.backgroundColor = "#bebebe";
    document.getElementById('visualizar').style.backgroundColor = "#f1f1f1";
    
    document.getElementById('profissional').disabled=false;
    document.getElementById('descricao').disabled=false;
    document.getElementById('finalidade').disabled=false;
    document.getElementById('orcamento').disabled=false;
    document.getElementById('previa').disabled=false;
    document.getElementById('inicio').disabled=false;
    document.getElementById('aprovacao').disabled=false;

    document.getElementById('profissional').style.cursor="pointer";
    document.getElementById('descricao').style.cursor="text";
    document.getElementById('finalidade').style.cursor="text";
    document.getElementById('orcamento').style.cursor="text";
    document.getElementById('previa').style.cursor="text";
    document.getElementById('inicio').style.cursor="text";
    document.getElementById('aprovacao').style.cursor="text";

    if(document.getElementById('fim')){
        document.getElementById('fim').disabled=true;
        document.getElementById('fim').style.cursor="text";
    }

    if(document.getElementById('c_final')){
        document.getElementById('c_final').disabled=true;
        document.getElementById('c_final').style.cursor="text";
    }

    document.getElementById('editar').disabled=true;
    document.getElementById('visualizar').disabled=false;

}

function visualizar() {

    document.getElementById('editar').style.backgroundColor = "#f1f1f1";
    document.getElementById('visualizar').style.backgroundColor = "#bebebe";

    document.getElementById('profissional').disabled=true;
    document.getElementById('descricao').disabled=true;
    document.getElementById('finalidade').disabled=true;
    document.getElementById('orcamento').disabled=true;
    document.getElementById('inicio').disabled=true;
    document.getElementById('aprovacao').disabled=true;
    document.getElementById('previa').disabled=true;

    document.getElementById('profissional').style.cursor="not-allowed";
    document.getElementById('descricao').style.cursor="not-allowed";
    document.getElementById('finalidade').style.cursor="not-allowed";
    document.getElementById('orcamento').style.cursor="not-allowed";
    document.getElementById('inicio').style.cursor="not-allowed";
    document.getElementById('aprovacao').style.cursor="not-allowed";
    document.getElementById('previa').style.cursor="not-allowed";

    if(document.getElementById('fim')){
        document.getElementById('fim').disabled=true;
        document.getElementById('fim').style.cursor="not-allowed";
    }

    if(document.getElementById('c_final')){
        document.getElementById('c_final').disabled=true;
        document.getElementById('c_final').style.cursor="not-allowed";
    }

    document.getElementById('salvar').style.visibility="hidden";
    document.getElementById('cancelar').style.visibility="hidden";
    
    document.getElementById('salvar').style.display="none";
    document.getElementById('cancelar').style.display="none";

    document.getElementById('editar').disabled=false;
    document.getElementById('visualizar').disabled=true;

}

function alterou() {
    document.getElementById('salvar').style.visibility="visible";
    document.getElementById('cancelar').style.visibility="visible";
    document.getElementById('salvar').style.display="flex";
    document.getElementById('cancelar').style.display="flex";

    document.getElementById('visualizar').disabled=true;
    document.getElementById('visualizar').style.cursor = "not-allowed";
}

