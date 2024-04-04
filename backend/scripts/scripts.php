<?php


function createTables($connection){
     $intilizetables = 
    
     "CREATE TABLE IF NOT EXISTS UserDetails (
          NumberOfFollowers INTEGER DEFAULT 0,
          NumberOfFollowing INTEGER DEFAULT 0,
          Age INTEGER NOT NULL,
          Username VARCHAR(30),
          Password VARCHAR(255),
          PRIMARY KEY (Username, Password)
       );
       
       CREATE TABLE IF NOT EXISTS AppUser (
         Username VARCHAR (30) NOT NULL UNIQUE,
         Password VARCHAR (255)  NOT NULL,
         UserID INTEGER,
         PRIMARY KEY (UserID),
         FOREIGN KEY (UserName, Password) REFERENCES UserDetails(UserName, Password)
             ON DELETE CASCADE
             ON UPDATE CASCADE
     
     );
     
      CREATE TABLE IF NOT EXISTS HomeCook (
         FavouriteCuisine VARCHAR (30),
         HobbyistLevel VARCHAR(30) DEFAULT 'Amateur',
         UserID INTEGER,
         PRIMARY KEY (UserID),
         FOREIGN KEY (UserID) REFERENCES AppUser
         ON DELETE CASCADE ON UPDATE CASCADE
     );
     
        
     CREATE TABLE IF NOT EXISTS ProfessionalChefSkill (
        RestaurantAffiliation VARCHAR (30),
        RestaurantLocation VARCHAR (30), 
        Certification VARCHAR (30),
        PRIMARY KEY (RestaurantAffiliation, RestaurantLocation)
     );
     
     
     
     CREATE TABLE IF NOT EXISTS ProfessionalChef (
         RestaurantAffiliation VARCHAR (30),
         RestaurantLocation VARCHAR (30),
         UserID INTEGER,
         PRIMARY KEY (UserID),
         FOREIGN KEY (UserID) REFERENCES AppUser
         ON DELETE CASCADE ON UPDATE CASCADE,
         FOREIGN KEY (RestaurantAffiliation, RestaurantLocation) REFERENCES ProfessionalChefSkill
         ON DELETE CASCADE ON UPDATE CASCADE
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
             FOREIGN KEY (Category, EntryFee) REFERENCES EventLocation ON DELETE CASCADE ON UPDATE CASCADE
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
             ON UPDATE CASCADE
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
             ON UPDATE CASCADE
        );
        
        
        CREATE TABLE IF NOT EXISTS RecipeDetails (
             PublishDate DATE,
             Title VARCHAR (20),  
             Description VARCHAR (200),
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
            ON UPDATE CASCADE
        );

        CREATE TABLE IF NOT EXISTS Video (
             Name VARCHAR (30), 
             UploadTime DATE,
             RecipeID INTEGER,
             VideoURL VARCHAR (100),
             Duration INTEGER NOT NULL,
             Views VARCHAR (30) DEFAULT 0,
             PRIMARY KEY (Name, UploadTime, RecipeID),
             FOREIGN KEY (RecipeID) REFERENCES Recipe
             ON DELETE CASCADE
             ON UPDATE CASCADE
        );
        
     
        CREATE TABLE IF NOT EXISTS Ingredient (
             Name VARCHAR (30),
             AllergenInfo VARCHAR (30) DEFAULT 'None',
             PRIMARY KEY (Name)
        );
        
        CREATE TABLE IF NOT EXISTS Contains (
             RecipeID INTEGER, 
             Name VARCHAR (30),
             PRIMARY KEY (RecipeID, Name),
             FOREIGN KEY (RecipeID) REFERENCES Recipe
                 ON DELETE CASCADE ON UPDATE CASCADE,
             FOREIGN KEY (Name) REFERENCES Ingredient
                 ON DELETE CASCADE ON UPDATE CASCADE
        );
     
        CREATE TABLE IF NOT EXISTS Follows (
             UserID1 INTEGER, 
             UserID2 INTEGER,
             PRIMARY KEY (UserID1, UserID2),
             FOREIGN KEY (UserID1) REFERENCES AppUser
             ON DELETE CASCADE ON UPDATE CASCADE,
             FOREIGN KEY (UserID2) REFERENCES AppUser
             ON DELETE CASCADE ON UPDATE CASCADE
        );
        

        CREATE TABLE IF NOT EXISTS Participates (
             UserID INTEGER , 
             EventID  VARCHAR(30),
             PRIMARY KEY (UserID, EventID),
             FOREIGN KEY (UserID) REFERENCES AppUser
             ON DELETE CASCADE ON UPDATE CASCADE,
             FOREIGN KEY (EventID) REFERENCES EventDetails
             ON DELETE CASCADE ON UPDATE CASCADE 
        );


        CREATE TABLE IF NOT EXISTS UserRanking (
             UserID INTEGER, 
             LeaderboardCategory VARCHAR (30), 
             Points INTEGER,
             Position INTEGER,
             PRIMARY KEY (UserID, LeaderboardCategory),
             FOREIGN KEY (UserID) REFERENCES AppUser
                 ON DELETE CASCADE ON UPDATE CASCADE,
             FOREIGN KEY (LeaderboardCategory) REFERENCES Leaderboard
                 ON DELETE CASCADE ON UPDATE CASCADE

        );

        CREATE TABLE IF NOT EXISTS Utilizes (
          Name VARCHAR (30),
          Price INTEGER ,
          Category VARCHAR (30),
          Quality VARCHAR (30),
         
             RecipeID INTEGER, 
             PRIMARY KEY (RecipeID, Name,Price,Category,Quality),
             FOREIGN KEY (RecipeID) REFERENCES Recipe
                 ON DELETE CASCADE ON UPDATE CASCADE,
             FOREIGN KEY (Name,Price,Category,Quality) REFERENCES CookingEquipmentName
                 ON DELETE CASCADE 
                 ON UPDATE CASCADE
     
        );
        
        CREATE TABLE IF NOT EXISTS Posts (
             RecipeID INTEGER, 
             UserID INTEGER,
             PRIMARY KEY (RecipeID, UserID),
             FOREIGN KEY (RecipeID) REFERENCES Recipe
                 ON DELETE CASCADE ON UPDATE CASCADE,
             FOREIGN KEY (UserID) REFERENCES AppUser
                 ON DELETE CASCADE ON UPDATE CASCADE
        );

        CREATE TABLE IF NOT EXISTS Reviews (
          RecipeID INTEGER,
          ReviewID INTEGER,
          UserID INTEGER,
     PRIMARY KEY (ReviewID, UserID, RecipeID),
     FOREIGN KEY (ReviewID) REFERENCES Review
    ON DELETE CASCADE ON UPDATE CASCADE,
     FOREIGN KEY (UserID) REFERENCES AppUser
    ON DELETE CASCADE ON UPDATE CASCADE,
     FOREIGN KEY (RecipeID) REFERENCES Recipe
    ON DELETE CASCADE ON UPDATE CASCADE
          ); 


        ";

