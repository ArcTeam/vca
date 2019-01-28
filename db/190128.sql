/*select audit.audit_table('addr_book');
select audit.audit_table('author');
select audit.audit_table('find');
select audit.audit_table('localization');
select audit.audit_table('login_request');
select audit.audit_table('record');
select audit.audit_table('request');
select audit.audit_table('usr');*/
create table notepad(user integer not null references usr(id) on delete cascade,note text not null);
alter table notepad add constraint notepad_pki(user,note);
alter table notepad owner to claudia;
