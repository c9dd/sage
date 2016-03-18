#Legal
Fewbricks and its developers are in no way associated with Advanced Custom Fields. Fewbricks is released under GPLv3.

#Fewbricks

Fewbricks is a module system developed by [FEW Agency](http://fewagency.se). It is built on top of the awesome plugin [Advanced Custom Fields](http://www.advancedcustomfields.com/) (ACF) v5 PRO meaning that you must have that installed for this to work.

The system was created for the following reasons:
 
 * Portability and reusability. Almost all web sites have a couple of building blocks (bricks or modules) in common. This can, for example, be "plain text", "image with text to the right", "image with text to the left", "image", "YouTube-video" and so on. Using a module system which is completely built using code (instead of storing settings in the database as ACF does out of the box) we can reuse such bricks without setting them up every time we set up a new site. Yes, ACF does come with the export functionality but it is still cumbersome to cherrypick bricks for each project.
 
 * Flexible ACF. This is probably the most important, and also the original, reason as to why this system was created. Since, in Fewbricks, all ACF-fields are set up using code, we can reuse fields and even other bricks across multiple bricks. This means that if we need to have, for example, a button in multiple bricks and places, we can create that brick once and then reuse that code all over the place. Now, imagine that the button have multiple settings and must give the administrator the ability to select a style and a functionality (internal link, external link, mail, download etc.) every time a button is used. Having to set that up in multiple times in ACFs visual editor would be a lot of work and you know that the client will want to add new functionality to the button all of a sudden :)
 
 * Cleaner way to output HTML. By having each brick outout its own HTML, figuring out where to make changes in a brick becomes a breeze. Even if the brick is used in multiple places and loops, the HTML is edited in one place.
 
 * Easier to see what fields belong to a brick. Instead of having to switch between WP Admin and code to see what you named a specific field, you have it all in one brick class file.
 
 * Extensibility. Since each brick is a class, we can easily create a new brick which adds new fields and/or its own output.
   
##Requirements
PHP 5.4+

