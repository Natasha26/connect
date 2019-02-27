<section id="group-view" class="mt-3">
  <div class="container">
    <h2>Group: <?= $group->groupName; ?> (<?= count($group->users); ?>)</h2>
    <h4>Users</h4>
    
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($group->users as $user): ?>
          <tr>
            <th scope="row"><?= ++$number ?></th>
            <td>
                <?= $user['last_name'] ?> <?= $user['first_name'] ?>
            </td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['phone'] ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
</div>
</section>