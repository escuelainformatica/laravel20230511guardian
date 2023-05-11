<form method="POST">
    @csrf
    <input type="text" name="email" /><br/>
    <input type="text" name="password" /><br/>
    <input type="submit" name="login" value="login"/>
</form>