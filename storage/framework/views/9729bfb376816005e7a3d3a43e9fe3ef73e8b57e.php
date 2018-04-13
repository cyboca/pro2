<form method="post" action="access">
    <?php echo e(csrf_field()); ?>

    <label>access code</label>
    <input type="password" name="access-code">
    <input type="submit" value="submit">
</form>