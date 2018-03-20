# SilverWare Sitemap Module

[![Latest Stable Version](https://poser.pugx.org/silverware/sitemap/v/stable)](https://packagist.org/packages/silverware/sitemap)
[![Latest Unstable Version](https://poser.pugx.org/silverware/sitemap/v/unstable)](https://packagist.org/packages/silverware/sitemap)
[![License](https://poser.pugx.org/silverware/sitemap/license)](https://packagist.org/packages/silverware/sitemap)

Provides a sitemap page for [SilverWare][silverware] apps.

## Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Issues](#issues)
- [Contribution](#contribution)
- [Maintainers](#maintainers)
- [License](#license)

## Requirements

- [SilverWare][silverware]

## Installation

Installation is via [Composer][composer]:

```
$ composer require silverware/sitemap
```

## Usage

After installing the module, a `SitemapPage` will become available in the CMS.  By default, the sitemap page will
show a tree of all pages in your site tree that are flagged as shown in menus.

On the Styles tab for the page, you can choose the font icon to use for links. On the Options tab, you may customise
the sitemap mode by choosing from the following options:

- All
- Children
- Selected

The 'All' mode (default) shows all navigable pages in your site tree.  The 'Children' mode will show the child pages
of the page you select from the field that appears.  The 'Selected' mode will show only those pages you select from
the field that appears.

On the Options tab you may also choose whether to show the page name or navigation label for both the link text, and
the title popup for each link.

## Issues

Please use the [issue tracker][issues] for bug reports and feature requests.

## Contribution

Your contributions are gladly welcomed to help make this project better.
Please see [contributing](CONTRIBUTING.md) for more information.

## Maintainers

[![Colin Tucker](https://avatars3.githubusercontent.com/u/1853705?s=144)](https://github.com/colintucker) | [![Praxis Interactive](https://avatars2.githubusercontent.com/u/1782612?s=144)](https://www.praxis.net.au)
---|---
[Colin Tucker](https://github.com/colintucker) | [Praxis Interactive](https://www.praxis.net.au)

## License

[BSD-3-Clause](LICENSE.md) &copy; Praxis Interactive

[silverware]: https://github.com/praxisnetau/silverware
[composer]: https://getcomposer.org
[issues]: https://github.com/praxisnetau/silverware-sitemap/issues
