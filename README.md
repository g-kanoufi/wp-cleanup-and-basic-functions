WP Cleanup and Basic Functions
==============================

**Contributors:** guillaume-lostweb
  
**Donate link:** http://lostwebdesigns.com
  
**Tags:** cleanup, WordPress head cleanup, developers common functions, images settings, privacy settings, administration customizations
  
**Requires at least:** 3.5.1
  
**Tested up to:** 4.3
  
**Stable tag:** 2.0.2
  
**License:** GPLv2 or later
  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html
  

Head section cleanup and many usual custom settings used on every website setup as images settings and sizes, privacy, and basic admin customizations

Description
----------

WordPress Cleanup and Basic Options Functions is a utility plugin, even though it's was developed with a  focus on developers as many functionalities are what you might just add to every new website you build, it's really easy to use, just check the boxes corresponding to the set up you want.
It will help you:

*    Cleanup your website head and also some markup included with shortcodes section.
*    Prettify the search url, ex: http://yourwebsite.com/search/search-terms.
*    Load jQuery from Google CDN(default) or form your chosen cdn provider instead of using the hosted version.
*    Change the p to figure tag to surround your images.
*    Add Retina support for your images.
*    Add additional images sizes and modify those.
*    Setup a Logo and background color for your login page
*    Add some more privacy adding a "referrer" meta tag
*    If Yoast SEO is activated, can remove Yoast comments in head
*    Set up for SMTP email settings    

And actually many other things.
Also besides the retina options(where you will be able to choose whether add the script from CDN or not), this plugin won't add any scritp or styles to your website frontend

Stay tuned as it will get updated possibly often with new features


## Installation ##

### Using The WordPress Dashboard ###

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'wp-cleanup-and-basic-functions'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard
5. Customize the setting by clicking on the "WordPress Cleanup and Basic Options Functions" menu tab

### Uploading in WordPress Dashboard ###

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `wp-cleanup-and-basic-functions.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

### Using FTP ###

1. Download `wp-cleanup-and-basic-functions.zip`
2. Extract the `wp-cleanup-and-basic-functions` directory to your computer
3. Upload the `wp-cleanup-and-basic-functions` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard

## Frequently Asked Questions ##

### How to use WordPress Cleanup and Basic Options Functions? ###

Just activate the plugin then go to the "Settings -> WP Cleanup" menu and just check the options you want.

### Will WordPress Cleanup and Basic Options Functions slow my website? ###

Well this is actually the whole contrary, WordPress Cleanup and Basic Options Functions will reduce the cluter from your website head section getting rid of useless scripts and inline css.

### I am not a developer, should i use that plugin ###

Yes, just make sure you know what the option will do before you check it. But all these options are pretty basic options and won't break your website.

## Screenshots ##

###1. No screenshots yet
###
[missing image]


## Changelog ##

### 2.0.2 ###
Removed get rid of width and height in editor as it was breaking the "Add media" in post.

### 2.0.1 ### 
Fixed a saving small bug

### 2.0 ###
This is a big refactor of this plugin, all code have been cleaned, also thickbox for Media upload has been changed with wp.media || Warning you might have to reset your login logo || Added set up fields for SMTP email settings with email test.

### 1.1.1 ###
= 1.1.1 =
Fixed a small bug for admin logo upload and some typo errors

### 1.1 ###
Fixed a bug with image upload when Retina support was not checked, also added svg upload in the Media uploader.

### 1.0.1 ###
Fixed some notice error making all checkboxes checked on first save and added possibility to enter your how CDN provider and version for jQuery

### 1.0 ###
Initial Release

## Upgrade Notice ##

### 2.0.2 ###
Make sure to update if you are having issues with the "Add media" in post editor.

### 2.0 ###
Major refactor of the plugin, all code have been cleaned, also thickbox for Media upload has been changed with wp.media || Warning you might have to reset your login logo

### 1.0.1 ###
Many small bug and notices have been resolved, make sure to update your plugin
