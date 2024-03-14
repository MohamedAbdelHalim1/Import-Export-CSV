<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Export CSV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        
        .form-group input[type="checkbox"] {
            margin-right: 5px;
        }
        
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Checkbox Form</h2>
    <form action="<?php echo e(route('export.sheet')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label><input type="checkbox" name="name"> Name</label>
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="phone"> Phone</label>
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="email"> Email</label>
        </div>
        <button type="submit" class="btn">Submit</button>
    </form>
</div>

</body>
</html><?php /**PATH C:\AstraTech\resources\views/users/export.blade.php ENDPATH**/ ?>