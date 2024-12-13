CREATE DATABASE astar_games;

USE astar_games;

CREATE TABLE new_games (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(255) NOT NULL,
  `g_category` varchar(255) DEFAULT NULL,
  `g_description` text DEFAULT NULL,
  `g_rating` float DEFAULT NULL,
  `g_image_url` varchar(255) DEFAULT NULL,
  `g_download_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`g_id`)
);

CREATE TABLE trending_games (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `download_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE users (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  PRIMARY KEY (`user_id`)
);

INSERT INTO new_games (g_id, g_name, g_category, g_description, g_rating, g_image_url, g_download_url) VALUES
(1, 'Suicide Squad: Kill the Justice League', 'Action', 'Suicide Squad: Kill the Justice League is a third-person shooter where misfits must defeat the Justice League.', 6, 'images/SuicideSquad.jpg', 'https://store.steampowered.com/app/315210/Suicide_Squad_Kill_the_Justice_League/'),
(2, 'Marvel Rivals', 'Action', 'Marvel Rivals is a team-based PVP shooter! Combine powers, use unique Team-Up skills, and fight in dynamic Marvel battlefields!', 7, 'images/rivals.jpg', 'https://store.steampowered.com/app/2767030/Marvel_Rivals/'),
(3, 'Black Myth: Wukong', 'Action', 'A Chinese mythology-based action RPG where you, the Destined One, uncover hidden truths behind a legendary past.', 10, 'images/wukong2.jpg', 'https://store.steampowered.com/app/2358720/Black_Myth_Wukong/'),
(4, 'Ghost of Tsushima', 'Open-World', 'Experience Ghost of Tsushima DIRECTOR\'S CUT on PC—explore its open world and uncover hidden wonders. ', 9.5, 'images/GhostOfTsushima.jpg', 'https://store.steampowered.com/app/2215430/Ghost_of_Tsushima_DIRECTORS_CUT/'),
(5, 'Hogwarts Legacy', 'Open-World', 'It is an immersive, open-world action RPG. Now you can take control of the action and be at the center of your own adventure in the wizarding world.', 9, 'images/HogwartsLegacy.avif', 'https://store.steampowered.com/app/990080/Hogwarts_Legacy/'),
(6, 'Star Wars Outlaws', 'Action', 'Explore the first-ever open-world Star Wars™ game as Kay Vess, a scoundrel seeking freedom. Fight, steal, and outwit crime syndicates across iconic and new galactic locations.', 7, 'images/starwars.avif', 'https://store.epicgames.com/en-US/p/star-wars-outlaws'),
(7, 'Cyberpunk 2077', 'Open-World', 'Cyberpunk 2077 is an open-world action RPG set in Night City—a dark, dangerous megalopolis driven by power, glamor, and body modification.', 9, 'images/cyberpunk.webp', 'https://store.steampowered.com/app/1091500/Cyberpunk_2077/'),
(8, 'Grand Theft Auto V', 'Open-World', 'Players can explore the award-winning world of Los Santos and Blaine County in resolutions up to 4K and enjoy 60 frames per second gameplay.', 9, 'images/gtav.png', 'https://store.steampowered.com/app/271590/Grand_Theft_Auto_V/'),
(9, 'Red Dead Redemption 2', 'Action', 'Winner of 175+ Game of the Year Awards and 250+ perfect scores, RDR2 follows outlaw Arthur Morgan and the Van der Linde gang on the run in early America. ', 9, 'images/rdr2.jpg', 'https://store.steampowered.com/app/1174180/Red_Dead_Redemption_2/'),
(10, 'Forza Horizon 5', 'Racing', 'Explore Mexico’s vibrant open world in Forza Horizon 5. Race in Hot Wheels or conquer Sierra Nueva in the Rally Adventure. Base game required; expansions sold separately.', 9, 'images/Forza5.e02f4ead-d89b-45cd-8eb5-5dcbf44ae91f', 'https://store.steampowered.com/app/1551360/Forza_Horizon_5/'),
(11, 'Valorant', 'Action', 'Showcase your style on a global stage with sharp gunplay and tactics. Survive 13-round battles in Competitive, Unranked, Deathmatch, or Spike Rush modes.', 9, 'images/valorant.jpg', 'https://store.epicgames.com/en-US/p/valorant'),
(12, 'Palworld', 'Open-World', 'Fight, farm, build and work alongside mysterious creatures called \"Pals\" in this completely new multiplayer, open world survival and crafting game!', 9, 'images/palworld.jpg', 'https://store.steampowered.com/app/1623730/Palworld/'),
(13, 'Phasmophobia', 'Horror', 'Phasmophobia is a 4-player online co-op horror game where you and your team use ghost-hunting tools to gather evidence of rising paranormal activity.', 10, 'images/phasmo.jpg', 'https://store.steampowered.com/app/739630/Phasmophobia/'),
(14, 'Tomb Raider', 'Open-World', 'Tomb Raider (2013) is an action-adventure game and series reboot, exploring Lara Croft\'s origins in the Survivor trilogy', 10, 'images/tombR1.jpg', 'https://store.steampowered.com/app/203160/Tomb_Raider/'),
(15, 'Assassin’s Creed Mirage', 'Action', 'A return to stealth-action roots, this installment takes place in Baghdad, focusing on parkour and stealth assassinations.', 7, 'images/acm.png', 'https://store.steampowered.com/app/3035570/Assassins_Creed_Mirage/'),
(16, 'Resident Evil Village', 'Horror', 'Experience unparalleled horror in Resident Evil Village with stunning visuals, intense action, and masterful storytelling.', 9, 'images/REVillage.png', 'https://store.steampowered.com/app/1196590/Resident_Evil_Village/'),
(17, 'Asphalt Legends Unite', 'Racing', 'Ignite your competitive spirit with Asphalt Legends UNITE! Team up for intense races, stunning stunts, and victory in the finest hypercars!', 9, 'images/asphaltL.jpg', 'https://store.steampowered.com/app/1815780/Asphalt_Legends_Unite/'),
(18, 'Marvel\'s Spider-Man 2', 'Action', 'Peter Parker and Miles Morales team up to explore New York City, swapping characters and shooting webs to fight bad guys. ', 10, 'images/spiderman2.jpg', 'https://store.steampowered.com/app/2651280/Marvels_SpiderMan_2/'),
(19, 'UNCHARTED™: Legacy of Thieves Collection', 'Open-World', 'Play as Nathan Drake and Chloe Frazer in standalone adventures, featuring critically acclaimed stories from UNCHARTED 4 and The Lost Legacy', 9, 'images/uncharted.jpg', 'https://store.steampowered.com/app/1659420/UNCHARTED_Legacy_of_Thieves_Collection/'),
(20, 'The Outlast Trials', 'Horror', 'Experience mind-numbing terror in Red Barrels\' latest game, playable solo or with friends. Survive the trials, but be warned: you may not escape unscathed.', 9, 'images/outlastT.jpg', 'https://store.steampowered.com/app/1304930/The_Outlast_Trials/'),
(21, 'Forza Horizon 4', 'Racing', 'Dynamic seasons change everything at the world’s greatest automotive festival. Go it alone or team up with others to explore beautiful and historic Britain in a shared open world.', 9, 'images/forza4.jpg', 'https://store.steampowered.com/app/1293830/Forza_Horizon_4/'),
(22, 'Dead by Daylight', 'Horror', 'Dead by Daylight: a 4v1 multiplayer horror game where one player is the Killer and four players must survive and escape.', 9, 'images/dbd.jpg', 'https://store.steampowered.com/app/381210/Dead_by_Daylight/'),
(23, 'Far Cry® 6', 'Open-World', 'Enter the adrenaline-filled world of a modern-day guerrilla revolution. With stunning vistas, visceral gunplay, and a huge variety of gameplay experiences, there\'s never been a better time to join the fight.', 7, 'images/farcry6.jpg', 'https://store.steampowered.com/app/2369390/Far_Cry_6/'),
(24, 'HITMAN World of Assassination', 'Action', 'Experience HITMAN: World of Assassination, combining the best of HITMAN 1-3.', 9, 'images/hitman.jpg', 'https://store.steampowered.com/app/1659040/HITMAN_World_of_Assassination/'),
(25, 'Shadow of the Tomb Raider', 'Open-World', 'As Lara Croft races to save the world from a Maya apocalypse, she must become the Tomb Raider she is destined to be.', 9, 'images/shadowTR.jpg', 'https://store.steampowered.com/app/750920/Shadow_of_the_Tomb_Raider_Definitive_Edition/'),
(26, 'Need for Speed™ Heat', 'Racing', 'Hustle by day and risk it all at night in Need for Speed™ Heat Deluxe Edition, a white-knuckle street racer, where the lines of the law fade as the sun starts to set.', 9, 'images/nfsheat.jpg', 'https://store.steampowered.com/app/1222680/Need_for_Speed_Heat/'),
(27, 'SILENT HILL 2', 'Horror', 'Return to Silent Hill with James as he searches for his late wife, confronting monsters, solving puzzles, and uncovering the truth in this remake of SILENT HILL 2.', 9, 'images/silenthill2.jpg', 'https://store.steampowered.com/app/2124490/SILENT_HILL_2/'),
(28, 'F1® 24', 'Racing', 'Join the grid and Be One of the 20. Drive like the greatest in EA SPORTS™ F1® 24, the official video game of the 2024 FIA Formula One World Championship™.', 7, 'images/f1.jpg', 'https://store.steampowered.com/app/2488620/F1_24/'),
(29, 'Dying Light 2 Stay Human', 'Horror', 'Survive a zombie-infested, post-apocalyptic open world. Use parkour and combat skills to navigate the City by day and fend off monsters by night.', 7, 'images/dyingL2.jpg', 'https://store.steampowered.com/app/534380/Dying_Light_2_Stay_Human_Reloaded_Edition/'),
(30, 'Riders Republic', 'Racing', 'Jump into a massive multiplayer playground! Bike, ski, snowboard, or wingsuit across an open world sports paradise.', 9, 'images/riders.jpg', 'https://store.steampowered.com/app/2290180/Riders_Republic/');

INSERT INTO trending_games (id, name, category, description, rating, image_url, download_url) VALUES
(1, 'Black Myth: Wukong', 'Action', 'A Chinese mythology-based action RPG where you, the Destined One, uncover hidden truths behind a legendary past.', 10, 'images/wukong2.jpg', 'https://store.steampowered.com/app/2358720/Black_Myth_Wukong/'),
(2, 'Ghost of Tsushima', 'Open-World', 'Experience Ghost of Tsushima DIRECTOR\'S CUT on PC—explore its open world and uncover hidden wonders. ', 9.5, 'images/GhostOfTsushima.jpg', 'https://store.steampowered.com/app/2215430/Ghost_of_Tsushima_DIRECTORS_CUT/'),
(3, 'Hogwarts Legacy', 'Open-World', 'It is an immersive, open-world action RPG. Now you can take control of the action and be at the center of your own adventure in the wizarding world.', 9, 'images/HogwartsLegacy.avif', 'https://store.steampowered.com/app/990080/Hogwarts_Legacy/'),
(4, 'Cyberpunk 2077', 'Open-World', 'Cyberpunk 2077 is an open-world action RPG set in Night City—a dark, dangerous megalopolis driven by power, glamor, and body modification.', 9, 'images/cyberpunk.webp', 'https://store.steampowered.com/app/1091500/Cyberpunk_2077/'),
(5, 'Grand Theft Auto V', 'Open-World', 'Players can explore the award-winning world of Los Santos and Blaine County in resolutions up to 4K and enjoy 60 frames per second gameplay.', 9, 'images/gtav.png', 'https://store.steampowered.com/app/271590/Grand_Theft_Auto_V/'),
(6, 'Red Dead Redemption 2', 'Action', 'Winner of 175+ Game of the Year Awards and 250+ perfect scores, RDR2 follows outlaw Arthur Morgan and the Van der Linde gang on the run in early America. ', 9, 'images/rdr2.jpg', 'https://store.steampowered.com/app/1174180/Red_Dead_Redemption_2/'),
(7, 'Forza Horizon 5', 'Racing', 'Explore Mexico’s vibrant open world in Forza Horizon 5. Race in Hot Wheels or conquer Sierra Nueva in the Rally Adventure. Base game required; expansions sold separately.', 9, 'images/Forza5.e02f4ead-d89b-45cd-8eb5-5dcbf44ae91f', 'https://store.steampowered.com/app/1551360/Forza_Horizon_5/'),
(8, 'Valorant', 'Action', 'Showcase your style on a global stage with sharp gunplay and tactics. Survive 13-round battles in Competitive, Unranked, Deathmatch, or Spike Rush modes.', 9, 'images/valorant.jpg', 'https://store.epicgames.com/en-US/p/valorant'),
(9, 'Palworld', 'Open-World', 'Fight, farm, build and work alongside mysterious creatures called \"Pals\" in this completely new multiplayer, open world survival and crafting game!', 9, 'images/palworld.jpg', 'https://store.steampowered.com/app/1623730/Palworld/'),
(10, 'Phasmophobia', 'Horror', 'Phasmophobia is a 4-player online co-op horror game where you and your team use ghost-hunting tools to gather evidence of rising paranormal activity.', 10, 'images/phasmo.jpg', 'https://store.steampowered.com/app/739630/Phasmophobia/'),
(11, 'Tomb Raider', 'Open-World', 'Tomb Raider (2013) is an action-adventure game and series reboot, exploring Lara Croft\'s origins in the Survivor trilogy', 10, 'images/tombR1.jpg', 'https://store.steampowered.com/app/203160/Tomb_Raider/'),
(12, 'Resident Evil Village', 'Horror', 'Experience unparalleled horror in Resident Evil Village with stunning visuals, intense action, and masterful storytelling.', 9, 'images/REVillage.png', 'https://store.steampowered.com/app/1196590/Resident_Evil_Village/'),
(13, 'Asphalt Legends Unite', 'Racing', 'Ignite your competitive spirit with Asphalt Legends UNITE! Team up for intense races, stunning stunts, and victory in the finest hypercars!', 9, 'images/asphaltL.jpg', 'https://store.steampowered.com/app/1815780/Asphalt_Legends_Unite/'),
(14, 'Marvel\'s Spider-Man 2', 'Action', 'Peter Parker and Miles Morales team up to explore New York City, swapping characters and shooting webs to fight bad guys. ', 10, 'images/spiderman2.jpg', 'https://store.steampowered.com/app/2651280/Marvels_SpiderMan_2/'),
(15, 'UNCHARTED™', 'Open-World', 'Play as Nathan Drake and Chloe Frazer in standalone adventures, featuring critically acclaimed stories from UNCHARTED 4 and The Lost Legacy', 9, 'images/uncharted.jpg', 'https://store.steampowered.com/app/1659420/UNCHARTED_Legacy_of_Thieves_Collection/'),
(16, 'The Outlast Trials', 'Horror', 'Experience mind-numbing terror in Red Barrels\' latest game, playable solo or with friends. Survive the trials, but be warned: you may not escape unscathed.', 9, 'images/outlastT.jpg', 'https://store.steampowered.com/app/1304930/The_Outlast_Trials/'),
(17, 'Forza Horizon 4', 'Racing', 'Dynamic seasons change everything at the world’s greatest automotive festival. Go it alone or team up with others to explore beautiful and historic Britain in a shared open world.', 9, 'images/forza4.jpg', 'https://store.steampowered.com/app/1293830/Forza_Horizon_4/'),
(18, 'Dead by Daylight', 'Horror', 'Dead by Daylight: a 4v1 multiplayer horror game where one player is the Killer and four players must survive and escape.', 9, 'images/dbd.jpg', 'https://store.steampowered.com/app/381210/Dead_by_Daylight/'),
(19, 'HITMAN World of Assassination', 'Action', 'Experience HITMAN: World of Assassination, combining the best of HITMAN 1-3.', 9, 'images/hitman.jpg', 'https://store.steampowered.com/app/1659040/HITMAN_World_of_Assassination/'),
(20, 'Shadow of the Tomb Raider', 'Open-World', 'As Lara Croft races to save the world from a Maya apocalypse, she must become the Tomb Raider she is destined to be.', 9, 'images/shadowTR.jpg', 'https://store.steampowered.com/app/750920/Shadow_of_the_Tomb_Raider_Definitive_Edition/'),
(21, 'Need for Speed™ Heat', 'Racing', 'Hustle by day and risk it all at night in Need for Speed™ Heat Deluxe Edition, a white-knuckle street racer, where the lines of the law fade as the sun starts to set.', 9, 'images/nfsheat.jpg', 'https://store.steampowered.com/app/1222680/Need_for_Speed_Heat/'),
(22, 'SILENT HILL 2', 'Horror', 'Return to Silent Hill with James as he searches for his late wife, confronting monsters, solving puzzles, and uncovering the truth in this remake of SILENT HILL 2.', 9, 'images/silenthill2.jpg', 'https://store.steampowered.com/app/2124490/SILENT_HILL_2/'),
(23, 'Riders Republic', 'Racing', 'Jump into a massive multiplayer playground! Bike, ski, snowboard, or wingsuit across an open world sports paradise.', 9, 'images/riders.jpg', 'https://store.steampowered.com/app/2290180/Riders_Republic/');

INSERT INTO users (user_id, username, password, name, email_id, role) VALUES
(5, 'phoenix', '12345', 'Phoenix', 'phoenix@gmail.com', 'admin'),
(6, 'Aishee', 'disha', 'Aishee Mitra', 'aisheemitra07@gmail.com', 'user');