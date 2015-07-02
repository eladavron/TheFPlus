<?php snippet('header') ?>


<main class="main page" role="main">

  <!-- SET UP VARIABLES -->
  <?php 
  $persons = explode(",", $page->cast()); 
$pubdate = date('l, F jS Y', $page->date());
$pubtime = date("g:ia", strtotime($page->time()));
if (strpos($page->featured_site(),',') !== false) {
  $multisite = true;
  $fsites = explode(",", $page->featured_site()); 
} else if ($page->featured_site() != '') {
  $multisite = false;
}
$etags = explode(",", $page->tags());
$songs = explode(",", $page->music_used());
  ?>

  <article class="episode full" itemscope itemtype="https://schema.org/RadioEpisode">
    <header>
      <h1>
        <span itemprop="episodeNumber" class="episode-number"><?php echo $page->uid() ?></span>:
        <span itemprop="name" class="episode-title"><?php echo $page->title() ?></span>
      </h1>

      <!-- FEATURED SITES -->
      <?php if ($page->featured_site() != ""): ?>
        <?php if ($multisite == true): ?>
        <div class="featured-site">
          Featured Sites: 
          <?php foreach($fsites as $fsite): ?>
          <span class="site"><?php echo trim($fsite) ?></span>
          <?php endforeach ?>
        </div>
        <?php endif ?>
        <?php if ($multisite == false): ?>
        <div class="featured-site">
          Featured Site:
          <span class="site">
            <?php echo trim($page->featured_site()) ?>
          </span>
          <?php endif ?>
        </div>
      <?php endif ?>

      <!-- DATE & TIME -->
      <time class="released" itemprop="datePublished" content="<?php echo $page->date('Y-m-d'); ?>T<?php echo $page->time(); ?>+06:00">
        <span class="date">
          <?php echo $pubdate ?>
        </span>
        @
        <span class="time">
          <?php echo $pubtime; ?>
        </span>
      </time>
    </header>

    <?php if($image = $page->image()): ?>
      <img itemprop="image" src="<?php echo $page->url() ?>/<?php echo $image->filename() ?>" class="cover" alt="F Plus Episode <?php echo $page->uid() ?>">
    <?php endif ?>

    <!-- CAST LIST -->
    <ul class="cast authors ridiculists info-block">
      <?php foreach($persons as $person): ?>
        <li itemprop="actor">
          <a href="<?php echo url::home() ?>/meet/<?php $clink = preg_replace('/\s+/', '-', $person); echo strtolower($clink) ?>"><span><?php echo $person ?></span></a>
      	</li>
      <?php endforeach ?>
    </ul>
    
    <div class="info-block">
      <!-- CONTENT PROVIDER -->
      <?php if ($page->provider() != ""): ?>
        <div class="content-provider">
          <label>content for this episode was compiled by</label>
          <a href="<?php echo url::home() ?>/meet/<?php $plink = strtolower(preg_replace('/\s+/', '-', $page->provider())); echo strtolower($plink) ?>">
            <span itemprop="contributor" class="provider"><?php echo $page->provider() ?></span>
          </a>
        </div>
      <?php endif ?>

      <!-- EDITOR -->
      <?php if ($page->editor() != ""): ?>
        <div class="edited-by">
          <label>edited by</label>
          <span class="editor" itemprop="editor">
            <?php echo $page->editor() ?>
          </span>
        </div>
      <?php endif ?>
    </div>


    <!-- EPISODE SUMMARY TEXT -->
    <summary class="info-block" itemprop="description">
      <?php echo $page->text()->kirbytext() ?>
    </summary>

    <!-- MUSIC USED -->
    <?php if ($page->music_used() != ""): ?>
      <div class="music-used info-block">
        <span class="list-leader">MUSIC USED:</span>
        <ol itemscope itemtype="http://schema.org/MusicPlaylist">
          <?php foreach($songs as $song): ?>
          <li itemprop="track"><?php echo trim($song) ?></li>
          <?php endforeach ?>
        </ol>
      </div>
    <?php endif ?>

    <div class="episode-actions">
      <!-- DOWNLOAD FILE -->
      <a itemprop="audio" class="action download" href="<?php echo $page->episode_file() ?>" title="Download episode" download>
        <svg viewBox="0 0 100 100">
					<use xlink:href="#IconDownload"></use>
				</svg>
      </a>

      <!-- READ DOCUMENT -->
      <?php if ($page->document_link() != ""): ?>
        <a itemprop="citation" class="action read" href="<?php echo $page->document_link() ?>" title="Read <?php echo $page->provider() ?>'s document"  target="_blank">
          <svg viewBox="0 0 100 100">
						<use xlink:href="#IconDocument"></use>
					</svg>
        </a>
      <?php endif ?>

      <!-- AUDIO CONTAINER -->
      <div class="audio-holder">
        <audio src="<?php echo $page->episode_file() ?>" preload="none" controls></audio>
      </div>

      <span class="share-label">share: </span>

      <!-- TWEET THIS -->
      <a class="social twitter" href="https://twitter.com/intent/tweet?source=webclient&text=<?php echo rawurlencode($page->title()); ?>%20<?php echo rawurlencode($page->url()); ?>%20<?php echo ('via @TheFPlus')?>" target="_blank" title="Tweet this">
        <svg viewBox="0 0 100 100">
					<use xlink:href="#IconTwitter"></use>
				</svg>
      </a>

      <!-- GOOGLE+ SHARE -->
      <a class="social googleplus" href="https://plus.google.com/share?url=<?php echo rawurlencode ($page->url()); ?>&title=<?php echo rawurlencode($page->title()); ?>" target="_blank" title="Share on Google+"> 
        <svg viewBox="0 0 100 100">
					<use xlink:href="#IconGooglePlus"></use>
				</svg>
      </a>
      
      <!-- FLATTR TIP -->
      <a class="social flattr" href="https://flattr.com/submit/auto?user_id=TheFPlus&url=<?php echo rawurlencode ($page->url()); ?>&title=<?php echo rawurlencode($page->title()); ?>" target="_blank" title="Tip us with Flattr">
        <svg viewBox="0 0 100 100">
					<use class="top-left orange" xlink:href="#FlattrTopLeft"></use>
					<use class="bottom-right green" xlink:href="#FlattrBottomRight"></use>
				</svg>
      </a>

      <!-- FACEBOOK SHARE -->
      <a class="social facebook" href="http://www.facebook.com/sharer.php?u=<?php echo rawurlencode ($page->url()); ?>" target="blank" title="Share on Facebook">
        <svg viewBox="0 0 100 100">
					<use xlink:href="#IconFacebook"></use>
				</svg>
      </a>
    </div>

    <!-- EPISODE TAGS -->
    <div class="info-block episode-tags">
      <span class="label">Episode Tags:</span>
      <ul itemprop="keywords" content="<?php echo $page->tags() ?>">
        <?php foreach($etags as $etag): ?>
          <?php $tagmatches = $site->grandChildren()->filterBy('tags', $etag, ','); ?>
          <?php $x = 0; ?>
          <?php foreach($tagmatches as $tagmatch): $x = $x+1; ?>
          <?php endforeach ?>
          <a <?php if ($x > 1): ?> href="<?php echo url::home() ?>/find/tag:<?php echo rawurlencode($etag) ?>" <?php endif ?>><?php echo trim($etag) ?></a>
        <?php endforeach ?>
      </ul>
    </div>

    <!-- ADDITIONAL FUN -->
    <?php if ($page->bonus_content() != ""): ?>
      <div class="info-block custom-html">
        <h4>Additional Fun</h4>
        <?php echo $page->bonus_content()->kirbytext() ?>
      </div>
    <?php endif ?>
    
  </article>

  <section class="comments disqus">
    <?php snippet('disqus-alt', array('allow_comments' => true)) ?>
  </section>

</main>

<?php snippet('footer') ?>