[Advanced Custom Fields](http://www.advancedcustomfields.com/) 5+ PRO

[Hidden field for Advanced Custom Fields](https://github.com/folbert/acf-hidden) This allows us to store settings in a brick. For example how many columns a multi column brick should have.

##Basic idea
Field groups, flexible content, repeaters and fields. All of those are names that you recognize from ACF and they are all available in Fewbricks as well. Just as in ACF, you create a field group and then you add some fields to it. If the field is a flexible content, you will add layouts to it. If you are creating a repeater, throw a couple of sub fields in there. All just as you would if you were creating field groups using ACFs GUI. But Fewbricks also gives you the ability to reuse bricks across multiple field groups and/or flexible contents and/or repeaters.
 
 That way, you can create a complex set up once and then reuse it all over the place.
 
 Some experience with ACF and knowledge about what a field, field group etc is is recommended and that can all be read up on in the [documentation for ACF](http://www.advancedcustomfields.com/resources).
 
 We recommend that you create at least one test field group using ACFs GUI and set it's location settings to "post type is equal to post" _and_ "post type is equal to page". That way the field group will never show up anywhere in the administration system and you can use it as a playground.
 
##Installation
 1. Make sure that the requirements are met
 2. Download this repo and unzip it to a directory named fewbricks in your themes directory
 3. Include or require the file init.php found at the root of this package

##Fields
The field types that are available for creating bricks are exactly the same field types that can be used in ACF. The settings for each field are also the same and have the same name as in ACF. This means that if you want to find out what you can do with a field you can either look in the class for that field, located in lib/acf/fields, or you can create a field in ACFs GUI and then use ACFs export-to-code-functionality to see the available options for a field and how they should be set. If ACF is updated with new field options, it doesn't matter if those options are available in the field classes in lib/acf/fields or not since they will be merged with ACFs field classes anyways.

The settings that all fields have in common are key, name and label:

* label - The text displayed to the administrator as label for the input field.

* name - Must be unique on its level. This means that if you create a bunch of field instances in a brick, you can not give two fields in the brick the same name. However, if you for example are re-using bricks in a brick, you don't have to worry that a field in the re-used bricks may have the same name as a field in the "master brick".

* key - **Must be a unique value across the theme.** This value must never be changed since it is what ACF uses to find data in the database. We recommend that you use something like the time and date for this. So for example if you are registering a field at 10.45 on April 6, 2015, you would set the key to something like 1504061045u (or whatever format you like your dates in) where the last character is a random one. Unless you register another brick at the same minute and for some reason use the same random letter, you will never risk having two identical values. You can *not* use a dynamic value such as time(). Also note that you *must* add a letter somewhere in the key. If you put Fewbricks in developer mode (se separate section in this ReadMe), you will get a warning if you have used duplicate keys.   
 
* settings - You can set all other settings that a field have by passing an associative array as the third argument when creating a field instance. Any keys in that array should correspond to keys in the `base_settings` in each field class in lib/acf/fields/.

**Note:** If you add an add-on field, you must create a field-class for that field in lib/acf/fields/. Just as we have done with the hidden field.

##Creating a brick

###General
Each brick has its own class placed in the folder named "bricks". Each class have a number of fields. Field instances can either be created directly in a brick, but a brick may also reuse existing bricks.
 
 First, make sure that a brick that does exactly what you want to achieve does not already exist. If it doesn't, see if a brick doing almost what you want to achieve exists. If it does, consider extending that brick or at least copy the existing code and use it as a start template for your new brick.
 
 If you need to write a brick from scratch: create a new file in the bricks folder and give it a name that describes what the brick does. Try to keep this short but still logical, for example text-and-list.php would hold the class text_and_list and consist of a field for text and maybe a repeater for list items.
 
 A brick-class must extend `project_brick` and have at least these functions:
  
 * `set_fields()` - this is where you specify the fields that the brick should handle. For example a text field, a wysiwyg field, a repeater with another module and a file upload. Or maybe it's a flexible content with a couple of layouts. 
 
 * `get_brick_html()` - this function should return the HTML for the brick..
 
 ###Creating a standard brick
 
 Let's create a standard brick with a text field and a wysiwyg-area. This is of course not a very impressive example since we are basically adding a brick that does what WordPress does out of the box. But it's a good place to start showing how to create stuff in fewbricks.
 
 1. In the folder "project/bricks", create a file named headline-and-content.php.
 2. Add this code to the file
          
        namespace fewbricks\bricks;
        
        use fewbricks\acf\fields as acf_fields;
        
        /**
         * Class text_and_content
         * @package fewbricks\bricks
         */
        class text_and_content extends project_brick {
        
            /**
             * @var string This will be the default label showing up in the editor area for the administrator.
             * It can be overridden by passing an item with the key "label" in the array that is the second argument when
             * creating a brick.
             */
            protected $label = 'Headline and content';
        
            /**
             * This is where all the fields for the brick will be set.
             */
            public function set_fields()
            {
        
            }
        
            /**
             * This function will be used in the frontend when displaying the brick.
             * It will be called by the parents class function get_html(). See that function
             * for info on what data you have at your disposal. 
             * @return string
             */
            protected function get_brick_html()
            {
        
            }
        
        }

  3. Now, lets add the fields to the brick. In the set_fields-function, add this code:
  
        $this->add_field(new acf_fields\text('Headline', 'headline', 1509041509a'));
        $this->add_field(new acf_fields\wysiwyg('Content', 'content', '1509041509b'));
    
    With the code above, we have added two fields. One text-field and one wysiwyg-field. Each field has gotten a label to display to the administrator, a name we can use when getting the data for the field and a site-wide-unique key (*very important that they are unique on a site wide level*).
    
  4. Let's add our new brick to a field group: in the folder project/field-groups, either create a new file or edit an existing one. If you create a new one, make sure to require it in field-groups/init.php. Add this code to the field groups file:
  
        $fg = new fewbricks\acf\field_group('Test content', '1504201020o', $location, 1);
        $fg->add_brick(new fewbricks\bricks\text_and_content('text_and_content_test', '1509041512c');
        $fg->register();
        
    Here we create a new field group with a name, a site-wide-unique key, a location (more about that in a minute) and an order. The order indicates where the field group should be positioned when editing the content of the page. If you want to set any of the other setting available to a field group, you can pass an assocative array with those settings as the fifth argument.
    
    We then add a brick to the field group. The brick gets instantiated with a name (text_and_content_test) that should be unique for all bricks and fields added to the first level of field groups.
     We also send a site-wide-unique key for the brick.
    
    The location is an assocative array that may look something like this:
    
        [
          [
            [
              'param' => 'post_type',
				      'operator' => '==',
				      'value' => 'page',
            ],
          ]
        ]
        
    Locations can be tricky so use the playground field group that we recommend that you create (see under "Basic idea" for more info on this). Using the example above, the field group will show up on all pages.
    
5. When the location has been set, load something in the backend where the field group should show up (any page if you have used the location example above). You should now see the field group on the page and the original content-wysiwyg should be gone.
    
    Add some content in the headline and content field and load up the page in the frontend. Is your content not being displayed? That's expected since the get_html-function is empty. Let's fix that now.
    
6. In the get_html-function, add this code:

        $html = '<h1>' . $this->get_field('headline') . '</h1>';
        $html .= 'The content: ' . $this->get_field('content');
        return $html
        
    `get_field()` is a wrapper function for ACFs own `get_field()` which takes care of adding any needed prefixes to get the value. Note that we are using the name values that we set when adding fields under step 3 above.
    
  7. One last thing to have the content of the brick show up: in the code creating the page in the frontend, add the following code where you want the content to show up:
  
        echo (new fewbricks\bricks\text_and_content('text_and_content_test'))->get_html(['arg1' => 'argval1'], ['demo-layout-1']);
        
    Note that we are using the name (text_and_content_test) that we set when adding the brick to the field group in step 4.
    
    The first argument are any values that you want to pass to the brick. This can be useful for example to tell the brick what page it is being loaded at or if a certain css class should be added to it.
    
    Argument number two is an array of layouts that you want to wrap the html in. See the section "Brick layouts" a cpl of lines down in this document,
    
    Now, reload the frontend and you should have whatever content you added to the brick in he backend show up.
    
###Is that all fewbricks is capable of?
Nope. Like we said, you can create flexible content, repeaters, bricks incorporating other bricks and also create field groups on the fly. For more on how to do this, check the files in the directories "field-groups", "demo", "bricks" and "layouts". Don't miss the brick named "demo-flexible-brick"!
  
##Brick layouts
Often when printing bricks you want to have some wrapping HTML that is the same for each brick. This can for example be Bootstraps "row" and "col"-divs. Other times, you might only want the "core html" of the brick without anything wrapping it. So we have created very (very, very indeed) basic layout system. 

Layout files are stored in the layouts directory and used by passing the names of the files without the file extension (.php) to the `get_html`-function of a brick. If you dont want to use a layout, don't pass anything (or `false`) to the function.

If a string or array is passed, the file(s) with the name(s) is then included after the core html of a brick has been built. This means that you have access to these variables in a layout-file:

* `$html` - the core html of the brick
* `$this` - an instance of the current brick class. This can be used to find out for example what background color should be set on the wrapping row using something like `$this->get_data_value('bg')`.

## Fewbricks specific settings for fields and bricks
There are some settings that we have added to make using Fewbricks easier.

*For fields and bricks*
`field_label_prefix` - Text to prepend on labels. We will automatically add a space between the prefix and the original label. Note that if you set this on a brick, all the bricks fields, including fields for any sub brick, will get the prefix.
`field_label_suffix` - Same as above but a suffix.

##What about styling?
Do as you want but one idea is that you create a css/less/sass/what-have-you file for each module and place it alongside the PHP-file and giving it the same name as the PHP-file. So for example the brick "image-and-text.php" would have a style file names "image-and-text.css/scss/less".

##Developer mode
By setting Fewbricks in developer mode, some extra debugging related to Fewbricks and ACF will become available. Also, every time a field group is registered, a check for duplicate keys will be excuted. You enable developer mode by setting a constant, preferrably in wp-config.php, named FEWBRICKS_DEV_MODE to true:
`define('FEWBRICKS_DEV_MODE', true)`

If developer mode is enabled, you can also var dump the fields settings each time a field group is registered. This is done by passing a get variable named "dumpfewbricksfields" to any page like so: http://mywordpressinstall.com/wp-admin/?dumpfewbricksfields .

##Field info
If you use the technique described above to enter developer mode, you will also get info about each field in the form of a yellow and blue info field next to each field in the backend. The yellow field hold the name of the field and the blue one holds the id. If you want the developer mode activated but not displaying the field info, add the following code to the same file that you activated developer mode in:
 `define('FEWBRICKS_HIDE_ACF_INFO', true)`

The code displaying the field info was originally found in the plugin [ACF: Field Snitch](https://sv.wordpress.org/plugins/advanced-custom-fields-field-snitch/) by [Stupid Studio](https://stupid-studio.com/) and modified by [Bryan Willis](https://gist.github.com/bryanwillis/bbfdce5febd3db16c53c#file-acf-field-snitch-v5-js) to work with verison 5 of ACF. 

##Important
Due to restrictions in the WordPress table structure, the max length of a field name is 64 characters. So if you have fields that go a couple of levels deep (for example a brick in a flexible field that have a repeater), you may run out of space for the name. Therefore, it is wise to shorten names so instead of for example "download_button", use "dl_btn". This should be considered whe creating instances of bricks and fields. If the value of a field is not saved, the reason is most likely that the name is too long.

##ACF Local JSON

**Warning: Local JSON under Fewbricks is somewhat buggy and may not work in some circumstances.**

Fewbricks supports [ACF Local JSON](http://www.advancedcustomfields.com/resources/local-json/). Using this should speed things up a bit since we dont have to execute all the PHP-code that Fewbricks is made up of. Follow these steps to activate local-JSON:

1. As outlined in the [ACF instructions for local JSON](http://www.advancedcustomfields.com/resources/local-json/): in the themes directory, create a directory named acf-json.
2. In the admin area, navigate to the Fewbricks admin page which is placed in the ACF menu. Click "Build JSON" and let the page reload.
3. In a file that is always included, preferably wp-config.php, define a constant named FEWBRICKS_USE_JSON: `define('FEWBRICKS_USE_ACF_JSON', true)`.
4. That's all there is to it. ACF will now load settings from the JSON-files in the acf-json directory created in step 1. 

###Important about local JSON
Every time you edit any fields in a field group or brick, you will need to rebuild the local JSON by taking the action outlined in step 2 above. One suggested workflow is that you always have local josn activated in all environments but production by following step 3 above. Then when you edit a modules fields and don't see the changes in the editing area of a page/post/options etc., you will be reminded of that you need to rebuild the JSON. When you are ready to push to production, the JSON will be up to date. Since all ACF definitions already are in the field groups/bricks, the only purpose of using local JSON is to increase performance by not having to execute all the field group definitions and its bricks.
