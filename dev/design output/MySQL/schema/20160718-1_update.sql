# adding auto_incerement to Instructions
USE `gapp`;
ALTER TABLE Page DROP FOREIGN KEY fkPages2Instructions;
ALTER TABLE Instructions MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT;
ALTER TABLE Page MODIFY idInstructions int NOT NULL;
ALTER TABLE Page ADD CONSTRAINT fkPages2Instructions FOREIGN KEY (idInstructions) REFERENCES Instructions(id);

#renaming favoritePlayers to favouriteWords
DROP TABLE IF EXISTS favouriteWords;
RENAME TABLE favouriteplayer TO favouriteWords;