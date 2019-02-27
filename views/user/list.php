<section id="user-list" class="mt-3">
  <div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Group</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
      <tr>
        <th scope="row"><?= $user['user_id'] ?></th>
        <td>
          <a href="/user/<?= $user['user_id'] ?>">
            <?= $user['last_name'] ?> <?= $user['first_name'] ?>
          </a>
        </td>
        <td><?= $user['email'] ?></td>
        <td><?= $user['phone'] ?></td>
        <td><?= $user['group_name'] ?></td>
        <td><a href="user/edit/<?= $user['user_id']?>" class="btn btn-primary btn-sm active" role="button" aria-pressed="true"><i class="fas fa-edit"></i></a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
    <a href="user/add" class="btn btn-primary btn-lg active" role="button" aria-pressed="true"><i class="fas fa-plus"></i></a>
    
  </div>
</section>