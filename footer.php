<div class="container mx-auto">
  <div
    class="flex flex-col items-center justify-between border-t border-grey-lighter py-10 sm:flex-row sm:py-12"
  >
    <div class="mr-auto flex flex-col items-center sm:flex-row">
      <a href="/" class="mr-auto sm:mr-6">
        <img src="<?php bloginfo('template_url'); ?>/assets/img/logo.svg" alt="logo" />
      </a>
      <p class="pt-5 font-body font-light text-primary dark:text-white sm:pt-0">
        
      <?php echo get_theme_mod('custom_copyright_text', '©2024 <a href="https://github.com/berkaygeldec/atlas" target="_blank" title="Atlas is a Personal Blog WordPress theme made with the latest technologies like TailwindCSS.">Atlas</a>.'); ?>
      </p>
    </div>
    <div class="mr-auto flex items-center pt-5 sm:mr-0 sm:pt-0">
      <?php 
      $links = [
          'custom_github_link' => 'bxl-github',
          'custom_codepen_link' => 'bxl-codepen',
          'custom_linkedin_link' => 'bxl-linkedin'
      ];
      
      foreach ($links as $key => $icon) {
          $link = get_theme_mod($key);
          if ($link) {
              echo '<a href="' . esc_url($link) . '" target="_blank">
                      <i class="text-4xl text-primary dark:text-white pl-5 hover:text-secondary dark:hover:text-secondary transition-colors bx ' . esc_attr($icon) . '"></i>
                    </a>';
          }
      }
      ?>
      
    </div>
  </div>
</div>

    </div>

    <script src="<?php bloginfo('template_url'); ?>/assets/js/main.js"></script>

    <?php wp_footer(''); ?>
  </body>
</html>
