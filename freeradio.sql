SET GLOBAL event_scheduler = ON;

DROP DATABASE IF EXISTS freeradio;
CREATE DATABASE freeradio;

USE freeradio;

CREATE TABLE top107 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    artist VARCHAR(255),
    title VARCHAR(255),
    votes INT UNSIGNED DEFAULT 0
);

CREATE TABLE admin_login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE program_schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    day INT,
    time_start TIME,
    time_end TIME,
    program_name VARCHAR(255)
);

CREATE TABLE ip_votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(255) NOT NULL,
    song_id INT NOT NULL,
    vote_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE EVENT IF NOT EXISTS reset_ip_votes ON SCHEDULE EVERY 1 DAY STARTS '2024-01-01 00:00:00' DO DELETE FROM ip_votes;

INSERT INTO program_schedule (day, time_start, time_end, program_name) VALUES
('1', '07:00', '09:00', 'Ranní Šoustancem Free Rádia'),
('1', '09:00', '10:00', 'Krimi zprávy Free Rádia'),
('1', '10:00', '11:00', 'Tajemný film Free Rádia'),
('1', '11:00', '12:00', 'Celebrity Show Free Rádia'),
('1', '12:00', '14:00', 'Žijeme Brnem'),
('1', '14:00', '17:00', 'Odpolední FreePárty'),
('1', '17:00', '20:00', 'Freebox Free Rádia'),

('2', '07:00', '09:00', 'Ranní Šoustancem Free Rádia'),
('2', '09:00', '10:00', 'Krimi zprávy Free Rádia'),
('2', '10:00', '11:00', 'Tajemný film Free Rádia'),
('2', '11:00', '12:00', 'Celebrity Show Free Rádia'),
('2', '12:00', '14:00', 'Žijeme Brnem'),
('2', '14:00', '17:00', 'Odpolední FreePárty'),
('2', '17:00', '20:00', 'Freebox Free Rádia'),

('3', '07:00', '09:00', 'Ranní Šoustancem Free Rádia'),
('3', '09:00', '10:00', 'Krimi zprávy Free Rádia'),
('3', '10:00', '11:00', 'Tajemný film Free Rádia'),
('3', '11:00', '12:00', 'Celebrity Show Free Rádia'),
('3', '12:00', '14:00', 'Žijeme Brnem'),
('3', '14:00', '17:00', 'Odpolední FreePárty'),
('3', '17:00', '20:00', 'Freebox Free Rádia'),

('4', '07:00', '09:00', 'Ranní Šoustancem Free Rádia'),
('4', '09:00', '10:00', 'Krimi zprávy Free Rádia'),
('4', '10:00', '11:00', 'Tajemný film Free Rádia'),
('4', '11:00', '12:00', 'Celebrity Show Free Rádia'),
('4', '12:00', '14:00', 'Žijeme Brnem'),
('4', '14:00', '17:00', 'Odpolední FreePárty'),
('4', '17:00', '20:00', 'Freebox Free Rádia'),

('5', '07:00', '09:00', 'Ranní Šoustancem Free Rádia'),
('5', '09:00', '10:00', 'Krimi zprávy Free Rádia'),
('5', '10:00', '11:00', 'Tajemný film Free Rádia'),
('5', '11:00', '12:00', 'Celebrity Show Free Rádia'),
('5', '12:00', '14:00', 'Žijeme Brnem'),
('5', '14:00', '17:00', 'Odpolední FreePárty'),
('5', '17:00', '20:00', 'Freebox Free Rádia'),

('6', '09:00', '14:00', 'Ranní Šoustancem Free Rádia'),
('6', '14:00', '19:00', 'Krimi zprávy Free Rádia'),

('7', '09:00', '13:00', 'Víkendovky Free Rádia'),
('7', '13:00', '17:00', 'Hitparáda Stosedmička Freečka [repríza]'),
('7', '17:00', '20:00', 'Nedělní Retroparty Free Rádia'),
('7', '20:00', '22:00', 'House 4 U');

