<section id="department-list" class="mt-3">
  <div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Establishment Name</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($departments as $department): ?>
      <tr>
        <th scope="row"><?= $department['department_id'] ?></th>
        <td>
          <a href="/department/<?= $department['department_id'] ?>">
            <?= $department['department_name'] ?>
          </a>
        </td>
        <td>
          <a href="/establishment/<?= $department['establishment_id'] ?>">
            <?= $department['establishment_name'] ?>
          </a>
        </td>        
        <td><a href="department/edit/<?= $department['department_id']?>" class="btn btn-primary btn-sm active" role="button" aria-pressed="true"><i class="fas fa-edit"></i></a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
    <div class="mt-3">
      <a href="department/add" class="btn btn-primary btn-lg active" role="button" aria-pressed="true"><i class="fas fa-plus"></i></a>
    </div>
    
    
  </div>
</section>