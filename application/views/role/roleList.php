<a href="/role/editRole">Создать роль</a><br />
<table>
    <?php foreach ($roles as $role) { ?>
    <tr>
        <td href="/role/editRole?id=<?php echo $role['id']; ?>">Редактировать</td>
        <td href="/role/deleteRole?id=<?php echo $role['id']; ?>">Удалить</td>
        <td href="/role/editRole"><?php echo $role['name']; ?></td>
    </tr>
    <?php } ?>
</table> 