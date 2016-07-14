
USE gapp;
DROP TABLE IF EXISTS notes ;
DROP TABLE IF EXISTS notebook ;

CREATE TABLE `gapp`.`notebook` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT 'My NoteBook',
  PRIMARY KEY (`id`));

ALTER TABLE `gapp`.`player`
ADD COLUMN `idNoteBook` INT UNSIGNED NULL AFTER `modifyDate`,
ADD UNIQUE INDEX `idNoteBook_UNIQUE` (`idNoteBook` ASC);
ALTER TABLE `gapp`.`player`
ADD CONSTRAINT `fkPlayer2NoteBook`
  FOREIGN KEY (`idNoteBook`)
  REFERENCES `gapp`.`notebook` (`id`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;

ALTER TABLE `gapp`.`wsgame`
ADD COLUMN `idNoteBook` INT UNSIGNED NULL AFTER `status`,
ADD UNIQUE INDEX `idNoteBook_UNIQUE` (`idNoteBook` ASC);
ALTER TABLE `gapp`.`wsgame`
ADD CONSTRAINT `fkGame2NoteBook`
  FOREIGN KEY (`idNoteBook`)
  REFERENCES `gapp`.`notebook` (`id`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;

  ALTER TABLE `gapp`.`wsround`
ADD COLUMN `idNoteBook` INT UNSIGNED NULL AFTER `index`,
ADD UNIQUE INDEX `idNoteBook_UNIQUE` (`idNoteBook` ASC);
ALTER TABLE `gapp`.`wsround`
ADD CONSTRAINT `fkRound2NoteBook`
  FOREIGN KEY (`idNoteBook`)
  REFERENCES `gapp`.`notebook` (`id`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;

CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `category` enum('funny','todo','remember','remarkable') NOT NULL DEFAULT 'funny',
  `body` varchar(500) DEFAULT NULL,
  `idNoteBook` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkNotes2NoteBook_idx` (`idNoteBook`),
  CONSTRAINT `fkNotes2NoteBook` FOREIGN KEY (`idNoteBook`) REFERENCES `notebook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

#PopulateGames() ---- 2

USE `gapp`;
DROP procedure IF EXISTS `PopulateGames`;

DELIMITER $$
USE `gapp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PopulateGames`(noOfGames INT)
BEGIN
DECLARE i  INT;
DECLARE j  INT;
DECLARE idGame  INT;
DECLARE idInstruction  INT;
DECLARE idPage  INT;
DECLARE nameTitleNo  INT;
DECLARE instnCnt  INT;
DECLARE modRes INT;
DECLARE instnRecordsCnt INT;
DECLARE modCnt INT;
DECLARE idgameCheck INT;
DECLARE idinstructionCheck INT;
DECLARE idpageCheck INT;

 SET i = 1;
 SET idGame=101;
 SET idInstruction=101;
 SET idPage=101;
 SET nameTitleNo=1;

SELECT id into idgameCheck FROM gapp.games WHERE id >= 101 order by id LIMIT 1;
SELECT id into idinstructionCheck FROM gapp.instructions WHERE id >= 101 order by id LIMIT 1;
SELECT id into idpageCheck FROM gapp.page WHERE id >= 101 order by id LIMIT 1;

if(idgameCheck is null and idinstructionCheck is null and idpageCheck is null)
 then
 WHILE i  <= noOfGames DO
  SET j = 1;

 insert into gapp.games values (idGame,CONCAT('Name_',nameTitleNo));

 SET instnCnt = (SELECT COUNT(*) FROM gapp.instructions where id>=101);
 SET modRes = instnCnt mod 10;
  SET modRes = modRes+ 1;
 insert into gapp.instructions values (idInstruction, idGame, CONCAT('Title_',nameTitleNo), CONCAT('app/assets/wordshuffle/testing/test-',modRes,'.png'));
 SET nameTitleNo = nameTitleNo + 1;

 SET instnRecordsCnt = (SELECT COUNT(*) FROM gapp.instructions where id >=101);

	IF ((instnRecordsCnt mod 3 = 0) AND (instnRecordsCnt mod 5 = 0))
	 then
		SET modCnt=4;
	elseif (instnRecordsCnt mod 3 = 0)
	 then
		SET modCnt=3;
	elseif (instnRecordsCnt mod 5 = 0)
	 then
		SET modCnt=5;
	else
		SET modCnt=2;

	END IF;

 WHILE j  <= modCnt DO
 insert into gapp.page values (idPage,idInstruction,CONCAT('app/assets/wordshuffle/testing/test-',j,'.html'),j);
 SET idPage = idPage + 1;
 SET j = j + 1;
 END WHILE;

 SET  i = i + 1;
 SET  idInstruction = idInstruction + 1;
 SET  idGame = idGame + 1;

END WHILE;
else
select 'Primary Key value greater than 101 already exist in one of the tables' as Warning;
end if;
END$$

DELIMITER ;
