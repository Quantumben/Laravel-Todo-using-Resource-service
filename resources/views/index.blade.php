<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO RESTFUL</title>
</head>
<body>
        <h1>View Todo List</h1>
	<button type="submit"><a href="todo.php">View all Todo</a></button>

	<form method="post" action=" ">
        @csrf
        
		<p>Todo title: </p>
		<input name="Title" type="text">
		<p>Todo description: </p>
		<input name="Description" type="text">
		<br>
		<input type="submit" name="submit" value="submit">
</body>
</html>