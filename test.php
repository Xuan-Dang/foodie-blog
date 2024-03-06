<?php 
    $posts = [
        [
            "name" => "Post 1",
            "url" => "post-1"
        ],
        [
            "name" => "Post 2",
            "url" => "post-2"
        ],
        [
            "name" => "Post 3",
            "url" => "post-1=3"
        ]
    ]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($posts as $index => $post): ?>
        <div>
            <p>Ten: <?php echo htmlspecialchars($post["name"]) ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>