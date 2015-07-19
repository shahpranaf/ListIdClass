### Intro

This tiny tool scans while code folder(zip) uploaded and lists id’s and
classes used.

### Background

While developing website, UI developer :\
 1. have to make sure that classes or id names should be unique.\
 2. Same id or class name should not be used at multiple places.\
 3. if two or more developers are working on same project, their class
name should not confict and should follow unique pattern.\
 4. Change in css of one page, should not change css of other page.\
 5. Many times new developer fixes UI of one page, but breaks another
page as he/she don’t know where the same class/id is used.\
 And many more..\
 It is very difficult for a developer to search each and every time all
files to check whether classname or id name is used in other files or
so.\

### ListIDClass Tool

I thought to develop a small script which lists down all classes and
id’s present in html files on single page. So I can easily refer whether
certain class is used at other files or not. **Uses** 1. Upload your
project.zip file in the uploader.\
 2. It will scan all html/php files and list id and classes used in each
file.\
 Also do note, this will not store your code on server. So dont worry
its 100% secure.\
 Working url : [ListIdClass]

  [ListIdClass]: http://shahpranav.com/list-id-class/