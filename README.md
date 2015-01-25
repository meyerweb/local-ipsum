# local-ipsum
Generates “lorem ipsum” style text using user-supplied text.  As the name suggests, it’s meant for location-specific text like “Cleveland Ipsum”, but it can be adapted to just about anything.

## `local.txt`

You supply fodder to the text generator by creating a `local.txt` and putting it in the same directory as the PHP files.  The format of `local.txt` is very simple:

1. Line 1: the title you want to give your ispum generator.  For example, `Cleveland Ipsum`.  Nothing else 
* Line 2 (optional): a geographic description of the locale in question.  For example, `Cleveland; Ohio; USA`.  This is currently not used by the code in any way, so if you want to skip this part, just leave the line blank.
* All following lines: the terms you want to supply to the generator, one per line.  This can be anything you want: the names of local suburbs, cultural institutions, sports teams, classic foods, notable names, and so on.

Comments are preceded by `//` and will be stripped out.  Thus, if you want to organize your data by category, you can title each section with a line like `// Notable Names`.  The parser will treat this as a blank line, which will be dropped when reading the file.

There is a sample `local.txt` provided to demonstrate the file format (such as it is).
