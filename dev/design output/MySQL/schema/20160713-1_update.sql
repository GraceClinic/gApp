#All Purpose Notebook ------ 1

USE gapp;
DROP TABLE IF EXISTS notes ;
USE gapp;
CREATE TABLE `notes` (
  `idNotes` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `category` enum('funny','todo','remember','remarkable') NOT NULL DEFAULT 'funny',
  `body` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idNotes`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

USE gapp;
DROP TABLE IF EXISTS notes_player ;
USE gapp;
CREATE TABLE `notes_player` (
  `idnotes` int(10) unsigned NOT NULL,
  `idplayer` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idnotes`,`idplayer`),
  UNIQUE KEY `idnotes_UNIQUE` (`idnotes`),
  KEY `fk_idplayer_idx` (`idplayer`),
  CONSTRAINT `fk_idnotes_notesplayer` FOREIGN KEY (`idnotes`) REFERENCES `notes` (`idNotes`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_idplayer` FOREIGN KEY (`idplayer`) REFERENCES `player` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

USE gapp;
DROP TABLE IF EXISTS notes_wsgame ;
USE gapp;
CREATE TABLE `notes_wsgame` (
  `idnotes` int(10) unsigned NOT NULL,
  `idWSgame` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idnotes`,`idWSgame`),
  UNIQUE KEY `idnotes_UNIQUE` (`idnotes`),
  KEY `fk_idWSGame_idx` (`idWSgame`),
  CONSTRAINT `fk_idWSGame` FOREIGN KEY (`idWSgame`) REFERENCES `wsgame` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_idnotes_noteswsgame` FOREIGN KEY (`idnotes`) REFERENCES `notes` (`idNotes`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

USE gapp;
DROP TABLE IF EXISTS notes_wsround ;
USE gapp;
CREATE TABLE `notes_wsround` (
  `idnotes` int(10) unsigned NOT NULL,
  `idround` int(11) NOT NULL,
  PRIMARY KEY (`idnotes`,`idround`),
  UNIQUE KEY `idnotes_UNIQUE` (`idnotes`),
  KEY `fk_idwsround_idx` (`idround`),
  CONSTRAINT `fk_idnotes_noteswsround` FOREIGN KEY (`idnotes`) REFERENCES `notes` (`idNotes`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_idwsround` FOREIGN KEY (`idround`) REFERENCES `wsround` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
 SET nameTitleNo = nameTitleNo + 1;
 
 SET instnCnt = (SELECT COUNT(*) FROM gapp.instructions);
 SET modRes = instnCnt mod 9;
 SET modRes = modRes+ 1;
 insert into gapp.instructions values (idInstruction, idGame, CONCAT('Title_',nameTitleNo), CONCAT('app/assets/wordshuffle/testing/test-',modRes,'.png'));
 
 SET instnRecordsCnt = (SELECT COUNT(*) FROM gapp.instructions);
 
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
