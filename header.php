<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link crossorigin="crossorigin" href="https://fonts.gstatic.com" rel="preconnect" />
    <link as="style" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="preload" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <link crossorigin="anonymous" href="
			<?php bloginfo('template_url'); ?>/assets/styles/main.min.css" media="screen" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/atom-one-dark.min.css" />
    <script>
      hljs.initHighlightingOnLoad();
    </script>
    <!--Alpine Js V3-->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <?php wp_head(''); ?>
  </head>
  <body x-data="global()" x-init="themeInit()" :class="isMobileMenuOpen ? 'max-h-screen overflow-hidden relative' : ''" class="dark:bg-primary">
  <div id="main">
      <div class="container mx-auto">
  <div class="flex items-center justify-between py-6 lg:py-10">
    <a href="/" class="flex items-center">
      <span href="/" class="mr-2">
      <?php
// Retrieve custom logo settings
$logo_type = get_theme_mod('custom_logo_type');
$template_url = get_bloginfo('template_url');
$logo_image = get_theme_mod('custom_logo_image');
$logo_text = get_theme_mod('custom_logo_text', 'John Doe');

// Determine the logo image source
$limg = $logo_image ? esc_url($logo_image) : esc_url($template_url . '/assets/img/logo.svg');
?>

<!-- Logo Image -->
<img src="<?php echo esc_url($logo_type == 'text' ? $template_url . '/assets/img/logo.svg' : $limg); ?>" alt="logo" />
</span>
<!-- Conditional Logo Text -->
<?php if ($logo_type == 'text') : ?>
    <p class="hidden font-body text-2xl font-bold text-primary dark:text-white lg:block">
        <?php echo esc_html($logo_text); ?>
    </p>
<?php endif; ?>
    </a>
    <div class="flex items-center lg:hidden">
      <i
        class="bx mr-8 cursor-pointer text-3xl text-primary dark:text-white"
        @click="themeSwitch()"
        :class="isDarkMode ? 'bxs-sun' : 'bxs-moon'"
      ></i>

      <svg
        width="24"
        height="15"
        xmlns="http://www.w3.org/2000/svg"
        @click="isMobileMenuOpen = true"
        class="fill-current text-primary dark:text-white"
      >
        <g fill-rule="evenodd">
          <rect width="24" height="3" rx="1.5" />
          <rect x="8" y="6" width="16" height="3" rx="1.5" />
          <rect x="4" y="12" width="20" height="3" rx="1.5" />
        </g>
      </svg>
    </div>
    <div class="hidden lg:block">
    <ul class="flex items-center">
      <?php wp_nav_menu(array(
        'theme_location' => 'primary',
        'container' => false,
        'items_wrap' => '%3$s', // Sadece menü öğelerini ekleyin, <ul> etiketini dışarıda tutun
        'walker' => new Custom_Walker_Nav_Menu()
      )); ?>
      <li>
        <i class="bx cursor-pointer text-3xl text-primary dark:text-white" @click="themeSwitch()" :class="isDarkMode ? 'bxs-sun' : 'bxs-moon'"></i>
      </li>
    </ul>
    </div>
  </div>
</div>

<div
  class="pointer-events-none fixed inset-0 z-50 flex bg-black bg-opacity-80 opacity-0 transition-opacity lg:hidden"
  :class="isMobileMenuOpen ? 'opacity-100 pointer-events-auto' : ''"
>
  <div class="ml-auto w-2/3 bg-green p-4 md:w-1/3">
    <i
      class="bx bx-x absolute top-0 right-0 mt-4 mr-4 text-4xl text-white"
      @click="isMobileMenuOpen = false"
    ></i>
    <ul class="mt-8 flex flex-col">
      
    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary', // Temanızda tanımlı menü konumunu belirtin
        'walker'         => new Custom_Mobil_Menu_Walker()
    ) );
    ?>
    </ul>
  </div>
</div>