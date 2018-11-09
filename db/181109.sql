begin;
create schema list;
create table list.usr_class(
  id serial primary key,
  class character varying unique not null,
  def character varying not null
);
insert into list.usr_class(class, def) values
  ('simple user', 'can do advanced research and download data as the list of records resulting from the search, with main data or complete data sheet'),
  ('advanced user', 'can performs all the research, he can add new record, modify or delete his own'),
  ('supervisor','same advanced user privileges, can manage all records, can approve records created by advanced users, can create new users, can manage list values'),
  ('admin','same supervisor privileges, can create new supervisors');
alter table list.usr_class owner to claudia;
create table login_request(
  id serial primary key,
  email character varying not null unique,
  first_name character varying,
  last_name character varying,
  address character varying,
  cell character varying,
  description text
);
alter table list.usr_class owner to claudia;
select audit.audit_table('login_request');
create table addr_book(
  id serial primary key,
  email character varying not null unique,
  first_name character varying,
  last_name character varying,
  address character varying,
  cell character varying,
  description text
);
select audit.audit_table('addr_book');
create table usr(
  id integer primary key references addr_book(id) on delete cascade,
  class integer not null references list.usr_class(id),
  salt character varying not null,
  pwd character varying not null,
  act boolean not null default 't',
  note text
);
select audit.audit_table('usr');
/*********************************************************/

commit;
