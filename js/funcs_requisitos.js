function editar() {
    
    document.getElementById('editar').style.backgroundColor = "#bebebe";
    document.getElementById('visualizar').style.backgroundColor = "#f1f1f1";
    
    document.getElementById('processo').disabled=false;
    document.getElementById('descricao').disabled=false;
    document.getElementById('versao').disabled=true;
    document.getElementById('tipo').disabled=false;
    document.getElementById('cadastro').disabled=true;
    document.getElementById('titulo').disabled=false;
    document.getElementById('custo').disabled=false;

    document.getElementById('processo').style.cursor="text";
    document.getElementById('descricao').style.cursor="text";
    document.getElementById('versao').style.cursor="not-allowed";
    document.getElementById('tipo').style.cursor="text";
    document.getElementById('cadastro').style.cursor="not-allowed";
    document.getElementById('titulo').style.cursor="text";
    document.getElementById('custo').style.cursor="text";

    document.getElementById('editar').disabled=true;
    document.getElementById('visualizar').disabled=false;

}

function visualizar() {

    document.getElementById('editar').style.backgroundColor = "#f1f1f1";
    document.getElementById('visualizar').style.backgroundColor = "#bebebe";

    document.getElementById('processo').disabled=true;
    document.getElementById('descricao').disabled=true;
    document.getElementById('versao').disabled=true;
    document.getElementById('tipo').disabled=true;
    document.getElementById('cadastro').disabled=true;
    document.getElementById('titulo').disabled=true;
    document.getElementById('custo').disabled=true;


    document.getElementById('processo').style.cursor="not-allowed";
    document.getElementById('descricao').style.cursor="not-allowed";
    document.getElementById('versao').style.cursor="not-allowed";
    document.getElementById('tipo').style.cursor="not-allowed";
    document.getElementById('cadastro').style.cursor="not-allowed";
    document.getElementById('titulo').style.cursor="not-allowed";
    document.getElementById('custo').style.cursor="not-allowed";


    document.getElementById('altera').style.visibility="hidden";
    document.getElementById('cancela').style.visibility="hidden";
    
    document.getElementById('altera').style.display="none";
    document.getElementById('cancela').style.display="none";

    document.getElementById('editar').disabled=false;
    document.getElementById('visualizar').disabled=true;

}

function alterou() {
    document.getElementById('altera').style.visibility="visible";
    document.getElementById('cancela').style.visibility="visible";
    document.getElementById('altera').style.display="flex";
    document.getElementById('cancela').style.display="flex";

    document.getElementById('visualizar').disabled=true;
    document.getElementById('visualizar').style.cursor = "not-allowed";
}

function fecha_e(){
    document.getElementById('erro').style.display = "none";
}
  
function fecha_s(){
    document.getElementById('sucesso').style.display = "none";
}