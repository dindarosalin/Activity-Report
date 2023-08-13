<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
</head>
<body>
    <h2>Login</h2>
    <a href="javascript:history.back()">Kembali</a>
    <form method="post" action="process_login.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Role:</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
