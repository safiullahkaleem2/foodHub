<?php

function dropTables($connection) {
    $dropTables = "
        DROP TABLE IF EXISTS Reviews CASCADE;
        DROP TABLE IF EXISTS Posts CASCADE;
        DROP TABLE IF EXISTS Utilizes CASCADE;
        DROP TABLE IF EXISTS UserRanking CASCADE;
        DROP TABLE IF EXISTS Participates CASCADE;
        DROP TABLE IF EXISTS Follows CASCADE;
        DROP TABLE IF EXISTS Contains CASCADE;
        DROP TABLE IF EXISTS Ingredient CASCADE;
        DROP TABLE IF EXISTS Video CASCADE;
        DROP TABLE IF EXISTS Recipe CASCADE;
        DROP TABLE IF EXISTS RecipeDetails CASCADE;
        DROP TABLE IF EXISTS CookingEquipmentName CASCADE;
        DROP TABLE IF EXISTS CookingEquipment CASCADE;
        DROP TABLE IF EXISTS Review CASCADE;
        DROP TABLE IF EXISTS ReviewDetails CASCADE;
        DROP TABLE IF EXISTS EventDetails CASCADE;
        DROP TABLE IF EXISTS EventLocation CASCADE;
        DROP TABLE IF EXISTS Leaderboard CASCADE;
        DROP TABLE IF EXISTS ProfessionalChef CASCADE;
        DROP TABLE IF EXISTS ProfessionalChefSkill CASCADE;
        DROP TABLE IF EXISTS HomeCook CASCADE;
        DROP TABLE IF EXISTS AppUser CASCADE;
        DROP TABLE IF EXISTS UserDetails CASCADE;
    ";

    try {
        $connection->beginTransaction();
        $connection->exec($dropTables);
        $connection->commit();
        echo "<p>All tables dropped successfully.</p>\n";
    } catch (PDOException $e) {
        $connection->rollBack();
        die("Error dropping tables: " . $e->getMessage());
    }
}


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
('Global', 'Exclusive Cooking Set'),
('National', 'Cookbook Collection'),
('Regional', 'Kitchen Appliance Bundle')";


$insertQuery10 = "INSERT INTO EventLocation (Category, EntryFee, Location)
VALUES 
('Cooking Competition', 50, 'City A'),
('Baking Workshop', 30, 'City B'),
('Food Festival', 20, 'City C'),
('Culinary Tour', 40, 'City D'),
('Wine Tasting', 60, 'City E'),
('Sushi Making Class', 40, 'City F'),
('Pizza Workshop', 25, 'City G'),
('BBQ Cookout', 35, 'City H'),
('Dessert Masterclass', 45, 'City I'),
('Vegetarian Cooking Class', 30, 'City J'),
('Wine and Cheese Pairing', 55, 'City K'),
('Gourmet Dinner', 70, 'City L'),
('Street Food Festival', 15, 'City M'),
('Cocktail Mixology Workshop', 50, 'City N'),
('Farm-to-Table Experience', 65, 'City O')";

