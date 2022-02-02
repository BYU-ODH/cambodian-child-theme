# Introduction
This repository contains work related to the [Cambodian Oral History Project](https://cambodianoralhistoryproject.byu.edu/) (COHP) at [BYU](https://byu.edu). 
The project is directed by [Dana Bourgerie](https://bourgerie.byu.edu/), professor of Chinese in the 
[Department of Asian and Near Eastern Languages](https://ane.byu.edu/). The project's technical work is overseen by [Brian Croxall](https://briancroxall.net), 
assistant research professor in the [Office of Digital Humanities](https://odh.byu.edu).

The site and its current functionality depend on three things:
- its theme
- the [Pods plugin](https://pods.io/)
- the [FacetWP plugin](https://facetwp.com/)

In this documentation, we describe how these three things are used and interact with one another.

## Theme
COHP runs on WordPress. Its uses a [child theme](https://github.com/BYU-ODH/cambodian-child-theme) of [Septera](https://wordpress.org/themes/septera/). The child theme makes adjustments to the following items from the default Septera theme:
- colors throughout the site for links, headers, etc.
- styling and flex boxes for different types of pages on the site, including how FacetWP displays on the [interview directory](https://cambodianoralhistoryproject.byu.edu/interviews/)
- margins for pages and posts
- the behavior of header/feature images on posts and pages: posts randomly draw from a selection of header images that have been added to the site rather than using a featured image (this was done as most featured images have people's faces in them, and the cropping and positioning was overly complicated); pages, on the other hand, use featured images which are set individually by the team
- the footer, which includes an auto-updated copyright statement

## Pods
COHP uses the [Pods plugin](https://pods.io/) to create custom content types that function as a simplified database. These custom content types include post types and taxonomies. Custom content types can have bi-directional relationships to other custom content types, allowing us to create semantic relationships where an `interviewee` particiaptes in an `interview` which is conducted by an `interviewer`.

### Custom Post Types
The custom post types are as follows:
- Interviewees, data about individuals interviewed by the project
- Interviewers, data about individuals who conducted the interviews
- Interviews, data about the interviews themselves 
- Provinces, data about the different provinces in Cambodia, including proper spelling in Khmer and [GeoNames](https://www.geonames.org/) URIs
  - It's worth noting that users have begun putting in other locations like states (e.g., Utah, California) or countries (e.g., Vietnam) since not all interviees were born in and/or currently live in Cambodia
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

- The big interview list is created through a Facet template that calls the `Interviewee Directory` template.
- Individual interview, interviewee, and interviewer pages, as well as the pages for individual provinces or topics, are created through the Auto Template Option in Pods, which automatically generates all of these pages.

### Shortcode Pages
Several pages are made through shortcodes that can be found in `functions.php`. These pages include the Interviews with English Translations, Interviews with Videos, Interview Topics, and Interviews by Location. The shortcode queries Pods and returns any values that fit the given parameters.

Due to some interference between the shortcodes and any text on the same page, these pages are built with Elementor in order to have individual blocks for the shortcode and for the text.
