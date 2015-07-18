# MyFirst Wordpress Theme
This is a public version of my first wordpress theme ever build (which can be obviously seen in the code), and describes my journey of getting into programming and WordPress. Now it is freely available for downloads!

##Theme Includes
* Fully HTML 5, and CSS3 enhancements for navigation.
* Responsive for different devices, responsive dropdown menu for resolutions under 640px.
* Comptabible with Chrome, Firefox, Internet Explorer 8+, Opera, Safari
* Semantic schemes (microdata and microschemes)
* Jquery Slider, small and largeversion
* Additional Sidebars for footer and pages
* Custom Content Type for Slider, items in slider are handles as a different post.
* Custom Content Type for Portfolio projects, Services, Work Approaches, Members or Employees and Testimonies or Clients
* Ability to display a number of posts styled in large or smallboxes on the homepage
* Styled smaller postboxes that can display posts in a masonry manner, i.e. different elements are not floated but stacked on each other (except for IE).
* Social media settings for following in header and for sharing in single posts
* SEO optimalisation based on used tags, categories, category description and additional meta keywords that can be filled in the theme settings page.
* Styled page elements
* Dynamic copyright based on the first and last postdate.
* Pagination for category, archive, or author pages
* Breadcrumbs for single posts and pages.
* Uses 2 custom menus
* This theme uses featured images for posts, which are displayed in the top of posts, 
and as thumbnail in archives, category archives, tag archives, author archives, portfolio pages, service pages, member pages, testimony pages, about page and archives. 

* Custom widget for making a readmore box
* Custom widget for displaying random posts
* Custom widget for displaying featured posts
* Custom widget for displaying recent news

* Custom Shortcodes for displaying: 
	* A download / view button with different colors (normal, red or green) [dlbutton url="url.com" class="normal"]Button Title[/dlbutton]. The class can be input with a certain color. You can also add the attributes size="normal" (accepts normal, large and small), target="_blank" (accepts _blank, _new and _self) and roundness="squared" to make the button squared.
	* A box shortcode with different colors: red, green, purple, yellow, blue or neutral [box  class="blue"]Colored Box[/box].
	* 3 Different ads inserted in the theme settings panel [adsense1] [adsense2] [adsense3]
	* Columns (2/3/4): 
		- [column class="two"]Content[/column] [column class="two-last"]Content[/column],
		- [column class="three"]Content[/column] [column class="three"]Content[/column] [column class="three-last"]Content[/column]
		- [column class="four"]Content[/column] [column class="four"]Content[/column] [column class="four"]Content[/column] [column class="four-last"]Content[/column]
		- other possible classes: two-thirds, two-thirds-last, three-fourth, three-fourth-last. 
	* Pullquotes [pull class="left"]Quote here[/pull]
	* [twitter] for displaying twitter following button
	
* Theme Settings page with settings for Analytics and ad management as well: 

## Recommended Knowledge
* Recommended size for small images in the slider are 960 * 480, the large slider automatically resizes area to screen height minus header. Please be aware that the focal point of images is within this frame.
* Recommended size for images used as feature image, which will then also be used for creating thumbnails, is 630*372, 
otherwhise they will be cropped automatically.
* When switching themes, the data from custom post types and metaboxes will be still in the database, but will not appear in your dashboard anymore.
* When entering urls for example slider images, please fill in the complete url including http://.
* Most javascripts are entered in one single file, functions.js

##Documentation

### Making Connections
If you install the [posts 2 posts plugin](https://wordpress.org/plugins/posts-to-posts/ "Post 2 Posts"), you can add connections. At portfolio projects, you can link

### Custom Post Types
The theme support various custom post types which you can load in the following manner:
* Portfolio Projects: These can be load by using the page template: Portfolio when setting up a page.
* Services: These can be load byusing the page template: Services
* Clients: These can be load by using the page template: Testimonies
* Work Process: These can be load by using the page template: Work Approach. Each Work Process is basically a step in your companies unique work process. 
* Posts: These can be load by using the page template: Posts. You can also link to them using categories.
* Custom Widgets: In the metaboxes for posts, pages, portfolio projects and services you can disable the default sidebar and decide to load custom widgets. Then, the content you enter in one or more of your custom widgets will be loaded in your sidebar.
* Slides: Slides are used on the homepage and are rendered through the index.php template if you enabled them in the themesettings. 

### Themesettings
You can find the themesettings panel under Appearance > Theme Settings in your Admin Menu. There are several options:
* Defining your general lay-out which is used by all templates
* Define your about, contact or policies page path (if entered, these will be automatically rendered in your footer)
* Define your page locations for your pages using custom page templates. Important, as can be used by the breadcrumbs.
* Define your settings for the homepage, such as introductionary quotes, loading slides and other kind of custom content.
* Define settings for single blog posts and archives, such as the lay-out, related posts and more.
* The settings for your portfolio projects, such as the lay-out for portfolio taxonomy archives and related projects
* Your social media accounts
* Your analytics code and custom advertising code
* Theme SEO options such as homemade cookies.. eeuh breadcrumbs and disabling default seo set-up.


### Metaboxes
Each of the post types has additional metaboxes (fields under the main editing screen) which help you to add data.
At pages, posts, services and portfolio projects you can change the following aspects:
* Add a subtitle (except for posts)
* Change lay-out settings
* Change settings for related projects or posts (for posts and projects)
* Change page template related settings (if using a page template, such as the contact page template)
* The use of custom widgets.
* Add a post loop under the single item (you can add a small archive of any post type under the main content)

For some custom content types, you have additional metaboxes you can fill in:
* Services: detail fields which are automatically add to your sidebar
* Projects: fields for displaying images or videos, automatically rendered in a slider
* Projects: fields for displaying client info and project links
* Members: fields for displaying the member role and his social profiles
* Slides: the caption, title and background for the slide, and a possible video. 

### File Structures
* All theme template files are placed in the root folder of the theme
* All admin functions are placed in the admin folder
* All extra functions, such as shortcodes, widgets, registering of custom post types and custom functions are placed in inc folder.
* The default index.php loads a homepage which can be set-up using the themesettings.
* Images and JS are logically placed in respectively the img and js folder.
