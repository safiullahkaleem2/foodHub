<?php include __DIR__ . '/../backend/src/homecookevent.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content -->
</head>
<body class="bg-base-content flex items-center justify-center h-screen">
    <?php if ($eventDetails): ?>
        <div class="card w-96 bg-neutral text-neutral-content shadow-xl">
            <div class="card-body items-center text-center">
                <h2 class="card-title text-white">Event Details</h2>
                <div class="mb-4">
                    <div class="font-bold text-lg text-white"><?= htmlspecialchars($eventDetails['name']); ?></div>
                </div>
                <div class="mb-2">
                    <span class="font-semibold text-white">Date:</span>
                    <span class="text-white"><?= htmlspecialchars($eventDetails['date']); ?></span>
                </div>
                <div class="mb-2">
                    <span class="font-semibold text-white">Location:</span>
                    <span class="text-white"><?= htmlspecialchars($eventDetails['location']); ?></span>
                </div>
                <div class="mb-2">
                    <span class="font-semibold text-white">Category:</span>
                    <span class="text-white"><?= htmlspecialchars($eventDetails['category']); ?></span>
                </div>
                <div class="mb-4">
                    <span class="font-semibold text-white">Entry Fee:</span>
                    <span class="text-white">$<?= htmlspecialchars($eventDetails['entry_fee']); ?></span>
                </div>
                <div class="form-control mt-6">
                    <?php if ($isRegistered): ?>
                        <button type="button" class="btn btn-secondary" disabled>You have already registered</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-primary" onclick="location.href='registerEvent.php?eventid=<?= htmlspecialchars($eventID) ?>'">Register Now</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="text-white">Event details not found.</div>
    <?php endif; ?>
</body>
</html>
