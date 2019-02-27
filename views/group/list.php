<section id="group-list" class="mt-3">
  <div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Department</th>
        <th scope="col">Establishment</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($groups as $group): ?>
      <tr>
        <th scope="row"><?= $group['group_id'] ?></th>
        <td>
          <a href="/group/<?= $group['group_id'] ?>"><?= $group['group_name'] ?></a>
        </td>
        <td>
          <a href="/department/<?= $group['department_id'] ?>"><?= $group['department_short_name'] ?></a>
        </td>
        <td>
          <a href="/establishment/<?= $group['establishment_id'] ?>"><?= $group['establishment_short_name'] ?></a>
        </td>
        
        <td><a href="group/edit/<?= $group['group_id']?>" class="btn btn-primary btn-sm active" role="button" aria-pressed="true"><i class="fas fa-edit"></i></a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
    <a href="group/add" class="btn btn-primary btn-lg active" role="button" aria-pressed="true"><i class="fas fa-plus"></i></a>
    
  </div>
</section>