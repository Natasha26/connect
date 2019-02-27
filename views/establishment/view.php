<section id="establishment-view" class="mt-3">
  <div class="container">
    <h2><?= $establishment->establishmentName; ?></h2>
    <h4><?= $establishment->shortName; ?></h4>
    <h4>Departments</h4>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Department Name</th>
            <th scope="col">Short Name</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($establishment->departments as $department): ?>
           <tr>
            <th scope="row"><?= $department['department_id'] ?></th>
            <td>
              <a href="/department/<?= $department['department_id'] ?>">
                <?= $department['department_name'] ?>
              </a>
            </td>
            <td>
              <?= $department['short_name'] ?>
            </td>
            
            
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
</div>
</section>