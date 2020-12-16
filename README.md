# Contao Alertbox Bundle

Easily manage alert boxes and hints that should be shown on specific pages.

## Install

Download the alertbox bundle:

```bash
composer require slashworks/contao-alertbox-bundle
```

Update the database by going to **/contao/install** or via CLI:

```bash
vendor/bin/contao-console contao:migrate
```

## Usage

### Create alertboxes

Manage and create alertboxes from the new backend module "CONTENT > Alertboxes". Select the pages where this alertbox will be shown.
If you select a custom template, this will override your template selection in the front end module.

### Create and include front end module

Create a new front end module of type "Alertbox". This front end module has to be included on all the pages where your alertboxes should be shown. The easiest way is to add the front end module to your page layouts.

### General

Any styling or javascript interaction has to be included manually. You can edit the mod_sw_alertbox template or create new ones for every alertbox and make all your necessary changes.

## Release

Run the PHP-CS-Fixer and the unit test before releasing new versions:

```bash
vendor/bin/ecs check src/ tests/ --fix
vendor/bin/phpunit
```
