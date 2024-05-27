<?php get_header(''); ?>

      <div><div class="container mx-auto">
  <div class="border-b border-grey-lighter py-16 lg:py-20">
    <div>
      <img src="<?php bloginfo('template_url'); ?>//assets/img/author.png" class="h-16 w-16" alt="author" />
    </div>
    <h1
      class="pt-3 font-body text-4xl font-semibold text-primary dark:text-white md:text-5xl lg:text-6xl"
    >
      <?php echo get_theme_mod('custom_hi_text', 'Hi, I’m John Doe.'); ?>
    </h1>
    <p class="pt-3 font-body text-xl font-light text-primary dark:text-white">
    <?php echo get_theme_mod('custom_hi_desc', 'A software engineer and open-source advocate enjoying the sunny life in Barcelona, Spain.'); ?>
    </p>
    <a
      href="<?php echo get_theme_mod('custom_hi_button_url', 'https://www.berkaygeldec.com.tr/'); ?>"
      class="mt-12 block bg-secondary px-10 py-4 text-center font-body text-xl font-semibold text-white transition-colors hover:bg-green sm:inline-block sm:text-left sm:text-2xl"
    >
    <?php echo get_theme_mod('custom_hi_button_text', 'Say Hello!'); ?>
    </a>
  </div>

  <div class="border-b border-grey-lighter py-16 lg:py-20">
    <div class="flex items-center pb-6">
      <img src="<?php bloginfo('template_url'); ?>/assets/img/icon-story.png" alt="icon story" />
      <h3
        class="ml-3 font-body text-2xl font-semibold text-primary dark:text-white"
      >
      <?php echo get_theme_mod('custom_about_title', 'About me'); ?> 
      </h3>
    </div>
    <div>
      <p class="font-body font-light text-primary dark:text-white">
        <?php echo nl2br(esc_html(get_theme_mod('custom_about_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nibh mauris cursus mattis molestie. Et leo duis ut diam. Sit amet tellus cras adipiscing enim eu turpis. Adipiscing at in tellus integer feugiat.'))); ?>
      </p>
    </div>
  </div>

  <div class="py-16 lg:py-20">
    <div class="flex items-center pb-6">
        <img src="<?php bloginfo('template_url'); ?>/assets/img/icon-story.png" alt="icon story" />
        <h3 class="ml-3 font-body text-2xl font-semibold text-primary dark:text-white">
            <?php echo get_theme_mod('custom_latest_title', 'Latest posts'); ?> 
        </h3>
    </div>
    <div class="pt-8" id="load-content">
        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'paged' => $paged
        );

        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) :
            $counter = 0;
            while ($the_query->have_posts()) : $the_query->the_post();
                $category = get_the_category();
                $category_name = !empty($category) ? esc_html($category[0]->name) : 'Uncategorized';
                $setup = new ThemeSetup();
                $category_class = $setup->get_category_label($counter);
                $reading_time = $setup->get_post_reading_time(get_the_content());
                ?>
                <div class="border-b border-grey-lighter pb-8 <?php echo ($counter !== 0) ? 'pt-10' : ''; ?>">
                    <span class="mb-4 inline-block rounded-full px-2 py-1 font-body text-sm <?php echo $category_class; ?>">
                        <?php echo $category_name; ?>
                    </span>
                    <a href="<?php the_permalink(); ?>"
                       class="block font-body text-lg font-semibold text-primary transition-colors hover:text-green dark:text-white dark:hover:text-secondary">
                        <?php the_title(); ?>
                    </a>
                    <div class="flex items-center pt-4">
                        <p class="pr-2 font-body font-light text-primary dark:text-white">
                            <?php echo get_the_date(); ?>
                        </p>
                        <span class="font-body text-grey dark:text-white">//</span>
                        <p class="pl-2 font-body font-light text-primary dark:text-white">
                            <?php echo $reading_time; ?>
                        </p>
                    </div>
                </div>
                <?php
                $counter++;
            endwhile;
        endif;

        wp_reset_postdata();

        ?>
    </div>
    <?php if ($the_query->max_num_pages > 1) : ?>
        <button class="load-more flex items-center pt-5 font-body italic text-green transition-colors hover:text-secondary dark:text-green-light dark:hover:text-secondary">
            Daha fazla yükle
        </button>
    <?php endif; ?>
</div>
<?php 

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'post_type' => 'my_projects',
    'paged' => $paged
);

$the_query = new WP_Query($args);
if ($the_query->have_posts()) : 
    ?>
  <div class="pb-16 lg:pb-20">
    <div class="flex items-center pb-6">
      <img src="<?php bloginfo('template_url'); ?>//assets/img/icon-project.png" alt="icon story" />
      <h3
        class="ml-3 font-body text-2xl font-semibold text-primary dark:text-white"
      >
        Projeler
      </h3>
    </div>
    <div>
      <?php 

    while ($the_query->have_posts()) : $the_query->the_post();
    ?>
      <a
        href="<?php the_permalink(''); ?>" title="<?php the_title(''); ?>"
        class="mb-6 flex items-center justify-between border border-grey-lighter px-4 py-4 sm:px-6"
      >
        <span class="w-9/10 pr-8">
          <h4
            class="font-body text-lg font-semibold text-primary dark:text-white"
          >
            <?php the_title(''); ?>
          </h4>
          <p class="font-body font-light text-primary dark:text-white">
            <?php echo get_the_excerpt(); ?>
          </p>
        </span>
        <span class="w-1/10">
          <img src="<?php bloginfo('template_url'); ?>//assets/img/chevron-right.png" class="mx-auto" alt="chevron right" />
        </span>
      </a>
      <?php 
    endwhile; ?>
    </div>
  </div>
  <?php endif; ?>
</div>
</div>
<?php get_footer(''); ?>