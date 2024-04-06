<!DOCTYPE html>
<html lang="en" class="bg-base-content text-neutral-content">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet">
</head>
<body class="h-screen flex justify-center items-center">

    <div class="text-center">
        <h1 class="text-3xl font-bold text-primary-500 mb-4">Delete Account</h1> 
        <h3 class="text-3xl font-bold text-primary-500 mb-4">Are you sure?</h3> 
       
        <button onclick="window.location.href = 'homepage_homecook.php'" class="btn btn-sm btn-primary mt-8">No</button>

        <form method="POST" action="/../backend/src/deleteuser.php" class="mt-4">
            <button type="submit" class="btn btn-sm btn-primary">Yes</button>
        </form>
    </div>

</body>
</html>
