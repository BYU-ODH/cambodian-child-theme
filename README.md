# Introduction
This repository contains work related to the [Cambodian Oral History Project](https://cambodianoralhistoryproject.byu.edu/) (COHP) at [BYU](https://byu.edu). 
The project is directed by [Dana Bourgerie](https://bourgerie.byu.edu/), professor of Chinese in the 
[Department of Asian and Near Eastern Languages](https://ane.byu.edu/). The project's technical work is overseen by [Brian Croxall](https://briancroxall.net), 
assistant research professor in the [Office of Digital Humanities](https://odh.byu.edu).

The site and its current functionality primarily depend on five things:
- [WordPress](https://wordpress.com/), tested 2/16/22 with version 5.9
- its [theme](https://github.com/BYU-ODH/cambodian-child-theme), which is a child theme of [Septera](https://wordpress.org/themes/septera/), tested 2/16/22 with version 1.5.1
- the [Pods plugin](https://pods.io/), tested 2/16/22 with version 2.8.8.10
- the [FacetWP plugin](https://facetwp.com/), tested 2/16/22 with version 3.9.6
- the [FacetWP - Pods Integration plugin](https://facetwp.com/help-center/using-facetwp-with/pods/), tested 2/16/22 with version 1.2.2

Additionally, there are a handful of plugins that give the site functionality that the team uses but are not integral to the development work that ODH has done on the site. These include:
- [Better Notifications for WP](https://wordpress.org/plugins/bnfw/), tested 2/16/22 with version 1.8.11
- [Current Year and Copyright Shortcodes](https://zatzlabs.com/project/current-year-and-copyright-shortcodes/), tested 2/16/22 with version 1.0.2
- [Elementor](https://elementor.com/), tested 2/16/22 with version 3.5.5
- [Email Logs](https://wpemaillog.com/), tested 2/16/22 with version 2.4.8
- [Import and export users and customers](https://wordpress.org/plugins/import-users-from-csv-with-meta/), tested 2/16/22 with version 1.19.1.9
- [Lara's Google Analytics](https://www.xtraorbit.com/wordpress-google-analytics-dashboard-widget/), tested 2/16/22 with version 3.3.3
- [Ninja Forms](https://ninjaforms.com/?utm_source=Ninja+Forms+Plugin&utm_medium=readme), tested 2/16/22 with version 3.6.7
- [WP Cassify](https://wpcassify.wordpress.com/), tested 2/16/22 with version 2.2.8

In this documentation, we describe how these elements are used and interact with one another.

## Theme
COHP runs on WordPress. Its uses a [child theme](https://github.com/BYU-ODH/cambodian-child-theme) of [Septera](https://wordpress.org/themes/septera/). The child theme makes adjustments to the following items from the default Septera theme:
- colors throughout the site for links, headers, etc.
- styling and flex boxes for different types of pages on the site, including how FacetWP displays on the [interview directory](https://cambodianoralhistoryproject.byu.edu/interviews/)
- margins for pages and posts
- the behavior of header/feature images on posts and pages: 
  - posts randomly draw from a selection of header images that have been added to the site rather than using a featured image (this was done as most featured images have people's faces in them, and the cropping and positioning was overly complicated); 
  - pages, on the other hand, use featured images which are set individually by the team
- the footer, which includes an auto-updated copyright statement

### Shortcode Pages
Several pages are made through shortcodes that can be found in `functions.php`. These pages include the [Interviews with English Translations](https://cambodianoralhistoryproject.byu.edu/interviews-with-english-translations/), [Interviews with Videos](https://cambodianoralhistoryproject.byu.edu/interviews-with-videos/), [Interview Topics](https://cambodianoralhistoryproject.byu.edu/interview-topics/), and [Interviews by Location](https://cambodianoralhistoryproject.byu.edu/interviews-by-location/). Each shortcode queries a Pod and returns the values that fit the given parameters.

Due to some interference between the shortcodes and any text on the same page, these pages are built with [Elementor](https://elementor.com/) in order to have individual blocks for the shortcode and for the text, allowing us to order the blocks on the page how we want.

## Pods
COHP uses the [Pods plugin](https://pods.io/) to create custom content types that function as a simplified database. These custom content types include post types and taxonomies. Custom content types can have bi-directional relationships to other custom content types, allowing us to create semantic relationships where an `interviewee` particiaptes in an `interview` which is conducted by an `interviewer`.

### Custom Post Types
The custom post types are as follows:
- Interviewees, data about individuals interviewed by the project
- Interviewers, data about individuals who conducted the interviews
- Interviews, data about the interviews themselves 
- Provinces, data about the different provinces in Cambodia, including proper spelling in Khmer and [GeoNames](https://www.geonames.org/) URIs
  - It's worth noting that users have begun putting in other locations like states (e.g., Utah, California) or countries (e.g., Vietnam) since not all interviewees were born in and/or currently live in Cambodia
- Stories Included, topics that frequently appear in interviews; in many ways, this functions similar to a tag
- Villages, data about villages in Cambodia, including proper spelling in Khmer and [Geonames](https://www.geonames.org/) URIs
- Zodiac, the 12 animals that are used in the Chinese zodiac; in many ways, this functions similar to a tag

### Custom Taxonomies
The custom taxonomies are used primarily on the `Interviewees` custom post type. They are as follows:
- Current Religion, which religion an interviewee currently practices
- Language Spoken, which language(s) an interviewee speaks (**Need to ask team whether this is for languages they use _in_ the interviewee or just the total range of languages that a person speaks**)
- Raised Religion, which religion an interviewee was raised within

Additionally, there is a custom taxonomy that is used on both the `Interviewees` and the `Interviewers` custom post type:
- Gender, the gender of the individual

Custom taxonomies were deployed so the students doing data entry would be less likely to make errors such as spelling or different ways of describing gender. 

Both the `Stories Included` and `Zodiac` custom post types could have easily been custom taxonomies. But since custom taxonomies appear on the righthand side of the WordPress interface, a decision was made to use custom post types so this information would be more visible (and therefore more likely to be completed) to those doing data entry.

### Pods Templates
Pods makes possible the creation of templates to display information from the custom post types.

- There are currently six templates: `Topics in Interviews`, `People from Province`, `Interviewee Directory`, `Interview Template`, `Interviewer Template`, and `Interviewee Template`. 

These templates can be used in Facet templates or shortcodes, or they can be added to a Pod through the Auto Template Option in order to automatically generate pages.

- The [big interview list](https://cambodianoralhistoryproject.byu.edu/interviews/) is created through a Facet template that calls the `Interviewee Directory` template.
- Individual interview, interviewee, and interviewer pages, as well as the pages for individual provinces or topics, are created through the Auto Template Option in Pods, which automatically generates all of these pages.

## FacetWP
COHP uses the [FacetWP plugin](https://facetwp.com/) to enable faceted browsing on the [Interview Directory](https://cambodianoralhistoryproject.byu.edu/interviews/). The plugin allows for the creation of facets and templates.

### Facets
Facets are mostly ways to filter content. There are also facets for pagination and the number of results per page. When creating a new facet, the plugin can look to custom taxonomies or any of the content within a particular Pod. We have created [screenshots of the different facets](https://github.com/BYU-ODH/cambodian-child-theme/tree/master/facetwp-templates), in case they need to be recreated.

### Templates
Templates can either be built visually or through HTML/PHP (AKA advanced mode). COHP uses the latter, and the template can be found [here](https://github.com/BYU-ODH/cambodian-child-theme/blob/master/facetwp-templates/template.md).

### Matching Queries, Pages, and Templates
**Critical**: If you want a facet to work on a page, its source needs to match the Pod that will be the primary datasource on the page. For example, the [Interview Directory](https://cambodianoralhistoryproject.byu.edu/interviews/) is, despite its name, actually comprised of results from the `Interviewees` Pod rather than the `Interviews` Pod. While the `Interviewee` Pod contains a person's `date of birth`, their `age at the time of interview` is contained in their `Interview` Pod. So it was impossible to include a facet for the `age at time of interview` in the Interview Directory.

## FacetWP - Pods Integration
Paid FacetWP accounts have access to a number of [add-ons](https://facetwp.com/add-ons/) to improve the functionality of FacetWP. This plugin "This lets you create facets based on Pods (meta-based) custom fields."

## Additional Plugins

### Better Notifications for WP
[This plugin](https://wordpress.org/plugins/bnfw/) allows notifications (AKA emails) to be sent out to certain groups of users when particular events happen. As currently implemented, the team uses this to notify those interested in the project when a new blog post has been published.

### Current Year and Copyright Shortcodes
[This plugin](https://zatzlabs.com/project/current-year-and-copyright-shortcodes/) provides shortcodes that can be deployed in parts of the site to indicate copyright and current year. This is currently used in the footer widget for the site.

### Elementor
[This plugin](https://elementor.com/) allows for a GUI-like experience when constructing pages. This is currently used on pages like [Interview Topics](https://cambodianoralhistoryproject.byu.edu/interview-topics/). Without this plugin, the explanatory text on the page appeared below the list of topics. This was the most expeditious way to fix that interaction.

### Email Logs
[This plugin](https://wpemaillog.com/) creates easy-to-read logs of all emails sent by the WordPress site. The team used it primarily when first setting up notifications with `Better Notifications for WP` to make sure it behaved as desired.

### Import and export users and customers
[This plugin](https://wordpress.org/plugins/import-users-from-csv-with-meta/) allows for creating users with CSV. The team used it to create new users that would have particular roles so that those users could receive notifications when new posts were published.

### Lara's Google Analytics
[This plugin](https://www.xtraorbit.com/wordpress-google-analytics-dashboard-widget/) allows for in-dashboard exploration of Google Analytics. It is ODH's go-to plugin for this feature.

### Ninja Forms
[This plugin](https://ninjaforms.com/?utm_source=Ninja+Forms+Plugin&utm_medium=readme) is used to create forms within the site. The team uses it on the [Contact Us](https://cambodianoralhistoryproject.byu.edu/contact-us/) and [Volunteer](https://cambodianoralhistoryproject.byu.edu/volunteer/) pages. 

### WP Cassify
[This plugin](https://wpcassify.wordpress.com/) is used to allow BYU users to log into the site using their Net ID. It is ODH's go-to plugin for this feature. In order for it to be used, users should have their username set to their Net ID (e.g., `blc6`) without any domain. Their email address can be set to any address they would like. When creating new users, the `Send the new user an email about their account` option should be _deselected_ as log-in process will default to BYU's CAS system.

