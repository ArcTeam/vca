-- CREATE OR REPLACE FUNCTION create_geom()
-- RETURNS TRIGGER AS '
--   BEGIN
--   NEW.geom := ST_setSRID(ST_MakePoint(NEW.lon,NEW.lat), 4326);
--   RETURN NEW;
--   END;
-- '
-- language 'plpgsql';
--
--
-- CREATE TRIGGER localization_trigger BEFORE insert or update ON localization FOR EACH ROW EXECUTE PROCEDURE create_geom();
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
  record.compiler compilerid,
  addr_book.first_name||' '||addr_book.last_name compiler,
  userlevel.level,
  record.data,
  record.cf,
  record.draft,
  validation.status,
  validation.supervisor supervisorid,
  supervisor.first_name||' '||supervisor.last_name supervisor,
  superlevel.level superlevel,
  validation."date"::date approved
FROM  record
left join localization on localization.record = record.id
left join geodati.state on localization.state = state.id
left join geodati.land on localization.land = land.id
left join geodati.municipality on localization.municipality = municipality.id
left join list.recordtype on record.type = recordtype.id
left join usr on record.compiler = usr.id
left join list.userlevel on usr.level = userlevel.id
left join public.addr_book on usr.id = addr_book.id
left join public.chronology on chronology.record = record.id
left join list.chronology cronostart on chronology.cronostart = cronostart.id
left join list.chronology cronoend on chronology.cronoend = cronoend.id
left join validation on validation.record = record.id

left join usr super on validation.supervisor = super.id
left join list.userlevel superlevel on super.level = superlevel.id
left join public.addr_book supervisor on super.id = supervisor.id
WHERE record.id = 313
