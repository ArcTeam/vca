create table request(address integer primary key references addr_book(id) on delete cascade, data timestamp with time zone not null default now());
