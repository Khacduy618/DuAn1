<table class="table">
    <div class="row">
        <h1 class="col-6 text-start">Authorization</h1>
        <div class="col-6 text-end">
        </div>
    </div>
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
            <td><a class="btn btn-success"
                    href="?mod=authorization&act=authorize&id=<?=$Employee['user_email']?> ">action</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>