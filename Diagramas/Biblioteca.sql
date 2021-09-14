/*==============================================================*/
/* DBMS name:      ORACLE Version 10g                           */
/* Created on:     13/9/2021 23:59:06                           */
/*==============================================================*/


alter table AUDITORIA
   drop constraint FK_AUDITORI_RELATIONS_PRESTAMO;

alter table AUDITORIA
   drop constraint FK_AUDITORI_RELATIONS_USUARIO;

alter table LIBRO
   drop constraint FK_LIBRO_DIFERENTE_MATERIA;

alter table LIBRO
   drop constraint FK_LIBRO_ESCRIBE_AUTOR;

alter table LIBRO
   drop constraint FK_LIBRO_PERTENECE_EDITORIA;

alter table PRESTAMO
   drop constraint FK_PRESTAMO_DE_LIBRO;

alter table PRESTAMO
   drop constraint FK_PRESTAMO_REALIZA_ESTUDIAN;

drop index RELATIONSHIP_7_FK;

drop index RELATIONSHIP_6_FK;

drop table AUDITORIA cascade constraints;

drop table AUTOR cascade constraints;

drop table EDITORIAL cascade constraints;

drop table ESTUDIANTE cascade constraints;

drop index ESCRIBE_FK;

drop index PERTENECE_FK;

drop index DIFERENTES_FK;

drop table LIBRO cascade constraints;

drop table MATERIA cascade constraints;

drop index DE_FK;

drop index REALIZA_FK;

drop table PRESTAMO cascade constraints;

drop table USUARIO cascade constraints;

/*==============================================================*/
/* Table: AUDITORIA                                             */
/*==============================================================*/
create table AUDITORIA  (
   AUD_ID               INTEGER                         not null,
   PRE_ID               INTEGER,
   USU_ID               INTEGER                         not null,
   AUD_DESCRIPCION      VARCHAR2(50)                    not null,
   constraint PK_AUDITORIA primary key (AUD_ID)
);

