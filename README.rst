=============================
Question2Answer Shortcode
=============================
-----------
Description
-----------
This is a plugin for **Question2Answer** that allows shortcode replacement in posts.

--------
Features
--------
- replace any text with any other text
- option to replace within HTML tags or exclude them from replace
- regular expression matching (see `Regular Expressions`_ below)

------------
Installation
------------
#. Install Question2Answer_
#. Get the source code for this plugin from github_, either using git_, or downloading directly:

   - To download using git, install git and then type 
     ``git clone git://github.com/NoahY/q2a-shortcode.git shortcode``
     at the command prompt (on Linux, Windows is a bit different)
   - To download directly, go to the `project page`_ and click **Download**

#. navigate to your site, go to **Admin -> Plugins** on your q2a install and select the '**Enable shortcode**' option, enter in some shortcode, then '**Save**'.

.. _Question2Answer: http://www.question2answer.org/install.php
.. _git: http://git-scm.com/
.. _github:
.. _project page: https://github.com/NoahY/q2a-shortcode

----------------------
Regular Expressions
----------------------

.. _Regular Expressions:
Regular expressions allow to replace patterns with specific text that may be based on the search pattern.  For example, putting:

  /\[mycode\]([^\]]+)\[\/mycode\]/
  
in the search box and:

  Hello, $1! 
  
in the replace box, would replace `[mycode]User[/mycode]` with `Hello, User!`.

For more info on regular expressions, google it.

----------
Disclaimer
----------
This is **beta** code.  It is probably okay for production environments, but may not work exactly as expected.  Refunds will not be given.  If it breaks, you get to keep both parts.

-------
Release
-------
All code herein is Copylefted_.

.. _Copylefted: http://en.wikipedia.org/wiki/Copyleft

---------
About Q2A
---------
Question2Answer is a free and open source platform for Q&A sites. For more information, visit:

http://www.question2answer.org/

