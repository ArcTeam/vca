CREATE OR REPLACE FUNCTION create_geom()
RETURNS TRIGGER AS '
  BEGIN
  NEW.geom := ST_setSRID(ST_MakePoint(NEW.lon,NEW.lat), 4326);
  RETURN NEW;
  END;
'
language 'plpgsql';


CREATE TRIGGER localization_trigger BEFORE insert or update ON localization FOR EACH ROW EXECUTE PROCEDURE create_geom();
