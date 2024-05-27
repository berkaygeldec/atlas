function global() {
  return {
    isMobileMenuOpen: false,
    isDarkMode: false,
    themeInit() {
      if (
        localStorage.theme === "dark" ||
        (!("theme" in localStorage) &&
          window.matchMedia("(prefers-color-scheme: dark)").matches)
      ) {
        localStorage.theme = "dark";
        document.documentElement.classList.add("dark");
        this.isDarkMode = true;
      } else {
        localStorage.theme = "light";
        document.documentElement.classList.remove("dark");
        this.isDarkMode = false;
      }
      var logo = document.getElementById('site-logo');
      var footer_logo = document.getElementById('site-footer-logo');
      if (this.isDarkMode) {
        logo.setAttribute('src', logo.getAttribute('dark-src'));
        footer_logo.setAttribute('src', logo.getAttribute('dark-src'));
      } else {
        logo.setAttribute('src', logo.getAttribute('light-src'));
        footer_logo.setAttribute('src', logo.getAttribute('light-src'));
      }
    },
    themeSwitch() {
      var logo = document.getElementById('site-logo');
      var footer_logo = document.getElementById('site-footer-logo');
      if (localStorage.theme === "dark") {
        localStorage.theme = "light";
        document.documentElement.classList.remove("dark");
        this.isDarkMode = false;
        logo.setAttribute('src', logo.getAttribute('light-src'));
        footer_logo.setAttribute('src', logo.getAttribute('light-src'));
      } else {
        localStorage.theme = "dark";
        document.documentElement.classList.add("dark");
        this.isDarkMode = true;
        logo.setAttribute('src', logo.getAttribute('dark-src'));
        footer_logo.setAttribute('src', logo.getAttribute('dark-src'));
      }
    },
  };
}
document.addEventListener('DOMContentLoaded', function() {
  var globalInstance = global();
  globalInstance.themeInit();
});
