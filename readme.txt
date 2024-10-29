=== Plugin Name ===
Contributors: gh3
Tags: multilanguage, multi, language, babel, multi language
Requires at least: 1.5
Stable tag: 0.65

Babel allows you to write your blog contents in multilanguage.
 
== Description ==

Babel is an interesting plugin that allows you to write your blog content in multilanguage in an easy way, using simple tags in your post.
If you are interested in more info about this plugin point your browser to this page: http://p.osting.it/my-works/babel/

== Installation ==

1. Upload all the files in `/wp-content/plugins/babel/` directory
If you want different languages, or flags you have to create two gif per each language called in this way:

`lang_tag.gif 
lang_tag_d.gif`

lang_tag is the tag that you can setup in babel.php file (for more info about add/modify languages read Faqs)

2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php babelize(); ?>` in your templates
4. You can start writing blog contents in multiple language using tags like:
`[en]post in english[/en]
[it]post in italian[/it]`

== Frequently Asked Questions ==

= How to use? =

You have only to write post, tagging each language:

eg. `[it]Italiano[/it] [en]English[/en]`

For titles, you have to write as normal title inside post, the one in the language you have set as default in babel.php file.

Then you have only to scroll till Custom Fields and add:

key: the short tag of the language ( eg. it or en, etc )
value: the title text

I have to write tags with spaces to let you see how to, but you haven’t to leave any spaces inside tags, or the system won’t work at all.

= How to change default language? =

You have to open babel.php file and set all the default value in arrayLang variable to 0, execpt for the one you want to set as default visible.

= How to add a language support? =

You can do following these steps:
Open babel.php
Look at arrayLang var
Point your mouse between after this line: 
`1 => array ( ‘lang’ => ‘it’,‘default’ => ‘0′,‘title’ => ‘Italiano’)

Add a comma and press enter

Add a new lang increasing the first number to 2, and setting all the info like: 

`2 => array ( ‘lang’ => ‘fr’,‘default’ => ‘0′,‘title’ => ‘French’)`

The last thing you have do to, is to put inside the babel directory two images called in the same way as ‘lang’ attribue in the array.

Eg.
If ‘lang’=>’fr’ we will have to name the two gifs like: fr.gif ( the active flag one ) and dfr.gif ( for the disabled one )

= How to localize menu?= 

Menu localization is actually on alpha stage, so it could not work perfectly.

Its usage is very simple, look at this example:
`<?php _b(”testo”,”link”,”it”); _b(”text”,”link”,”en”);?>`

= I got a trouble with titles, how to solve it? =

I saw that some templates misuse the the_title function for the anchor title value too, and this generate some troubles with Babel.

The solution to this problem is very easy, you have to edit a couple of your template files ( in particular single.php, index.php and page.php ).

First of all you have to find this line:

`title="Permanent Link to <?php the_title(); ?>"`

and the replace with this one:

`title="Permanent Link to <?php echo strip_tags(get_the_title()); ?>"`

= <!--more--> problem how to fix ? =

More problem is very easy to fix with a simple workaround, you have just to write a post doing this:

`[it]Before more italian[/it]
[en]Before more english[/en]
<!--more-->
[it]After more italian[/it]
[en]After more english[/en]`