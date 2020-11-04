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
    trailer varchar(50),
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
	idmovieshow int not null,
    numseat int not null,
    constraint PK_SEAT primary key (idseat),
    constraint FK_MOVIESHOW foreign key (idmovieshow) references movieshows (idmovieshow)
)ENGINE=InnoDB;

CREATE TABLE purchase(
    idpurchase int not null auto_increment,
    iduser int not null,
    cost int not null,
    date_ date,
    time_ time,
    constraint PK_PURCHASE primary key (idpurchase),
    constraint FK_IDUSER foreign key (iduser) references users (iduser)
)ENGINE=InnoDB;

CREATE TABLE tickets(
	idticket int not null auto_increment,
	idseat int not null,
    idmovieshow int not null,
    iduser int not null,
    idpurchase int not null,
	ticketcost int,
    qrcode varchar(50),
    constraint PK_TICKET primary key (idticket),
    constraint FK_SEAT foreign key (idseat) references seats(idseat),
    constraint FK_MOVIESH foreign key (idmovieshow) references movieshows(idmovieshow),
    constraint FK_USER foreign key (iduser) references users(iduser),
    constraint FK_PURCHASE foreign key (idpurchase) references purchase(idpurchase)
)ENGINE=InnoDB;


INSERT INTO typemovieshows(nametypemovieshow) VALUES("2D"),("3D");

INSERT INTO typerooms(nametyperoom) VALUES ("Sala Standard"),("Sala Senior"),("Sala Premium");

INSERT INTO usertypes(nameusertype) VALUES ("User"),("Admin");

INSERT INTO users(idusertype, firstname, lastname, username, email, userpassword) VALUES 
(2,"Isaias Emanuel","Calfin","Soler","isaiasemanuelcalfin@hotmail.com","$2y$12$yVfORaTBb29gRFhXUjv\/OeBGq49.2OK3o\/cQycxkxlqE3cDrEBwqG"),
(1,"Matias Manuel","Fernandez","Cosme Fulatino","matosmdq88@gmail.com","$2y$12$k0NR.RDXshLAI1KytIK2hOkm8mZ.EImEVs22lI3BMgw12hgmLo0be");

insert into cinemas (namecinema, adress, phonenumber, isactivec) values ("Ambassador","Cordoba 1234","2235656598",true),
																	   ("Gallegos","Catamarca 5441","2234457847",true),
                                                                       ("Aldrey","Sarmiento 2665","242525263",true);


insert into rooms (nameroom, capacity, idtyperoom, idcinema, ticketcost, isactiver) values  ("Sala 1",60,1,1,100,true),("Sala 2",50,2,1,110,true),("Sala 3",50,3,1,150,true),("Sala 1",50,3,2,120,true),("Sala 2",65,1,2,105,true),("Sala 3",70,1,2,160,true),("Sala Avengers",100,1,3,120,true),("Sala Universal",80,2,3,140,true),("Sala Dolby Atmos",60,3,3,200,true);

DROP PROCEDURE IF EXISTS add_cinema;
DELIMITER $$
CREATE PROCEDURE add_cinema(in namecinema varchar(50), in adress varchar(50), in phonenumber varchar(50), in isactivec boolean)
comment "agrega un cinema"
BEGIN
	INSERT INTO cinemas (namecinema , adress , phonenumber , isactivec) VALUES (namecinema, adress, phonenumber, isactivec);
END;
$$

DROP PROCEDURE IF EXISTS delete_cinema;
DELIMITER $$
CREATE PROCEDURE delete_cinema(in idcine int)
comment "elimina logicamente un cinema y todas las tablas dependientes"
BEGIN
	update cinemas set isactivec=false where idCinema=idcine;
    update movieshows set isactiveMovieShow=false where idCinema=idcine;
    update rooms set isactiver=false where idCinema=idcine;
END;
$$


DROP PROCEDURE IF EXISTS up_cinema;
DELIMITER $$
CREATE PROCEDURE up_cinema(in idcine int)
comment "activa logicamente un cinema "
BEGIN
	update cinemas set isactivec=true where idCinema=idcine;
END;
$$

DROP PROCEDURE IF EXISTS delete_room;
DELIMITER $$
CREATE PROCEDURE delete_room(in idr int)
comment "elimina logicamente un cinema y todas las tablas dependientes"
BEGIN
	update rooms set isactiver=false where idRoom=idr;
    update movieshows set isactiveMovieShow=false where idRoom=idr;
END;
$$


DROP PROCEDURE IF EXISTS up_room;
DELIMITER $$
CREATE PROCEDURE up_room(in idr int)
comment "activa logicamente una sala "
BEGIN
	update rooms set isactiver=true where idRoom=idr;
END;
$$