INSERT INTO top107 (artist, title) VALUES ('Italobrothers', 'Mañana');
INSERT INTO top107 (artist, title) VALUES ('Bebe Rexha & Nathan Dawe', 'Heart Still Beating');
INSERT INTO top107 (artist, title) VALUES ('Deorro', 'Me Caes Muy Bien');
INSERT INTO top107 (artist, title) VALUES ('Armin Van Buuren', 'Lose This Feeling (Maddix Remix)');
INSERT INTO top107 (artist, title) VALUES ('Becky Hill', 'Multiply');
INSERT INTO top107 (artist, title) VALUES ('Alok & A7s', 'Monster');
INSERT INTO top107 (artist, title) VALUES ('Calvin Harris & Ellie Goulding', 'Free');
INSERT INTO top107 (artist, title) VALUES ('Ella Henderson Feat. Rudimental', 'Alibi');
INSERT INTO top107 (artist, title) VALUES ('Swedish House Mafia & Niki', 'Lioness');
INSERT INTO top107 (artist, title) VALUES ('Benny Benassi & Nu-La', 'Give Me Your Love');
INSERT INTO top107 (artist, title) VALUES ('Robin Schulz, Topic, Oaks', 'One By One');
INSERT INTO top107 (artist, title) VALUES ('Ana Mena', 'Madrid City');
INSERT INTO top107 (artist, title) VALUES ('Lunax', 'You Owe Me');
INSERT INTO top107 (artist, title) VALUES ('Twocolors Feat. Roe Byrne', 'Stereo');
INSERT INTO top107 (artist, title) VALUES ('Cyril', 'Sound Of Silence');
INSERT INTO top107 (artist, title) VALUES ('Becky Hill', 'Outside Of Love');
INSERT INTO top107 (artist, title) VALUES ('Verona', 'Na Mě Nečekej');
INSERT INTO top107 (artist, title) VALUES ('Lola Indigo', 'La Reina');
INSERT INTO top107 (artist, title) VALUES ('Ella Henderson & Switch Disco', 'Under The Sun');
INSERT INTO top107 (artist, title) VALUES ('Minelli', 'Bug A Boo');
INSERT INTO top107 (artist, title) VALUES ('Joel Corry', 'Hey Dj');
INSERT INTO top107 (artist, title) VALUES ('Gabry Ponte & Vicco', 'Viento');
INSERT INTO top107 (artist, title) VALUES ('The Kolors', 'Karma');
INSERT INTO top107 (artist, title) VALUES ('Pnau Feat. Empire Of The Sun', 'Aeiou');
INSERT INTO top107 (artist, title) VALUES ('The Hitmen', 'Monsters In My Bed');
INSERT INTO top107 (artist, title) VALUES ('Nicky Romero Feat. Chelcee Grimes', 'Sensation');
INSERT INTO top107 (artist, title) VALUES ('89ers & Rimini Rockaz', 'Kingston Town');
INSERT INTO top107 (artist, title) VALUES ('Gigi Dagostino Feat. Boostedkids', 'Shadows Of The Night');
INSERT INTO top107 (artist, title) VALUES ('Becky Hill & Sonny Fodera', 'Never Be Alone');
INSERT INTO top107 (artist, title) VALUES ('Heidi Klum', 'Sunglasses At Night');
INSERT INTO top107 (artist, title) VALUES ('Cyril', 'Stumblin’ In');
INSERT INTO top107 (artist, title) VALUES ('Mike Candys', 'Si Te Vas');
INSERT INTO top107 (artist, title) VALUES ('Tiesto X Gabry Ponte', 'Mockingbird');
INSERT INTO top107 (artist, title) VALUES ('Gareth Emery Feat. Annabel', 'House In The Streetlight');
INSERT INTO top107 (artist, title) VALUES ('Kshmr', 'Take Me Home, Country Roads');
INSERT INTO top107 (artist, title) VALUES ('Rocco, Perfect Pitch', 'Echo');
INSERT INTO top107 (artist, title) VALUES ('Dua Lipa', 'Training Season');
INSERT INTO top107 (artist, title) VALUES ('Klaas', 'Neverending Story');
INSERT INTO top107 (artist, title) VALUES ('Armin Van Buuren & Hardwell', 'Follow The Light');
INSERT INTO top107 (artist, title) VALUES ('Felix Jaehn Feat. Sophie Ellis-Bextor', 'Ready For Your Love');
INSERT INTO top107 (artist, title) VALUES ('The Kolors', 'Un Ragazzo Una Ragazza');
INSERT INTO top107 (artist, title) VALUES ('Picco Vs. Jens O.', 'Heroes Of The Night');
INSERT INTO top107 (artist, title) VALUES ('Kygo Feat. Zak Abel & Nile Rodgers', 'For Life');
INSERT INTO top107 (artist, title) VALUES ('Oliver Heldens & David Guetta', 'Chills (Feel My Love)');
INSERT INTO top107 (artist, title) VALUES ('The Chainsmokers & Kim Petras', 'Don’t Lie');
INSERT INTO top107 (artist, title) VALUES ('Sick Individuals', 'Who Do You Love');
INSERT INTO top107 (artist, title) VALUES ('Steve Modana', 'Eloui');
INSERT INTO top107 (artist, title) VALUES ('Don Diablo & Sandro Cavazza', 'Young Again');
INSERT INTO top107 (artist, title) VALUES ('W&W X Vinai', 'Axel F (Take It To The Floor)');
INSERT INTO top107 (artist, title) VALUES ('Karol G & Tiesto', 'Contigo');
INSERT INTO top107 (artist, title) VALUES ('Bebe Rexha Feat. Nicki Minaj', 'No Broken Hearts');
INSERT INTO top107 (artist, title) VALUES ('Pam Rabbit', 'Space');
INSERT INTO top107 (artist, title) VALUES ('Regard', 'Call On Me');
INSERT INTO top107 (artist, title) VALUES ('Sophie And The Giants', 'Shut Up And Dance');
INSERT INTO top107 (artist, title) VALUES ('Bingo Players & Disco Fries', 'Our House');
INSERT INTO top107 (artist, title) VALUES ('Burak Yeter Feat. Parkah & Durzo', 'Say My Name');
INSERT INTO top107 (artist, title) VALUES ('Neptunica, Jasper Forks', 'River Flows In You');
INSERT INTO top107 (artist, title) VALUES ('Jaxomy & Raffaella Carra', 'Pedro');
INSERT INTO top107 (artist, title) VALUES ('Ava Max', 'Blood, Sweat & Tears');
INSERT INTO top107 (artist, title) VALUES ('Purple Disco Machine, Benjamin Ingrosso', 'Honey Boy');
INSERT INTO top107 (artist, title) VALUES ('Bob Sinclar & Sofiya Nzau', 'Digane');
INSERT INTO top107 (artist, title) VALUES ('Ofenbach Feat. Salem Ilese', 'Feelings Dont Lie');
INSERT INTO top107 (artist, title) VALUES ('Dimitri Vegas & Vin Diesel', 'Don’t Stop The Music');
INSERT INTO top107 (artist, title) VALUES ('Alan Walker & Bludnymph', 'Beautiful Nightmare');
INSERT INTO top107 (artist, title) VALUES ('Eminem', 'Houdini');
INSERT INTO top107 (artist, title) VALUES ('Marcus & Martinus', 'Unforgettable');
INSERT INTO top107 (artist, title) VALUES ('Katy Perry', 'Lifetimes');
INSERT INTO top107 (artist, title) VALUES ('Vinai & Tungevaag', 'Whenever You Are');
INSERT INTO top107 (artist, title) VALUES ('Vize', 'Heaven');
INSERT INTO top107 (artist, title) VALUES ('Blanka', 'Asereje');
INSERT INTO top107 (artist, title) VALUES ('Benny Benassi & Oaks', 'Never Been Yours');
INSERT INTO top107 (artist, title) VALUES ('Sofi Tukker', 'Throw Some Ass');
INSERT INTO top107 (artist, title) VALUES ('Purple Disco Machine & Chromeo', 'Heartbreaker');
INSERT INTO top107 (artist, title) VALUES ('Cascada', 'Call Me');
INSERT INTO top107 (artist, title) VALUES ('Imanbek & Younotus', 'Heal My Heart');
INSERT INTO top107 (artist, title) VALUES ('Jerome, 89ers, Marc Et Claude', 'I Need Your Lovin');
INSERT INTO top107 (artist, title) VALUES ('Clean Bandit & David Guetta', 'Cry Baby');
INSERT INTO top107 (artist, title) VALUES ('Sigala Feat. Trevor Daniel', 'It Is A Feeling');
INSERT INTO top107 (artist, title) VALUES ('Alan Walker & Ina Wroldsen', 'Barcelona');
INSERT INTO top107 (artist, title) VALUES ('The Weeknd', 'Dancing In The Flames');
INSERT INTO top107 (artist, title) VALUES ('Sabrina Carpenter', 'Taste');
INSERT INTO top107 (artist, title) VALUES ('Matoma', 'Let Me');
INSERT INTO top107 (artist, title) VALUES ('Martin Garrix & Carolina Liar', 'Smile');
INSERT INTO top107 (artist, title) VALUES ('Tiscore & Bellini', 'Danger Zone');
INSERT INTO top107 (artist, title) VALUES ('Prezioso & Blasterjaxx', 'Shady');
INSERT INTO top107 (artist, title) VALUES ('Paris Hilton Feat. Megan Thee Stallion', 'Bba');
INSERT INTO top107 (artist, title) VALUES ('Kesha', 'Joyride');
INSERT INTO top107 (artist, title) VALUES ('Afrojack & Pitbull & Ne-Yo', '2 The Moon');
INSERT INTO top107 (artist, title) VALUES ('Galantis Feat. Rosa Linn', 'One Cry');
INSERT INTO top107 (artist, title) VALUES ('Meghan Trainor', 'Criminals');
INSERT INTO top107 (artist, title) VALUES ('The Black Eyed Peas, El Alfa & Becky G', 'Tonight');
INSERT INTO top107 (artist, title) VALUES ('Meduza Feat. Onerepublic & Leony', 'Fire');
INSERT INTO top107 (artist, title) VALUES ('Nathan Evans', 'Flowers In The Water');
INSERT INTO top107 (artist, title) VALUES ('Edward Maya', 'Just Like A Song');
INSERT INTO top107 (artist, title) VALUES ('Jonas Blue & Eyelar', '100 Lives');
INSERT INTO top107 (artist, title) VALUES ('Kygo & Sigrid', 'The Feeling');
INSERT INTO top107 (artist, title) VALUES ('Switch Disco', 'I Found You');
INSERT INTO top107 (artist, title) VALUES ('Marshmello & Kane Brown', 'Miles On It');
INSERT INTO top107 (artist, title) VALUES ('Charli Xcx Feat. Billie Eilish', 'Guess');
INSERT INTO top107 (artist, title) VALUES ('Alok & Jess Glynne', 'Summers Back');
INSERT INTO top107 (artist, title) VALUES ('James Carter & Leony, Sam Fischer', 'Summer Of Love');
INSERT INTO top107 (artist, title) VALUES ('Kiesza', 'I Go Dance');
INSERT INTO top107 (artist, title) VALUES ('Cyril & Kita Alexander', 'True');
INSERT INTO top107 (artist, title) VALUES ('Ace Of Base', 'Wish You Were Mine');
INSERT INTO top107 (artist, title) VALUES ('Inna', 'Get The Feeling');
INSERT INTO top107 (artist, title) VALUES ('Kylie Minogue', 'Lights Camera Action');
INSERT INTO top107 (artist, title) VALUES ('Nelly Furtado', 'Honesty');
