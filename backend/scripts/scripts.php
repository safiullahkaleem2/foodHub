<?php


function createTables($connection){
$createQuery = "BEGIN;
DROP TABLE IF EXISTS UserDetails CASCADE;

CREATE TABLE UserDetails (
     NumberOfFollowers INTEGER DEFAULT 0,
     NumberOfFollowing INTEGER DEFAULT 0,
     Age INTEGER NOT NULL,
     Username VARCHAR(30),
     Password VARCHAR(30),
     PRIMARY KEY (Username, Password)
  );
  
DROP TABLE IF EXISTS AppUser CASCADE;
CREATE TABLE AppUser (
    Username VARCHAR (30) NOT NULL UNIQUE,
    Password VARCHAR (30)  NOT NULL,
    UserID INTEGER,
    PRIMARY KEY (UserID),
    FOREIGN KEY (UserName, Password) REFERENCES UserDetails(UserName, Password)
ON DELETE CASCADE
 ON UPDATE CASCADE

);

DROP TABLE IF EXISTS HomeCookSkill CASCADE;


CREATE TABLE HomeCookSkill (
     NumberofFollowers INTEGER DEFAULT 0,
     HobbyistLevel VARCHAR(30) DEFAULT 'Amateur',
     PRIMARY KEY (NumberofFollowers)
 );
  
DROP TABLE IF EXISTS HomeCookDetails CASCADE;

CREATE TABLE HomeCookDetails (
    FavouriteCuisine VARCHAR (30),
    NumberofFollowers Integer DEFAULT 0,
   NumberofFollowing Integer DEFAULT 0,
    Age Integer  NOT NULL,
    Username VARCHAR (30),
    Password VARCHAR(30),
    PRIMARY KEY (Username, Password),
    FOREIGN KEY (NumberofFollowers) REFERENCES HomeCookSkill(NumberofFollowers)
ON DELETE CASCADE
);


DROP TABLE IF EXISTS HomeCook CASCADE;

CREATE TABLE HomeCook (
    UserID INTEGER,
    PRIMARY KEY (UserID),
    FOREIGN KEY (UserID) REFERENCES AppUser
	ON DELETE CASCADE
);

DROP TABLE IF EXISTS ProfessionalChefSkill CASCADE;

CREATE TABLE ProfessionalChefSkill (
   RestaurantAffiliation VARCHAR (30),
   RestaurantLocation VARCHAR (30), 
   Certification VARCHAR (30),
   PRIMARY KEY (RestaurantAffiliation, RestaurantLocation)
);



DROP TABLE IF EXISTS ProfessionalChefDetails CASCADE;

CREATE TABLE ProfessionalChefDetails (
    RestaurantAffiliation VARCHAR (30),
    RestaurantLocation VARCHAR (30),
    NumberofFollowers Integer DEFAULT 0,
    NumberofFollowing Integer DEFAULT 0,
    Age Integer  NOT NULL,
    Username VARCHAR (30),
    Password VARCHAR(30),
    PRIMARY KEY (Username, Password),
    FOREIGN KEY (RestaurantAffiliation, RestaurantLocation) REFERENCES ProfessionalChefSkill
    ON DELETE CASCADE
);

DROP TABLE IF EXISTS ProfessionalChef CASCADE;
CREATE TABLE ProfessionalChef (
    Username VARCHAR (30) NOT NULL UNIQUE,
    Password VARCHAR (30) NOT NULL,
    UserID INTEGER,
    PRIMARY KEY (UserID),
    FOREIGN KEY (UserID) REFERENCES AppUser
ON DELETE CASCADE,
    FOREIGN KEY (Password, UserName) REFERENCES ProfessionalChefDetails
    ON DELETE CASCADE
);

     DROP TABLE IF EXISTS Leaderboard CASCADE;
     CREATE TABLE Leaderboard (
        LeaderboardCategory VARCHAR (30) NOT NULL UNIQUE,
        Prize VARCHAR (30),
        PRIMARY KEY (LeaderboardCategory)
   );
   
   DROP TABLE IF EXISTS EventLocation CASCADE;
   CREATE TABLE EventLocation (
        Category VARCHAR (30),
        EntryFee INTEGER,
        Location VARCHAR (30) NOT NULL,
        PRIMARY KEY (Category, EntryFee)
   );
   
   DROP TABLE IF EXISTS EventDetails CASCADE;

   CREATE TABLE EventDetails (
        Category VARCHAR (30) NOT NULL,
        EntryFee INTEGER,
        EventID VARCHAR (30),
        Date VARCHAR (30),
        PRIMARY KEY (EventID),
        FOREIGN KEY (Category, EntryFee) REFERENCES EventLocation ON DELETE CASCADE
   );
   

   DROP TABLE IF EXISTS ReviewDetails CASCADE;


   CREATE TABLE ReviewDetails (
        TimePosted DATE,
        Comment VARCHAR (30),
        Rating INTEGER DEFAULT 0,
        PRIMARY KEY (TimePosted, Comment)
   );
   
   DROP TABLE IF EXISTS Review CASCADE;

   CREATE TABLE Review (
        TimePosted DATE NOT NULL,
        Comment VARCHAR (30),
        ReviewID INTEGER,
        PRIMARY KEY (ReviewID),
        FOREIGN KEY (TimePosted, Comment) REFERENCES ReviewDetails
       ON DELETE CASCADE
   );
   DROP TABLE IF EXISTS CookingEquipment CASCADE;
   
   CREATE TABLE CookingEquipment (
        Price INTEGER ,
        Category VARCHAR (30),
        Quality VARCHAR (30),
        Brand VARCHAR (20) NOT NULL,
        PRIMARY KEY (Price, Category, Quality)
   
   );
   

   DROP TABLE IF EXISTS CookingEquipmentName CASCADE;

   CREATE TABLE CookingEquipmentName (
     Name VARCHAR (30),
        Price INTEGER ,
        Category VARCHAR (30),
        Quality VARCHAR (30),
 
        PRIMARY KEY (Name,Price, Category, Quality),
        FOREIGN KEY (Price, Category, Quality) REFERENCES CookingEquipment
       ON DELETE CASCADE
   );
   
   
   DROP TABLE IF EXISTS RecipeDetails CASCADE;

   CREATE TABLE RecipeDetails (
        PublishDate DATE,
        Title VARCHAR (20),  
        Culture VARCHAR (20) NOT NULL, 
        Difficulty VARCHAR (20) NOT NULL, 
        Serving INTEGER,
        PRIMARY KEY (PublishDate, Title)
   );
   
   DROP TABLE IF EXISTS Recipe CASCADE;

   CREATE TABLE Recipe (
        RecipeID INTEGER ,
        PublishDate DATE NOT NULL,
        EstimatedTime INTEGER  NOT NULL,
        Title VARCHAR (20) NOT NULL,
        PRIMARY KEY (RecipeID),
       FOREIGN KEY (PublishDate, Title) REFERENCES RecipeDetails
       ON DELETE CASCADE
   );
   
   DROP TABLE IF EXISTS Video CASCADE;

   CREATE TABLE Video (
        Name VARCHAR (30), 
        UploadTime DATE,
        RecipeID INTEGER,
        Duration INTEGER NOT NULL,
        Views VARCHAR (30) DEFAULT 0,
        PRIMARY KEY (Name, UploadTime, RecipeID),
        FOREIGN KEY (RecipeID) REFERENCES Recipe
                  ON DELETE CASCADE
   );
   

   DROP TABLE IF EXISTS Ingredient CASCADE;

   CREATE TABLE Ingredient (
        Name VARCHAR (30),
        AllergenInfo VARCHAR (30) DEFAULT 'None',
        PRIMARY KEY (Name)
   );
   

   DROP TABLE IF EXISTS Follows CASCADE;
   
   CREATE TABLE Follows (
        UserID1 INTEGER, 
        UserID2 INTEGER,
        PRIMARY KEY (UserID1, UserID2),
        FOREIGN KEY (UserID1) REFERENCES AppUser
        ON DELETE CASCADE,
        FOREIGN KEY (UserID2) REFERENCES AppUser

        ON DELETE CASCADE
   );
   

   DROP TABLE IF EXISTS Participates;

   CREATE TABLE Participates (
        UserID INTEGER , 
        EventID  VARCHAR(30),
        PRIMARY KEY (Userid, EventID),
        FOREIGN KEY (Userid) REFERENCES Appuser
        ON DELETE CASCADE,
        FOREIGN KEY (EventID) REFERENCES EventDetails
        ON DELETE CASCADE
   );
   
   DROP TABLE IF EXISTS Ranking CASCADE;

   CREATE TABLE Ranking (
        Points INTEGER, 
        Position INTEGER,
        PRIMARY KEY (Points)
   );
   
   DROP TABLE IF EXISTS UserRanking;

   CREATE TABLE UserRanking (
        UserID INTEGER, 
        LeaderboardCategory VARCHAR (30), 
        Points INTEGER,
        PRIMARY KEY (UserID, LeaderboardCategory),
        FOREIGN KEY (UserID) REFERENCES Appuser
            ON DELETE CASCADE,
        FOREIGN KEY (LeaderboardCategory) REFERENCES Leaderboard
            ON DELETE CASCADE,
       FOREIGN KEY (Points) REFERENCES Ranking
            ON DELETE CASCADE
   );
   
   DROP TABLE IF EXISTS Utilizes;

   CREATE TABLE Utilizes (
     Name VARCHAR (30),
     Price INTEGER ,
     Category VARCHAR (30),
     Quality VARCHAR (30),
    
        RecipeID INTEGER, 
        PRIMARY KEY (RecipeID, Name,Price,Category,Quality),
        FOREIGN KEY (RecipeID) REFERENCES Recipe
            ON DELETE CASCADE,
        FOREIGN KEY (Name,Price,Category,Quality) REFERENCES CookingEquipmentName
            ON DELETE CASCADE ON UPDATE CASCADE

   );
   
   DROP TABLE IF EXISTS Posts;

   CREATE TABLE Posts (
        RecipeID INTEGER, 
        UserID INTEGER,
        PRIMARY KEY (RecipeID, UserID),
        FOREIGN KEY (RecipeID) REFERENCES Recipe
            ON DELETE CASCADE,
        FOREIGN KEY (UserID) REFERENCES Appuser
            ON DELETE CASCADE
   );

   INSERT INTO UserDetails (NumberOfFollowers, NumberOfFollowing, Age, Username, Password) VALUES (100, 50, 30, 'john_doe', 'password123');

   INSERT INTO AppUser (Username, Password, UserID) VALUES ('john_doe', 'password123', 1);

   

COMMIT;";

pg_query($connection, $createQuery);

}

?>