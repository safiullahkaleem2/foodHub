<?php


function createTables($connection){
$createQuery = "BEGIN;
DROP TABLE IF EXISTS UserDetails;

CREATE TABLE UserDetails (
   Number of Followers Integer  DEFAULT 0,
   Number of Following Integer  DEFAULT 0,
    Age Integer  NOT NULL,
    Username VARCHAR (30),
    Password BINARY (64),
    PRIMARY KEY (Username, Password)
);

DROP TABLE IF EXISTS User;
CREATE TABLE User (
    Username VARCHAR (30) NOT NULL UNIQUE,
    Password VARCHAR (30)  NOT NULL,
    UserID INTEGER,
    PRIMARY KEY (UserID),
    FOREIGN KEY (UserName, Password) REFERENCES UserDetails
ON DELETE CASCASE
);
 
DROP TABLE IF EXISTS HomeCookDetails;

CREATE TABLE HomeCookDetails (
    FavouriteCuisine VARCHAR (30),
    Number of Followers Integer DEFAULT 0,
   Number of Following Integer DEFAULT 0,
    Age Integer (3) NOT NULL
    Username VARCHAR (30),
    Password BINARY (64),
    PRIMARY KEY (Username, Password),
    FOREIGN KEY (Number of Followers) REFERENCES HomeCookSkill
ON DELETE CASCASE
);


DROP TABLE IF EXISTS HomeCook;

CREATE TABLE HomeCook (
    Username VARCHAR (30) NOT NULL UNIQUE,
    Password VARCHAR (30) NOT NULL,
    UserID INTEGER,
    PRIMARY KEY (UserID),
    FOREIGN KEY (UserID, Password, Username) REFERENCES User
	ON DELETE CASCASE
);

DROP TABLE IF EXISTS HomeCookSkill;


CREATE TABLE HomeCookHomeCookSkill (
    Number of Followers Integer DEFAULT 0,
    HobbyistLevel VARCHAR (30) DEFAULT “Amateur”
    PRIMARY KEY (Number of Followers)
);


DROP TABLE IF EXISTS ProfessionalChefDetails;

CREATE TABLE ProfessionalChefDetails (
    Restaurant Affiliation VARCHAR (30),
    Restaurant Location VARCHAR (30)),
    Number of Followers Integer DEFAULT 0,
    Number of Following Integer DEFAULT 0,
    Age Integer  NOT NULL,
    Username VARCHAR (30),
    Password BYTEA,
    PRIMARY KEY (Username, Password),
    FOREIGN KEY (Restaurant Affiliation, Restaurant Location) REFERENCES ProfessionalChefSkill
);

DROP TABLE IF EXISTS ProfessionalChef;
CREATE TABLE ProfessionalChef (
    Username VARCHAR (30) NOT NULL UNIQUE,
    Password BYTEA NOT NULL,
    UserID INTEGER,
    PRIMARY KEY (UserID),
    FOREIGN KEY (UserID) REFERENCES User
ON DELETE CASCASE,
    FOREIGN KEY (Password, UserName) REFERENCES ProfessionalChefDetails
);

DROP TABLE IF EXISTS ProfessionalChefSkill;

