
CREATE TABLE users 
(
	id integer PRIMARY KEY,
	username text NOT NULL,
	password text NOT NULL,
	UNIQUE (username)
);

CREATE TABLE user_detailed
(
	userid integer PRIMARY KEY,
	name text not null,
	location text not null,
	birthdate integer not null,
	information text not null,
	pictureid integer not null,
	FOREIGN KEY (userid) REFERENCES USERS (id),
	FOREIGN KEY (pictureid) REFERENCES USERS (id)
);

CREATE TABLE messages 
(
	id integer PRIMARY KEY, 
	userid integer NOT NULL, 
	datetime integer NOT NULL, 
	message text NOT NULL, 
	FOREIGN KEY (userid) REFERENCES USERS (id)
);

CREATE TABLE follows
(
	userid integer NOT NULL, 
	following integer NOT NULL, 
	PRIMARY KEY (userid,following), 
	FOREIGN KEY (userid) REFERENCES USERS (id), 
	FOREIGN KEY (following) REFERENCES USERS (id)
);