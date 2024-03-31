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
        ProfilePicURL VARCHAR (100),
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
        Age Integer NOT NULL,
        Username VARCHAR (30),
        Password VARCHAR(30),
        PRIMARY KEY (Username, Password)
     --    FOREIGN KEY (NumberofFollowers) REFERENCES HomeCookSkill(NumberofFollowers)
     --    ON DELETE CASCADE
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
        NumberofFollowers INTEGER DEFAULT 0,
        NumberofFollowing INTEGER DEFAULT 0,
        Age INTEGER NOT NULL,
        Username VARCHAR (30),
        Password VARCHAR(30),
        PRIMARY KEY (Username, Password)
     --    FOREIGN KEY (RestaurantAffiliation, RestaurantLocation) REFERENCES ProfessionalChefSkill
     --    ON DELETE CASCADE
    );
    
    CREATE TABLE IF NOT EXISTS ProfessionalChef (
        Username VARCHAR (30) NOT NULL UNIQUE,
        Password VARCHAR (30) NOT NULL,
        UserID INTEGER,
        PRIMARY KEY (UserID),
        FOREIGN KEY (UserID) REFERENCES AppUser
        ON DELETE CASCADE
     --    FOREIGN KEY (Password, UserName) REFERENCES ProfessionalChefDetails
     --    ON DELETE CASCADE
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
            Description VARCHAR (200),
            VideoURL VARCHAR (100),
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

$insertQuery = "INSERT INTO UserDetails (NumberOfFollowers, NumberOfFollowing, Age, Username, Password)
VALUES 
(100, 50, 25, 'user1', 'password1'),
(200, 75, 30, 'user2', 'password2'),
(150, 60, 28, 'user3', 'password3'),
(120, 45, 22, 'user4', 'password4'),
(80, 35, 27, 'user5', 'password5')";

$insertQuery2 = "INSERT INTO AppUser (Username, Password, ProfilePicURL, UserID)
VALUES
('user1', 'password1', 'https://randomuser.me/api/portraits/men/70.jpg', 1),
('user2', 'password2', 'https://randomuser.me/api/portraits/women/43.jpg', 2),
('user3', 'password3', 'https://randomuser.me/api/portraits/women/31.jpg', 3),
('user4', 'password4', 'https://randomuser.me/api/portraits/men/35.jpg', 4),
('user5', 'password5', 'https://randomuser.me/api/portraits/men/51.jpg', 5)";

$insertQuery3 = "INSERT INTO HomeCook (UserID)
VALUES
(1),
(2),
(3)";

$insertQuery4 = "INSERT INTO HomeCookSkill (NumberofFollowers, HobbyistLevel)
VALUES 
(0, 'Amateur'),
(200, 'Intermediate'),
(500, 'Advanced')";

$insertQuery5 = "INSERT INTO HomeCookDetails (FavouriteCuisine, NumberofFollowers, NumberofFollowing, Age, Username, Password)
VALUES
('Italian', 100, 50, 25, 'user1', 'password1'),
('Mexican', 200, 75, 30, 'user2', 'password2'),
('Japanese', 150, 60, 28, 'user3', 'password3')";

$insertQuery6 = "INSERT INTO ProfessionalChef (Username, Password, UserID)
VALUES
('user4', 'password4', 4),
('user5', 'password5', 5)";

$insertQuery7 = "INSERT INTO ProfessionalChefSkill (RestaurantAffiliation, RestaurantLocation, Certification)
VALUES 
('Restaurant1', 'Location1', 'Chef Certification 1'),
('Restaurant2', 'Location2', 'Chef Certification 2')";

$insertQuery8 = "INSERT INTO ProfessionalChefDetails (RestaurantAffiliation, RestaurantLocation, NumberofFollowers, NumberofFollowing, Age, Username, Password)
VALUES 
('Restaurant1', 'Location1', 120, 45, 22, 'user4', 'password4'),
('Restaurant2', 'Location2', 80, 35, 27, 'user5', 'password5')";

$insertQuery9 = "INSERT INTO Leaderboard (LeaderboardCategory, Prize)
VALUES 
('Monthly Top Chef', 'Exclusive Cooking Set'),
('Weekly Recipe Contest', 'Cookbook Collection'),
('Best Home Cook', 'Kitchen Appliance Bundle'),
('Culinary Innovator', 'Gourmet Dining Experience'),
('Master Chef', 'Cooking Masterclass Pass')";


$insertQuery10 = "INSERT INTO EventLocation (Category, EntryFee, Location)
VALUES 
('Cooking Competition', 50, 'City A'),
('Baking Workshop', 30, 'City B'),
('Food Festival', 20, 'City C'),
('Culinary Tour', 40, 'City D'),
('Wine Tasting', 60, 'City E')";

$insertQuery11 = "INSERT INTO EventDetails (Category, EntryFee, EventID, Date)
VALUES 
('Cooking Competition', 50, 'event1', '2024-04-15'),
('Baking Workshop', 30, 'event2', '2024-05-10'),
('Food Festival', 20, 'event3', '2024-06-20'),
('Culinary Tour', 40, 'event4', '2024-07-05'),
('Wine Tasting', 60, 'event5', '2024-08-12')";

$insertQuery12 = "INSERT INTO ReviewDetails (TimePosted, Comment, Rating)
VALUES 
('2023-01-01', 'Bad food!', 1),
('2023-02-15', 'Ok service!', 2),
('2023-03-20', 'Delicious dishes.', 3),
('2023-04-10', 'Nice ambiance.', 4),
('2023-05-05', 'Friendly staff.', 5)";

$insertQuery13 = "INSERT INTO Review (TimePosted, Comment, ReviewID)
VALUES 
('2023-01-01', 'Bad food!', 1),
('2023-02-15', 'Ok service!', 2),
('2023-03-20', 'Delicious dishes.', 3),
('2023-04-10', 'Nice ambiance.', 4),
('2023-05-05', 'Friendly staff.', 5)";

$insertQuery14 = "INSERT INTO CookingEquipment (Price, Category, Quality, Brand)
VALUES 
(50, 'Knives', 'High', 'Brand1'),
(100, 'Pots', 'Medium', 'Brand2'),
(80, 'Blenders', 'High', 'Brand3'),
(120, 'Ovens', 'High', 'Brand4'),
(60, 'Mixers', 'Medium', 'Brand5')";

$insertQuery15 = "INSERT INTO CookingEquipmentName (Name, Price, Category, Quality)
VALUES 
('Knife Set', 50, 'Knives', 'High'),
('Cookware Set', 100, 'Pots', 'Medium'),
('Blender', 80, 'Blenders', 'High'),
('Oven', 120, 'Ovens', 'High'),
('Mixer', 60, 'Mixers', 'Medium')";

$insertQuery16 = "INSERT INTO RecipeDetails (PublishDate, Title, Description, VideoURL, Culture, Difficulty, Serving)
VALUES 
('2024-01-01', 'Recipe1', 'Delicious dish with various ingredients.', 'https://example.com/video1', 'Italian', 'Intermediate', 4),
('2024-02-15', 'Recipe2', 'Simple and quick recipe for busy days.', 'https://example.com/video2', 'Mexican', 'Beginner', 2),
('2024-03-20', 'Recipe3', 'Healthy and flavorful meal with fresh ingredients.', 'https://example.com/video3', 'Japanese', 'Advanced', 6),
('2024-04-10', 'Recipe4', 'Classic recipe loved by all.', 'https://example.com/video4', 'French', 'Intermediate', 4),
('2024-05-05', 'Recipe5', 'Perfect dessert for any occasion.', 'https://example.com/video5', 'Indian', 'Expert', 8)";

$insertQuery17 = "INSERT INTO Recipe (RecipeID, PublishDate, EstimatedTime, Title)
VALUES 
(1, '2024-01-01', 60, 'Recipe1'),
(2, '2024-02-15', 30, 'Recipe2'),
(3, '2024-03-20', 90, 'Recipe3'),
(4, '2024-04-10', 45, 'Recipe4'),
(5, '2024-05-05', 120, 'Recipe5')";

$insertQuery18 = "INSERT INTO Video (Name, UploadTime, RecipeID, Duration, Views)
VALUES 
('Video1', '2024-01-01', 1, 120, '1000'),
('Video2', '2024-02-15', 2, 90, '800'),
('Video3', '2024-03-20', 3, 150, '1200'),
('Video4', '2024-04-10', 4, 60, '500'),
('Video5', '2024-05-05', 5, 180, '1500')";

$insertQuery19 = "INSERT INTO Ingredient (Name, AllergenInfo)
VALUES 
('Flour', 'Gluten'),
('Sugar', 'None'),
('Eggs', 'None'),
('Butter', 'Dairy'),
('Salt', 'None')";

$insertQuery20 = "INSERT INTO Follows (UserID1, UserID2)
VALUES 
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 1)";

