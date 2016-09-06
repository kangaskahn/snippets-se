=== Snippets SE ===
Contributors: Matt Vona
Tags: content, replace, custom, variables
Requires at least: 4
Tested up to: 4.6
Stable tag: 1.0.3
License: GPLv2

Use custom {{variables}} across your site to display and manage information in multiple places.

== Description ==
The Snippets SE WordPress plugin allows you to create variables that render as different text on your site. You could use {{phone}} to display your company\'s phone number across your site, and only have to change it in 1 place. Make your own variables and customize them to do things!

Check out the [github repo](https://github.com/kangaskahn/snippets-se) for more information.

== Installation ==
Download and activate the plugin. A snippets admin menu will appear. Create, edit, organize, and manage your snippets. The title is the variable word, and the content is what it outputs when you place that word within two curly brackets: like {{this}} anywhere on your pages:

* Page content fields
* text widget title fields
* text widget content fields
* -Page titles- (This has been removed)
* excerpts

*Advanced: *
You can use the function `snippetsse_scanVar` for your own functions by adding a filter, like so:

`add_filter(\'the_content\', \'snippetsse_scanVar\');`

== Changelog ==
Current Version: v1.0.3
- Fixed bug that displayed all page and post names listed as first on list. This was a title issue. 
- No more support for the title. Unfortunately this causes issue with the admin panel. Hopefully will fix in later update.

v1.0.2
- Tested with WordPress 4.6

v1.0.1
- Updated function names to be specific to this WP plugin

v1.0.0
- Initial Release