#!/usr/bin/perl -w
# � Gertjan van Noord, 1997.
# mailto:vannoord@let.rug.nl

use strict;
use vars qw($opt_d $opt_f $opt_h $opt_l $opt_n $opt_t $opt_v $opt_u $opt_a);
use Getopt::Std;
use Benchmark;

my $non_word_characters='0-9\s';

# OPTIONS
getopts('a:d:f:hlnt:u:v');

# defaults: set $opt_X unless already defined (Perl Cookbook p. 6):
$opt_a ||= 10;
$opt_d ||= 'LM';
$opt_f ||= 0;
$opt_t ||= 400;
$opt_u ||= 1.05;

sub help {
    print <<HELP
Text Categorization. Typically used to determine the language of a
given document. 

Usage
-----

* print help message:

$0 -h

* for guessing: 

$0 [-a Int] [-d Dir] [-f Int] [-l] [-t Int] [-u Int] [-v]

    -a    the program returns the best-scoring language together
          with all languages which are $opt_u times worse (cf option -u). 
          If the number of languages to be printed is larger than the value 
          of this option (default: $opt_a) then no language is returned, but
          instead a message that the input is of an unknown language is
          printed. Default: $opt_a.
    -d    indicates in which directory the language models are 
          located (files ending in .lm). Currently only a single 
          directory is supported. Default: $opt_d.
    -f    Before sorting is performed the Ngrams which occur this number 
          of times or less are removed. This can be used to speed up
          the program for longer inputs. For short inputs you should use
          -f 0.
          Default: $opt_f.
    -l    indicates that input is given as an argument on the command line,
          e.g. text_cat -l "this is english text"
          Cannot be used in combination with -n.
    -t    indicates the topmost number of ngrams that should be used. 
          If used in combination with -n this determines the size of the 
          output. If used with categorization this determines
          the number of ngrams that are compared with each of the language
          models (but each of those models is used completely). 
    -u    determines how much worse result must be in order not to be 
          mentioned as an alternative. Typical value: 1.05 or 1.1. 
          Default: $opt_u.
    -v    verbose. Continuation messages are written to standard error.

* for creating new language model, based on text read from standard input:

$0 -n [-v]

    -v    verbose. Continuation messages are written to standard error.


HELP
}

if ($opt_h) { help(); exit 0; };

if ($opt_n) { 
    my %ngram=();
    my @result = create_lm(input(),\%ngram);
    print join("\n",map { "$_\t $ngram{$_}" ; } @result),"\n";
  } elsif ($opt_l) {
    classify($ARGV[0]);
  } else { 
    classify(input()); 
}

# CLASSIFICATION
sub classify {
  my ($input)=@_;
  my %results=();
  my $maxp = $opt_t;
  # open directory to find which languages are supported
  opendir DIR, "$opt_d" or die "directory $opt_d: $!\n";
  my @languages = sort(grep { s/\.lm// && -r "$opt_d/$_.lm" } readdir(DIR));
  closedir DIR;
  @languages or die "sorry, can't read any language models from $opt_d\n" .
    "language models must reside in files with .lm ending\n";


  # create ngrams for input. Note that hash %unknown is not used;
  # it contains the actual counts which are only used under -n: creating
  # new language model (and even then they are not really required).
  my @unknown=create_lm($input);
  # load model and count for each language.
  my $language;
  my $t1 = new Benchmark;
  foreach $language (@languages) {
    # loads the language model into hash %$language.
    my %ngram=();
    my $rang=1;
    open(LM,"$opt_d/$language.lm") || die "cannot open $language.lm: $!\n";
    while (<LM>) {
      chomp;
      # only use lines starting with appropriate character. Others are
      # ignored.
      if (/^[^$non_word_characters]+/o) {
	$ngram{$&} = $rang++;
      } 
    }
    close(LM);
    #print STDERR "loaded language model $language\n" if $opt_v;
    
    # compares the language model with input ngrams list
    my ($i,$p)=(0,0);
    while ($i < @unknown) {
      if ($ngram{$unknown[$i]}) {
	$p=$p+abs($ngram{$unknown[$i]}-$i);
      } else { 
	$p=$p+$maxp; 
      }
      ++$i;
    }
    #print STDERR "$language: $p\n" if $opt_v;
    
    $results{$language} = $p;
  }
  print STDERR "read language models done (" . 
    timestr(timediff(new Benchmark, $t1)) . 
      ".\n" if $opt_v;
  my @results = sort { $results{$a} <=> $results{$b} } keys %results;
  
  print join("\n",map { "$_\t $results{$_}"; } @results),"\n" if $opt_v;
  my $a = $results{$results[0]};
  
  my @answers=(shift(@results));
  while (@results && $results{$results[0]} < ($opt_u *$a)) {
    @answers=(@answers,shift(@results));
  }
  if (@answers > $opt_a) {
    print "I don't know; " .
      "Perhaps this is a language I haven't seen before?\n";
  } else {
    print join(" or ", @answers), "\n";
  }
}

# first and only argument is reference to hash.
# this hash is filled, and a sorted list (opt_n elements)
# is returned.
sub input {
  {
    local $/;     # so it doesn't affect $/ elsewhere
    undef $/;
    $_ = <>;      # swallow input.
  }
  $_ || die "determining the language of an empty file is hard...\n";
  return $_;
}

sub create_lm {
  my $t1 = new Benchmark;
  my $ngram;
  ($_,$ngram) = @_;  #$ngram contains reference to the hash we build
    # then add the ngrams found in each word in the hash
  my $word;
  foreach $word (split("[$non_word_characters]+")) {
    $word = "_" . $word . "_";
    my $len = length($word);
    my $flen=$len;
    my $i;
    for ($i=0;$i<$flen;$i++) {
      $$ngram{substr($word,$i,5)}++ if $len > 4;
      $$ngram{substr($word,$i,4)}++ if $len > 3;
      $$ngram{substr($word,$i,3)}++ if $len > 2;
      $$ngram{substr($word,$i,2)}++ if $len > 1;
      $$ngram{substr($word,$i,1)}++;
      $len--;
    }
  }
  ###print "@{[%$ngram]}";
  my $t2 = new Benchmark;
  print STDERR "count_ngrams done (". 
    timestr(timediff($t2, $t1)) .").\n" if $opt_v;

  # as suggested by Karel P. de Vos, k.vos@elsevier.nl, we speed up
  # sorting by removing singletons
  map { my $key=$_; if ($$ngram{$key} <= $opt_f) 
             { delete $$ngram{$key}; }; } keys %$ngram;
  #however I have very bad results for short inputs, this way

  
  # sort the ngrams, and spit out the $opt_t frequent ones.
  # adding  `or $a cmp $b' in the sort block makes sorting five
  # times slower..., although it would be somewhat nicer (unique result)
  my @sorted = sort { $$ngram{$b} <=> $$ngram{$a} } keys %$ngram;
  splice(@sorted,$opt_t) if (@sorted > $opt_t); 
  print STDERR "sorting done (" . 
    timestr(timediff(new Benchmark, $t2)) . 
      ").\n" if $opt_v;
  return @sorted;
}
