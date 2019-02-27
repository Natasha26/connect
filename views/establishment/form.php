<div class="container">
  <form action='/establishment/<?= $path ?>' method='post'>
    <div class="form-group">
      <label for="establishment-name">Establishment Name</label>
      <input type="text" class="form-control" id="establishment-name" name='establishment_name' placeholder="Establishment Name" value='<?= $establishment->establishmentName; ?>'>
    </div>
    
    <div class="form-group">
      <label for="short-name">Short Name</label>
      <input type="text" class="form-control" id="short-name" name='short_name' placeholder="Short Name" value='<?= $establishment->shortName; ?>'>
    </div>
    <input type="hidden" name="action" value="<?= $action ?>">
    <?php if ($establishment->establishmentId): ?>
      <input type='hidden' name='establishment_id' value='<?= $establishment->establishmentId; ?>'>
    <?php endif; ?>
   
    <button type="submit" class="btn btn-primary">Submit</button>
  </form> 
</div>
