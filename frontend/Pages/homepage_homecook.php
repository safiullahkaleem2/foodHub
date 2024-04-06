<?php

require_once __DIR__ . '/../../backend/src/queries/queryfunctions.php';
require __DIR__ . '/../../backend/src/recipefilter.php';

// Error Checking
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create Queries
createleaderboards($connection);
createevents($connection);
createrecipe($connection);
createprochefs($connection);
?>

<!DOCTYPE html>
<html>
<head>

    <!-- CDN for daisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!--Navigation bar -->
        <!--Base-->
        <div class="navbar bg-base-100 bg-neutral text-neutral-content">

            <!--Dropdown With Avatar-->
            <div class="navbar-start">
                
                <!--Photo-->
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar online">
                        <div class="w-10 rounded-full"> 
                            <img alt="Tailwind CSS Navbar component" src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"/>
                         </div>    
                    </div>
                    
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52 bg-neutral">
                    <li><a href="homecookprofilePage.html">Profile</a></li>
                    <li><a href="homeCookEventPage.html">Browse Events</a></li>
                    <li><a href="deleteaccount.php">Delete Account</a></li>
                    <li><a href="loginpage.html">Log out</a></li>
                </ul>
                </div>
            </div>

            <!--Title-->
            <div class="navbar-center">
                <a class="btn btn-ghost text-xl" style="pointer-events: none;">FoodHub</a>
                <img src="https://cdn.dribbble.com/userupload/3998399/file/original-9c55bbf2aa9c9cc167c188fa5bea8217.jpg?resize=752x" class="h-12 mr-6">
            </div>

            <!--Search Bar Recipes-->
            <!-- <div class="navbar-end">
            <form method="POST" action="">
                <label class="input input-bordered flex items-center gap-2 input-xs bg-base-content">
                    <input type="text" name="searchusers" class="grow" placeholder="Search Users" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /></svg>
                  </label>
            <form>
            </div> -->
        </div>
    
</head>

<body class=" bg-base-content text-neutral-content">
 
<div class="join">
    <h3 class="text-3xl font-bold text-start text-primary-500 ml-8 mb-4 pt-4">Recommended Chefs</h3>
    <button onclick="window.location.href = 'filterusers.php'" class="btn btn-sm btn-primary ml-4" style="margin-top: 20px;">User Statistics</button>
