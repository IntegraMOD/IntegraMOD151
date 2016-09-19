/*
======================================================================
 NewsBar v1.2 (modified to Forum Images NewsFader 1.0)
 (c) 2002 VASIL DINKOV- PLOVDIV, BULGARIA
 Vasil Dinkov's NewsBar v1.2 is modified for use and distribution by
 forumimages.com with the author's kind permission.
======================================================================
 Forum Images NewsFader 1.0
 A Forum Images Production -- http://www.forumimages.us/
 Authors: SamG, Daz
 License: FI Free to Use and Distribute - Please see the included licenses.html
	file before using this software. A copy of the license that applies to this script
	can be	found on the Forum Images site should it not be included;
	http://www.forumimages.us/terms.html
======================================================================
*/
// <![CDATA[

var loadImage = new Image(), regexpResult = null;
for ( var i = 0; i < newsContent.length; i++ ) {
  if ( pauseOnMouseover ) newsContent[i] = newsContent[i].replace(/<a(\s\w+=".+")*>/gi, '<a$1 onmouseout="newsNew();" onmouseover="clearTimeout(newsEvent);">');
  if ( regexpResult = newsContent[i].match(/<img[^<]+\/>/gi) ) {
    for ( var j = 0; j < regexpResult.length; j++ ) {
      loadImage.src = regexpResult[j].replace(/.+src="(.+)".+/i, '$1');
    }
  }
}

defaultNewsTimeout *= 1000;
newsTimeout *= 1000;
var contentIndex = 0, text = null;
if ( fade ) var b = startBlue, fadeEvent = null, g = startGreen, r = startRed;
document.write(defaultNews);
var newsEvent = window.setTimeout('newsNew()', defaultNewsTimeout);

function newsNew() {
  text = newsContent[contentIndex];
  contentIndex++;
  document.getElementById('finewsdisplay').innerHTML = text;
  if ( fade ) fadeNews();
  if ( contentIndex == newsContent.length ) contentIndex = 0;
  newsEvent = window.setTimeout('newsNew()', newsTimeout);
}

function fadeNews() {
  if ( fadeToDark ) {
    if ( (r >= endRed) && (g >= endGreen) && (b >= endBlue) ) {
      document.getElementById('finewsdisplay').style.color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
      fadeEvent = setTimeout('fadeNews()', 1);
      b -= 7;
      g -= 7;
      r -= 7;
      return;
    }
  }
  else {
    if ( (r <= endRed) && (g <= endGreen) && (b <= endBlue) ) {
      document.getElementById('finewsdisplay').style.color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
      fadeEvent = setTimeout('fadeNews()', 1);
      b += 7;
      g += 7;
      r += 7;
      return;
    }
  }
  document.getElementById('finewsdisplay').style.color = 'rgb(' + endRed + ', ' + endGreen + ', ' + endBlue + ')';
  b = startBlue;
  g = startGreen;
  r = startRed;
}

function newsPopUp(uri) {
  var newWindow = window.open(uri, newsPopUpName, newsPopUpFeatures);
}
// ]]>