$insertQuery21 = "INSERT INTO Participates (UserID, EventID)
VALUES 
(1, 'event1'),
(2, 'event2'),
(3, 'event3'),
(4, 'event4'),
(5, 'event5')";

$insertQuery22 = "INSERT INTO Ranking (Points, Position)
VALUES 
(100, 1),
(90, 2),
(80, 3),
(70, 4),
(60, 5)";

$insertQuery23 = "INSERT INTO UserRanking (UserID, LeaderboardCategory, Points)
VALUES 
(1, 'Monthly Top Chef', 100),
(2, 'Monthly Top Chef', 90),
(3, 'Monthly Top Chef', 80),
(4, 'Monthly Top Chef', 70),
(5, 'Monthly Top Chef', 60)";

$insertQuery24 = "INSERT INTO Utilizes (Name, Price, Category, Quality, RecipeID)
VALUES 
('Knife Set', 50, 'Knives', 'High', 1),
('Cookware Set', 100, 'Pots', 'Medium', 2),
('Blender', 80, 'Blenders', 'High', 3),
('Oven', 120, 'Ovens', 'High', 4),
('Mixer', 60, 'Mixers', 'Medium', 5)";

$insertQuery25 = "INSERT INTO Posts (RecipeID, UserID)
VALUES 
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5)";