$connection->beginTransaction();
$connection->exec($intilizetables);

$connection->commit();


}

function sampleData($connection){
$insertQuery = "INSERT INTO UserDetails (NumberOfFollowers, NumberOfFollowing, Age, Username, Password)
VALUES 
(100, 50, 25, 'jacky', '110'),
(200, 75, 30, 'safiullah', '320'),
(150, 60, 28, 'mohammad', '310'),
(120, 45, 22, 'seva', '221'),
(80, 35, 27, 'raymond', '304'),
(145,90, 89,'nafis', '304'),
(89,453, 43,'gregor', '110'),
(57,329, 71,'clune', '340'),
(67,78, 56,'feeley', '213'),
(98,46, 32,'holmes', '310'),
(87,20, 102,'pottinger', '304'),
(68,198, 125,'wolfman', '313'),
(56,980, 98,'jordon', '213'),
(110,589, 75,'geoffrey', '121'),
(120,437, 32,'bradley', '320'),
(89,84938, 43,'cinda', '221'),
(96,473827483, 87,'carter', '210'),
(48,2490, 12,'patrice', '313'),
(82,437843, 35,'ratna', '295'),
(102,3848, 23,'anton', '999')";

$insertQuery2 = "INSERT INTO AppUser (Username, Password, UserID)
VALUES
('jacky', '110', 1),
('safiullah', '320', 2),
('mohammad', '310', 3),
('seva', '221', 4),
('raymond', '304', 5),
('nafis', '304', 6),
('gregor', '110', 7),
('clune', '340', 8),
('feeley', '213', 9),
('holmes', '310', 10),
('pottinger', '304', 11),
('wolfman', '313', 12),
('jordon', '213', 13),
('geoffrey', '121', 14),
('bradley', '320', 15),
('cinda', '221', 16),
('carter', '210', 17),
('patrice', '313', 18),
('ratna', '295', 19),
('anton', '999', 20)";

$insertQuery5 = "INSERT INTO HomeCook (FavouriteCuisine, HobbyistLevel, UserID)
VALUES
('Italian', 'Amateur', 1),
('Mexican', 'Intermediate',2),
('Japanese', 'Advanced', 3),
('Italian', 'Amateur', 4),
('British', 'Advanced', 5)";

$insertQuery7 = "INSERT INTO ProfessionalChefSkill (RestaurantAffiliation, RestaurantLocation, Certification)
VALUES 
('Restaurant1', 'Location1', 'Chef Certification 1'),
('Restaurant2', 'Location2', 'Chef Certification 2'),
('Restaurant3', 'Location3', 'Chef Certification 3'),
('Restaurant4', 'Location4', 'Chef Certification 4'),
('Restaurant5', 'Location5', 'Chef Certification 5')";


$insertQuery6 = "INSERT INTO ProfessionalChef (RestaurantAffiliation, RestaurantLocation, UserID)
VALUES
('Restaurant1', 'Location1', 6),
('Restaurant2', 'Location2', 7),
('Restaurant3', 'Location3', 8),
('Restaurant4', 'Location4', 9),
('Restaurant5', 'Location5', 10),
('Restaurant1', 'Location1', 11),
('Restaurant2', 'Location2', 12),
('Restaurant3', 'Location3', 13),
('Restaurant4', 'Location4', 14),
('Restaurant5', 'Location5', 15),
('Restaurant1', 'Location1', 16),
('Restaurant2', 'Location2', 17),
('Restaurant3', 'Location3', 18),
('Restaurant4', 'Location4', 19),
('Restaurant5', 'Location5', 20)";

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

$insertQuery16 = "INSERT INTO RecipeDetails (PublishDate, Title, Description, Culture, Difficulty, Serving)
VALUES 
('2024-01-01', 'Recipe1', 'Delicious dish with various ingredients.', 'Italian', 'Intermediate', 4),
('2024-02-15', 'Recipe2', 'Simple and quick recipe for busy days.', 'Mexican', 'Beginner', 2),
('2024-03-20', 'Recipe3', 'Healthy and flavorful meal with fresh ingredients.', 'Japanese', 'Advanced', 6),
('2024-04-10', 'Recipe4', 'Classic recipe loved by all.', 'French', 'Intermediate', 4),
('2024-05-05', 'Recipe5', 'Perfect dessert for any occasion.', 'Indian', 'Expert', 8),
('2024-06-20', 'Recipe6', 'Savory and aromatic dish with a twist.', 'Chinese', 'Intermediate', 5),
('2024-07-15', 'Recipe7', 'Light and refreshing salad for summer days.', 'Mediterranean', 'Beginner', 3),
('2024-08-10', 'Recipe8', 'Hearty soup perfect for chilly evenings.', 'American', 'Intermediate', 6),
('2024-09-05', 'Recipe9', 'Spicy and flavorful curry recipe.', 'Thai', 'Advanced', 7),
('2024-10-01', 'Recipe10', 'Decadent chocolate cake for chocolate lovers.', 'Swiss', 'Expert', 10),
('2024-11-10', 'Recipe11', 'Vegetarian delight packed with nutrients.', 'Indian', 'Intermediate', 4),
('2024-12-05', 'Recipe12', 'Comfort food for a cozy night in.', 'Italian', 'Beginner', 3),
('2025-01-20', 'Recipe13', 'Exotic seafood dish with a tropical flair.', 'Caribbean', 'Advanced', 6),
('2025-02-15', 'Recipe14', 'Refreshing drink perfect for hot summer days.', 'Mexican', 'Beginner', 2),
('2025-03-10', 'Recipe15', 'Fusion recipe blending flavors from East and West.', 'Asian Fusion', 'Intermediate', 5),
('2025-04-05', 'Recipe16', 'Rich and creamy pasta dish.', 'Italian', 'Expert', 8),
('2025-05-01', 'Recipe17', 'Light and healthy wrap for a quick meal.', 'Mediterranean', 'Beginner', 2),
('2025-06-20', 'Recipe18', 'Grilled dish with smoky flavors.', 'American', 'Intermediate', 4),
('2025-07-15', 'Recipe19', 'Zesty and tangy dish with a kick.', 'Mexican', 'Advanced', 7),
('2025-08-10', 'Recipe20', 'Decadent dessert with a surprise element.', 'French', 'Expert', 9)";

$insertQuery17 = "INSERT INTO Recipe (RecipeID, PublishDate, EstimatedTime, Title)
VALUES 
(1, '2024-01-01', 60, 'Recipe1'),
(2, '2024-02-15', 30, 'Recipe2'),
(3, '2024-03-20', 90, 'Recipe3'),
(4, '2024-04-10', 45, 'Recipe4'),
(5, '2024-05-05', 120, 'Recipe5'),
(6, '2024-06-20', 75, 'Recipe6'),
(7, '2024-07-15', 20, 'Recipe7'),
(8, '2024-08-10', 60, 'Recipe8'),
(9, '2024-09-05', 90, 'Recipe9'),
(10, '2024-10-01', 180, 'Recipe10'),
(11, '2024-11-10', 40, 'Recipe11'),
(12, '2024-12-05', 30, 'Recipe12'),
(13, '2025-01-20', 120, 'Recipe13'),
(14, '2025-02-15', 15, 'Recipe14'),
(15, '2025-03-10', 60, 'Recipe15'),
(16, '2025-04-05', 90, 'Recipe16'),
(17, '2025-05-01', 25, 'Recipe17'),
(18, '2025-06-20', 45, 'Recipe18'),
(19, '2025-07-15', 75, 'Recipe19'),
(20, '2025-08-10', 150, 'Recipe20')";

$insertQuery18 = "INSERT INTO Video (Name, UploadTime, RecipeID, VideoURL, Duration, Views)
VALUES 
('Video1', '2024-01-01', 1, 'https://example.com/video1', 120, '1000'),
('Video2', '2024-02-15', 2, 'https://example.com/video1', 90, '800'),
('Video3', '2024-03-20', 3, 'https://example.com/video1',150, '1200'),
('Video4', '2024-04-10', 4, 'https://example.com/video1',60, '500'),
('Video5', '2024-05-05', 5, 'https://example.com/video1', 180, '1500')";

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
(5, 1),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 6)";

