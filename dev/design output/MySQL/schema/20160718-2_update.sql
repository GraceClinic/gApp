USE `gapp`;

DROP procedure IF EXISTS `Populate_Players`;

DELIMITER $$
USE `gapp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Populate_Players`(IN `numPlayers` INT)
BEGIN
	DECLARE dontRunProcedure INT;
    DECLARE challengeEntries INT;
	DECLARE challengeIds INT;
    DECLARE iterator INT;
    DECLARE cId INT;
    DECLARE cOffId INT;
    DECLARE wsGameEntry INT DEFAULT 1;
    DECLARE totalRoundEntries INT;
    DECLARE tempRoundEntries INT;
    DECLARE wsEntryNumber INT;
    DECLARE roundTime INT DEFAULT 240;
    DECLARE wsRound INT DEFAULT 1;
    DECLARE wsGameId INT;
    DECLARE wsRoundId INT;
    DECLARE roundAvg FLOAT;
    DECLARE roundIterator INT;
    DECLARE totalPoints INT;
    DECLARE tempWsRoundId INT;
    DECLARE wsGameStatus INT DEFAULT 4;
    DECLARE wsRoundIndex INT;
	SELECT EXISTS(select id from Player where id > 101 order by id asc limit 1) or exists(select id from Challenge where id > 101 order by id asc limit 1) or exists(select id from WSGame where id > 101 order by id asc limit 1) or exists(select id from WSRound where id > 101 order by id asc limit 1) INTO dontRunProcedure;
    IF (!dontRunProcedure) THEN
		SET @testing := 1; #Session variable to check and run procedure to delete entries from tables
		SET challengeEntries = 1;
        SET challengeIds = 101;
        #populating entries to challenge table
		WHILE challengeEntries <= 10 DO
			INSERT INTO Challenge values(challengeIds, concat("Your Question Number", challengeEntries));
            SET challengeEntries = challengeEntries + 1;
            SET challengeIds = challengeIds + 1;
        END WHILE;
        DROP VIEW IF EXISTS sortedChallenge;
        CREATE VIEW sortedChallenge AS SELECT id FROM Challenge where id > 100 order by id asc;
        SET iterator = 0;
        SET totalRoundEntries = 0;
        SET wsGameId = 101;
        SET wsRoundId = 101;
        SET wsRoundIndex = 0;
        WHILE iterator < numPlayers DO
			SET cOffId = iterator % 10;
			SELECT id  from sortedChallenge limit cOffId, 1 INTO cId;
            #creating dynamic player entries
			INSERT INTO Player(id, name, idChallenge, secret, createDate, modifyDate) VALUES (101 + iterator, concat("Player", iterator + 1), cId, concat("Player", iterator + 1),  DATE_ADD(STR_TO_DATE('1,7,2016','%d,%m,%Y'), INTERVAL (101 + iterator) % 100 DAY), DATE_ADD(STR_TO_DATE('1,7,2016','%d,%m,%Y'), INTERVAL (101 + iterator) % 100 DAY));
			#calculate roundTime before inserting into WSGame
            #iterator + 1 refers each player
            IF (iterator + 1) % 15 = 0 THEN
                SET wsGameEntry = 7;
            ELSEIF (iterator + 1) % 5 = 0 THEN
                SET wsGameEntry = 5;
            ELSEIF (iterator + 1) % 3 = 0 THEN
                SET wsGameEntry = 3;
            END IF;
            SET tempRoundEntries = totalRoundEntries;
            SET wsEntryNumber = 1;
            WHILE wsEntryNumber <= wsGameEntry DO
                IF (tempRoundEntries + wsEntryNumber) % 15 = 0 THEN
                    SET wsRound = 2;
                    SET roundTime = 180;
                ELSEIF (tempRoundEntries + wsEntryNumber) % 5 = 0 THEN
                    SET wsRound = 5;
                    SET roundTime = 120;
                ELSEIF (tempRoundEntries + wsEntryNumber) % 3 = 0 THEN
                    SET wsRound = 3;
                    SET roundTime = 60;
                END IF;
                #calculating average points for wsRounds for each wsGame
                SET roundIterator = 1;
                SET tempWsRoundId = wsRoundId;
                SET totalPoints = 0;
                WHILE roundIterator <= wsRound DO
                    SET totalPoints = totalPoints + tempWsRoundId;
                    SET tempWsRoundId = tempWsRoundId + 1;
                    SET roundIterator = roundIterator + 1;
                END WHILE;
                SET roundAvg = totalPoints / wsRound;
                IF (iterator + 1) % 15 = 0 THEN
                    IF wsEntryNumber = 1 THEN
                        SET wsGameStatus = 1;
                    ELSEIF wsEntryNumber = 7 THEN
                        SET wsGameStatus = 2;
                    END IF;
                ELSEIF (iterator + 1) % 5 = 0 THEN
                    IF wsEntryNumber = 5 THEN
                        SET wsGameStatus = 5;
                    END IF;
                ELSEIF (iterator + 1) % 3 = 0 THEN
                    IF wsEntryNumber = 3 THEN
                        SET wsGameStatus = 3;
                    END IF;
                END IF;
                INSERT INTO WSGame(id, idPlayer, roundsPerGame, secondsPerRound, start, `end`, points, roundAvg, `status`) VALUES (wsGameId, 101 + iterator, wsRound, roundTime, DATE_ADD(STR_TO_DATE('1,7,2016','%d,%m,%Y'), INTERVAL wsGameId % 100 DAY), DATE_ADD(STR_TO_DATE('1,7,2016','%d,%m,%Y'), INTERVAL wsGameId % 100 DAY), totalPoints, roundAvg, wsGameStatus);
                SET roundIterator = 1;
                WHILE roundIterator <= wsRound DO
                    INSERT INTO wsRound(id, idWSGame, time, points, wordCount, start, `end`, `index`) VALUES (wsRoundId, wsGameId, roundTime, wsRoundId, 2 * (wsRoundIndex + roundIterator) + 20, DATE_ADD(STR_TO_DATE('1,7,2016','%d,%m,%Y'), INTERVAL wsRoundId % 100 DAY), DATE_ADD(STR_TO_DATE('1,7,2016','%d,%m,%Y'), INTERVAL wsRoundId % 100 DAY), wsRoundIndex + roundIterator);
                    SET wsRoundId = wsRoundId + 1;
                    SET roundIterator = roundIterator + 1;
                END WHILE;
                SET wsRoundIndex = wsRoundIndex + wsRound;
                SET wsGameId = wsGameId + 1;
                SET wsEntryNumber = wsEntryNumber + 1;
                SET wsRound = 1;
                SET roundTime = 240;
                SET wsGameStatus = 4;
            END WHILE;
            SET totalRoundEntries = totalRoundEntries + wsGameEntry;
            SET iterator = iterator + 1;
            SET wsGameEntry = 1;
		END WHILE;

	ELSE
		SELECT "Sorry you can't run the procedure, already got entries" as '';
	END IF;
    DROP VIEW IF EXISTS sortedChallenge;

END$$

DELIMITER ;