$insertQuery11 = "INSERT INTO EventDetails (Category, EntryFee, EventID, Date)
VALUES 
('Cooking Competition', 50, 'event1', '2024-04-15'),
('Baking Workshop', 30, 'event2', '2024-05-10'),
('Food Festival', 20, 'event3', '2024-06-20'),
('Culinary Tour', 40, 'event4', '2024-07-05'),
('Wine Tasting', 60, 'event5', '2024-08-12'),
('Sushi Making Class', 40, 'event6', '2024-09-05'),
('Pizza Workshop', 25, 'event7', '2024-10-10'),
('BBQ Cookout', 35, 'event8', '2024-11-20'),
('Dessert Masterclass', 45, 'event9', '2024-12-15'),
('Vegetarian Cooking Class', 30, 'event10', '2025-01-05'),
('Wine and Cheese Pairing', 55, 'event11', '2025-02-10'),
('Gourmet Dinner', 70, 'event12', '2025-03-20'),
('Street Food Festival', 15, 'event13', '2025-04-15'),
('Cocktail Mixology Workshop', 50, 'event14', '2025-05-10'),
('Farm-to-Table Experience', 65, 'event15', '2025-06-20')";

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
('2024-01-01', 'Spaghetti Carbonara', 'Delicious dish with pasta, eggs, cheese, and pancetta.', 'Italian', 'Intermediate', 4),
('2024-02-15', 'Guacamole', 'Simple and quick recipe for avocado lovers.', 'Mexican', 'Beginner', 2),
('2024-03-20', 'Sushi Rolls', 'Healthy and flavorful meal with fresh seafood and vegetables.', 'Japanese', 'Advanced', 6),
('2024-04-10', 'Coq au Vin', 'Classic French recipe with chicken cooked in wine.', 'French', 'Intermediate', 4),
('2024-05-05', 'Gulab Jamun', 'Traditional Indian dessert made with milk solids and sugar syrup.', 'Indian', 'Expert', 8),
('2024-06-20', 'Kung Pao Chicken', 'Savory and spicy Chinese dish with peanuts and vegetables.', 'Chinese', 'Intermediate', 5),
('2024-07-15', 'Greek Salad', 'Light and refreshing salad with tomatoes, cucumbers, and feta cheese.', 'Mediterranean', 'Beginner', 3),
('2024-08-10', 'Clam Chowder', 'Hearty soup made with clams, potatoes, and cream.', 'American', 'Intermediate', 6),
('2024-09-05', 'Thai Green Curry', 'Spicy and flavorful Thai curry with chicken or vegetables.', 'Thai', 'Advanced', 7),
('2024-10-01', 'Black Forest Cake', 'Decadent chocolate cake with layers of cherries and whipped cream.', 'Swiss', 'Expert', 10),
('2024-11-10', 'Paneer Tikka Masala', 'Vegetarian Indian dish with marinated paneer in a creamy tomato sauce.', 'Indian', 'Intermediate', 4),
('2024-12-05', 'Lasagna', 'Classic Italian comfort food with layers of pasta, cheese, and meat sauce.', 'Italian', 'Beginner', 3),
('2025-01-20', 'Jerk Shrimp', 'Exotic Caribbean dish with spicy jerk seasoning.', 'Caribbean', 'Advanced', 6),
('2025-02-15', 'Agua Fresca', 'Refreshing Mexican drink made with fruit and water.', 'Mexican', 'Beginner', 2),
('2025-03-10', 'Sushi Burger', 'Innovative fusion recipe combining sushi and burger elements.', 'Asian Fusion', 'Intermediate', 5),
('2025-04-05', 'Alfredo Pasta', 'Rich and creamy pasta dish with Parmesan cheese sauce.', 'Italian', 'Expert', 8),
('2025-05-01', 'Falafel Wrap', 'Light and healthy Mediterranean wrap with falafel and veggies.', 'Mediterranean', 'Beginner', 2),
('2025-06-20', 'BBQ Ribs', 'Grilled American dish with smoky barbecue flavors.', 'American', 'Intermediate', 4),
('2025-07-15', 'Chili con Carne', 'Zesty Mexican dish with ground beef, beans, and spices.', 'Mexican', 'Advanced', 7),
('2025-08-10', 'Crème Brûlée', 'Decadent French dessert with a caramelized sugar topping.', 'French', 'Expert', 9)";

$insertQuery17 = "INSERT INTO Recipe (RecipeID, PublishDate, EstimatedTime, Title)
VALUES 
(1, '2024-01-01', 60, 'Spaghetti Carbonara'),
(2, '2024-02-15', 30, 'Guacamole'),
(3, '2024-03-20', 90, 'Sushi Rolls'),
(4, '2024-04-10', 45, 'Coq au Vin'),
(5, '2024-05-05', 120, 'Gulab Jamun'),
(6, '2024-06-20', 75, 'Kung Pao Chicken'),
(7, '2024-07-15', 20, 'Greek Salad'),
(8, '2024-08-10', 60, 'Clam Chowder'),
(9, '2024-09-05', 90, 'Thai Green Curry'),
(10, '2024-10-01', 180, 'Black Forest Cake'),
(11, '2024-11-10', 40, 'Paneer Tikka Masala'),
(12, '2024-12-05', 30, 'Lasagna'),
(13, '2025-01-20', 120, 'Jerk Shrimp'),
(14, '2025-02-15', 15, 'Agua Fresca'),
(15, '2025-03-10', 60, 'Sushi Burger'),
(16, '2025-04-05', 90, 'Alfredo Pasta'),
(17, '2025-05-01', 25, 'Falafel Wrap'),
(18, '2025-06-20', 45, 'BBQ Ribs'),
(19, '2025-07-15', 75, 'Chili con Carne'),
(20, '2025-08-10', 150, 'Crème Brûlée')";