$insertQuery21 = "INSERT INTO Participates (UserID, EventID)
VALUES 
(1, 'event1'),
(2, 'event2'),
(3, 'event3'),
(4, 'event4'),
(5, 'event5')";


$insertQuery23 = "INSERT INTO UserRanking (UserID, LeaderboardCategory, Points,Position)
VALUES 
(1, 'Monthly Top Chef', 100, 1),
(2, 'Monthly Top Chef', 90,2),
(3, 'Monthly Top Chef', 80,3),
(4, 'Monthly Top Chef', 70,4),
(5, 'Monthly Top Chef', 60,5)";

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

$connection->beginTransaction();

$connection->exec($insertQuery);
echo "<p>Inserted into UserDetails table.</p>\n";

$connection->exec($insertQuery2);
echo "<p>Inserted into AppUser table.</p>\n";


$connection->exec($insertQuery5);
echo "<p>Inserted into HomeCookDetails table.</p>\n";


$connection->exec($insertQuery7);
echo "<p>Inserted into ProfessionalChefSkill table.</p>\n";

$connection->exec($insertQuery6);
echo "<p>Inserted into ProfessionalChef table.</p>\n";





$connection->exec($insertQuery9);
echo "<p>Inserted into Leaderboard table.</p>\n";

$connection->exec($insertQuery10);
echo "<p>Inserted into EventLocation table.</p>\n";

