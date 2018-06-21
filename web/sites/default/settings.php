<?php

// @codingStandardsIgnoreFile

$databases = array();
$databases['default']['default'] = [
  'database' => getenv('DRUPAL_DB_NAME'),
  'driver' => 'mysql',
  'host' => getenv('DRUPAL_DB_HOST'),
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'password' => getenv('DRUPAL_DB_PASSWORD'),
  'port' => getenv('DRUPAL_DB_PORT'),
  'prefix' => '',
  'username' => getenv('DRUPAL_DB_USER'),
];

$config_directories = array();
$config_directories['sync'] = '../config/sync';

$settings['hash_salt'] = getenv('DRUPAL_HASH_SALT');

$settings['entity_update_batch_size'] = 50;
$settings['update_free_access'] = FALSE;
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];
$settings['install_profile'] = 'standard';

if (getenv('DRUPAL_MODE') == 'development') {
  assert_options(ASSERT_ACTIVE, TRUE);
  \Drupal\Component\Assertion\Handle::register();
  $settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';

  $config['system.logging']['error_level'] = 'verbose';

  $config['system.performance']['css']['preprocess'] = FALSE;
  $config['system.performance']['js']['preprocess'] = FALSE;

  $settings['skip_permissions_hardening'] = TRUE;
}
