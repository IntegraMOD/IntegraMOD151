function no_thread_stretch(size)
{
//document.write('<link rel="stylesheet" type="text/css" href="templates/overflow' + cssname + '.css">');

   var width;
   if (window.innerWidth) //if browser supports window.innerWidth
   {
      width = window.innerWidth;
   }
   else if (document.documentElement && document.documentElement.clientHeight) // Explorer 6 Strict Mode
   {
      width = document.documentElement.clientWidth + 20;
   }
   else if (document.all) //else if browser supports document.all (IE 4+)
   {
      width = document.body.clientWidth + 20;
   }

   document.write('<style type="text/css">');
   document.write('<!--');
   document.write('.postoverflow');
   document.write('{');
   document.write('   width: ' + (width - size) + 'px;');
   if (document.all)
      document.write('   padding-bottom: 20px;');
   document.write('   overflow: auto;');
   document.write('}');
   document.write('-->');
   document.write('</style>');
}