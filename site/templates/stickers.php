<?php snippet('header') ?>

<?php
  $pubdate = date('l, F jS Y', $page->date());
  $pubtime = date("g:ia", strtotime($page->time()));
?>

<main class="main page" role="main">

    <article class="full default">
      <header>
        <h1 style="margin-bottom:0;"><?php echo $page->title() ?></h1>
        
        <!-- DATE & TIME -->
        <time class="released" content="<?php echo $page->date('Y-m-d'); ?>T<?php echo $page->time(); ?>+06:00">
          <span>Last Release: </span>
          <strong class="date">
            <?php echo date('l, F jS Y', $page->date()); ?>
          </strong>
          @
          <strong class="time">
            <?php echo date("g:ia", strtotime($page->time())); ?>
          </strong>
        </time>
      </header>
      
      <?php echo $page->text()->kirbytext() ?>
      
    </article>
      
      <div class="merch-grid stickers">
        
        <?php foreach($page->stickers()->toStructure()->sortBy('series_num', 'desc') as $sticker): ?>
        
          <div class="grid-box sticker-box" itemscope itemtype="http://schema.org/Product">
            <a name="<?= $sticker->series_num(); ?>"></a>
            <meta itemprop="category" content="sticker" />
            <meta itemprop="url" content="<?php echo $page->url(); ?>" />
            <meta itemprop="description" content="<?php echo strip_tags($page->text()->kirbytext());; ?>" />
            <figure class="thumb-holder">
              <?php if ($sticker->fullsize() != "") { ?>
                <a onclick="window.open('<?php echo $sticker->fullsize()->toFile()->url(); ?>', 'popupWindow', 'width=<?php echo $sticker->fullsize()->toFile()->width(); ?>,height=<?php echo $sticker->fullsize()->toFile()->height(); ?>');" class="zoom">
                  <img itemprop="image" src="<?php echo $page->url() ?>/<?php echo $sticker->pic()->filename() ?>" class="thumb" />
                </a>
              <?php } else { ?>
                <img itemprop="image" src="<?php echo $page->url() ?>/<?php echo $sticker->pic()->filename() ?>" class="thumb" />
              <?php } ?>
            </figure>
            <div class="details">
              <div class="detail full name">
                <label>Name</label>
                <div class="text" itemprop="name">
                  <?php echo $sticker->title(); ?>
                </div>
              </div>

              <div class="detail two-thirds artist">
                <label>Artist</label>
                <div class="text">
                  <?php $slug = strtolower(preg_replace('/\s+/', '-', str_replace(array("'", '!'), "", $sticker->artist()))); ?>
                  <?php if ($site->find('meet')->find($slug)) { ?>
                    <a href="http://thefpl.us/meet/<?php echo $slug; ?>"><?php echo $sticker->artist(); ?></a>
                  <?php } else { ?>
                    <span><?php echo $sticker->artist(); ?></span>
                  <?php } ?>
                </div>
              </div>
              
              <div class="detail third series-number">
                <label>Series</label>
                <div class="text">
                  <?php echo $sticker->series_num(); ?>
                </div>
              </div>

              <div class="detail third dimensions">
                <label>Dimensions</label>
                <div class="text">
                  <?php echo $sticker->dimensions(); ?>
                </div>
              </div>
              
              <div class="detail third shape">
                <label>Shape</label>
                <div class="text">
                  <?php echo $sticker->shape(); ?>
                </div>
              </div>
              
              <div class="detail third material">
                <label>Material</label>
                <div class="text">
                  <?php echo $sticker->vinyl(); ?>
                </div>
              </div>
              
              <div class="detail third printed">
                <label>Printed</label>
                <div class="text">
                  <?php echo $sticker->printed(); ?>
                </div>
              </div>
              <div class="detail third released">
                <label>Released</label>
                <div class="text">
                  <?php if ($sticker->released == "") { ?>
                    pending
                  <?php } else { ?>
                    <?php echo $sticker->date('m/d/y', 'released'); ?>
                    <meta itemprop="releaseDate" content="<?php echo $sticker->released(); ?>" />
                  <?php } ?>
                </div>
              </div>
              <?php if ($sticker->soldout() != ""): ?>
                <div class="detail third sold-out">
                  <label>Sold Out</label>
                  <div class="text">
                    <?php echo $sticker->date('m/d/y', 'soldout'); ?>
                  </div>
                </div>
              <?php endif; ?>

              <?php if ($sticker->soldout() == "" && $sticker->buttona_slug() != "") { ?>
                <div class="detail full buy-buttons">
                  <label>Buy Now</label>
                  <div class="buttons">
                    <?php if ($sticker->buttona_slug() != ""): ?>
                      <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="name" content="<?php echo $sticker->buttona_num(); ?> X <?php echo $sticker->title(); ?>" />
                        <meta itemprop="priceCurrency" content="USD" />
                        <meta itemprop="price" content="<?php echo $sticker->buttona_price(); ?>" />
                        <meta itemprop="url" content="<?php echo $page->url(); ?>" />
                        <meta itemprop="itemCondition" itemtype="http://schema.org/NewCondition" />
                        <meta itemprop="availability" itemtype="http://schema.org/LimitedAvailability" />
                      </div>
                      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick"/>
                        <input type="hidden" name="hosted_button_id" value="<?php echo $sticker->buttona_slug(); ?>"/>
                        <button type="submit" onclick="trackEvent('stickers', '<?php echo $sticker->title(); ?>', '<?php echo $sticker->buttona_num(); ?> @ $<?php echo $sticker->buttona_price(); ?>', <?php echo $sticker->buttona_price(); ?>);"><?php echo $sticker->buttona_num(); ?> @ $<?php echo $sticker->buttona_price(); ?></button>
                      </form>
                    <?php endif; ?>
                    <?php if ($sticker->buttonb_slug() != ""): ?>
                      <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="name" content="<?php echo $sticker->buttonb_num(); ?> X <?php echo $sticker->title(); ?>" />
                        <meta itemprop="priceCurrency" content="USD" />
                        <meta itemprop="price" content="<?php echo $sticker->buttonb_price(); ?>" />
                        <meta itemprop="url" content="<?php echo $page->url(); ?>" />
                        <meta itemprop="itemCondition" itemtype="http://schema.org/NewCondition" />
                        <meta itemprop="availability" itemtype="http://schema.org/LimitedAvailability" />
                      </div>
                      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick"/>
                        <input type="hidden" name="hosted_button_id" value="<?php echo $sticker->buttonb_slug(); ?>"/>
                        <button type="submit" onclick="trackEvent('stickers', '<?php echo $sticker->title(); ?>', '<?php echo $sticker->buttonb_num(); ?> @ $<?php echo $sticker->buttonb_price(); ?>', <?php echo $sticker->buttonb_price(); ?>);"><?php echo $sticker->buttonb_num(); ?> @ $<?php echo $sticker->buttonb_price(); ?></button>
                      </form>
                    <?php endif; ?>
                    <?php if ($sticker->buttonc_slug() != ""): ?>
                      <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="name" content="<?php echo $sticker->buttonc_num(); ?> X <?php echo $sticker->title(); ?>" />
                        <meta itemprop="priceCurrency" content="USD" />
                        <meta itemprop="price" content="<?php echo $sticker->buttonc_price(); ?>" />
                        <meta itemprop="url" content="<?php echo $page->url(); ?>" />
                        <meta itemprop="itemCondition" itemtype="http://schema.org/NewCondition" />
                        <meta itemprop="availability" itemtype="http://schema.org/LimitedAvailability" />
                      </div>
                      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick"/>
                        <input type="hidden" name="hosted_button_id" value="<?php echo $sticker->buttonc_slug(); ?>"/>
                        <button type="submit" onclick="trackEvent('stickers', '<?php echo $sticker->title(); ?>', '<?php echo $sticker->buttonc_num(); ?> @ $<?php echo $sticker->buttonc_price(); ?>', <?php echo $sticker->buttonc_price(); ?>);"><?php echo $sticker->buttonc_num(); ?> @ $<?php echo $sticker->buttonc_price(); ?></button>
                      </form>
                    <?php endif; ?>
                  </div>
                </div>
              <?php } else if ($sticker->soldout() != "") { ?>
                <div class="detail full no-buttons" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                  <span>SOLD OUT</span>
                  <meta itemprop="availability" content="http://schema.org/SoldOut" />
                  <meta itemprop="priceCurrency" content="USD" />
                  <meta itemprop="price" content="3" />
                </div>
              <?php } else if ($sticker->released == "") { ?>
                <div class="detail full no-buttons">
                  <span>PRINTING</span>
                </div>
              <?php } ?>

            </div>
              <span itemprop="brand" itemscope itemtype="http://schema.org/PerformingGroup">
                <meta itemprop="name" content="<?php echo $site->title(); ?>" />
                <meta itemprop="url" content="<?php echo $site->url(); ?>" />
              </span>
          </div>
        <?php endforeach; ?>
      </div>
  
      <article class="full default" style="margin-top:20px;">
        <div class="splc-description">
          <?php echo $page->splc_desc()->kirbytext() ?>
          <?php $splc_total = (int)(string)$page->splc_total(); ?>
          <p>Sales of these stickers have contributed <strong>$<?php echo number_format($splc_total); ?></strong> to their campaign. Last donation made on <strong><?php echo date('F jS, Y', strtotime($page->splc_asof())); ?></strong></p>
        </div>
      <article class="full default">

      <div class="product-photos">
        <h3>Some Stickers in the world...</h3>
        <?php foreach($page->photos()->toStructure()->sortBy('series_num', 'desc') as $photo): ?>
          <div class="photo-holder">
            <img src="<?php echo $page->url() ?>/<?php echo $photo->pic()->filename() ?>" data-series="<?php echo $photo->series_num(); ?>" alt="<?php echo $photo->desc(); ?>" />
          </div>
        <?php endforeach; ?>
        <div class="share-your-photo">
          <?php echo $page->share_cta()->kirbytext(); ?>
        </div>
      </div>
      
      <!-- TAGS -->
      <?php if ($page->tags() != "") { ?>
        <div class="info-block episode-tags">
          <span class="label">Tags:</span>
          <ul itemprop="keywords" content="<?php echo $page->tags() ?>">
            <?php $etags = explode(",", $page->tags()); ?>
            <?php foreach($etags as $etag): ?>
              <?php $tagmatches = $site->grandChildren()->filterBy('tags', $etag, ','); ?>
              <?php $x = 0; ?>
              <?php foreach($tagmatches as $tagmatch): $x = $x+1; ?>
              <?php endforeach ?>
              <a <?php if ($x > 1): ?> href="<?php echo url::home() ?>/find/tag:<?php echo trim($etag) ?>" <?php endif ?>><?php echo trim($etag) ?></a>
            <?php endforeach ?>
          </ul>
        </div>
      <?php } ?>
  
    <section class="comments disqus">
      <?php snippet('disqus-alt', array('allow_comments' => true)) ?>
    </section>
    
  </main>

<?php snippet('footer') ?>