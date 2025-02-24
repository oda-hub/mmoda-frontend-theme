<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup templates
 */

if ($is_front) {
  $page['content']['system_main']['default_message'] = array(); // This will remove the 'No front page content has been created yet.'
}
?>
<header id="navbar" role="banner"
  class="<?php print $navbar_classes; ?>">
  <div class="<?php print $container_class; ?>">
    <div class="navbar-header">
      <?php if ($logo): ?>
        <a class="logo navbar-btn pull-left"
        href="<?php print $front_page; ?>"
        title="<?php print t('Home'); ?>"> <img
        src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
      <a class="logo navbar-btn pull-left" target="_blank"
        href="https://www.unige.ch/sciences/astro/en/"
        title="Departement of Astronomy - university of Geneva"><img
        src="<?php print $base_path.$directory;?>/logo-fac-sciences.png" alt="Departement of Astronomy - university of Geneva" />
      </a>
      <a class="logo navbar-btn pull-left" target="_blank"
        href="https://www.isdc.unige.ch/integral/"
        title="The INTErnational Gamma-Ray Astrophysics Laboratory - INTEGRAL"><img
        src="<?php print $base_path.$directory;?>/logo-isdc.png" alt="The INTErnational Gamma-Ray Astrophysics Laboratory - INTEGRAL" />
      </a>
      <a class="logo navbar-btn pull-left"
        href="https://www.epfl.ch/labs/lastro" target="_blank"
        title="Laboratory of Astrophysics (LASTRO) - EPFL"><img
        src="<?php print $base_path.$directory;?>/logo-epfl.png" alt="Laboratory of Astrophysics (LASTRO) - EPFL" />
      </a>
      <a class="logo navbar-btn pull-left"
        href="https://apc.u-paris.fr/APC_CS/en" target="_blank"
        title="Laboratoire AstroParticule et Cosmologie (APC)"><img
        src="<?php print $base_path.$directory;?>/logo-apc.png" alt="Laboratoire AstroParticule et Cosmologie (APC)" />
      </a>
      <a class="logo navbar-btn pull-left"
        href="https://kau.org.ua/en" target="_blank"
        title="Kyiv Academic University (KAU)"><img
        src="<?php print $base_path.$directory;?>/logo-kau.png" alt="Kyiv Academic University (KAU)" />
      </a>
      <a class="logo navbar-btn pull-left"
        href="https://www.astro.unige.ch/astroordas" target="_blank"
        title="AstroORDAS"><img
        src="<?php print $base_path.$directory;?>/logo-astroORDAS.png" alt="AstroORDAS" />
      </a>
      <a class="logo navbar-btn pull-left"
        href="https://cordis.europa.eu/project/id/101131928" target="_blank"
        title="AstroORDAS"><img
        src="<?php print $base_path.$directory;?>/logo-acme.png" alt="ACME" />
      </a>
      <?php endif; ?>

      <!-- MTM disable site name
      <?php if (!empty($site_name)): ?>
        <a class="name navbar-brand" href="<?php print $front_page; ?>"
        title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
      <?php endif; ?>
      -->

      <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
        <button type="button" class="navbar-toggle"
        data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only"><?php print t('Toggle navigation'); ?></span>
        <span class="icon-bar"></span> <span class="icon-bar"></span> <span
          class="icon-bar"></span>
      </button>
      <?php endif; ?>
    </div>
        <div class="mmoda-user-menu btn-group pull-right" role="group">
          <?php  if (!$logged_in) :?>
          <div class="openid-connect-block pull-left">
           <?php
          module_load_include('inc', 'openid_connect', 'includes/openid_connect.forms');
          $form = drupal_get_form('openid_connect_login_form');

          print drupal_render($form);
          //print drupal_render(drupal_get_form('openid_connect_login_form'));
          ?>
          </div>
          <a title="Sign in"
            class="btn btn-default"
            href="<?=$base_path?>user/login"><span class="oda-icon-label">Sign in </span>
            <span class="glyphicon glyphicon-log-in"></span> </a>

          <a
            title="Sign up"
            class="btn btn-default"
            href="<?=$base_path?>user/register"><span class="oda-icon-label">Sign up </span>
            <span class="glyphicon glyphicon-user"></span> </a>
          <?php  else :?>
          <a
            title="My account"
            data-mmodaclass="ctools-use-modal ctools-modal-modal-popup-large btn btn-default"
            class="btn btn-default" target="_blank"
            href="<?=$base_path?>user"><span class="oda-icon-label">My account </span>
            <span class="glyphicon glyphicon-user"> </span> </a>
          <!--
            <a
            title="My account"
            class="ctools-use-modal ctools-modal-modal-popup-large btn btn-default open-in-modal" href="modal_forms/nojs/user/<?=$GLOBALS['user']->uid?>/change-password"><span
            class="oda-icon-label">Change password</span><span
            class="glyphicon glyphicon-lock"> </span> </a>
            -->
         <a
            title="Sign out"
            class="btn btn-default"
            href="<?=$base_path?>user/logout"><span class="oda-icon-label">Sign out </span>
            <span class="glyphicon glyphicon-log-out"></span> </a>
          <?php endif;?>
        </div>

    <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
      <div class="navbar-collapse collapse" id="navbar-collapse">
      <nav role="navigation">
          <?php if (!empty($primary_nav)): ?>
            <?php print render($primary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($secondary_nav)): ?>
            <?php print render($secondary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($page['navigation'])): ?>
            <?php print render($page['navigation']); ?>
          <?php endif; ?>
        </nav>
    </div>
    <?php endif; ?>
  </div>
</header>

<div class="main-container <?php print $container_class; ?>">

  <header role="banner" id="page-header">
    <?php if (!empty($site_slogan)): ?>
      <!-- MTM disable slogan
      <p class="lead"><?php print $site_slogan; ?></p>
       -->
    <?php endif; ?>

    <?php print render($page['header']); ?>
  </header>
  <!-- /#page-header -->

  <div class="row">


    <section class="col-sm-12">
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <?php

      if (! empty($breadcrumb)) :
        print $breadcrumb;
      endif;

      ?>
      <a id="main-content"></a>
      <?php print $messages; ?>
      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>
      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>
      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
    </section>


  </div>
</div>

