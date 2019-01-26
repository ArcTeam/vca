alter table usr add column password text;
update usr set password = crypt('alfaomega', gen_salt('bf', 8)) where id = 9;
alter table usr drop column pwd, drop column salt;
alter table usr rename column password to pwd;
