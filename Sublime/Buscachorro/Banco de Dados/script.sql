/* 
	Grupo de TCC
    - Pedro Henrique Rosa
    - Vinícius Franco Moreira
    - Victor Hugo Antunes
    - Luiz Fernando dos Santos Silva,
    - Nicolas Jose Do Nascimento,
    - Rafael
 */

create database if not exists db_buscachorro;
use db_buscachorro;


/* ----------- Criação das Tabelas ------------  */

/*  Tabela RAÇA  */

create table tb_raca(
cd_raca int auto_increment primary key,
nm_raca varchar(150) not null unique
);

/*  Tabela COR   */

create table tb_cor(
cd_cor int not null auto_increment primary key,
nm_cor varchar(100) not null unique
);

/*  Tabela Usuario   */

create table tb_usuario(
cd_usuario int primary key auto_increment not null,
nm_nome varchar(140) not null,
nm_email varchar(140) not null unique,
nm_cidade VARCHAR(140),
nm_estado varchar(20),
nm_senha varchar(40) not null,
nm_cep varchar(15) not null,
ct_usuario varchar(20) not null,
dt_registro DATETIME default current_timestamp,
cd_tipo_usuario int not null,  -- Se 1 = ADM. Se 2 = Cliente
cd_status_usuario char(1) not null


);

/*  Tabela Animal  */

create table tb_animal(
cd_animal int not null primary key auto_increment,
nm_animal varchar(140),
sexo_animal varchar(30),
nm_ponto_referencia varchar(150),
descricao longtext,
dt_registro datetime not null default current_timestamp,
nm_porte varchar(45) not null,
st_animal char(1) not null,
id_usuario int,
id_cor int not null,
id_raca int not null,
foreign key(id_usuario) references tb_usuario (cd_usuario),
foreign key(id_cor) references tb_cor (cd_cor),
foreign key(id_raca) references tb_raca (cd_raca)
);

/*  Tabela Foto   */

create table tb_foto(

cd_foto_aimal int not null primary key auto_increment,
url_imagem varchar(150) not null,
id_animal int not null,
foreign key(id_animal) references tb_animal(cd_animal)
);

/*  Tabela Comentario   */

create table tb_comentario(
cd_comentario int not null primary key auto_increment,
dt_comentario datetime not null,
ds_comentario longtext not null,
id_usuario int not null,
id_animal int not null,
foreign key(id_usuario) references tb_usuario(cd_usuario),
foreign key(id_animal) references tb_animal(cd_animal)
);

/*  Tabela Localização */

create table tb_localizacao(
cd_localizacao int not null primary key auto_increment,
cd_latitude varchar(150) not null,
cd_longitude varchar(150) not null,
dt_registro datetime default current_timestamp,
id_animal int not null,
id_usuario int not null,
foreign key(id_animal) references tb_animal(cd_animal),
foreign key(id_usuario) references tb_usuario(cd_usuario)

);

/*  Tabela Foto Localização  */

create table tb_foto_localizacao(
cd_foto_localizacao int not null primary key auto_increment,
url_foto varchar(150) not null,
id_localizacao int not null,
foreign key (id_localizacao) references tb_localizacao (cd_localizacao)
);

show tables;

/* ------------- Insert de Dados ------- */


/*  Insert de Raças */

insert into tb_raca set
nm_raca = "Pit-Bull";

insert into tb_raca set
nm_raca = "RotWiller";

insert into tb_raca set
nm_raca = "Border-Collie";

insert into tb_raca set
nm_raca = "Pastor-Alemão";

insert into tb_raca set
nm_raca = "Pinscher";

insert into tb_raca set
nm_raca = "Poodle";

insert into tb_raca set
nm_raca = "Golden-Retriever";

insert into tb_raca set
nm_raca = "Labrador";

insert into tb_raca set
nm_raca = "Husky";

insert into tb_raca set
nm_raca = "Shih-Tzu";

insert into tb_raca set
nm_raca = "Lhasa-Apso";

insert into tb_raca set
nm_raca = "Pug";

insert into tb_raca set
nm_raca = "Bulldog-francês";

insert into tb_raca set
nm_raca = "Chihuahua";

insert into tb_raca set
nm_raca = "Vira-Lata";

/*  Insert de Cores */

insert into tb_cor set
nm_cor = "Branco";

insert into tb_cor set
nm_cor = "Caramelo";

insert into tb_cor set
nm_cor = "Marrom";

insert into tb_cor set
nm_cor = "Preto";

insert into tb_cor set
nm_cor = "Amarelo";

insert into tb_cor set
nm_cor = "Cinza";

insert into tb_cor set
nm_cor = "Dourado";

insert into tb_cor set
nm_cor = "Tigrado";

insert into tb_cor set
nm_cor = "Azul";

insert into tb_cor set
nm_cor = "Fulvo";

insert into tb_cor set
nm_cor = "Creme";

insert into tb_cor set
nm_cor = "Ruivo";

insert into tb_cor set
nm_cor = "Rajado";

insert into tb_cor set
nm_cor = "Merle";

insert into tb_cor set
nm_cor = "Prateado";

-- INSERT DE USUARIOS ADMINISTRADORES!