</div>
    <div class="flex justify-center gap-12">
        <div class = chef1> 
            <ul>
            <a href="professionalChefprofilePage.php?userId=<?php echo $prochefs[0]['userid']; ?>">
                        <img id = "chef1" class="mask mask-circle" src="" alt="Italian Trulli" style="width:150px;height:150;">
                    </a>
                    <div id = "chefname1" class="text-sm font-bold text-center text-primary-500 mb-4"><?php echo ucfirst($prochefs[0]['username']); ?></div>
            </ul>
        </div> 

        <div class = chef2>
            <ul>
            <a href="professionalChefprofilePage.php?userId=<?php echo $prochefs[1]['userid']; ?>">
                <img id = "chef2" class="mask mask-circle" src="" alt="Italian Trulli" style="width:150px;height:150;">
                <div id = "chefname2" class="text-sm font-bold text-center text-primary-500 mb-4"><?php echo ucfirst($prochefs[1]['username']); ?></div>
                </a>
            </ul>
        </div> 

        <div class = chef3>
            <ul>
            <a href="professionalChefprofilePage.php?userId=<?php echo $prochefs[2]['userid']; ?>">
                    <img id = "chef3" class="mask mask-circle" src="" alt="Italian Trulli" style="width:150px;height:150;">
                </a>
                <div id = "chefname3" class="text-sm font-bold text-center text-primary-500 mb-4"><?php echo ucfirst($prochefs[2]['username']); ?></div>
            </ul>
        </div> 

        <div class = chef4>
            <ul>
            <a href="professionalChefprofilePage.php?userId=<?php echo $prochefs[3]['userid']; ?>">
                    <img id = "chef4" class="mask mask-circle" src="" alt="Italian Trulli" style="width:150px;height:150;">
                </a>
                <div id = "chefname4" class="text-sm font-bold text-center text-primary-500 mb-4"><?php echo ucfirst($prochefs[3]['username']); ?></div>
            </ul>
        </div> 

        <div class = chef5>
            <ul>
            <a href="professionalChefprofilePage.php?userId=<?php echo $prochefs[4]['userid']; ?>">
                    <img id = "chef5" class="mask mask-circle" src="" alt="Italian Trulli" style="width:150px;height:150;">
                </a>
                <div id = "chefname5" class="text-sm font-bold text-center text-primary-500 mb-4"><?php echo ucfirst($prochefs[4]['username']); ?></div>
            </ul>
        </div> 

        <div class = chef6>
            <ul>
            <a href="professionalChefprofilePage.php?userId=<?php echo $prochefs[5]['userid']; ?>">
                    <img id = "chef6" class="mask mask-circle" src="" alt="Italian Trulli" style="width:150px;height:150;">
                </a>
                <div id = "chefname6" class="text-sm font-bold text-center text-primary-500 mb-4"><?php echo ucfirst($prochefs[5]['username']); ?></div>
            </ul>
        </div> 

        <div class = chef7>
            <ul>
            <a href="professionalChefprofilePage.php?userId=<?php echo $prochefs[6]['userid']; ?>">
                    <img id = "chef7" class="mask mask-circle" src="" alt="Italian Trulli" style="width:150px;height:150;">
                </a>
                <div id = "chefname7" class="text-sm font-bold text-center text-primary-500 mb-4"><?php echo ucfirst($prochefs[6]['username']); ?></div>
            </ul>
        </div> 

        <div class = chef8>
            <ul>
            <a href="professionalChefprofilePage.php?userId=<?php echo $prochefs[7]['userid']; ?>">
                    <img id = "chef8" class="mask mask-circle" src="" alt="Italian Trulli" style="width:150px;height:150;">
                </a>
                <div id = "chefname8" class="text-sm font-bold text-center text-primary-500 mb-4"><?php echo ucfirst($prochefs[7]['username']); ?></div>
            </ul>
        </div> 

        <div class = chef9>
            <ul>
            <a href="professionalChefprofilePage.php?userId=<?php echo $prochefs[8]['userid']; ?>">
                    <img id = "chef9" class="mask mask-circle" src="" alt="Italian Trulli" style="width:150px;height:150;">
                </a>
                <div id = "chefname9" class="text-sm font-bold text-center text-primary-500 mb-4"><?php echo ucfirst($prochefs[8]['username']); ?></div>
            </ul>
        </div> 
    </div>

    <!--TODO-->
    <!--Recommended Recipes-->
   <div class="join">
        <h3 class="text-3xl font-bold text-start text-primary-500 mb-4 pt-4 ml-8">Recommended Recipes</h3> 
        <button onclick="window.location.href = 'filterecipes.php'" class="btn btn-sm btn-primary ml-4" style="margin-top: 20px;">Filter Recipes</button>
    </div>

    <div class="flex gap-8 ml-8 pt-4 bg-base-content"> 
        <div class="max-w-sm rounded overflow-hidden shadow-xl">
        <a href="viewRecipePage.php?recipeId=<?php echo $recipe[0]['recipeid']; ?>">
                <img class="w-full" id = "food1" src="" alt="Sunset in the mountains">
            </a>

            <div class="px-6 py-4">
              <div id = "recipename1" class="font-bold text-xl mb-2"><?php echo ucfirst($recipe[0]['title']); ?></div>
              <p id = "recipedesc1" class="text-white">
                <div style="font-weight: bold;">
                    <?php echo $recipe[0]['culture']; ?>
                </div>
                <?php echo $recipe[0]['description']; ?>
            </p>
    </div>
