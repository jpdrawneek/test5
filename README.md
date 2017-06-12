# test5

Write a console command tool that consumes a text file from the URL below, and outputs the
100 most frequent words in the following format:
word1,count
word2,count
word3,count
...

Install
=======
In project root:

composer install -o

Run
===
In project root:

./bin/console.sh getWordCount

If you want a different number of items returned:

./bin/console.sh getWordCount <count>
