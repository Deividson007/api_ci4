--create schema controle;

create table controle.status (
	idStatus serial primary key,
	descricao varchar(50),
	datainclusao timestamp not null default now(),
	ativo boolean not null default true
);
create table controle.tipoDespesa (
	idTipoDespesa serial primary key,
	descricao varchar(100) not null,
	datainclusao timestamp not null default now(),
	ativo boolean not null default true
);
create table controle.despesa (
	idDespesa serial primary key,
	idUsuario int references usuario.usuario(idUsuario) not null,
	descricao varchar(250) not null,
	idStatus int references controle.status(idStatus) not null,
	idTipoDespesa int references controle.tipoDespesa(idTipoDespesa) not null,
	valor decimal(15,2) null,
	dataDespesa date null,
	dataVencimento date not null,
	datainclusao timestamp not null default now(),
	ativo boolean not null default true
);
create table controle.detalheDespesa (
	idDetalheDespesa serial primary key,
	idDespesa int references controle.despesa(idDespesa) not null,
	descricao varchar(250) null,
	valor decimal(15,2) not null,
	dataDespesa date null,
	numeroParcela int null,
	datainclusao timestamp not null default now(),
	ativo boolean not null default true
);