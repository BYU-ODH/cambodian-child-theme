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
- the behavior of header/feature images on posts and pages: 
  - posts randomly draw from a selection of header images that have been added to the site rather than using a featured image (this was done as most featured images have people's faces in them, and the cropping and positioning was overly complicated); 
  - pages, on the other hand, use featured images which are set individually by the team
- the footer, which includes an auto-updated copyright statement

### Shortcode Pages
Several pages are made through shortcodes that can be found in `functions.php`. These pages include the [Interviews with English Translations](https://cambodianoralhistoryproject.byu.edu/interviews-with-english-translations/), [Interviews with Videos](https://cambodianoralhistoryproject.byu.edu/interviews-with-videos/), [Interview Topics](https://cambodianoralhistoryproject.byu.edu/interview-topics/), and [Interviews by Location](https://cambodianoralhistoryproject.byu.edu/interviews-by-location/). The shortcode queries Pods and returns any values that fit the given parameters.

Due to some interference between the shortcodes and any text on the same page, these pages are built with [Elementor](https://elementor.com/) in order to have individual blocks for the shortcode and for the text, allowing us to order the blocks on the page in the order that we want.

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

- The [big interview list](https://cambodianoralhistoryproject.byu.edu/interviews/) is created through a Facet template that calls the `Interviewee Directory` template.
- Individual interview, interviewee, and interviewer pages, as well as the pages for individual provinces or topics, are created through the Auto Template Option in Pods, which automatically generates all of these pages.

## FacetWP
COHP uses the [FacetWP plugin](https://facetwp.com/) to enable faceted browsing on the [Interview Directory](https://cambodianoralhistoryproject.byu.edu/interviews/). The plugin allows for the creation of facets and templates.

### Facets
Facets are mostly ways to filter content. There are also facets for pagination and the number of results per page. When creating a new facet, the plugin can look to custom taxonomies or any of the content within a particular Pod. We have created [screenshots of the different facets](https://github.com/BYU-ODH/cambodian-child-theme/tree/master/facetwp-templates), in case they need to be recreated.

### Templates
Templates can either be built visually or through HTML/PHP (AKA advanced). COHP uses the latter, and the template can be found [here](https://github.com/BYU-ODH/cambodian-child-theme/blob/master/facetwp-templates/template.md).

### Matching Queries, Pages, and Templates
**Critical**: If you want a facet to work on a page, its source needs to match the Pod that will be the primary datasource on the page. For example, the [Interview Directory](https://cambodianoralhistoryproject.byu.edu/interviews/) is, despite its name, actually comprised of results from the `Interviewees` Pod rather than the `Interviews` Pod. While the `Interviewee` Pod contains a person's `date of birth`, their `age at the time of interview` is contained in their `Interview` Pod. So it was impossible to include a facet for the `age at time of interview` in the Interview Directory.
