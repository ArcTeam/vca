SELECT record.name
FROM record
left join localization on localization.record = record.id
left join geodati.state state on localization.state = state.id
left join geodati.land land on localization.land = land.id
left join geodati.municipality municipality on localization.municipality = municipality.id
left join chronology cronostart on cronostart.record = record.id
left join chronology cronoend on cronoend.record = record.id
left join list.chronology cronostartlist on cronostart.cronostart = cronostartlist.id
left join list.chronology cronoendlist on cronoend.cronoend = cronoendlist.id
left join list.recordtype type on record.type = type.id
left join validation on validation.record = record.id
where validation.status = true AND to_tsvector(concat_ws(' ', record.name, record.info, state.name, land.name, municipality.name)) @@ to_tsquery('sponda & trentina')
