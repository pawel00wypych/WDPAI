create sequence user_id_user_seq
    as integer;

alter sequence user_id_user_seq owner to dbuser;

create table role
(
    id_role serial
        primary key
        unique,
    role    varchar(20) not null
        unique
);

alter table role
    owner to dbuser;

create table user_details
(
    id_user_details serial
        primary key
        unique,
    user_name       varchar(256) not null,
    surname         varchar(256),
    phone           integer
);

alter table user_details
    owner to dbuser;

create table users
(
    id_user         integer default nextval('schema.user_id_user_seq'::regclass) not null
        constraint user_pkey
            primary key
        constraint user_id_user_key
            unique,
    id_user_details integer                                                      not null
        constraint user_id_user_details_key
            unique
        constraint user_user_details_id_user_details_fk
            references user_details
            on update cascade on delete cascade,
    id_role         integer                                                      not null
        constraint user_role_id_role_fk
            references role
            on update cascade on delete cascade,
    email           varchar(256)                                                 not null
        constraint user_email_key
            unique,
    user_password   varchar(256)                                                 not null,
    salt            varchar(22)                                                  not null,
    created_at      date                                                         not null
);

alter table users
    owner to dbuser;

alter sequence user_id_user_seq owned by users.id_user;

create table workout
(
    id_workout   serial
        primary key
        unique,
    id_user      integer      not null
        constraint workout_user_id_user_fk
            references users
            on update cascade on delete cascade,
    description  varchar(512),
    workout_name varchar(128) not null,
    total_time   varchar(5),
    total_hsr    integer,
    total_volume integer,
    total_reps   integer,
    created_at   date         not null,
    body_weight  integer
);

alter table workout
    owner to dbuser;

create table exercise
(
    id_exercise   serial
        primary key
        unique,
    id_user       integer      not null
        constraint exercise_user_id_user_fk
            references users
            on update cascade on delete cascade,
    exercise_name varchar(256) not null,
    description   varchar(512),
    total_hsr     integer,
    total_reps    integer,
    total_volume  integer,
    created_at    date         not null,
    break         varchar(5)
);

alter table exercise
    owner to dbuser;

create table workout_exercise
(
    id_workout  integer not null
        constraint workout_exercise_workout_id_workout_fk
            references workout
            on update cascade on delete cascade,
    id_exercise integer
        constraint workout_exercise_exercise_id_exercise_fk
            references exercise
            on update cascade on delete cascade
);

alter table workout_exercise
    owner to dbuser;

create table exercise_set
(
    id_exercise_set serial
        primary key
        unique,
    id_exercise     integer not null
        constraint exercise_set_exercise_id_exercise_fk
            references exercise
            on update cascade on delete cascade,
    reps            integer,
    rir             integer,
    rpe             integer,
    weight          integer
);

alter table exercise_set
    owner to dbuser;

insert into exercise (id_exercise, id_user, exercise_name, description, total_hsr, total_reps, total_volume, created_at, break)
values  (1, 1, 'squat', null, 3, 10, 1000, '2023-02-18', '02:00'),
        (2, 1, 'deadlift', null, 7, 18, 2700, '2023-02-18', '02:00'),
        (3, 1, 'pull ups', null, 3, 8, 80, '2023-02-18', '02:00'),
        (4, 1, 'biceps curls', null, 4, 18, 324, '2023-02-18', '02:00');

insert into exercise_set (id_exercise_set, id_exercise, reps, rir, rpe, weight)
values  (1, 1, 10, 2, 8, 100),
        (2, 2, 10, 1, 9, 150),
        (3, 2, 8, 2, 8, 150),
        (4, 3, 8, 2, 8, 10),
        (5, 4, 18, 1, 9, 18);

insert into role (id_role, role)
values  (1, 'user'),
        (2, 'admin');

insert into user_details (id_user_details, user_name, surname, phone)
values  (1, 'john', 'snow', 111222333),
        (4, 'jan', 'wojtas', 111222333),
        (5, 'pawel', 'kowalski', 111222333);

insert into users (id_user, id_user_details, id_role, email, user_password, salt, created_at)
values  (1, 1, 2, 'jsnow@admin.com', '$2y$10$a2RnYjJ3KEVPciZ6UnpJSOX.EO2Dicfj.k0XVbXWKg0Mi3rXgdkHK', 'kdgb2w(EOr&zRzII_0V-KF', '2023-02-17'),
        (2, 4, 1, 'jan@email.com', '$2y$10$KVV1Jk5WOFNfJlIpRSNwLO4oj14EYx.YCo/zi.B7KSDHfKBdoxPOa', ')Uu&NV8S_&R)E#p-h3S$ib', '2023-02-17'),
        (4, 5, 1, 'pawel@email.com', '$2y$10$JWw1RS1TX1lwcD1nYU5JXuC9BnVb54Ay0lnA4diY9lAyskJQPpnRa', '%l5E-S_Ypp=gaNI_ztLvAj', '2023-02-17');

insert into workout (id_workout, id_user, description, workout_name, total_time, total_hsr, total_volume, total_reps, created_at, body_weight)
values  (5, 1, 'light', 'push', '01:30', 3, 1000, 10, '2023-02-18', 80),
        (6, 1, 'medium', 'pull', '02:00', 14, 3104, 44, '2023-02-18', 81);

insert into workout_exercise (id_workout, id_exercise)
values  (5, 1),
        (6, 2),
        (6, 3),
        (6, 4);