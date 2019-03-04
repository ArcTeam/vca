-- \x
-- SELECT
--   record.id,
--   state.name AS state,
--   land.name AS land,
--   municipality.name AS municipality,
--   localization.toponym,
--   localization.address,
--   localization.lon,
--   localization.lat,
--   record.name,
--   cronostart.definition AS cronostart,
--   cronoend.definition AS cronoend,
--   chronology.period,
--   record.info,
--   addr_book.first_name,
--   addr_book.last_name,
--   recordtype.type,
--   record.tag,
--   record.relatedrecord,
--   record.biblio,
--   record.data
-- FROM  record
-- inner join localization on localization.record = record.id
-- inner join geodati.state on localization.state = state.id
-- inner join geodati.land on localization.land = land.id
-- inner join geodati.municipality on localization.municipality = municipality.id
-- inner join list.recordtype on record.type = recordtype.id
-- inner join public.addr_book on record.compiler = addr_book.id
-- inner join public.chronology on chronology.record = record.id
-- inner join list.chronology cronostart on chronology.cronostart = cronostart.id
-- inner join list.chronology cronoend on chronology.cronoend = cronoend.id
-- WHERE record.id = 3;

select a.lastname||' '||a.firstname as author
from (select id, unnest(secondauth) idauth from bibliography) sa
inner join author a on sa.idauth = a.id
where sa.id = 3
