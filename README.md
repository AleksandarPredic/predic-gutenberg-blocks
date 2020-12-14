# Gutenberg example project

## Description
This projects represents an example of building plugins using external API service and integrating that data 
into the Gutenberg blocks.

## Dependencies
* WordPress (the lates version, the better)
* Active Gutenberg editor (Not disabled)
* PHP: 7.2 or above
* Composer autoloader dependency
* Node package manager

## Development process
* Clone the repository
* Run `npm install`
* Visit every plugin README.md file and follow the instructions for the installation.
* The advice is to use Symbolic links to link the folders to the external WP installation and not to copy the 
whole repository to the wp-content/plugins directory.
  
## Generate plugin zip file for the production
* Run `npm run bundle-base` and the file `predic-api-base.zip` will be generated 
in the repository root directory. This is a file you can upload to your WP site.
* Run `npm run bundle-blocks` and the file `predic-blocks.zip` will be generated
  in the repository root directory. This is a file you can upload to your WP site.
  
This zip files will already have installed composer vendor files ready for the production, so 
you have no extra work to do.

## Manual plugin zip and production setup
* Clone the repository
* Visit each plugin folder and run `npm install` and `composer install`
* Zip the plugin folders and upload them to your WP installation
  
## Plugin descriptions
Each plugin folder contains its own readme file with precise instructions and descriptions.

* [Predic API Base plugin](predic-api-base/)
* [Gutenberg custom blocks plugin](predic-blocks/)

## Files

    predic-api-base/ [API base files]
    predic-blocks/ [Blocks plugin files]
    .editorconfig
    .gitignore
    .php_cs
    package.json
    package-lock.json
    README.md


