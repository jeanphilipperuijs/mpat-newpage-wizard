# MPAT NewPage Wizard #


## Case ##
Step by step creating MPAT pages.

This project is at the same time an example how to create a WordPress plugin for MPAT.
___

## Dependencies ##
This plugins depends of the [MPAT-Core plugin](https://github.com/MPAT-eu).

It uses the REST API v2 which is [built-in](https://wordpress.org/support/topic/rest-api-in-wp-4-7/) since WordPress 4.7.

The following error message will appear when starting the wizard if the plugin is missing:

```Missing the custom REST for Page Layouts http://[your-host]/wp-json/mpat/v1/layout. Have you installed "mpat-core-plugin" ?```
___

## Usage ##
This plugin adds by default at the top of the `page overview` a new button next to `Add New` to named `Wizard`.

In `General Settings` you can choose to replace instead of adding.
This is does the same as the following:

To replace the 'add new' button with the 'wizard':
<code>update_option('mpatNewPageWizard', 'on'));</code>

___
