<?php

    require_once __DIR__ . '/../../backend/src/queries/userdetails.php';
    require_once __DIR__ . '/../../backend/src/queries/recipedetails.php';
    require_once __DIR__ . '/../../backend/src/queries/events.php';




shuffle($userList);
shuffle($recipes);
shuffle($eventData);
$profilePictures = [ 'https://randomuser.me/api/portraits/women/1.jpg','https://randomuser.me/api/portraits/women/2.jpg','https://randomuser.me/api/portraits/women/3.jpg','https://randomuser.me/api/portraits/women/4.jpg','https://randomuser.me/api/portraits/women/5.jpg',
                        'https://randomuser.me/api/portraits/women/6.jpg','https://randomuser.me/api/portraits/men/1.jpg','https://randomuser.me/api/portraits/men/2.jpg','https://randomuser.me/api/portraits/men/3.jpg','https://randomuser.me/api/portraits/men/4.jpg',
                        'https://randomuser.me/api/portraits/men/5.jpg','https://randomuser.me/api/portraits/men/6.jpg','https://randomuser.me/api/portraits/women/7.jpg','https://randomuser.me/api/portraits/women/8.jpg','https://randomuser.me/api/portraits/women/9.jpg',
                        'https://randomuser.me/api/portraits/women/10.jpg','https://randomuser.me/api/portraits/women/11.jpg','https://randomuser.me/api/portraits/women/12.jpg','https://randomuser.me/api/portraits/men/7.jpg','https://randomuser.me/api/portraits/men/8.jpg',
                        'https://randomuser.me/api/portraits/men/9.jpg','https://randomuser.me/api/portraits/men/10.jpg','https://randomuser.me/api/portraits/men/11.jpg','https://randomuser.me/api/portraits/men/12.jpg','https://randomuser.me/api/portraits/women/13.jpg',
                        'https://randomuser.me/api/portraits/women/14.jpg','https://randomuser.me/api/portraits/women/15.jpg','https://randomuser.me/api/portraits/women/16.jpg','https://randomuser.me/api/portraits/women/17.jpg','https://randomuser.me/api/portraits/women/18.jpg',
                        'https://randomuser.me/api/portraits/men/13.jpg','https://randomuser.me/api/portraits/men/14.jpg','https://randomuser.me/api/portraits/men/15.jpg','https://randomuser.me/api/portraits/men/16.jpg','https://randomuser.me/api/portraits/men/17.jpg',
                        'https://randomuser.me/api/portraits/men/18.jpg','https://randomuser.me/api/portraits/women/19.jpg','https://randomuser.me/api/portraits/women/20.jpg','https://randomuser.me/api/portraits/women/21.jpg','https://randomuser.me/api/portraits/women/22.jpg',
                        'https://randomuser.me/api/portraits/women/23.jpg','https://randomuser.me/api/portraits/women/24.jpg','https://randomuser.me/api/portraits/men/19.jpg','https://randomuser.me/api/portraits/men/20.jpg','https://randomuser.me/api/portraits/men/21.jpg',
                        'https://randomuser.me/api/portraits/men/22.jpg','https://randomuser.me/api/portraits/men/23.jpg','https://randomuser.me/api/portraits/men/24.jpg', 'https://randomuser.me/api/portraits/women/25.jpg',
                        'https://randomuser.me/api/portraits/women/26.jpg','https://randomuser.me/api/portraits/women/27.jpg','https://randomuser.me/api/portraits/women/28.jpg','https://randomuser.me/api/portraits/women/29.jpg',
                        'https://randomuser.me/api/portraits/women/30.jpg','https://randomuser.me/api/portraits/men/25.jpg','https://randomuser.me/api/portraits/men/26.jpg','https://randomuser.me/api/portraits/men/27.jpg',
                        'https://randomuser.me/api/portraits/men/28.jpg','https://randomuser.me/api/portraits/men/29.jpg','https://randomuser.me/api/portraits/men/30.jpg','https://randomuser.me/api/portraits/women/31.jpg',
                        'https://randomuser.me/api/portraits/women/32.jpg','https://randomuser.me/api/portraits/women/33.jpg','https://randomuser.me/api/portraits/women/34.jpg','https://randomuser.me/api/portraits/women/35.jpg',
                        'https://randomuser.me/api/portraits/women/36.jpg','https://randomuser.me/api/portraits/men/31.jpg', 'https://randomuser.me/api/portraits/men/32.jpg', 'https://randomuser.me/api/portraits/men/33.jpg',
                        'https://randomuser.me/api/portraits/men/34.jpg','https://randomuser.me/api/portraits/men/35.jpg','https://randomuser.me/api/portraits/men/36.jpg','https://randomuser.me/api/portraits/women/37.jpg',
                        'https://randomuser.me/api/portraits/women/38.jpg','https://randomuser.me/api/portraits/women/39.jpg','https://randomuser.me/api/portraits/women/40.jpg','https://randomuser.me/api/portraits/women/41.jpg',
                        'https://randomuser.me/api/portraits/women/42.jpg','https://randomuser.me/api/portraits/men/37.jpg','https://randomuser.me/api/portraits/men/38.jpg','https://randomuser.me/api/portraits/men/39.jpg',
                        'https://randomuser.me/api/portraits/men/40.jpg','https://randomuser.me/api/portraits/men/41.jpg','https://randomuser.me/api/portraits/men/42.jpg','https://randomuser.me/api/portraits/women/43.jpg',
                        'https://randomuser.me/api/portraits/women/44.jpg','https://randomuser.me/api/portraits/women/45.jpg','https://randomuser.me/api/portraits/women/46.jpg','https://randomuser.me/api/portraits/women/47.jpg',
                        'https://randomuser.me/api/portraits/women/48.jpg','https://randomuser.me/api/portraits/men/43.jpg','https://randomuser.me/api/portraits/men/44.jpg','https://randomuser.me/api/portraits/men/45.jpg',
                        'https://randomuser.me/api/portraits/men/46.jpg','https://randomuser.me/api/portraits/women/49.jpg','https://randomuser.me/api/portraits/women/50.jpg','https://randomuser.me/api/portraits/women/51.jpg'];

