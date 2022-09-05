show databases;
drop database keep_db;
use keep_db;

insert into day (name, date, description) values
("push", "2022-09-04", "Includes all push exercices such as push-ups, dips and hs-pushs."),
("pull", "2022-09-05", "Includes all pull exercices such as pull-ups, chin-ups and rows."),
("legs", "2022-09-06", "The most hated day of all time, destruction of legs and lost of energie."),
("full-body", "2022-09-07", "Same as legs day, besides having a lit-bit of fun and upper-body pump.");

insert into exercice (name, description, sets, reps, day_id) values
("hs-pushs", "Whatever ..", 5, 12, 1),
("push-ups", "Whatever ..", 5, 12, 1),
("dips", "Whatever ..", 5, 12, 1);

select * from day;
select * from exercice;

truncate table day;

drop database keep_db;