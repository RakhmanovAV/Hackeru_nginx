<div class="error">
<?php echo $error ?? ''; ?>
</div>
                
<form action = "/role/editRole" method ="post">
    <input type="hidden" name="id" value="<?php echo $role['id'] ?? 0; ?>">
    Название: <input type="text" name="name" value="<?php echo $role['name'] ?? ''; ?>"><br />
    <?php foreach ($privileges as $privilege) { ?>
        <?php echo $privilege['name']; ?>
        <input type="checkbox" name="privilage[]" 
        value="<?php echo $privilege['id']; ?>" 
        <?php echo isset($role['privileges'][$privilege['id']]) ? ' checked="checked"' : '' ?>
        >
        <br />
    <?php } ?>
        <input type="submit" name="send" />
</form>