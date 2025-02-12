<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">User name</th>
            <th scope="col">Email</th>
            <th scope="col">Telephone number</th>
            <th scope="col">Authorization</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($Employees as $Employee){?>
        <tr>
            <th scope="row">
                <?=$Employee['user_name']?>
            </th>
            <td><?=$Employee['user_email']?></td>
            <td><?=$Employee['user_phone']?></td>
            <td><a href="?mod=authorization&act=authorize&id=<?=$Employee['user_email']?> ">authorization</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>