drop database moviepass;
CREATE database moviepass;

use moviepass;

CREATE TABLE usertypes(
	idusertype int not null auto_increment,
    nameusertype varchar(50),
    constraint PK_USERTYPE primary key(idusertype),
    constraint UNQ_NAMEUSERTYPE unique(nameusertype)
)ENGINE=InnoDB;

CREATE TABLE users(
	iduser int not null auto_increment,
    idusertype int not null,
    firstname varchar(50),
    lastname varchar(50),
    username varchar(50),
    email varchar(50),
    userpassword varchar(100),
    isactiveu boolean,
    constraint PK_USER primary key(iduser),
    constraint FK_USERTYPE foreign key(idusertype) references usertypes(idusertype),
    constraint UNQ_USERNAME unique(username),
    constraint UNQ_EMAIL unique(email)
)ENGINE=InnoDB;

CREATE TABLE cinemas(
	idcinema int not null auto_increment,
	namecinema varchar(50),
	adress varchar(100),
	phonenumber varchar(50),
    isactivec boolean,
	constraint PK_CINEMA  primary key(idcinema),
    constraint UNQ_CINE unique (namecinema,adress)
)ENGINE=InnoDB;

CREATE TABLE billboards(
	idbillboard int not null auto_increment,
    idcinema int not null,
    isactive boolean,
    constraint PK_BILLBOARD primary key (idbillboard),
    constraint FK_CINEMA foreign key(idcinema) references cinemas (idcinema)
)ENGINE=InnoDB;

CREATE TABLE typerooms(
	idtyperoom int not null auto_increment,
    nametyperoom varchar(50),
    constraint PK_TYPEROOM primary key (idtyperoom)
)ENGINE=InnoDB;

CREATE TABLE rooms(
	idroom int not null auto_increment,
	nameroom varchar(50),
	capacity int,
	idtyperoom int not null,
	idcinema int not null,
    ticketcost int,
    isactiver boolean,
    constraint PK_ROOM primary key (idroom),
    constraint FK_CINEROOM foreign key (idcinema) references cinemas (idcinema),
    constraint FK_TYPEROOM foreign key (idtyperoom) references typerooms(idtyperoom)
)ENGINE=InnoDB;

CREATE TABLE genres(
	idgenre int not null,
    namegenre varchar(50),
    constraint PK_GENRE primary key (idgenre),
    constraint UNQ_GENRE unique (namegenre)
)ENGINE=InnoDB;

CREATE TABLE movies(
	idmovie int not null auto_increment,
    imdbid int not null,
    namemovie varchar(100),
    synopsis varchar(1000),
    poster varchar(500),
    background varchar(500),
	voteAverage int,
    runtime int,
    isactiveMovie boolean,
    constraint PK_MOVIE primary key (idmovie),
    constraint UNK_IMDBID unique (imdbid)
)ENGINE=InnoDB;


CREATE TABLE genresxmovie(
	idgenrexmovie int not null auto_increment,
    idgenre int not null,
    idmovie int not null,
    constraint PK_GENRESXMOVIE primary key(idgenrexmovie),
    constraint FK_IDGENRE foreign key(idgenre) references genres(idgenre),
    constraint FK_IDMOVIE foreign key(idmovie) references movies(idmovie)
)ENGINE=InnoDB;

CREATE TABLE typemovieshows(
	idtypemovieshow int not null auto_increment,
    nametypemovieshow varchar(50),
    constraint PK_TYPEMOVIESHOW primary key (idtypemovieshow)
)ENGINE=InnoDB;

CREATE TABLE movieshows(
	idmovieshow int not null auto_increment,
    idmovie int not null,
    idcinema int not null,
    idtypemovieshow int not null,
    idroom int not null,
    date_ date,
    time_ time,
    isactiveMovieShow boolean,
    constraint PK_MOVIESHOW primary key (idmovieshow),
    constraint FK_CINEMASHOW foreign key (idcinema) references cinemas (idcinema),
    constraint FK_MOVIE foreign key (idmovie) references movies (idmovie),
    constraint FK_TYPEMOVIESHOW foreign key (idtypemovieshow) references typemovieshows (idtypemovieshow),
    constraint FK_ROOM foreign key (idroom) references rooms (idroom)
)ENGINE=InnoDB;

CREATE TABLE seats(
	idseat int not null auto_increment,
	occupied boolean,
	idmovieshow int not null,
    constraint PK_SEAT primary key (idseat),
    constraint FK_MOVIESHOW foreign key (idmovieshow) references movieshows (idmovieshow)
)ENGINE=InnoDB;

CREATE TABLE tickets(
	idticket int not null auto_increment,
	idseat int not null,
    idmovieshow int not null,
    iduser int not null,
    discount int,
	ticketcost float,
    isactivet boolean,
    constraint PK_TICKET primary key (idticket),
    constraint FK_SEAT foreign key (idseat) references seats(idseat),
    constraint FK_MOVIESH foreign key (idmovieshow) references movieshows(idmovieshow),
    constraint FK_USER foreign key (iduser) references users(iduser)
)ENGINE=InnoDB;

CREATE TABLE purchase(
    idpurchase int not null auto_increment,
    iduser int not null,
    cost int not null,
    date_ date,
    constraint PK_PURCHASE primary key (idpurchase),
    constraint FK_IDUSER foreign key (iduser) references users (iduser)
)ENGINE=InnoDB;


INSERT INTO typemovieshows(nametypemovieshow) VALUES("2D"),("3D");

INSERT INTO typerooms(nametyperoom) VALUES ("Sala Standard"),("Sala Senior"),("Sala Premium");

INSERT INTO usertypes(nameusertype) VALUES ("User"),("Admin");

USE moviepass;
INSERT INTO users(idusertype, firstname, lastname, username, email, userpassword, isactiveu) VALUES 
(2,"Isaias Emanuel","Calfin","Soler","isaiasemanuelcalfin@hotmail.com","$2y$12$yVfORaTBb29gRFhXUjv\/OeBGq49.2OK3o\/cQycxkxlqE3cDrEBwqG",1),
(2,"Matias Manuel","Fernandez","Cosme Fulatino","matosmdq88@gmail.com","$2y$12$yVfORaTBb29gRFhXUjv\/OeBGq49.2OK3o\/cQycxkxlqE3cDrEBwqG",1),
(2,"Ignacio Gonzalo","Romero","romero","rom.gonzalo88@gmail.com","$2y$12$KV8USIB8NlmqFRH24LGMEenrvbxD.mPD7YMJE7AcZHqBeTB4IZmyG",1);

insert into cinemas (namecinema, adress, phonenumber, isactivec) values ("Ambassador","Cordoba 1234","2235656598",true),
																	   ("Aldrey","Sarmiento 2665","2234457847",true),
                                                                       ("Gallegos","Catamarca 5414","242525263",true);

insert into billboards (idcinema, isactive) values (1,true),(2,true),(3,true);

insert into rooms (nameroom, capacity, idtyperoom, idcinema, ticketcost, isactiver) values  ("Sala 1",60,1,1,100,true),("Sala 2",50,2,1,110,true),("Sala 3",50,3,1,150,true),("Sala 1",50,3,2,120,true),("Sala 2",65,1,2,105,true),("Sala 3",70,1,2,160,true),("Sala Avengers",100,1,3,120,true),("Sala Universal",80,2,3,140,true),("Sala Dolby Atmos",60,3,3,200,true);