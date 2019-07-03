with unnested as (select distinct unnest(reading) r from biblio),
reading as (select b.id, b.main, b.title, b.year from unnested, biblio b where unnested.r = b.id)
select * from reading order by 1 asc
