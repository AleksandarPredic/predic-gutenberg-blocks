<?php
// Init the class method that will be called on the server side rendering
$sportsBlocksTable = \PredicBlocks\Blocks\Templates\SportOddsTable::getInstance();
$sportsBlocksTable->initAjaxHooks();
$sportsBlocksTable->registerDynamicBlock();
