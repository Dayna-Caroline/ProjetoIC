/*scripts desenvolvidos por Fernanda Castor Modolo 19/02*/
/*Atualizado por Dayna Caroline Domiciano do Prado 26/02*/
drop table if exists consumo;
drop table if exists mudancas;
drop table if exists requisitos;
drop table if exists equipamentos;
drop table if exists projeto;
drop table if exists profissional;
drop table if exists empresa;

drop sequence if exists id_empresa;
drop sequence if exists id_projeto;
drop sequence if exists id_profissional;
drop sequence if exists id_equipamento;
drop sequence if exists id_requisito;
drop sequence if exists id_mud;
drop sequence if exists id_consumo;

create sequence id_empresa
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create sequence id_projeto
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create sequence id_profissional
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create sequence id_equipamento
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create sequence id_requisito
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create sequence id_mud
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create sequence id_consumo
minvalue 1
maxvalue 9223372036854775807
start 1
cache 1;

create table empresa
(
    id_empresa integer not null default nextval('id_empresa'),
    razao varchar(100) not null,
    fantasia varchar(50) not null,
    cep varchar(9) not null,
    endereco varchar(100) not null,
    numero varchar(50) not null,
    bairro varchar(100) not null,
    complemento varchar(100) ,
    cidade varchar(100) not null,
    uf varchar(2) not null,
    cnpj varchar(18) not null,
    ie varchar(16) not null,
    cnae varchar(10) not null,
    ativo varchar(1) not null,
    senha varchar(50) not null,
    primary key(id_empresa) 

);

create table profissional
(
    id_profissional integer not null default nextval('id_profissional'),
    nome varchar(100) not null,
    cpf varchar(14) not null,
    doc varchar(14) not null,
    tipo varchar(1) not null,
    cep varchar(9) not null,
    endereco varchar(100) not null,
    numero varchar(50) not null,
    bairro varchar(100) not null,
    complemento varchar(100) not null,
    cidade varchar(100) not null,
    uf varchar(2) not null,
    registro varchar(14) not null,
    orgao varchar(10) not null,
    empresa integer not null,
    primary key(id_profissional),
    foreign key(empresa) references empresa(id_empresa)
);

create table projeto
(   
    id_projeto integer not null default nextval('id_projeto'),
    descricao varchar(100) not null,
    finalidade varchar(100) not null,
    orcamento float(24) not null,
    responsavel integer not null, 
    aprovacao date not null,
    inicio date not null,
    fim date not null,
    c_final float(24) not null,
    empresa integer not null,
    primary key(id_projeto),
    foreign key (empresa) references empresa(id_empresa),
    foreign key(responsavel) references profissional(id_profissional)

);


create table equipamentos 
(
     id_equipamento integer not null default nextval('id_equipamento'),
     descricao varchar(100) not null,
     marca varchar(50) not null,
     fabricante varchar(50) not null,
     tipo varchar(50) not null,
     modelo varchar(10) not null,
     tensao varchar(3) not null,
     consumo float(24) not null,
     classe varchar(1) not null,
     empresa integer not null,
     primary key(id_equipamento),
     foreign key(empresa) references empresa(id_empresa)

);

create table requisitos
(
    id_requisito integer not null default nextval('id_requisito'),
    projeto integer not null,
    titulo varchar(50) not null,
    processo varchar(50) not null,
    cadastro date not null,
    versao varchar(10) not null,
    descricao varchar(100) not null,
    tipo integer not null,
    primary key(id_requisito),
    foreign key(projeto) references projeto(id_projeto)
);

create table mudancas
(
    id_mudanca integer not null default nextval ('id_mud'),
    projeto integer not null,
    pedido date,
    tipo varchar(1),
    aceite varchar(1),
    solicitante integer not null, 
    requisito integer not null,
    descricao varchar(10000), 
    custo float(24),
    primary key(id_mudanca),
    foreign key (projeto) references projeto(id_projeto),
    foreign key (requisito) references requisitos(id_requisito)
);

create table consumo
(
    id_consumo integer not null default nextval ('id_consumo'),
    empresa integer not null,
    equipamento integer not null,
    mes integer not null,
    ano integer not null,
    consumo float(24),
    primary key(id_consumo),
    foreign key(empresa) references empresa(id_empresa),
    foreign key(equipamento) references equipamentos(id_equipamento)
);
