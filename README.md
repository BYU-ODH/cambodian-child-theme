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