$db->beginTransaction();

$db->exec($insertQuery);
echo "<p>Inserted into UserDetails table.</p>\n";

$db->exec($insertQuery2);
echo "<p>Inserted into AppUser table.</p>\n";

$db->exec($insertQuery3);
echo "<p>Inserted into HomeCook table.</p>\n";

$db->exec($insertQuery4);
echo "<p>Inserted into HomeCookSkill table.</p>\n";

$db->exec($insertQuery5);
echo "<p>Inserted into HomeCookDetails table.</p>\n";

$db->exec($insertQuery6);
echo "<p>Inserted into ProfessionalChef table.</p>\n";

$db->exec($insertQuery7);
echo "<p>Inserted into ProfessionalChefSkill table.</p>\n";

$db->exec($insertQuery8);
echo "<p>Inserted into ProfessionalChefDetails table.</p>\n";

$db->exec($insertQuery9);
echo "<p>Inserted into Leaderboard table.</p>\n";

$db->exec($insertQuery10);
echo "<p>Inserted into EventLocation table.</p>\n";

$db->exec($insertQuery11);
echo "<p>Inserted into EventDetails table.</p>\n";

$db->exec($insertQuery12);
echo "<p>Inserted into ReviewDetails table.</p>\n";

$db->exec($insertQuery13);
echo "<p>Inserted into Review table.</p>\n";

$db->exec($insertQuery14);
echo "<p>Inserted into CookingEquipment table.</p>\n";

$db->exec($insertQuery15);
echo "<p>Inserted into CookingEquipmentName table.</p>\n";

$db->exec($insertQuery16);
echo "<p>Inserted into RecipeDetails table.</p>\n";

$db->exec($insertQuery17);
echo "<p>Inserted into Recipe table.</p>\n";

$db->exec($insertQuery18);
echo "<p>Inserted into Video table.</p>\n";

$db->exec($insertQuery19);
echo "<p>Inserted into Ingredient table.</p>\n";

$db->exec($insertQuery20);
echo "<p>Inserted into Follows table.</p>\n";

$db->exec($insertQuery21);
echo "<p>Inserted into Participates table.</p>\n";

$db->exec($insertQuery22);
echo "<p>Inserted into Ranking table.</p>\n";

$db->exec($insertQuery23);
echo "<p>Inserted into UserRanking table.</p>\n";

$db->exec($insertQuery24);
echo "<p>Inserted into Utilizes table.</p>\n";

$db->exec($insertQuery25);
echo "<p>Inserted into Posts table.</p>\n";

$db->commit();
echo "<p>All data inserted successfully.</p>\n";


$db->commit();