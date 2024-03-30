<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$intilizetables = 
    
    "CREATE TABLE IF NOT EXISTS UserDetails (
         NumberOfFollowers INTEGER DEFAULT 0,
         NumberOfFollowing INTEGER DEFAULT 0,
         Age INTEGER NOT NULL,
         Username VARCHAR(30),
         Password VARCHAR(30),
         PRIMARY KEY (Username, Password)
      );
      
      CREATE TABLE IF NOT EXISTS AppUser (
        Username VARCHAR (30) NOT NULL UNIQUE,
        Password VARCHAR (30)  NOT NULL,
        UserID INTEGER,
        PRIMARY KEY (UserID),
        FOREIGN KEY (UserName, Password) REFERENCES UserDetails(UserName, Password)
            ON DELETE CASCADE
            ON UPDATE CASCADE
    
    );
    
    CREATE TABLE IF NOT EXISTS HomeCookSkill (
         NumberofFollowers INTEGER DEFAULT 0,
         HobbyistLevel VARCHAR(30) DEFAULT 'Amateur',
         PRIMARY KEY (NumberofFollowers)
     );
      
     CREATE TABLE IF NOT EXISTS HomeCookDetails (
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
    
    
    CREATE TABLE IF NOT EXISTS HomeCook (
        UserID INTEGER,
        PRIMARY KEY (UserID),
        FOREIGN KEY (UserID) REFERENCES AppUser
        ON DELETE CASCADE
    );
    
    CREATE TABLE IF NOT EXISTS ProfessionalChefSkill (
       RestaurantAffiliation VARCHAR (30),
       RestaurantLocation VARCHAR (30), 
       Certification VARCHAR (30),
       PRIMARY KEY (RestaurantAffiliation, RestaurantLocation)
    );
    
    
    
    CREATE TABLE IF NOT EXISTS ProfessionalChefDetails (
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
    
    CREATE TABLE IF NOT EXISTS ProfessionalChef (
        Username VARCHAR (30) NOT NULL UNIQUE,
        Password VARCHAR (30) NOT NULL,
        UserID INTEGER,
        PRIMARY KEY (UserID),
        FOREIGN KEY (UserID) REFERENCES AppUser
        ON DELETE CASCADE,
        FOREIGN KEY (Password, UserName) REFERENCES ProfessionalChefDetails
        ON DELETE CASCADE
    );
    
    CREATE TABLE IF NOT EXISTS Leaderboard (
            LeaderboardCategory VARCHAR (30) NOT NULL UNIQUE,
            Prize VARCHAR (30),
            PRIMARY KEY (LeaderboardCategory)
       );
       
       CREATE TABLE IF NOT EXISTS EventLocation (
            Category VARCHAR (30),
            EntryFee INTEGER,
            Location VARCHAR (30) NOT NULL,
            PRIMARY KEY (Category, EntryFee)
       );
       
       CREATE TABLE IF NOT EXISTS EventDetails (
            Category VARCHAR (30) NOT NULL,
            EntryFee INTEGER,
            EventID VARCHAR (30),
            Date VARCHAR (30),
            PRIMARY KEY (EventID),
            FOREIGN KEY (Category, EntryFee) REFERENCES EventLocation ON DELETE CASCADE
       );
       
    
       CREATE TABLE IF NOT EXISTS ReviewDetails (
            TimePosted DATE,
            Comment VARCHAR (30),
            Rating INTEGER DEFAULT 0,
            PRIMARY KEY (TimePosted, Comment)
       );
       
       CREATE TABLE IF NOT EXISTS Review (
            TimePosted DATE NOT NULL,
            Comment VARCHAR (30),
            ReviewID INTEGER,
            PRIMARY KEY (ReviewID),
            FOREIGN KEY (TimePosted, Comment) REFERENCES ReviewDetails
            ON DELETE CASCADE
       );

       CREATE TABLE IF NOT EXISTS CookingEquipment (
            Price INTEGER ,
            Category VARCHAR (30),
            Quality VARCHAR (30),
            Brand VARCHAR (20) NOT NULL,
            PRIMARY KEY (Price, Category, Quality)
       
       );
       
    
       CREATE TABLE IF NOT EXISTS CookingEquipmentName (
         Name VARCHAR (30),
            Price INTEGER ,
            Category VARCHAR (30),
            Quality VARCHAR (30),
     
            PRIMARY KEY (Name,Price, Category, Quality),
            FOREIGN KEY (Price, Category, Quality) REFERENCES CookingEquipment
            ON DELETE CASCADE
       );
       
       
       CREATE TABLE IF NOT EXISTS RecipeDetails (
            PublishDate DATE,
            Title VARCHAR (20),  
            Culture VARCHAR (20) NOT NULL, 
            Difficulty VARCHAR (20) NOT NULL, 
            Serving INTEGER,
            PRIMARY KEY (PublishDate, Title)
       );
       
       CREATE TABLE IF NOT EXISTS Recipe (
            RecipeID INTEGER ,
            PublishDate DATE NOT NULL,
            EstimatedTime INTEGER  NOT NULL,
            Title VARCHAR (20) NOT NULL,
            PRIMARY KEY (RecipeID),
           FOREIGN KEY (PublishDate, Title) REFERENCES RecipeDetails
           ON DELETE CASCADE
       );
       
       CREATE TABLE IF NOT EXISTS Video (
            Name VARCHAR (30), 
            UploadTime DATE,
            RecipeID INTEGER,
            Duration INTEGER NOT NULL,
            Views VARCHAR (30) DEFAULT 0,
            PRIMARY KEY (Name, UploadTime, RecipeID),
            FOREIGN KEY (RecipeID) REFERENCES Recipe
            ON DELETE CASCADE
       );
       
    
       CREATE TABLE IF NOT EXISTS Ingredient (
            Name VARCHAR (30),
            AllergenInfo VARCHAR (30) DEFAULT 'None',
            PRIMARY KEY (Name)
       );
       
    
       CREATE TABLE IF NOT EXISTS Follows (
            UserID1 INTEGER, 
            UserID2 INTEGER,
            PRIMARY KEY (UserID1, UserID2),
            FOREIGN KEY (UserID1) REFERENCES AppUser
            ON DELETE CASCADE,
            FOREIGN KEY (UserID2) REFERENCES AppUser
            ON DELETE CASCADE
       );
       
    
       CREATE TABLE IF NOT EXISTS Participates (
            UserID INTEGER , 
            EventID  VARCHAR(30),
            PRIMARY KEY (Userid, EventID),
            FOREIGN KEY (Userid) REFERENCES Appuser
            ON DELETE CASCADE,
            FOREIGN KEY (EventID) REFERENCES EventDetails
            ON DELETE CASCADE
       );
       
       CREATE TABLE IF NOT EXISTS Ranking (
            Points INTEGER, 
            Position INTEGER,
            PRIMARY KEY (Points)
       );
       
       CREATE TABLE IF NOT EXISTS UserRanking (
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
       
       CREATE TABLE IF NOT EXISTS Utilizes (
         Name VARCHAR (30),
         Price INTEGER ,
         Category VARCHAR (30),
         Quality VARCHAR (30),
        
            RecipeID INTEGER, 
            PRIMARY KEY (RecipeID, Name,Price,Category,Quality),
            FOREIGN KEY (RecipeID) REFERENCES Recipe
                ON DELETE CASCADE,
            FOREIGN KEY (Name,Price,Category,Quality) REFERENCES CookingEquipmentName
                ON DELETE CASCADE 
                ON UPDATE CASCADE
    
       );
       
       CREATE TABLE IF NOT EXISTS Posts (
            RecipeID INTEGER, 
            UserID INTEGER,
            PRIMARY KEY (RecipeID, UserID),
            FOREIGN KEY (RecipeID) REFERENCES Recipe
                ON DELETE CASCADE,
            FOREIGN KEY (UserID) REFERENCES Appuser
                ON DELETE CASCADE
       );
       ";

$db = new PDO('pgsql:host=localhost');

// Intilize tables
$db->beginTransaction();

$db->exec($intilizetables);

$db->commit();


