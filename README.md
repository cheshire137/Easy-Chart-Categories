Easy Chart Categories
===
This is a WordPress plugin that provides a WordPress [shortcode](http://codex.wordpress.org/Shortcode) that will display your categories in a chart and another shortcode that will display your tags.  This plugin requires that the [Easy Chart Builder plugin](http://wordpress.org/extend/plugins/easy-chart-builder/) by [dyerware](http://profiles.wordpress.org/users/dyerware/) is installed and activated.

Usage
---
Show top 12 most popular categories in a pie chart:

    [easychart_categories]

Show top 12 most popular tags in a pie chart:

    [easychart_tags]

Show the first five categories, sorted by name, without counts, using custom colors, and with a summary data table of counts:

    [easychart_categories showcounts="false" groupcolors="556270, 4ECDC4, C7F464, FF6B6B, C44D58" number="5"
        orderby="name" order="ASC" hidechartdata="false"]

Options
---
See options for the WordPress function [get_terms()](http://codex.wordpress.org/Function_Reference/get_terms) and for the [Easy Chart Builder plugin](http://www.dyerware.com/main/products/easy-chart-builder-plugin-parameters.html).  Also:

- `showcounts` - Show or hide the count for each category/tag.  Valid values:  `true`, `false`.  Defaults to `true`.
