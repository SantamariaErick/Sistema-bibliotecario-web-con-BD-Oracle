/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     9/9/2021 21:37:21                            */
/*==============================================================*/


drop table if exists AUDITORIA;

drop table if exists AUTOR;

drop table if exists EDITORIAL;

drop table if exists ESTUDIANTE;

drop table if exists LIBRO;

drop table if exists MATERIA;

drop table if exists PRESTAMO;

drop table if exists USUARIO;

/*==============================================================*/
/* Table: AUDITORIA                                             */
/*==============================================================*/
create table AUDITORIA
(
   AUD_ID               int not null auto_increment,
   PRE_ID               int,
   USU_ID               int not null,
   AUD_DESCRIPCION      varchar(50) not null,
   primary key (AUD_ID)
);

/*==============================================================*/
/* Table: AUTOR                                                 */
/*==============================================================*/
create table AUTOR
(
   AUT_ID               int not null auto_increment,
   AUT_NOMBRE           varchar(50) not null,
   AUT_DESCRIPCION      varchar(300) not null,
   AUT_IMAGEN           varchar(50) not null,
   AUT_ESTADO           bool not null,
   primary key (AUT_ID)
);

/*==============================================================*/
/* Table: EDITORIAL                                             */
/*==============================================================*/
create table EDITORIAL
(
   EDI_ID               int not null auto_increment,
   EDI_NOMBRE           varchar(50) not null,
   EDI_DESCRIPCION      varchar(300) not null,
   EDI_CONDICION        bool not null,
   primary key (EDI_ID)
);

/*==============================================================*/
/* Table: ESTUDIANTE                                            */
/*==============================================================*/
create table ESTUDIANTE
(
   EST_ID               int not null auto_increment,
   EST_CODIGO           varchar(20) not null,
   EST_CEDULA           varchar(10) not null,
   EST_NOMBRE           varchar(50) not null,
   EST_CARRERA          varchar(30) not null,
   EST_DIRECCION        varchar(50),
   EST_TELEFONO         varchar(10) not null,
   EST_EMAIL            varchar(50) not null,
   EST_ESTADO           bool not null,
   primary key (EST_ID)
);

/*==============================================================*/
/* Table: LIBRO                                                 */
/*==============================================================*/
create table LIBRO
(
   LIB_ID               int not null auto_increment,
   MAT_ID               int not null,
   EDI_ID               int not null,
   AUT_ID               int not null,
   LIB_TITULO           varchar(50) not null,
   LIB_CANTIDADDISPONIBLE numeric(10,0) not null,
   LIB_ANIOEDICION      varchar(4) not null,
   LIB_CANTIDADPAGINAS  numeric(10,0) not null,
   LIB_FORMATO          varchar(50) not null,
   LIB_PESO             decimal(7,2) not null,
   LIB_DESCIPCION       varchar(500) not null,
   LIB_PORTADA          varchar(50) not null,
   LIB_ESTADO           bool not null,
   primary key (LIB_ID)
);

/*==============================================================*/
/* Table: MATERIA                                               */
/*==============================================================*/
create table MATERIA
(
   MAT_ID               int not null auto_increment,
   MAT_NOMBRE           varchar(50) not null,
   MAT_DESCRIPCION      varchar(300) not null,
   MAT_CONDICION        bool not null,
   primary key (MAT_ID)
);

/*==============================================================*/
/* Table: PRESTAMO                                              */
/*==============================================================*/
create table PRESTAMO
(
   PRE_ID               int not null auto_increment,
   EST_ID               int not null,
   LIB_ID               int not null,
   PRE_FECHAPRESTADO    date not null,
   PRE_FECHADEVUELTO    date not null,
   PRE_CANTIDAD         numeric(10,0) not null,
   PRE_OBSERVACIONES    varchar(150) not null,
   PRE_ESTADO           varchar(8) not null,
   primary key (PRE_ID)
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO
(
   USU_ID               int not null auto_increment,
   USU_TRABAJADOR       varchar(30) not null,
   USU_CEDULA           varchar(11) not null,
   USU_NOMBRE           varchar(50) not null,
   USU_PROFESION        varchar(30) not null,
   USU_CARGO            varchar(20) not null,
   USU_DIRECCION        varchar(50) not null,
   USU_TELEFONO         varchar(10) not null,
   USU_EMAIL            varchar(30) not null,
   USU_LOGIN            varchar(30) not null,
   USU_CLAVE            varchar(30) not null,
   primary key (USU_ID)
);

alter table AUDITORIA add constraint FK_RELATIONSHIP_6 foreign key (PRE_ID)
      references PRESTAMO (PRE_ID) on delete restrict on update restrict;

alter table AUDITORIA add constraint FK_RELATIONSHIP_7 foreign key (USU_ID)
      references USUARIO (USU_ID) on delete restrict on update restrict;

alter table LIBRO add constraint FK_DIFERENTES foreign key (MAT_ID)
      references MATERIA (MAT_ID) on delete restrict on update restrict;

alter table LIBRO add constraint FK_ESCRIBE foreign key (AUT_ID)
      references AUTOR (AUT_ID) on delete restrict on update restrict;

alter table LIBRO add constraint FK_PERTENECE foreign key (EDI_ID)
      references EDITORIAL (EDI_ID) on delete restrict on update restrict;

alter table PRESTAMO add constraint FK_DE foreign key (LIB_ID)
      references LIBRO (LIB_ID) on delete restrict on update restrict;

alter table PRESTAMO add constraint FK_REALIZA foreign key (EST_ID)
      references ESTUDIANTE (EST_ID) on delete restrict on update restrict;

