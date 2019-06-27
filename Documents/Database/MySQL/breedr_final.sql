--
-- Tabel `breed`
--

CREATE TABLE breed (
  breedID int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) DEFAULT NULL,
  PRIMARY KEY (breedID)
);

--
-- Tabel `user`
--

CREATE TABLE `user` (
  userID int(11) NOT NULL AUTO_INCREMENT,
  username varchar(50) DEFAULT NULL,
  password varchar(300) DEFAULT NULL,
  email varchar(50) DEFAULT NULL,
  firstName varchar(50) DEFAULT NULL,
  lastName varchar(50) DEFAULT NULL,
  longi decimal(11,8) DEFAULT NULL,
  lat decimal(10,8) DEFAULT NULL,
  PRIMARY KEY (userID)
);

--
-- Tabel `dog`
--

CREATE TABLE dog (
  dogID int(11) NOT NULL AUTO_INCREMENT,
  userID int(11) NOT NULL,
  breedID int(11) NOT NULL,
  name varchar(50) DEFAULT NULL,
  age int(11) DEFAULT NULL,
  sex varchar(6) DEFAULT NULL,
  description varchar(500) DEFAULT NULL,
  PRIMARY KEY (dogID),
  FOREIGN KEY (userID) REFERENCES `user`(userID),
  FOREIGN KEY (breedID) REFERENCES breed(breedID)
);

--
-- Tabel `image`
--

CREATE TABLE image (
  imageID int(11) NOT NULL AUTO_INCREMENT,
  path varchar(300) DEFAULT NULL,
  PRIMARY KEY (imageID)
);

--
-- Tabel `image_class`
--

CREATE TABLE image_class (
  imageClassID int(11) NOT NULL AUTO_INCREMENT,
  imageID int(11) NOT NULL,
  userID int(11) NOT NULL,
  PRIMARY KEY (imageClassID),
  FOREIGN KEY (imageID) REFERENCES image(imageID),
  FOREIGN KEY (userID) REFERENCES `user`(userID)
);

--
-- Tabel `swipe`
--

CREATE TABLE swipe (
  swipeID int(11) NOT NULL AUTO_INCREMENT,
  dogID int(11) NOT NULL,
  dogSID int(11) NOT NULL,
  PRIMARY KEY (swipeID), 
  FOREIGN KEY (dogID) REFERENCES dog(dogID),
  FOREIGN KEY (dogSID) REFERENCES dog(dogID)
);

--
-- Tabel `match`
--

CREATE TABLE `match` (
  matchID int(11) NOT NULL AUTO_INCREMENT,
  swipeID int(11) DEFAULT NULL,
  PRIMARY KEY (matchID),
  FOREIGN KEY (swipeID) REFERENCES swipe(swipeID)
  );

--
-- Tabel `messages`
--

CREATE TABLE messages (
  messageID int(11) NOT NULL AUTO_INCREMENT,
  dogID int(11) NOT NULL,
  dogSID int(11) NOT NULL,
  message varchar(140) DEFAULT NULL,
  PRIMARY KEY (messageID),
  FOREIGN KEY (dogID) REFERENCES dog(dogID),
  FOREIGN KEY (dogSID) REFERENCES dog(dogID)
);

--
-- Tabellenstruktur für Tabelle `preferences`
--

CREATE TABLE preferences (
  prefID int(11) NOT NULL AUTO_INCREMENT,
  userID int(11) NOT NULL,
  prefBreed varchar(50) DEFAULT NULL,
  prefAge int(11) DEFAULT NULL,
  prefSex varchar(6) DEFAULT NULL,
  prefDistance double DEFAULT NULL,
  PRIMARY KEY (prefID),
  FOREIGN KEY (userID) REFERENCES `user`(userID)
);
