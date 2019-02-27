<?php

class HTML
{
  public static function selected($str1, $str2) 
  {
    return ($str1 == $str2) ? "selected='selected'" : "";
  }
  
  public static function readOnly(bool $flag)
  {
    return ($flag) ? "readonly='readonly'" : "";
  }
  
  public static function messages($messages)
  {
    if (!empty($messages)):
    ?>
      <section class='section-messages'>
        <div class='container'>
          <ul class='list-group'>
          <?php foreach ($messages as $key => $messageBlock): ?>
            <?php foreach ($messageBlock as $message): ?>
            <li class='list-group-item list-group-item-<?= $key ?>'><?= $message; ?></li>
            <?php endforeach; ?>
          <?php endforeach; ?>
          </ul>
        </div>
      </section>
     <?php
     endif;
  }
  
  public static function breadcrumbs($breadcrumbs)
  {
    ?>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb): ?>
        <li class="breadcrumb-item"><a href="<?= $breadcrumb['url'] ?>"><?= $breadcrumb['text'] ?></a></li>
        <?php endforeach; ?>
      </ol>
    </nav>
    <?php
  }
  

}