
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <style>
        /* CSS for user list */
        .user-list {
            list-style-type: none;
            padding: 0;
        }

        .user-item {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .user-item h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <h1>All Users</h1>
    <ul class="user-list">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="user-item">
                <h3><?php echo e($user->fullname); ?></h3>
                <p>Email: <?php echo e($user->email); ?></p>
                <p>Phone Number: <?php echo e($user->phone_number ?? 'N/A'); ?></p>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</body>
</html><?php /**PATH C:\AstraTech\resources\views/users/index.blade.php ENDPATH**/ ?>