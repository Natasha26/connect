<section id="establishment-list" class="mt-3">
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Short Name</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($establishments as $establishment): ?>
          <tr>
            <th scope="row"><?= $establishment['establishment_id'] ?></th>
            <td>
              <a href="/establishment/<?= $establishment['establishment_id'] ?>">
                <?= $establishment['establishment_name'] ?>
              </a>
            </td>
            <td><?= $establishment['short_name'] ?></td>
            
            
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>