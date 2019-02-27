<div class="container">
  <form action='/department/<?= $path ?>' method='post'>

    <div class="form-group">
      <label for="department-name">Department Name</label>
      <input type="text" class="form-control" id="department-name" name='department_name' placeholder="Department Name" value="<?= $department->departmentName; ?>">
    </div>

    <div class="form-group">
      <label for="short-name">Short Name</label>
      <input type="text" class="form-control" id="short-name" name='short_name' placeholder="Short Name" value="<?= $department->shortName; ?>">
    </div>
    
    <div class="form-group">
      <label for="establishment-id">Establishment ID</label>
      <select class="form-control" id="establishment-id" name="establishment_id">
        <?php foreach ($establishments as $establishmentItem): ?>
          <option value="<?= $establishmentItem['establishment_id']; ?>" <?= HTML::selected($establishmentItem['establishment_id'], $department->establishmentId); ?>>
            <?= $establishmentItem['establishment_name']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <?php if ($department->departmentId): ?>
      <input type='hidden' name='department_id' value='<?= $department->departmentId; ?>'>
      <?php endif; ?>
      <input type='hidden' name='action' value='<?= $action ?>'>
      
      <button type="submit" class="btn btn-primary">Submit</button>
    </form> 
  </div>