$foodPictures = ['https://images.unsplash.com/photo-1565299507177-b0ac66763828?q=80&w=1022&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1432139509613-5c4255815697?q=80&w=985&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1501959915551-4e8d30928317?q=80&w=987&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1481070555726-e2fe8357725c?q=80&w=1035&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
'https://images.unsplash.com/photo-1481931098730-318b6f776db0?q=80&w=990&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','https://images.unsplash.com/photo-1484980972926-edee96e0960d?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?q=80&w=960&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=987&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=1065&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=962&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1529042410759-befb1204b468?q=80&w=986&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?q=80&w=1010&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1484723091739-30a097e8f929?q=80&w=1049&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?q=80&w=987&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'];
$eventImages = ['https://www.withfire.co.uk/wp-content/uploads/2020/03/With-Fire-Incredible-Street-Food-Catering-Ideas-for-Your-Event.jpg', 'https://www.teambonding.com/wp-content/uploads/2020/10/Depositphotos_565421122_L-1.jpg'
,'https://mocandco.com/wp-content/uploads/2017/06/tray_of_food.jpg', 'https://www.reventals.com/blog/wp-content/uploads/2019/06/AdobeStock_186295600.jpeg'];




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Content Page</title>
</head>
<body>

<!-- User Details Section -->
<section id="user-details">
    <?php foreach (array_slice($userList, 0, 9) as $index => $user): ?>
        <div><?= htmlspecialchars($user['username']); ?></div>
    <?php endforeach; ?>
</section>

<!-- Recipe Details Section -->
<section id="recipe-details">
    <?php foreach (array_slice($recipes, 0, 8) as $index => $recipe): ?>
        <h3><?= htmlspecialchars($recipe['title']); ?></h3>
        <p><?= htmlspecialchars($recipe['description']); ?></p>
    <?php endforeach; ?>
</section>

<!-- Profile Pictures Section -->
<section id="profile-pictures">
    <?php foreach (array_slice($profilePictures, 0, 15) as $picture): ?>
        <img src="<?= htmlspecialchars($picture); ?>" alt="Profile Picture">
    <?php endforeach; ?>
</section>

<!-- Food Pictures Section -->
<section id="food-pictures">
    <?php foreach (array_slice($foodPictures, 0, 8) as $picture): ?>
        <img src="<?= htmlspecialchars($picture); ?>" alt="Food Picture">
    <?php endforeach; ?>
</section>

<!-- Event Details Section -->
<section id="events">
    <?php foreach (array_slice($eventData, 0, 4) as $index => $event): ?>
        <div class="event">
            <img src="<?= htmlspecialchars($eventImages[$index]); ?>" alt="Event Image">
            <h4><?= htmlspecialchars($event['category']); ?></h4>
            <p>Date: <?= htmlspecialchars($event['date']); ?></p>
            <p>Location: <?= htmlspecialchars($event['location']); ?></p>
        </div>
    <?php endforeach; ?>
</section>

</body>
</html>
