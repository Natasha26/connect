<div class="container">
  <form action='/user/<?= $path; ?>' method='post'>

    <div class="form-group">
      <label for="last-name">Last Name</label>
      <input type="text" class="form-control" id="last-name" name='last_name' placeholder="Last Name" value="<?= $user->lastName; ?>">
    </div>
    <div class="form-group">
      <label for="first-name">First Name</label>
      <input type="text" class="form-control" id="first-name" name='first_name' placeholder="First Name" value="<?= $user->firstName; ?>">
    </div>
    <div class="form-group">
      <label for="middle-name">Middle Name</label>
      <input type="text" class="form-control" id="middle-name" name='middle_name' placeholder="Middle Name" value="<?= $user->middleName; ?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name='email' placeholder="Email" value="<?= $user->email; ?>">
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" class="form-control" id="phone" name='phone' placeholder="Phone"  value="<?= $user->phone; ?>">
    </div>
    
    <div class="form-group">
      <label for="group-id">Group ID</label>
      <select class="form-control" id="group-id" name="group_id" <?= HTML::readOnly($group->groupId > 0); ?>>
        <?php foreach ($groups as $groupItem): ?>
          <option value="<?= $groupItem['group_id']; ?>" <?= HTML::selected($groupItem['group_id'], $user->groupId); ?>>
          <?= $groupItem['group_name']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    
    
    <?php if ($user->userId): ?>
      <input type='hidden' name='user_id' value='<?= $user->userId; ?>'>
      <?php endif; ?>
      <input type='hidden' name='action' value='<?= $action ?>'>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form> 
  </div>