$insertQuery18 = "INSERT INTO Video (Name, UploadTime, RecipeID, VideoURL, Duration, Views)
VALUES 
('Video1', '2024-01-01', 1, 'https://www.youtube.com/embed/D_2DBLAt57c', 120, '1000'),
('Video2', '2024-02-15', 2, 'https://www.youtube.com/embed/HoToW7cYna0', 90, '800'),
('Video3', '2024-03-20', 3, 'https://www.youtube.com/embed/nIoOv6lWYnk',150, '1200'),
('Video4', '2024-04-10', 4, 'https://www.youtube.com/embed/Pa39m_w1gz8',60, '500'),
('Video5', '2024-05-05', 5, 'https://www.youtube.com/embed/J3O0ZEJYLFQ', 180, '1500'),
('Video6', '2024-06-20', 6, 'https://www.youtube.com/embed/Ar3qVJyfSVs', 75, '900'),
('Video7', '2024-07-15', 7, 'https://www.youtube.com/embed/dDhOpHcAJGo', 20, '300'),
('Video8', '2024-08-10', 8, 'https://www.youtube.com/embed/FRNcmhvdUGA', 60, '700')";


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
(1, 'event2'),
(1, 'event3'),
(1, 'event4'),
(1, 'event5'),
(1, 'event6'),
(1, 'event7'),
(1, 'event8'),
(1, 'event9'),
(1, 'event10'),
(1, 'event11'),
(1, 'event12'),
(1, 'event13'),
(1, 'event14'),
(1, 'event15'),
(2, 'event1'),
(2, 'event2'),
(2, 'event3'),
(2, 'event4'),
(2, 'event5'),
(2, 'event6'),
(2, 'event7'),
(2, 'event8'),
(2, 'event9'),
(2, 'event10'),
(2, 'event11'),
(2, 'event12'),
(2, 'event13'),
(2, 'event14'),
(2, 'event15'),
(3, 'event1'),
(3, 'event2'),
(3, 'event3'),
(3, 'event4'),
(3, 'event5'),
(3, 'event6'),
(3, 'event7'),
(3, 'event8'),
(3, 'event9'),
(3, 'event10'),
(3, 'event11'),
(3, 'event12'),
(3, 'event13'),
(3, 'event14'),
(3, 'event15'),
(14, 'event2'),
(13, 'event3'),
(4, 'event4'),
(5, 'event5')";


$insertQuery23 = "INSERT INTO UserRanking (UserID, LeaderboardCategory, Points,Position)
VALUES 
(1, 'Global', 100, 1),
(2, 'Global', 90,2),
(3, 'Global', 80,3),
(4, 'Global', 70,4),
(5, 'Global', 60,5),
(6, 'National', 100, 1),
(7, 'National', 90,2),
(8, 'National', 80,3),
(9, 'National', 70,4),
(10, 'National', 60,5),
(11, 'Regional', 100, 1),
(12, 'Regional', 90,2),
(13, 'Regional', 80,3),
(14, 'Regional', 70,4),
(15, 'Regional', 60,5)";

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

$insertQuery25 = "INSERT INTO Contains (RecipeID, Name)
VALUES 
(1, 'Flour'),
(2, 'Flour'),
(3, 'Flour'),
(4, 'Flour'),
(5, 'Flour'),
(6, 'Flour'),
(7, 'Flour'),
(8, 'Flour'),
(9, 'Flour'),
(10, 'Flour'),
(11, 'Flour'),
(12, 'Flour'),
(13, 'Flour'),
(14, 'Flour'),
(15, 'Flour'),
(16, 'Flour'),
(17, 'Flour'),
(18, 'Flour'),
(19, 'Flour'),
(20, 'Flour'),
(1, 'Sugar'),
(2, 'Sugar'),
(3, 'Sugar'),
(4, 'Sugar'),
(5, 'Sugar'),
(6, 'Sugar'),
(7, 'Sugar'),
(8, 'Sugar'),
(9, 'Sugar'),
(10, 'Sugar'),
(11, 'Sugar'),
(12, 'Sugar'),
(13, 'Sugar'),
(14, 'Sugar'),
(15, 'Sugar'),
(16, 'Sugar'),
(17, 'Sugar'),
(18, 'Sugar'),
(19, 'Sugar'),
(20, 'Sugar'),
(1, 'Eggs'),
(2, 'Eggs'),
(3, 'Eggs'),
(4, 'Eggs'),
(5, 'Eggs'),
(6, 'Eggs'),
(7, 'Eggs'),
(8, 'Eggs'),
(9, 'Eggs'),
(10, 'Eggs'),
(11, 'Eggs'),
(12, 'Eggs'),
(13, 'Eggs'),
(14, 'Eggs'),
(15, 'Eggs'),
(16, 'Eggs'),
(17, 'Eggs'),
(18, 'Eggs'),
(19, 'Eggs'),
(20, 'Eggs'),
(1, 'Butter'),
(2, 'Butter'),
(3, 'Butter'),
(4, 'Butter'),
(5, 'Butter'),
(6, 'Butter'),
(7, 'Butter'),
(8, 'Butter'),
(9, 'Butter'),
(10, 'Butter'),
(11, 'Butter'),
(12, 'Butter'),
(13, 'Butter'),
(14, 'Butter'),
(15, 'Butter'),
(16, 'Butter'),
(17, 'Butter'),
(18, 'Butter'),
(19, 'Butter'),
(20, 'Butter'),
(1, 'Salt'),
(2, 'Salt'),
(3, 'Salt'),
(4, 'Salt'),
(5, 'Salt'),
(6, 'Salt'),
(7, 'Salt'),
(8, 'Salt'),
(9, 'Salt'),
(10, 'Salt'),
(11, 'Salt'),
(12, 'Salt'),
(13, 'Salt'),
(14, 'Salt'),
(15, 'Salt'),
(16, 'Salt'),
(17, 'Salt'),
(18, 'Salt'),
(19, 'Salt'),
(20, 'Salt')";

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
     
     
     