select record.id from record
inner join validation on validation.record = record.id
where validation.state = true and record.compiler = 20;
