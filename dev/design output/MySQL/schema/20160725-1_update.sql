UPDATE player SET name = LOWER(name) WHERE id > 0;
UPDATE wordlist SET Word = TRIM(TRAILING '\r' FROM Word) WHERE id > 100;