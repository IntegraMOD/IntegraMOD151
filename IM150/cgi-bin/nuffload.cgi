#!/usr/bin/perl -W

# Author : Nuffmon 2005
# http://www.nuffmon.oftheweek.de
# Version 1.4.2
# Last Update 19/11/2005
#
# The Initial Developer of the Original Code is Raditha Dissanayake.
# Portions created by Raditha are Copyright (C) 2003
# Raditha Dissanayake. All Rights Reserved.


use CGI;
use CGI::Carp qw(fatalsToBrowser);

my $qstring = "";

if (length ($ENV{'QUERY_STRING'}) > 0){
      $buffer = $ENV{'QUERY_STRING'};
      @pairs = split(/&/, $buffer);
      foreach $pair (@pairs){
           ($name, $value) = split(/=/, $pair);
           $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
           $$name = $value;
           $qstring .= "$name=$value&";
      }
 }
$psid =~ s/[^a-zA-Z0-9]//g;

$post_data_file = "tmp/" . $psid . "_postdata";
$monitor_file = "tmp/" . $psid . "_flength";
$qstring_file = "tmp/" . $psid . "_qstring";

$len = $ENV{'CONTENT_LENGTH'};
$bRead=0;
$|=1;

# Check for max upload size, set to whatever you want
if($len > 32000000)
{
  close (STDIN);
  print "Content-type: text/html\n\n";
  print "<br>The maximum upload size has been exceeded<br>\n";
  exit;
}

# Send content-length to monitor file
if (-e "$monitor_file") {
  unlink("$monitor_file");
}
open (MF,">", "$monitor_file") or die "can't open monitor file";
print MF $len;
close (MF);
sleep(1);

# read and store the raw post data on a temporary file so that we can
# pass it though to a CGI instance later on.
if (-e "$post_data_file") {
  unlink("$post_data_file");
}
open(TMP,">","$post_data_file") or &bye_bye ("can't open temp file");
my $i=0;
$ofh = select(TMP); $| = 1; select ($ofh);
while (read (STDIN ,$LINE, 4096) && $bRead < $len )
{
  $bRead += length $LINE;
  $i++;
  print TMP $LINE;
}
close (TMP);

#
# We don't want to decode the post data ourselves. That's like
# reinventing the wheel. If we handle the post data with the perl
# CGI module that means the PHP script does not get access to the
# files, but there is a way around this.
#
# We can ask the CGI module to save the files, then we can pass
# these filenames to the PHP script. In other words instead of
# giving the raw post data (which contains the 'bodies' of the
# files), we just send a list of file names.
#

open(STDIN,"$post_data_file") or die "can't open temp file";
my $cg = new CGI();
my %vars = $cg->Vars;
my $j = 0;

while(($key,$value) = each %vars)
{
  $file_upload = $cg->param($key);
  if(defined $value && $value ne '')
  {
    my $fh = $cg->upload($key);
    if(defined $fh)
    {
      $tmp_filename = "tmp/$psid"."_actualdata"."$j";
      open(TMP,">","$tmp_filename") or &bye_bye ("can't open temp file");
      while(<$fh>) {
        print TMP $_;
      }
      close(TMP);
      $fsize =(-s $fh);
      $fh =~ s/([^a-zA-Z0-9_\-.])/uc sprintf("%%%02x",ord($1))/eg;
      $tmp_filename =~ s/([^a-zA-Z0-9_\-.])/uc sprintf("%%%02x",ord($1))/eg;
      $qstring .= "file[name][$j]=$fh&file[size][$j]=$fsize&";
      $qstring .= "file[tmp_name][$j]=$tmp_filename&";
      $qstring .= "file[field][$j]=$key&";
      $j++;
    }
    else
    {
      $value =~ s/([^a-zA-Z0-9_\-.])/uc sprintf("%%%02x",ord($1))/eg;
      $qstring .= "$key=$value&" ;
    }
  }
}

# Write query string to file.
if (-e "$qstring_file") {
  unlink("$qstring_file");
}
open (QSTR,">", "$qstring_file") or die "can't open output file";
print QSTR $qstring;
close (QSTR);

# Tidy up after ourselves.
unlink("$monitor_file");
unlink("$post_data_file");

# OK lets get back to album upload.
my $url= $redirect . "?psid=$psid";
print "Location: $url\n\n";
