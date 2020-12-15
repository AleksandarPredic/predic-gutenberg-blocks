# Custom Gutengerg blocks plugin
This plugin adds two custom blocks to the Gutenberg editor:
* Bet calculator with recent bets table
* Sports odds table

Those are two separate blocks.

## Theme support
This plugin was created for the default WP theme [Twenty Twenty-One](https://wordpress.org/themes/twentytwentyone/)  and is not guaranteed 
that it will look good on other themes.

## Installation
* Run `composer install`
* Run `npm install`
* Run `npm run dev` to start watching the files
* Run `npm run build` to build the bundle files for the production

That is all :) Happy codding!

## Dev dependencies
* PHP: 7.2 or above
* Composer
* Node package manager
* Node.js v15 or above

## Dev Features
* Dev JS and SCSS linters. Build (not dev) bundle process will fail if any errors 
* Webpack 4 for minification and dependency management
* SCSS
* ES6 syntax support for frontend JS files
* JS and CSS source maps

## Plugin features and descriptions

### Bet calculator
Being able to calculate how much a bet returns for any given stake is one of the basics of betting and
for that we need a Bet Calculator to simplify this process for our users. This is why the Bet calculator is developed.

It allows the user to calculate multiple bets using different odds formats.

#### Recent bets
This is a table, a part of the Bet calculator block, that sits below the calculator
and allows the user to see all his recent bets. 

When the user clicks on the `Clear` button in the calculator, this table will start
logging the new bets row. That way the user can see all his bets grouped by the payout.

### Sports odds table
Shows odds for top 10 games of user’s choice from Live Sports Odds API. 

User can use the filters to search: sport, region, market and team.
Table uses the JavaScript to apply the filters, so the user experience is at high level.

## Files

	assets/ 
	assets/
	├── css/ [Auto-generated styles bundle]
	├── js/ [Auto-generated JS bundle]
	├── scss/
	blocks/ [Gutenberg blocks files]
	├── bet-calculator/
	├── sports-odds-table/
	languages/ [translation files]
	src/ [PHP namespace with autoloader]
	├──Blocks/ [Blocks PHP files for dynamic rendering]
	.babelrc
	composer.json
	eslintrc.json
	package.json
	package-lock.json
	predic-blocks.php
	README.md
	stylelintrc.json
	webpack.config.js [Main plugin file]

## Preview images

### Bet calculator and recent bets table
![Block editor](https://gutenberg.acapredic.com/github-images/bet-calculator-block-preview.png)

![Block frontend](https://gutenberg.acapredic.com/github-images/bet-calculator-block.png)

### Sports odds table
![Block editor](https://gutenberg.acapredic.com/github-images/sports-odds-table-block-preview.png)

![Block frontend](https://gutenberg.acapredic.com/github-images/sports-odds-table-block.png)


## Real world example
As this is just an example, there are some tasks not done completely.

Here is a list of what needs to be finalizes when there is more time:

* Handle client side blocks re-rendering to avoid page cache problems
* Add Schema.org objects for the Sports odds table block
* Solve using multiple output css files with webpack 4 for mini-css-extract-plugin
* Extract translations
