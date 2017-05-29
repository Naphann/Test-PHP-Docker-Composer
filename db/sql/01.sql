SET SQL_MODE=ANSI_QUOTES;

create table "Teacher" (
    tid         int not null auto_increment,
    title       varchar(255),
    name        varchar(255) not null,
    lastname    varchar(255) not null,
    oldname     varchar(255),
    oldlastname varchar(255),
    start_year  year,
    end_year    year,
    tugen       int,
    sex         binary(1),
    nationalid  varchar(13),
    birthday    year,
    houseno     varchar(50),
    building    varchar(255),
    villageno   varchar(50),
    soi         varchar(255),
    subdistrict varchar(255),
    district    varchar(255),
    province    varchar(255),
    postalcode  varchar(15),
    country     varchar(255),
    hometel     varchar(15),
    mobile      varchar(15),
    email       varchar(255),
    primary key (tid)
);

create table "Building" (
    bid     int not null auto_increment,
    name    varchar(255),
    primary key(bid)
);

create table "Department" (
    did     int not null auto_increment,
    name    varchar(255),
    primary key (did)
);

create table "BuildingManage" (
    tid     int,
    bid     int,
    year    year,
    primary key (tid, bid, year),
    foreign key (tid) references "Teacher" (tid),
    foreign key (bid) references "Building" (bid)
);

create table "RoomAdvisor" (
    tid     int,
    room    varchar(255),
    year    year,
    primary key (tid, room, year),
    foreign key (tid) references "Teacher" (tid)
);

create table "TeacherInDepartment" (
    tid     int,
    did     int,
    year    year,
    primary key (tid, did, year),
    foreign key (tid) references "Teacher" (tid),
    foreign key (did) references "Department" (did)
);
