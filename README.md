# Global Fields for ExpressionEngine 2

### Overview

A proof of concept module Tab which lets you bring fields from any field group into the publish page.

Say for example you wanted to add a keywords field to every publish page. 

Using native methods, you'd need to add a keywords field to every field group - and then create some sort of mechanism for dealing with all the different field names that are all housing your keywords. The other alternative would be to use one giant field group for all channels. Yuck.

Global Fields will allow you to create 1 keywords field, and apply it to all publish pages (for example).

GYPSY! I hear you cry. 

Not really. 

This implementation is pretty simple, and for now all it works with are basic text inputs, textareas and checkboxes/selects.

### Installing/Usage

Install the module, and then update the $field_ids array at the top of tab.global_fields.php to include all the field_ids you want to appear globally.

You can hide the tab and it's fields for any channel via publish layouts.

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

Anyt field that stores data outside of the native channel_data table will be incompatible for now. I haven't looked into it much but the main issue will be getting the contents of the field if field data exists.

That's not to say it isn't possible, it just needs more time than I have now.


### Outputting Data

Outputting the data is the same as if the fields were part of the field group associated with the channel. 

The search parameter works fine too on the channel:entries tag as the data is stored natively in the channel_data table.

### Caveats

Probably more than I'm aware of right now.

### Support and Feature Requests
The add-on is not officially supported but send requests/bug reports/pull requests here to this repo.

* * *

Copyright (c) 2012 Iain Urquhart
http://iain.co.nz