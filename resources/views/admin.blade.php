<form method="post" action="access">
    {{ csrf_field() }}
    <label>access code</label>
    <input type="password" name="access-code">
    <input type="submit" value="submit">
</form>