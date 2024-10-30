=== Image Scrolling Gallery FX ===
Contributors: flashxml
Tags: images, photos, widget, post, plugin, posts, sidebar, image, scroll, gallery, free, flash, images, text, effects, as3, thumb, animation, tooltip, roll, over, out, css, vertical, horizontal, html, background, shade, xml, bestfit, boxfit, slideshow
Requires at least: 2.8.0
Tested up to: 3.0.1
Stable tag: trunk

An original "Image Scrolling Gallery". Completely XML customizable without any Flash knowledge. And it's free!

== Description ==

You can integrate it in any website for free without even using Flash. It's fully customizable and uses the Image Scroller FX component, having the same customizable variables of the scroller and adding many gallery properties, image transitions and text effects. The image scroller can be placed on any position. The images in the gallery can be shown as boxFit, bestFit or forceFit. The specific properties of the Image Scroller FX like  vertical or horizontal alignment, roll over behaviors, thumb spacing, scrolling and speed properties, HTML/CSS formatted tooltip, background and shade properties are also available.

== Installation ==

Make sure your Wordpress version is greater than 2.8 and your hosting provider is using PHP5.

1. There are two files to download: [WordPress Plugin](http://downloads.wordpress.org/plugin/image-scrolling-gallery-fx.zip "Image Scrolling Gallery FX Plugin") (that you have to install and activate) & [Free package](http://www.flashxml.net/free/download/image-scrolling-gallery.zip "Image Scrolling Gallery FX")
2. Create a new folder inside your **wp-content** folder called **flashxml**, inside this folder create a new one called **image-scrolling-gallery-fx** and copy the content of the **free package** there
3. If you copied the **free package** to a location different than the one above, go to **Image Scrolling Gallery FX** from the **Settings** tab in your **WordPress Dashboard** and update the path accordingly
4. Add `[image-scrolling-gallery-fx width="600" height="400"][/image-scrolling-gallery-fx]` where you want the Flash to show up in your post/page. Don't forget to provide your own width and height values, since 600 and 400 are just examples
5. If you want to make the Image Scrolling Gallery FX part of your theme, edit the template files and add `<?php imagescrollinggalleryfx_echo_embed_code(600, 400); ?>` where you want it to show up
6. Go to [FlashXML.net](http://www.flashxml.net/ "Free Flash Components") and [customize your Image Scrolling Gallery FX](http://www.flashxml.net/image-scrolling-gallery.html "Image Scrolling Gallery FX") using the Live Demo. Generate the `settings.xml` text and use it to overwrite `wp-content/flashxml/image-scrolling-gallery-fx/settings.xml`, `wp-content/flashxml/image-scrolling-gallery-fx/fxImageScroller/settings.xml` and `wp-content/flashxml/image-scrolling-gallery-fx/holder/settings.xml` files accordingly
7. To use your own images, upload them to `wp-content/flashxml/image-scrolling-gallery-fx/images/` and update the `wp-content/flashxml/image-scrolling-gallery-fx/images/thumbs.xml` and `wp-content/flashxml/image-scrolling-gallery-fx/images/big.xml` files accordingly

= No Flash support text =

To support visitors without Adobe Flash Player, you can provide alternative content by adding the text between `[image-scrolling-gallery-fx width="600" height="400"]` and `[/image-scrolling-gallery-fx]`. If you made the Flash part of your theme, add the text as **the third argument** of the `imagescrollinggalleryfx_echo_embed_code()` function call (for example `<?php imagescrollinggalleryfx_echo_embed_code(600,400,"Alternative content"); ?>`).

= Additional settings file =

To embed the Image Scrolling Gallery FX more than once, you will need another set of settings file and (probably) another set of images. Let's assume your new files are called `settings2.xml`. Add `[image-scrolling-gallery-fx width="600" height="400" settings="settings2.xml"][/image-scrolling-gallery-fx]` where you want the Flash to show up in your post/page. If you made the Flash part of your theme, add the file name as **the fourth argument** of the `imagescrollinggalleryfx_echo_embed_code()` function call (for example `<php imagescrollinggalleryfx_echo_embed_code(600,400,"Alternative content","settings2.xml"); >`).

= Getting rid of the FlashXML.net label =

To remove the FlashXML.net label from the top-left corner you'll need to buy the [paid package](http://www.flashxml.net/image-scrolling-gallery.html" Image Scrolling Gallery FX"). Once you'll do that, simply use the SWF file from the paid package to overwrite the SWF file from the `wp-content/flashxml/image-scrolling-gallery-fx/` folder.

== Screenshots ==

1. The Live Demo on [FlashXML.net](http://www.flashxml.net/image-scrolling-gallery.html "Image Scrolling Gallery FX") is the utility that helps easily customize your Image Scrolling Gallery FX to fit all your needs.