insert into tb_usuario set
nm_nome = "Nicolas",
nm_email = "nicj@adm.com",
nm_senha = md5("123"),
ct_usuario = "123",
cd_tipo_usuario = 1,
cd_status_usuario = 1;

insert into tb_usuario set
nm_nome = "Pedro",
nm_email = "pedroh@adm.com",
nm_senha = md5("123"),
ct_usuario = "123",
cd_tipo_usuario = 1,
cd_status_usuario = 1;

insert into tb_usuario set
nm_nome = "Gustavo",
nm_email = "gusg@adm.com",
nm_senha = md5("123"),
ct_usuario = "123",
cd_tipo_usuario = 1,
cd_status_usuario = 1;

insert into tb_usuario set
nm_nome = "Victor",
nm_email = "vica@adm.com",
nm_senha = md5("123"),
ct_usuario = "123",
cd_tipo_usuario = 1,
cd_status_usuario = 1;

insert into tb_usuario set
nm_nome = "Vinicius",
nm_email = "vinif@adm.com",
nm_senha = md5("123"),
ct_usuario = "123",
cd_tipo_usuario = 1,
cd_status_usuario = 1;

/*  Insert Tabela Usuario*

Exemplos de INSERTS NÃO NECESSÁRIOS!

/

-- insert into tb_usuario set
-- nm_nome = "Vinicius",
-- nm_email = "vinicius@mail.com",
-- nm_senha = md5("123"),
-- ct_usuario = "(12)98765-9898",
-- cd_tipo_usuario = 1;

-- insert into tb_usuario set
-- nm_nome = "Pedro",
-- nm_email = "pedro@mail.com",
-- nm_senha = md5("123"),
-- ct_usuario = "(12)98735-9898",
-- cd_tipo_usuario = 1;

-- insert into tb_usuario set
-- nm_nome = "Victor",
-- nm_email = "victor@mail.com",
-- nm_senha = md5("123"),
-- ct_usuario = "(12)98732-9898",
-- cd_tipo_usuario = 1;

-- insert into tb_usuario set
-- nm_nome = "Rafael",
-- nm_email = "rafael@mail.com",
-- nm_senha = md5("123"),
-- ct_usuario = "(12)98235-9898",
-- cd_tipo_usuario = 1;

-- insert into tb_usuario set
-- nm_nome = "Luiz",
-- nm_email = "luiz@mail.com",
-- nm_senha = md5("123"),
-- ct_usuario = "(12)18735-9898",
-- cd_tipo_usuario = 1;

-- /*  Insert Tabela Animal*/

-- insert into tb_animal set 
-- nm_animal = "Cristal",
-- sexo_animal = "Feminino",
-- nm_ponto_referencia = "Etec Ilza Nascimento Pintus",
-- descricao = "Perto da portaria da etec. Em frente à preça",
-- nm_porte = "Médio",
-- st_animal = "1",
-- id_usuario = "1",
-- id_cor = "2",
-- id_raca = "15";

-- insert into tb_animal set 
-- nm_animal = "Caleb",
-- sexo_animal = "Masculino",
-- nm_ponto_referencia = "carrefour",
-- descricao = "Proximo ao carrefour da etec. Em frente à preça",
-- nm_porte = "Grande",
-- st_animal = "1",
-- id_usuario = "2",
-- id_cor = "4",
-- id_raca = "12";

-- insert into tb_animal set 
-- nm_animal = "Roger",
-- sexo_animal = "Masculino",
-- nm_ponto_referencia = "Golden",
-- descricao = "Em frente ao golden",
-- nm_porte = "Pequeno",
-- st_animal = "1",
-- id_usuario = "3",
-- id_cor = "5",
-- id_raca = "3";

-- insert into tb_animal set 
-- nm_animal = "Nunes",
-- sexo_animal = "Masculino",
-- nm_ponto_referencia = "Golden",
-- descricao = "Atrás do golden",
-- nm_porte = "Grande",
-- st_animal = "1",
-- id_usuario = "4",
-- id_cor = "8",
-- id_raca = "1";

-- insert into tb_animal set 
-- nm_animal = "Magalhaes",
-- sexo_animal = "Masculino",
-- nm_ponto_referencia = "Subway",
-- descricao = "Em frente ao subway",
-- nm_porte = "Médio",
-- st_animal = "1",
-- id_usuario = "5",
-- id_cor = "10",
-- id_raca = "1";

/*  Consulta nome do Animal*/

-- select nm_animal
-- from
--  tb_animal
-- where 
-- id_cor  = 2
-- ;

-- select nm_animal
-- from
--  tb_animal
-- where 
-- id_cor  = 4
-- ;

/*  Consulta portes animal*/

-- select 
-- nm_porte,
-- nm_animal
-- from
-- tb_animal;

/*  Consulta nome usuario, nome animal, porte do animal e cor do animal*/

-- select tb_usuario.nm_nome as "Nome do Usuário",
--  tb_animal.nm_animal as "Nome do Animal",
--  nm_porte as "Porte do Animal",
--  tb_cor.nm_cor as "Cor do Animal"
-- from tb_animal
-- inner join tb_usuario on tb_animal.id_usuario = tb_usuario.cd_usuario
-- inner join tb_cor on tb_animal.id_cor = tb_cor.cd_cor;

-- select * from tb_usuario;
-- select * from tb_animal;
-- select * from tb_cor;
-- show tables;