</div>

        <div class="max-w-sm rounded overflow-hidden shadow-xl">
        <a href="viewRecipePage.php?recipeId=<?php echo $recipe[1]['recipeid']; ?>">
                <img class="w-full" id = "food2" src="" alt="Sunset in the mountains">
            </a>

            <div class="px-6 py-4">
              <div id = "recipename2" class="font-bold text-xl mb-2"><?php echo ucfirst($recipe[1]['title']); ?></div>
              <p id = "recipedesc2" class="text-white">
              <div style="font-weight: bold;">
                    <?php echo ucfirst($recipe[1]['culture']); ?>
                </div>
              <?php echo ucfirst($recipe[1]['description']); ?>
            </p>
            </div>
        </div>

        <div class="max-w-sm rounded overflow-hidden shadow-xl">
        <a href="viewRecipePage.php?recipeId=<?php echo $recipe[2]['recipeid']; ?>">
                <img class="w-full" id = "food3" src="" alt="Sunset in the mountains">
            </a>

            <div class="px-6 py-4">
            <div id = "recipename3" class="font-bold text-xl mb-2"><?php echo ucfirst($recipe[2]['title']); ?></div>
            
              <p id = "recipedesc3" class="text-white">
              <div style="font-weight: bold;">
                    <?php echo ucfirst($recipe[2]['culture']); ?>
                </div>
              <?php echo ucfirst($recipe[2]['description']); ?>
              </p>
            </div>
        </div>

        <div class="max-w-sm rounded overflow-hidden shadow-xl">
        <a href="viewRecipePage.php?recipeId=<?php echo $recipe[3]['recipeid']; ?>">
                <img class="w-full" id = "food4" src="" alt="Sunset in the mountains">
            </a>

            <div class="px-6 py-4">
              <div id = "recipename4" class="font-bold text-xl mb-2"><?php echo ucfirst($recipe[3]['title']); ?></div>
              <p id = "recipedesc4" class="text-white">
              <div style="font-weight: bold;">
                    <?php echo ucfirst($recipe[3]['culture']); ?>
                </div>
              <?php echo ucfirst($recipe[3]['description']); ?>
              </p>
            </div>
        </div>
    </div>    

    <div class="flex gap-8 ml-8 pt-4 bg-base-content"> 
        <div class="max-w-sm rounded overflow-hidden shadow-xl">
        <a href="viewRecipePage.php?recipeId=<?php echo $recipe[4]['recipeid']; ?>">
                <img class="w-full" id = "food5" src="" alt="Sunset in the mountains">
            </a>

            <div class="px-6 py-4">
              <div id = "recipename5" class="font-bold text-xl mb-2"><?php echo ucfirst($recipe[4]['title']); ?></div>
              <p id = "recipedesc5" class="text-white">
              <div style="font-weight: bold;">
                    <?php echo ucfirst($recipe[4]['culture']); ?>
                </div>
              <?php echo ucfirst($recipe[4]['description']); ?>
              </p>
            </div>
        </div>

        <div class="max-w-sm rounded overflow-hidden shadow-xl">
        <a href="viewRecipePage.php?recipeId=<?php echo $recipe[5]['recipeid']; ?>">
                <img class="w-full" id = "food6" src="" alt="Sunset in the mountains">
            </a>

            <div class="px-6 py-4">
              <div id = "recipename6" class="font-bold text-xl mb-2"><?php echo ucfirst($recipe[5]['title']); ?></div>
              <p id = "recipedesc6" class="text-white">
              <div style="font-weight: bold;">
                    <?php echo ucfirst($recipe[5]['culture']); ?>
                </div>
              <?php echo ucfirst($recipe[5]['description']); ?>
            </p>
            </div>
        </div>

        <div class="max-w-sm rounded overflow-hidden shadow-xl">
        <a href="viewRecipePage.php?recipeId=<?php echo $recipe[6]['recipeid']; ?>">
                <img class="w-full" id = "food7" src="" alt="Sunset in the mountains">
            </a>

            <div class="px-6 py-4">
              <div id = "recipename7" class="font-bold text-xl mb-2"><?php echo ucfirst($recipe[6]['title']); ?></div>
              <p id = "recipedesc7" class="text-white">
              <div style="font-weight: bold;">
                    <?php echo ucfirst($recipe[6]['culture']); ?>
                </div>
              <?php echo ucfirst($recipe[6]['description']); ?>
              </p>
            </div>
        </div>

        <div class="max-w-sm rounded overflow-hidden shadow-xl">
        <a href="viewRecipePage.php?recipeId=<?php echo $recipe[7]['recipeid']; ?>">
                <img class="w-full" id = "food8" src="" alt="Sunset in the mountains">
            </a>

            <div class="px-6 py-4">
              <div id = "recipename8" class="font-bold text-xl mb-2"><?php echo ucfirst($recipe[7]['title']); ?></div>
              <p id = "recipedesc8" class="text-white">
              <div style="font-weight: bold;">
                    <?php echo ucfirst($recipe[7]['culture']); ?>
                </div>
              <?php echo ucfirst($recipe[7]['description']); ?>
              </p>
              </p>
            </div>

        </div>
    </div>    

    <!--Leaderboards-->
    <div class="join ml-4">
        <div class="container mx-auto px-4 py-8">
            <h3 class="text-3xl font-bold text-center text-primary-500 mb-4">Global Leaderboard</h3>
            <table class="table-md bg-neutral">
                <thead>
                    <tr class="text-success">
                        <th>Position</th>
                        <th>Name</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <!-- row 1 -->
                    <tr>
                        <th class="text-warning">1</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard1" src="" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold"><?php echo ucfirst($globalarray[0]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($globalarray[0]['points']); ?></td>
                    </tr>
                    

                    <!-- row 2 -->
                    <tr>
                        <th class="text-gray-400">2</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard2" src="" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold"><?php echo ucfirst($globalarray[1]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($globalarray[1]['points']); ?></td>
                    </tr>

                    <!-- row 2 -->
                    <tr>
                        <th class="text-yellow-600">3</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard3" src="" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold"><?php echo ucfirst($globalarray[2]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($globalarray[2]['points']); ?></td>
                    </tr>

                    <!-- row 4 -->
                    <tr>
                        <th>4</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard4" src="" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold"><?php echo ucfirst($globalarray[3]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($globalarray[3]['points']); ?></td>
                    </tr>

                    <!-- row 5 -->
                    <tr>
                        <th>5</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard5" src="" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold"><?php echo ucfirst($globalarray[4]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($globalarray[4]['points']); ?></td>
                    </tr>

            </table>
        </div>

        <div class="joinoverflow-x-auto container mx-auto px-4 py-8">
            <h3 class="text-3xl font-bold text-center text-primary-500 mb-4">National Leaderboard</h3>
            <table class="table-md bg-neutral">
                <thead>
                    <tr class="text-success">
                        <th>Position</th>
                        <th>Name</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <!-- row 1 -->
                    <tr>
                        <th class="text-warning">1</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard6" src="" />
                                </div>
                            </div>

                            <div>
                                <div class="font-bold"><?php echo ucfirst($nationalarray[0]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($nationalarray[0]['points']); ?></td>
                    </tr>
                    

                    <!-- row 2 -->
                    <tr>
                        <th class="text-gray-400">2</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard7" src="" />
                                </div>
                            </div>
                            <div>
                            <div class="font-bold"><?php echo ucfirst($nationalarray[1]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($nationalarray[1]['points']); ?></td>
                    </tr>

                    <!-- row 2 -->
                    <tr>
                        <th class="text-yellow-600">3</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard8" src="" />
                                </div>
                            </div>
                            <div>
                            <div class="font-bold"><?php echo ucfirst($nationalarray[2]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($nationalarray[2]['points']); ?></td>
                    </tr>

                    <!-- row 4 -->
                    <tr>
                        <th>4</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard9" src="" />
                                </div>
                            </div>
                            <div>
                            <div class="font-bold"><?php echo ucfirst($nationalarray[3]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($nationalarray[3]['points']); ?></td>
                    </tr>

                    <!-- row 5 -->
                    <tr>
                        <th>5</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard10" src="" />
                                </div>
                            </div>
                            <div>
                            <div class="font-bold"><?php echo ucfirst($nationalarray[4]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($nationalarray[4]['points']); ?></td>
                    </tr>

            </table>
        </div>

        <div class="joinoverflow-x-auto container mx-auto px-4 py-8">
            <h3 class="text-3xl font-bold text-center text-primary-500 mb-4">Regional Leaderboard</h3>
            <table class="table-md bg-neutral">
                <thead>
                    <tr class="text-success">
                        <th>Position</th>
                        <th>Name</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <!-- row 1 -->
                    <tr>
                        <th class="text-warning">1</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard11" src="" />
                                </div>
                            </div>
                            <div>
                            <div class="font-bold"><?php echo ucfirst($regionalarray[0]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($regionalarray[0]['points']); ?></td>
                    </tr>
                    

                    <!-- row 2 -->
                    <tr>
                        <th class="text-gray-400">2</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard12" src="" />
                                </div>
                            </div>
                            <div>
                            <div class="font-bold"><?php echo ucfirst($regionalarray[1]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($regionalarray[1]['points']); ?></td>
                    </tr>

                    <!-- row 2 -->
                    <tr>
                        <th class="text-yellow-600">3</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard13" src="" />
                                </div>
                            </div>
                            <div>
                            <div class="font-bold"><?php echo ucfirst($regionalarray[2]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($regionalarray[2]['points']); ?></td>
                    </tr>

                    <!-- row 4 -->
                    <tr>
                        <th>4</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard14" src="" />
                                </div>
                            </div>
                            <div>
                            <div class="font-bold"><?php echo ucfirst($regionalarray[3]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($regionalarray[3]['points']); ?></td>
                    </tr>

                    <!-- row 5 -->
                    <tr>
                        <th>5</th>
                        <td class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-circle w-10 h-10">
                                    <img id = "leaderboard15" src="" />
                                </div>
                            </div>
                            <div>
                            <div class="font-bold"><?php echo ucfirst($regionalarray[4]['username']); ?></div>
                            </div>
                        </td>
                        <td><?php echo ucfirst($regionalarray[4]['points']); ?></td>
                    </tr>

            </table>
        </div>
        
    </div>

    <!--Events-->
    <div>
    <div class="join">
    <h3 class="text-3xl font-bold text-start text-primary-500 ml-8 mb-4 pt-4">Upcoming Events</h3>
    <form method="POST" action="/../backend/src/eventsfilter.php">
    <button type="submit" class="btn btn-sm btn-primary ml-4" style="margin-top: 20px;">Hall Of Fame</button>
    </form>
    </div>
    <div class="flex justify-center gap-8">
        <div class="card card-compact w-96 bg-neutral shadow-xl ml-4">
            <figure><img src="https://www.withfire.co.uk/wp-content/uploads/2020/03/With-Fire-Incredible-Street-Food-Catering-Ideas-for-Your-Event.jpg" alt="Shoes" /></figure>
            <div class="absolute top-40 left-0 p-4 bg-base-content">
                <h3 id = "eventtitle1" class="text-white text-xl font-semibold"><?php echo ucfirst($events[0]['category']); ?></h3>
            </div>
            <div class="card-body">
                <div class="join">
                    <?php echo ucfirst($events[0]['date']); ?>
                </div>
                <p>
                    <?php echo ucfirst($events[0]['location']); ?> 
                    <br>
                    $<?php echo ucfirst($events[0]['entryfee']); ?>
                </p>
                <div class="card-actions justify-end">
                    <a href="homeCookEventPage.php?eventid=<?php echo $events[0]['eventid']; ?>" class="btn btn-primary">Join</a>>
                </div>
            </div>
        </div>

        <div class="card card-compact w-96 bg-neutral shadow-xl">
            <figure><img src="https://www.teambonding.com/wp-content/uploads/2020/10/Depositphotos_565421122_L-1.jpg" alt="Shoes" /></figure>
            <div class="absolute top-40 left-0 bg-neutral p-4">
                <h3 id = "eventtitle1" class="text-white text-xl font-semibold"><?php echo ucfirst($events[1]['category']); ?></h3>
            </div>
            <div class="card-body">
                <div class="join">
                    <?php echo ucfirst($events[1]['date']); ?>
                </div>
                <p>
                    <?php echo ucfirst($events[1]['location']); ?> 
                    <br>
                    $<?php echo ucfirst($events[1]['entryfee']); ?>
                </p>
                <div class="card-actions justify-end">
                <a href="homeCookEventPage.php?eventid=<?php echo $events[1]['eventid']; ?>" class="btn btn-primary">Join</a>>
                </div>
            </div>
        </div>

        <div class="card card-compact w-96 bg-neutral shadow-xl">
            <figure><img src="https://mocandco.com/wp-content/uploads/2017/06/tray_of_food.jpg" alt="Shoes" /></figure>
            <div class="absolute top-40 left-0 bg-neutral p-4">
                <h3 id = "eventtitle1" class="text-white text-xl font-semibold"><?php echo ucfirst($events[2]['category']); ?></h3>
            </div>
            <div class="card-body">
                <div class="join">
                    <?php echo ucfirst($events[2]['date']); ?>
                </div>
                <p>
                    <?php echo ucfirst($events[2]['location']); ?> 
                    <br>
                    $<?php echo ucfirst($events[2]['entryfee']); ?>
                </p>
                <div class="card-actions justify-end">
                <a href="homeCookEventPage.php?eventid=<?php echo $events[2]['eventid']; ?>" class="btn btn-primary">Join</a>>
                </div>
            </div>
        </div>

        <div class="card card-compact w-96 bg-neutral shadow-xl mr-4">
            <figure><img src="https://www.reventals.com/blog/wp-content/uploads/2019/06/AdobeStock_186295600.jpeg" alt="Shoes" /></figure>
            <div class="absolute top-40 left-0 bg-neutral p-4">
                <h3 id = "eventtitle1" class="text-white text-xl font-semibold"><?php echo ucfirst($events[3]['category']); ?></h3>
            </div>
            <div class="card-body">
                <div class="join">
                    <?php echo ucfirst($events[3]['date']); ?>
                </div>
                <p>
                    <?php echo ucfirst($events[3]['location']); ?> 
                    <br>
                    $<?php echo ucfirst($events[3]['entryfee']); ?>
                </p>
                <div class="card-actions justify-end">
                <a href="homeCookEventPage.php?eventid=<?php echo $events[3]['eventid']; ?>" class="btn btn-primary">Join</a>>
                </div>
            </div>
        </div>
    </div> 

    <script src = "homepage.js"></script>

</body>
</html>