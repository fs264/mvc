<?php 
include 'header.html';
include 'navbar.html';

$str = '';
if(!empty($data)){
  foreach ($data as $key => $value) {

    if(!$key)
      $str.='<li class="orbit-slide is-active"><img src="assets/img/'.$value.'"></li>';
    else
      $str.='<li class="orbit-slide"><img src="assets/img/'.$value.'"></li>';

  }
}else{
  echo "<center><h3>Sorry, there is no data to display.</h3></p></center>";
}
?>

<!-- carousel -->

<center>
 <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
  <ul class="orbit-container">
    <button class="orbit-previous" aria-label="previous"><span class="show-for-sr">Previous Slide</span>&#9664;</button>
    <button class="orbit-next" aria-label="next"><span class="show-for-sr">Next Slide</span>&#9654;</button>
    <?= $str ?>
  </ul>
</div>
</center>

<?php include 'footer.html'; ?>