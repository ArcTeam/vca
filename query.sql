SELECT 
  record.id, 
  state.name AS state, 
  land.name AS land, 
  municipality.name AS municipality, 
  localization.toponym, 
  localization.address, 
  localization.lon, 
  localization.lat, 
  record.name, 
  cronostart.definition AS cronostart, 
  cronoend.definition AS cronoend, 
  record.info, 
  addr_book.last_name, 
  recordtype.type, 
  record.tag, 
  record.relatedrecord, 
  chronology.period, 
  record.biblio, 
  record.data
FROM 
  public.record, 
  public.localization, 
  list.recordtype, 
  geodati.state, 
  geodati.land, 
  geodati.municipality, 
  public.addr_book, 
  public.chronology, 
  list.chronology cronostart, 
  list.chronology cronoend
WHERE 
  record.type = recordtype.id AND
  record.compiler = addr_book.id AND
  localization.record = record.id AND
  localization.municipality = municipality.id AND
  localization.land = land.id AND
  localization.state = state.id AND
  chronology.record = record.id AND
  chronology.cronostart = cronostart.id AND
  chronology.cronoend = cronoend.id;
