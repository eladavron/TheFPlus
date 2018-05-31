<?php snippet('header') ?>

<main class="main search" role="main">
  
  <form class="page-search">
    <input type="search" name="q" value="<?php echo esc($query) ?>">
    <input type="submit" value="search">
  </form>

  <section class="episodes summaries all-search-results">
  
  
  <?php if ($results->count() < 1) { ?>
    
    <?php
      $searchesToTry = array('britain', 'recipes', 'satan', 'furries', 'crime', 'juggalos', 'wikihow', 'magick', 'penis', 'drugs', 'reddit', 'teenagers', 'vampire', 'dragon', 'gross', 'questions');
      shuffle($searchesToTry);
      $searchesToTry = array_slice($searchesToTry, 0, 4)
    ?>

    <article class="no-search-results full">
      <p>
      No results for <b><?= $query; ?></b>.
      </p>
      <p>
        Maybe try searching for 
        <?php 
          $termcount = 0;
          foreach($searchesToTry as $searchTerm) {
            $termcount++;
            if ($termcount == count($searchesToTry)) { echo 'or &nbsp;'; }
            echo '<a href="' . $site->url() . '/search?q=' .  $searchTerm . '">' . $searchTerm . '</a>';
            if ($termcount < count($searchesToTry)) { echo ', &nbsp;'; } else { echo '?'; }
          }
        ?>
      <p>
    </summary>
  <?php } else { ?>
    <summary class="search-results-count">
      <?= $results->count(); ?> results found.
    </summary>
  <?php } ?>

  <?php foreach($results->sortBy('date', 'desc') as $result): ?>    
    <article class="<?php echo html($result->parent()->slug()) ?> brief">
      <header>
      <h2 class="title">
        <a href="<?php echo $result->url() ?>" title="<?php echo html($result->title()) ?>">
          <?php echo $result->title() ?>
        </a>
      </h2>
      </header>
      <?php if($image = $result->image()): ?>
        <a class="image-holder" href="<?php echo html($result->url()) ?>">
          <?php if ($result->cover() != "") { ?>
            <img src="<?php echo $result->cover()->toFile()->url(); ?>" class="cover" />
          <?php } else { ?>
            <img src="<?php echo html($image->url()) ?>" class="cover" />
          <?php } ?>
          <?php if ($result->tags() != ""):
            $etags = explode(",", $result->tags());
          ?>
          <div class="hover-cover">
            <ul class="tags">
              <?php foreach($etags as $etag): ?>
                <li><?php echo $etag ?></li>
              <?php endforeach ?>
            </ul>
          </div>
          <?php endif ?>
        </a>
      <?php endif ?>
      <summary>
        <?php if ($result->cast() != ""):
            $persons = explode(",", $result->cast());
          ?>
          <ul class="cast ridiculists authors">
            <?php foreach($persons as $person): ?>
            <li><?php echo $person ?></li>
            <?php endforeach ?>
          </ul>
        <?php endif ?>
        <div class="content">
          <p><?php echo excerpt($result->text(), 222) ?></p>
        </div>
      </summary>
    </article>
  <?php endforeach ?>
    
  </section>
  
</main>

<?php snippet('footer') ?>