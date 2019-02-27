<section id="user-view" class="mt-3">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-8">
        <table class="table table-bordered">
          <tr>
            <th>Last Name:</th>
            <td><?= $user->lastName; ?></td>
          </tr>
          <tr>
            <th>First Name:</th>
            <td><?= $user->firstName; ?></td>
          </tr>
          <tr>
            <th>Middle Name:</th>
            <td><?= $user->middleName; ?></td>
          </tr>
          <tr>
            <th>Email:</th>
            <td><?= $user->email; ?></td>
          </tr>
          <tr>
            <th>Phone:</th>
            <td><?= $user->phone; ?></td>
          </tr>
          <tr>
            <th>Group:</th>
            <td><?= $user->groupName; ?></td>
          </tr>
          <tr>
            <th>Department:</th>
            <td><?= $user->departmentName; ?></td>
          </tr>
          <tr>
            <th>Establishment:</th>
            <td><?= $user->establishmentName; ?></td>
          </tr>
        </table>
      </div>
      <div class="col-12 col-md-4">
        <img src="/images/users/placeholder.png">
      </div>
    </div>
  </div>
</section>