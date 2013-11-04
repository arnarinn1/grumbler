
CREATE TABLE users 
(
	id int PRIMARY KEY,
	username text NOT NULL,
	password text NOT NULL,
	UNIQUE (username)
);

CREATE TABLE user_detailed
(
	userid int NOT NULL,
	first_name text,
	sec_name text,
	birthdate int not null,
	profile_picture blob not null,
	FOREIGN KEY (userid) REFERENCES USERS (id)
)

CREATE TABLE messages 
(
	id int PRIMARY KEY, 
	userid int NOT NULL, 
	timestamp int NOT NULL, 
	message text NOT NULL, 
	FOREIGN KEY (userid) REFERENCES USERS (id)
);

CREATE TABLE follows
(
	userid int NOT NULL, 
	following int NOT NULL, 
	PRIMARY KEY (userid,following), 
	FOREIGN KEY (userid) REFERENCES USERS (id), 
	FOREIGN KEY (following) REFERENCES USERS (id)
);