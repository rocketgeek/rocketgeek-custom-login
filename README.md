# RocketGeek Custom Login
RocketGeek Custom Login is a simple WordPress example plugin that creates a custom login screen.

## Assumptions
- This is a custom plugin and is not intended for general distribution.
- There is no customization ability in the WP admin. Any customization is done by editing the css and/or main plugin class.  (It's a "one-and-done" kind-of-thing.)

## Qualifications
Normally, a plugin created for general distribution would utilize OOP best practices, etc. However, for the purposes of this exercise, the plugin combines multiple elements and functions into as few files as possible within the plugin directory.

## Installation
- Install and activate like any other plugin.

## Customization
- This is intended as an example of what can be done.  It is assumed that you'll use this as a starting point for customizing your own login. However, this can be used "as is" - it's a fully working example that doesn't require change.
- 2 themes are included - light and dark.  If you don't want to do much customization, you can simple change the `$theme` variable value as desired ("dark" or "light").

## Notes
- Borrowed heavily from Adam Clark's project at https://github.com/avclark/10up-bcl
