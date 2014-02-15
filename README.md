Bonfire Comments
===============

A simple comments module. This is not a standalone module and should be used with [Bonfire-Blog](https://github.com/superlativecode/Bonfire-Blog) or integrate it into another bonfire module.

###Dependices not included

*   [Bonfire](https://github.com/ci-bonfire/Bonfire) by [Superlative Code](http://superlativecode.com/)
*   [Bonfire-Blog](https://github.com/superlativecode/Bonfire-Blog) by [Superlative Code](http://superlativecode.com/)
*   [Bonfire-Images](https://github.com/superlativecode/Bonfire-Images) by [Superlative Code](http://superlativecode.com/)

###Installation

**Note:** We assume you have a working instance of Bonfire running.

1.  `cd ./path/to/modules/`
2.  `git clone https://github.com/superlativecode/Bonfire-Blog ./blog`
3.  `git clone https://github.com/superlativecode/Bonfire-Comments ./comments`
4.  `git clone https://github.com/superlativecode/Bonfire-Images ./images`
5.  Login to the admin panel and migrate to the latest version on all three of those modules
6.  Move `/application/modules/blog/public/assets/images/spritemap*.png` to `/public/assets/images`
7.  Copy the libraries in `/application/modules/blog/libraries` to `/application/libaries`
8.  Create folder `/public/uploads/` with permissions for read and write
9.  Make sure each module has the correct permissions to access it

###Features

*   Nested Comments
*   Approve Comments
*   Delete Comments
*   Reply-To
*   Modal Comments
*   XSS Protection

###Libraries Used

*   [Parsedown](http://parsedown.org/)

###TODO

*   Better comment approval process

[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/superlativecode/bonfire-comments/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

