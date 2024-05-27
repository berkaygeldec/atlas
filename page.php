<?php get_header(''); if (have_posts()) : while (have_posts()) : the_post(); $reading_time = get_post_reading_time(get_the_content()); 

$category = get_the_category();
$category_name = !empty($category) ? esc_html($category[0]->name) : 'Uncategorized';
?>
<div><div class="container mx-auto">
  <div class="pt-16 lg:pt-20">
    <div class="border-b border-grey-lighter pb-8 sm:pb-12">
      <h2
        class="block font-body text-3xl font-semibold leading-tight text-primary dark:text-white sm:text-4xl md:text-5xl"
      >
        <?php the_title(''); ?>
      </h2>
    </div>
    <div
      class="prose prose max-w-none border-b border-grey-lighter py-8 dark:prose-dark sm:py-12"
    >
     <?php echo the_content(''); ?>

    </div>

    <div class="flex items-center py-10">
      <span class="pr-5 font-body font-medium text-primary dark:text-white"
        >Paylaş</span
      >
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">
    <i class="bx bxl-facebook text-2xl text-primary transition-colors hover:text-secondary dark:text-white dark:hover:text-secondary"></i>
</a>
<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank">
    <i class="bx bxl-twitter pl-2 text-2xl text-primary transition-colors hover:text-secondary dark:text-white dark:hover:text-secondary"></i>
</a>
<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank">
    <i class="bx bxl-linkedin pl-2 text-2xl text-primary transition-colors hover:text-secondary dark:text-white dark:hover:text-secondary"></i>
</a>
<a href="https://reddit.com/submit?url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank">
    <i class="bx bxl-reddit pl-2 text-2xl text-primary transition-colors hover:text-secondary dark:text-white dark:hover:text-secondary"></i>
</a>

    </div>
  </div>
</div>
</div>
<?php endwhile; else : endif; wp_reset_query();  get_footer(''); ?>