/*==============================================================*/
/* Index: RELATIONSHIP_6_FK                                     */
/*==============================================================*/
create index RELATIONSHIP_6_FK on AUDITORIA (
   PRE_ID ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_7_FK                                     */
/*==============================================================*/
create index RELATIONSHIP_7_FK on AUDITORIA (
   USU_ID ASC
);

/*==============================================================*/
/* Table: AUTOR                                                 */
/*==============================================================*/
create table AUTOR  (
   AUT_ID               INTEGER                         not null,
   AUT_NOMBRE           VARCHAR2(50)                    not null,
   AUT_DESCRIPCION      VARCHAR2(300),
   AUT_IMAGEN           VARCHAR2(50),
   AUT_ESTADO           SMALLINT                        not null,
   constraint PK_AUTOR primary key (AUT_ID)
);

/*==============================================================*/
/* Table: EDITORIAL                                             */
/*==============================================================*/
create table EDITORIAL  (
   EDI_ID               INTEGER                         not null,
   EDI_NOMBRE           VARCHAR2(50)                    not null,
   EDI_DESCRIPCION      VARCHAR2(300),
   EDI_CONDICION        SMALLINT                        not null,
   constraint PK_EDITORIAL primary key (EDI_ID)
);

/*==============================================================*/
/* Table: ESTUDIANTE                                            */
/*==============================================================*/
create table ESTUDIANTE  (
   EST_ID               INTEGER                         not null,
   EST_CODIGO           VARCHAR2(20)                    not null,
   EST_CEDULA           VARCHAR2(10)                    not null,
   EST_NOMBRE           VARCHAR2(50)                    not null,
   EST_CARRERA          VARCHAR2(30)                    not null,
   EST_DIRECCION        VARCHAR2(50),
   EST_TELEFONO         VARCHAR2(10)                    not null,
   EST_EMAIL            VARCHAR2(50)                    not null,
   EST_ESTADO           SMALLINT                        not null,
   constraint PK_ESTUDIANTE primary key (EST_ID)
);

/*==============================================================*/
/* Table: LIBRO                                                 */
/*==============================================================*/
create table LIBRO  (
   LIB_ID               INTEGER                         not null,
   MAT_ID               INTEGER                         not null,
   EDI_ID               INTEGER                         not null,
   AUT_ID               INTEGER                         not null,
   LIB_TITULO           VARCHAR2(50)                    not null,
   LIB_CANTIDADDISPONIBLE NUMBER(10)                      not null,
   LIB_ANIOEDICION      VARCHAR2(4)                     not null,
   LIB_CANTIDADPAGINAS  NUMBER(10)                      not null,
   LIB_FORMATO          VARCHAR2(50)                    not null,
   LIB_PESO             NUMBER(7,2)                     not null,
   LIB_DESCRIPCION      VARCHAR2(500),
   LIB_PORTADA          VARCHAR2(50),
   LIB_ESTADO           SMALLINT                        not null,
   constraint PK_LIBRO primary key (LIB_ID)
);

/*==============================================================*/
/* Index: DIFERENTES_FK                                         */
/*==============================================================*/
create index DIFERENTES_FK on LIBRO (
   MAT_ID ASC
);

/*==============================================================*/
/* Index: PERTENECE_FK                                          */
/*==============================================================*/
create index PERTENECE_FK on LIBRO (
   EDI_ID ASC
);

/*==============================================================*/
/* Index: ESCRIBE_FK                                            */
/*==============================================================*/
create index ESCRIBE_FK on LIBRO (
   AUT_ID ASC
);

/*==============================================================*/
/* Table: MATERIA                                               */
/*==============================================================*/
create table MATERIA  (
   MAT_ID               INTEGER                         not null,
   MAT_NOMBRE           VARCHAR2(50)                    not null,
   MAT_DESCRIPCION      VARCHAR2(300),
   MAT_CONDICION        SMALLINT                        not null,
   constraint PK_MATERIA primary key (MAT_ID)
);

/*==============================================================*/
/* Table: PRESTAMO                                              */
/*==============================================================*/
create table PRESTAMO  (
   PRE_ID               INTEGER                         not null,
   EST_ID               INTEGER                         not null,
   LIB_ID               INTEGER                         not null,
   PRE_FECHAPRESTADO    DATE                            not null,
   PRE_FECHADEVUELTO    DATE,
   PRE_CANTIDAD         NUMBER(10)                      not null,
   PRE_OBSERVACIONES    VARCHAR2(150),
   PRE_ESTADO           VARCHAR2(8)                     not null,
   constraint PK_PRESTAMO primary key (PRE_ID)
);

/*==============================================================*/
/* Index: REALIZA_FK                                            */
/*==============================================================*/
create index REALIZA_FK on PRESTAMO (
   EST_ID ASC
);

/*==============================================================*/
/* Index: DE_FK                                                 */
/*==============================================================*/
create index DE_FK on PRESTAMO (
   LIB_ID ASC
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO  (
   USU_ID               INTEGER                         not null,
   USU_TRABAJADOR       VARCHAR2(30),
   USU_CEDULA           VARCHAR2(11)                    not null,
   USU_NOMBRE           VARCHAR2(50)                    not null,
   USU_PROFESION        VARCHAR2(30)                    not null,
   USU_CARGO            VARCHAR2(20)                    not null,
   USU_DIRECCION        VARCHAR2(50)                    not null,
   USU_TELEFONO         VARCHAR2(10)                    not null,
   USU_EMAIL            VARCHAR2(30)                    not null,
   USU_LOGIN            VARCHAR2(30)                    not null,
   USU_CLAVE            VARCHAR2(30)                    not null,
   constraint PK_USUARIO primary key (USU_ID)
);

alter table AUDITORIA
   add constraint FK_AUDITORI_RELATIONS_PRESTAMO foreign key (PRE_ID)
      references PRESTAMO (PRE_ID);

alter table AUDITORIA
   add constraint FK_AUDITORI_RELATIONS_USUARIO foreign key (USU_ID)
      references USUARIO (USU_ID);

alter table LIBRO
   add constraint FK_LIBRO_DIFERENTE_MATERIA foreign key (MAT_ID)
      references MATERIA (MAT_ID);

alter table LIBRO
   add constraint FK_LIBRO_ESCRIBE_AUTOR foreign key (AUT_ID)
      references AUTOR (AUT_ID);

alter table LIBRO
   add constraint FK_LIBRO_PERTENECE_EDITORIA foreign key (EDI_ID)
      references EDITORIAL (EDI_ID);

alter table PRESTAMO
   add constraint FK_PRESTAMO_DE_LIBRO foreign key (LIB_ID)
      references LIBRO (LIB_ID);

alter table PRESTAMO
   add constraint FK_PRESTAMO_REALIZA_ESTUDIAN foreign key (EST_ID)
      references ESTUDIANTE (EST_ID);

