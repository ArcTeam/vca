\x
SELECT
  record.id,
  record.biblio,
  record.name,
  state.name AS state,
  land.name AS land,
  municipality.name AS municipality,
  localization.toponym,
  localization.address,
  localization.lon,
  localization.lat,
  recordtype.type,
  cronostart.definition AS cronostart,
  cronoend.definition AS cronoend,
  chronology.period,
  record.info,
  array_to_json(record.tags) tag,
  addr_book.first_name||' '||addr_book.last_name usr,
  userlevel.level,
  record.data,
  record.cf
FROM  record
left join localization on localization.record = record.id
left join geodati.state on localization.state = state.id
left join geodati.land on localization.land = land.id
left join geodati.municipality on localization.municipality = municipality.id
left join list.recordtype on record.type = recordtype.id
left join usr on record.compiler = usr.id
left join list.userlevel on usr.class = userlevel.userclass
left join public.addr_book on usr.id = addr_book.id
left join public.chronology on chronology.record = record.id
left join list.chronology cronostart on chronology.cronostart = cronostart.id
left join list.chronology cronoend on chronology.cronoend = cronoend.id
WHERE record.id = 3
