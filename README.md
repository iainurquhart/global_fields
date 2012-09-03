# Global Fields for ExpressionEngine 2

### Overview

A proof of concept module Tab which lets you bring fields from any field group into the publish page.

Say for example you wanted to add a keywords field to every publish page. 

Using native methods, you'd need to add a keywords field to every field group - and then create some sort of mechanism for dealing with all the different field names that are all housing your keywords. The other alternative would be to use one giant field group for all channels. Yuck.

Global Fields will allow you to create 1 keywords field, and apply it to all publish pages (for example).

GYPSY! I hear you cry. 

Not really. 

This implementation is surprisingly simple.

### Installing/Usage

Install the module, and then add the following lines to your config:

	$config['global_fields_tab_name'] = 'Global Fields';
	$config['global_field_ids'] = array(4,5,6);

'global_field_ids' is an array of the field_ids you want to make global. 

In the example above, we're setting field_id_4, field_id_5 and field_id_6 to be global.

'global_fields_tab_name' is the label which is applied to the tab, the default is 'Global Fields'

You can hide the tab and it's fields for any channel they are not required via publish layouts.

#### Tested Fieldtypes

Compatible with all first party fields:

Checkboxes  
Date  
File  
Multi Select  
Radio Buttons  
Relationship [whoa]  
Select Dropdown  
Text Input  
Textarea  
Textarea (RTE)  

Any field that stores data outside of the native channel_data table will be incompatible for now. I haven't looked into it much but the main issue will be getting the contents of the field if field data exists.

That's not to say it isn't possible, it just needs more time than I have now.


### Outputting Data

Outputting the data is the same as if the fields were part of the field group associated with the channel. 

The search parameter works fine too on the channel:entries tag as the data is stored natively in the channel_data table.

### Caveats

Native EE Search, Low Search and Supersearch will not search into these fields. Any add-on which looks at field group settings will simply ignore global fields.

It seems like none of these add-ons have taken Tabs into consideration (I'm assuming because there aren't many Tab add-ons out there) and there are no hooks at this time that could be used for extending search add-ons to include Tab fields. There are some possible workarounds and I'm still investigating.

### Support and Feature Requests
The add-on is not officially supported but send requests/bug reports/pull requests here to this repo.

* * *

Copyright (c) 2012 Iain Urquhart
http://iain.co.nz