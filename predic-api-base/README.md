# Base API plugin
This plugin is created separately, so it can be used as a base for an API requests for our themes
and plugins.

## Configuration
Install plugin via WP Admin interface and then visit the WP Admin settings page 
` Settings -> Predic API Settings` to fill in the `API key` and `API host` data.

## Installation
* Run `composer install`

That is all :) Happy codding!

## Dev dependencies
* PHP: 7.2 or above
* Composer

## Features

### No direct class calls in other plugins
For the API calls in other plugins we use `filters` so in case our plugin is deactivated or 
we change a Class name, nothing will happen, and we don't need additional refactor.

To get data use this filters in other themes or plugins:

* `apply_filters('predic_api_base_get_odds', $region, $sport, $market);`
* `apply_filters('predic_api_base_get_sports', null);`

### Admin settings page for API key and host
Under WP Admin settings menu, `Settings -> Predic API Settings`, you need to enter you API key and API host for the RapidAPI.

**Important**: If those entries are empty, the blocks' plugin will not work properly.

### Admin notice
If the plugin settings fields are empty, the Admin notice will be displayed to remind the user that the 
blocks plugin will not work properly.

### Transient cache for API requests 
Every API request will be cached for an hour. This applies only for the one combination of 
sport, market and region. If this combination changes, the API will make a new request and cache it for that 
given combination. Every combination will create its own cache and will last an hour.

## WP Unit Tests
Follow this steps to run unit tests (Linux):
* Run `composer install`
* Run `cd {path to this plugin dir}`
* Run `bash bin/install-wp-tests.sh wordpress_test root '' localhost latest`.
  Replace “root” with the username of your database and replace ” with the database password. Also replace “localhost” with the hostname of your database.
* Run tests with `./vendor/bin/phpunit` or use an alias of your choice

If you have problems setting up the tests, here are the [docs](https://make.wordpress.org/cli/handbook/misc/plugin-unit-tests/) 

## Files

	bin/ [WP Unit tests bin]
	├── languages/ [translation files]
	├── src/ [PHP namespace with autoloader]
	├── tests/ [WP Unit tests]
	.phpcs.xml.dist
	.travis.yml
	composer.json
	phpunit.xml.dist
	predic-api-base.php [Main plugin file]
	README.md

## Real world example
As this is just an example, there are some tasks not done completely.

#### Here is a list of what needs to be finalizes when there is more time:
* Cover all classes with WP unit tests
* Extract translations
