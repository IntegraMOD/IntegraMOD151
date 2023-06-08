/*
 +-------------------------------------------------------------------------------------+
 |                                                                                     |
 | DHTML Tabsets                                                                       |
 |                                                                                     |
 | Copyright and Legal Notices:                                                        |
 |                                                                                     |
 |   All source code, images, programs, files included in this distribution            |
 |   Copyright (c) 1996,1997,1998,1999,2000                                            |
 |                                                                                     |
 |          John C. Cokos  iWeb, Inc.                                                  |
 |          All Rights Reserved.                                                       |
 |                                                                                     |
 |                                                                                     |
 |   Web: http://www.iwebsoftware.com      Email: info@iwebsoftware.com                |
 |                                                                                     |
 +-------------------------------------------------------------------------------------+

    ** 
       Original Tabset Scripts were obtained from another source.  Cannot remember
       where I got them from.  I've manipulated the daylights out of it, to make it
       work in all browsers, and behave the way that I wanted it to.   If you are,
       or if you know the originater, please email me at the address noted above, and
       I will be happy to change the copyright notices herein to include you as
       the original source.
    **

*/


/*  This file should not be modified */

if (DOM) { currShow=document.getElementById('T11');}
else if (IE) { currShow=document.all['T11'];}
else if (NS4) { currShow=document.layers["T11"];};       
changeCont("11", "tab11");