$connection->exec($insertQuery11);
echo "<p>Inserted into EventDetails table.</p>\n";

$connection->exec($insertQuery12);
echo "<p>Inserted into ReviewDetails table.</p>\n";

$connection->exec($insertQuery13);
echo "<p>Inserted into Review table.</p>\n";

$connection->exec($insertQuery14);
echo "<p>Inserted into CookingEquipment table.</p>\n";

$connection->exec($insertQuery15);
echo "<p>Inserted into CookingEquipmentName table.</p>\n";

$connection->exec($insertQuery16);
echo "<p>Inserted into RecipeDetails table.</p>\n";

$connection->exec($insertQuery17);
echo "<p>Inserted into Recipe table.</p>\n";

$connection->exec($insertQuery18);
echo "<p>Inserted into Video table.</p>\n";

$connection->exec($insertQuery19);
echo "<p>Inserted into Ingredient table.</p>\n";

$connection->exec($insertQuery20);
echo "<p>Inserted into Follows table.</p>\n";

$connection->exec($insertQuery21);
echo "<p>Inserted into Participates table.</p>\n";


$connection->exec($insertQuery23);
echo "<p>Inserted into UserRanking table.</p>\n";

$connection->exec($insertQuery24);
echo "<p>Inserted into Utilizes table.</p>\n";

$connection->exec($insertQuery25);
echo "<p>Inserted into Posts table.</p>\n";

$connection->commit();
echo "<p>All data inserted successfully.</p>\n";

}

