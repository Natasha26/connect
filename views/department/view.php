<section id="department-view" class="mt-3">
  <div class="container">
    <h2><?= $department->departmentName; ?></h2>
    <h4><?= $department->shortName; ?></h4>
    <h4>Groups</h4>
    <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Group Name</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($department->groups as $group): ?>
             <tr>
              <th scope="row"><?= $group['group_id'] ?></th>
              <td>
                <a href="/group/<?= $group['group_id'] ?>">
                  <?= $group['group_name'] ?>
                </a>
              </td>
              
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
</div>
</section>