CREATE TABLE ProfessionalChefSkill (
   Restaurant Affiliation VARCHAR (30),
   Restaurant Location VARCHAR (30), 
   Certification VARCHAR (30),
   PRIMARY KEY (Restaurant Affiliation, Restaurant Location)
);

     DROP TABLE IF EXISTS Leaderboard;
     CREATE TABLE Leaderboard (
        Leaderboard Category VARCHAR (30) NOT NULL UNIQUE,
        Prize VARCHAR (30),
        PRIMARY KEY (Leaderboard Category)
   );
   
   DROP TABLE IF EXISTS EventLocation;
   CREATE TABLE EventLocation (
        Category VARCHAR (30),
        Entry Fee INTEGER (5),
        Location VARCHAR (30) NOT NULL,
        PRIMARY KEY (Category, Entry Fee)
   );
   
   DROP TABLE IF EXISTS EventDetails;

   CREATE TABLE EventDetails (
        Category VARCHAR (30) NOT NULL,
        EntryFee INTEGER,
        EventID VARCHAR (30),
        Date VARCHAR (30),
        PRIMARY KEY (EventID),
        FOREIGN KEY (Category, Entry Fee) REFERENCES EventLocation
   );
   

   DROP TABLE IF EXISTS ReviewDetails;


   CREATE TABLE ReviewDetails (
        TimePosted DATE,
        Comment VARCHAR (30),
        Rating INTEGER DEFAULT 0,
        PRIMARY KEY (Time Posted, Comment)
   );
   
   DROP TABLE IF EXISTS Review;

   CREATE TABLE Review (
        TimePosted DATE NOT NULL,
        Comment VARCHAR (30),
        ReviewID INTEGER,
        PRIMARY KEY (ReviewID),
        FOREIGN KEY (Time Posted, Comment) REFERENCES ReviewDetails
       ON DELETE CASCASE
   );
   DROP TABLE IF EXISTS CookingEquipment;
   
   CREATE TABLE CookingEquipment (
        Price INTEGER ,
        Category VARCHAR (20),
        Quality VARCHAR (30),
        Brand VAR CHAR (20) NOT NULL,
        PRIMARY KEY (Price, Category, Quality)
   
   );
   

   DROP TABLE IF EXISTS CookingEquipmentName;

   CREATE TABLE CookingEquipmentName (
        Price INTEGER ,
        Category VARCHAR (30),
        Quality VARCHAR (30),
        Name VARCHAR (30),
        PRIMARY KEY (Price, Category, Quality, Name),
        FOREIGN KEY (Price, Category, Quality) REFERENCES CookingEquipment
       ON DELETE CASCASE
   );
   
   
   DROP TABLE IF EXISTS RecipeDetails;

   CREATE TABLE RecipeDetails (
        Publish Date DATE,
        Title VARCHAR (20),  
        Culture VARCHAR (20) NOT NULL, 
        Difficulty VARCHAR (20) NOT NULL, 
        Serving: INTEGER,
        PRIMARY KEY (Publish Date, Title)
   );
   
   DROP TABLE IF EXISTS Recipe;

   CREATE TABLE Recipe (
        RecipeID INTEGER ,
        Publish Date DATE (20) NOT NULL,
        Estimated Time INTEGER  NOT NULL,
        Title VARCHAR (20) NOT NULL
        PRIMARY KEY (RecipeID),
       FOREIGN KEY (Publish Date, Title) REFERENCES RecipeDetails
       ON DELETE CASCASE
   );
   
   DROP TABLE IF EXISTS Video;

   CREATE TABLE Video (
        Name VARCHAR (30), 
        Upload Time DATE (20),
        RecipeID INTEGER,
        Duration INTEGER NOT NULL,
        Views VARCHAR (30) DEFAULT 0,
        PRIMARY KEY (Name, UploadTime, RecipeID),
        FOREIGN KEY (RecipeID) REFERENCES Recipe
                  ON DELETE CASCASE
   );
   

   DROP TABLE IF EXISTS Ingredient;

   CREATE TABLE Ingredient (
        Name VARCHAR (30),
        Allergen Info VARCHAR (30) DEFAULT “None”,
        PRIMARY KEY (Name)
   );
   

   
   CREATE TABLE Follows (
        UserID1 INTEGER (10), 
        UserID2 INTEGER (10),
        PRIMARY KEY (UserID1, UserID2),
        FOREIGN KEY (UserID1) REFERENCES User1
        ON DELETE CASCADE,
        FOREIGN KEY (UserID2) REFERENCES User2
        ON DELETE CASCADE
   );
   

   DROP TABLE IF EXISTS Partcipates;

   CREATE TABLE Participates (
        UserID INTEGER , 
        EventID  INTEGER,
        PRIMARY KEY (Userid, EventID),
        FOREIGN KEY (Userid) REFERENCES User
        ON DELETE CASCADE,
        FOREIGN KEY (EventID) REFERENCES Event
        ON DELETE CASCADE
   );
   
   DROP TABLE IF EXISTS Ranking;

   CREATE TABLE Ranking (
        Points: INTEGER , 
        Position: INTEGER,
        PRIMARY KEY (Points)
   );
   
   DROP TABLE IF EXISTS UserRanking;

   CREATE TABLE UserRanking (
        UserID INTEGER, 
        Leaderboard Category VARCHAR (30), 
        Points INTEGER,
        PRIMARY KEY (UserID, Leaderboard Category),
        FOREIGN KEY (UserID) REFERENCES User
            ON DELETE CASCADE,
        FOREIGN KEY (Leaderboard Category) REFERENCES Leaderboard
            ON DELETE CASCADE,
       FOREIGN KEY (Points) REFERENCES Ranking
            ON DELETE CASCASE
   );
   
   DROP TABLE IF EXISTS Utilizes;

   CREATE TABLE Utilizes (
        RecipeID INTEGER, 
        Name VARCHAR (10),
        Brand VARCHAR (10),
        PRIMARY KEY (RecipeID, Brand, Name),
        FOREIGN KEY (RecipeID) REFERENCES Recipe
            ON DELETE CASCADE,
        FOREIGN KEY (Brand, Name) REFERENCES CookingEquipmentName
            ON DELETE CASCADE
   );
   
   DROP TABLE IF EXISTS Posts;

   CREATE TABLE Posts (
        RecipeID INTEGER, 
        UserID INTEGER,
        PRIMARY KEY (RecipeID, UserID),
        FOREIGN KEY (RecipeID) REFERENCES Recipe
            ON DELETE CASCADE
        FOREIGN KEY (UserID) REFERENCES User
            ON DELETE CASCADE
   );
   

COMMIT;";

pg_query($connection, $createQuery);

}

?>