DROP PROCEDURE IF EXISTS delete_movieshow;
DELIMITER $$
CREATE PROCEDURE delete_movieshow(in idm int)
comment "elimina logicamente un movieshow"
BEGIN
	update movieshows set isactiveMovieShow=false where idMovieShow=idm;
END;
$$

DROP PROCEDURE IF EXISTS get_movieshows_active;
DELIMITER $$
CREATE PROCEDURE get_movieshows_active()
comment "extrae los movieshows activos"
BEGIN
	select * 
    from movieshows as m 
	JOIN typemovieshows as tm 
	ON m.idtypemovieshow = tm.idtypemovieshow
    JOIN movies as mo
	ON m.idmovie = mo.idmovie 
    JOIN rooms as r 
	ON m.idroom = r.idroom 
    JOIN typerooms as t 
	ON r.idtyperoom = t.idtyperoom
    JOIN cinemas as c
    ON m.idcinema = c.idcinema
    where isactiveMovieShow=true;
END;
$$

DROP PROCEDURE IF EXISTS get_movieshows;
DELIMITER $$
CREATE PROCEDURE get_movieshows()
comment "extrae los movieshows"
BEGIN
	select * 
    from movieshows as m 
	JOIN typemovieshows as tm 
	ON m.idtypemovieshow = tm.idtypemovieshow
    JOIN movies as mo
	ON m.idmovie = mo.idmovie 
    JOIN rooms as r 
	ON m.idroom = r.idroom 
    JOIN typerooms as t 
	ON r.idtyperoom = t.idtyperoom
    JOIN cinemas as c
    ON m.idcinema = c.idcinema;
END;
$$


DROP PROCEDURE IF EXISTS get_cinema_id;
DELIMITER $$
CREATE PROCEDURE get_cinema_id(in id int)
comment "obtiene un cine"
BEGIN
	SELECT * FROM cinemas WHERE idcinema=id;
END;
$$

DROP PROCEDURE IF EXISTS get_cinemas;
DELIMITER $$
CREATE PROCEDURE get_cinemas()
comment "obtiene todos los cines activos"
BEGIN
	SELECT * FROM cinemas WHERE isactivec = true;
END;
$$

DROP PROCEDURE IF EXISTS update_cinema;
DELIMITER $$
CREATE PROCEDURE update_cinema(in namec varchar(50),in adressc varchar(50),in phonenumberc varchar(50),in isactive boolean, in idc int)
comment "update de un cine"
BEGIN
	UPDATE cinemas SET namecinema = namec, adress = adressc , phonenumber = phonenumberc , isactivec = isactive WHERE idcinema = idc;
END;
$$

DROP PROCEDURE IF EXISTS add_genre;
DELIMITER $$
CREATE PROCEDURE add_genre(in id int,in nameg varchar(50))
comment "agrega un genero"
BEGIN
	INSERT INTO genres(idgenre, namegenre) VALUES ( id, nameg);
END;
$$

DROP PROCEDURE IF EXISTS update_genre;
DELIMITER $$
CREATE PROCEDURE update_genre(in id int,in nameg varchar(50))
comment "update un genero"
BEGIN
	UPDATE genres SET namegenre = nameg WHERE idgenre = id ;
END;
$$

DROP PROCEDURE IF EXISTS get_genres;
DELIMITER $$
CREATE PROCEDURE get_genres()
comment "get de todos los generos"
BEGIN
	SELECT * FROM genres;
END;
$$

DROP PROCEDURE IF EXISTS get_movies;
DELIMITER $$
CREATE PROCEDURE get_movies()
comment "get de todas las movies"
BEGIN
	SELECT * FROM movies;
END;
$$

DROP PROCEDURE IF EXISTS get_movie_id;
DELIMITER $$
CREATE PROCEDURE get_movie_id(in id int)
comment "get de una mopvie por id"
BEGIN
	SELECT * FROM movies WHERE idmovie=id;
END;
$$

DROP PROCEDURE IF EXISTS update_qr;
DELIMITER $$
CREATE PROCEDURE update_qr(in id int,in img blob)
comment "sube el codigo QR"
BEGIN
	UPDATE tickets SET qrcode=img WHERE idticket=id;
END;
$$

DROP PROCEDURE IF EXISTS add_ticket;
DELIMITER $$
CREATE PROCEDURE add_ticket(in idmo int, in idpur int, in idus int, in costo int, in asiento int)
comment "agrega un ticket y devuelve el id"
BEGIN
	INSERT INTO tickets (idmovieshow , idpurchase , iduser , ticketcost , idseat) VALUES (idmo , idpur, idus , costo , asiento);
END;
$$

DROP PROCEDURE IF EXISTS get_id_ticket;
DELIMITER $$
CREATE PROCEDURE get_id_ticket(in idfunc int , in idasiento int)
comment "devuelve   id de tickete"
BEGIN
	SELECT idticket FROM tickets WHERE idmovieshow=idfunc AND idseat=idasiento;
END;
$$