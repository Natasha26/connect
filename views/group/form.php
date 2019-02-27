<div class="container">
  <form action='/group/<?= $path; ?>' method='post'>

    <div class="form-group">
      <label for="group-name">Group Name</label>
      <input type="text" class="form-control" id="group-name" name='group_name' placeholder="Group Name" value='<?= $group->groupName; ?>'>
    </div>
    
    <div class="form-group">
      <label for="department-id">Department ID</label>
      <select class="form-control" id="department-id" name="department_id">
        <?php foreach ($departments as $departmentItem): ?>
          <option value="<?= $departmentItem['department_id']; ?>" <?= HTML::selected($departmentItem['department_id'], $group->departmentId); ?>>
            <?= $departmentItem['department_name']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <?php if ($group->groupId): ?>
      <input type='hidden' name='group_id' value='<?= $group->groupId; ?>'>
      <?php endif; ?>
      <input type='hidden' name='action' value='<?= $action ?>'>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form> 
  </div>
