SELECT row_to_json(poi.*) AS geometrie
FROM (
  SELECT 'FeatureCollection'::text AS type, array_to_json(array_agg(features.*)) AS features
  FROM (
    SELECT 'Feature'::text AS type, st_asgeojson(localization.geom)::json AS geometry, row_to_json(prop.*) AS properties
    FROM localization
    JOIN (
      SELECT state.name state, land.name land, municipality.name municipality, localization.lon, localization.lat, record.id, record.name, cronostartlist.definition cronostart, cronoendlist.definition cronoend, type.type
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
    ) prop ON localization.record = prop.id
  ) features
) poi;
