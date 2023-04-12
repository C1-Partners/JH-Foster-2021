/**
 * Tabs
 * ------
 */

if($('.nav-tabs').length) {
 let hash = window.location.hash;
 hash && $('ul.nav a[href="' + hash + '"]').tab('show');

 $('.nav-tabs a').click(function (e) {
     $(this).tab('show');
     let scrollmem = $('body').scrollTop() || $('html').scrollTop();
     window.location.hash = this.hash;
     $('html,body').scrollTop(scrollmem);
 });
}