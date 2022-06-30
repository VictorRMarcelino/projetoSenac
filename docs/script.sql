/**
CREATE TABLE public.usuario (
    id serial NOT NULL,
    nome varchar(100) NOT NULL,
    senha varchar(30) NOT NULL,
    email varchar(50) NOT NULL,
    sexo varchar(30) NOT NULL,
    sobreMim varchar(200),
    CONSTRAINT usuario_pkey PRIMARY KEY (id)
);

CREATE TABLE public.publicacoes (
	id serial4 NOT NULL,
	usuario int NOT NULL,
	publicacao varchar(150) NOT NULL,
	tipo_publicacao varchar(30) NOT NULL,
	data_publicacao date NOT NULL,
	CONSTRAINT publicacoes_pkey PRIMARY KEY (id),
	CONSTRAINT "FK_PUBLICACOES=>USUARIO" FOREIGN KEY (usuario) REFERENCES public.usuario(id)
);

CREATE TABLE public.amigos (
    usuario int2 NOT NULL,
    listaamigos json NOT null default '[]',
    CONSTRAINT amigos_pkey PRIMARY KEY (usuario)
);

create table reclamacoes(
id serial not null,
usuario varchar(100) not null,
email varchar(100) not null,
tipoReclamacao varchar(100) not null,
reclamacao varchar(250) not null,
constraint reclamacoes_pkey primary key (id)
);

CREATE TABLE public.usuarioamigos (
	id_usuario serial4 NOT NULL,
	lista_amigos json null,
	CONSTRAINT usuarioamigos_pkey PRIMARY KEY (id_usuario)
);

CREATE TABLE public.solicitacao (
	id_usuario serial4 NOT NULL,
	solicitacao_enviada json null, -- lista de id de usuario que foi enviado solicitacao
	solicitacao_recebida json null, -- lista de id de usuario que me enviou solicitacao de amizade
	CONSTRAINT solicitacao_pkey PRIMARY KEY (id_usuario)
);

CREATE TABLE public.solicitacao_enviada_status (
	id_usuario int NOT null,
	status varchar (200) not null, --PENDENTE, ACEITO
	CONSTRAINT solicitacao_enviada_status_pkey PRIMARY KEY (id_usuario)
);

CREATE TABLE public.solicitacao_recebida_status (
	id_usuario int NOT null,
	status varchar (200) not null, --PENDENTE, ACEITO
	CONSTRAINT solicitacao_recebida_status_pkey PRIMARY KEY (id_usuario)
);

-- criar uma pagina de profile com link de opcao de solicitar amizade, apos clicar no usuario na feedline




