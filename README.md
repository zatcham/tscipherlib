# tscipherlib
basic weak cipher

Use "from tscipherlib import *" to import this library

cencode(text,key)
This expects a string (text) and an integer (key), and will output an integer array with the encrypted characters in it.

cencodeh(text,key)
This expects a string (text) and an integer (key), and will output a hexadecimal string with the encrypted characters in it.

cscramble(iterate,key)
This is used internally by the cencode and cdecode functions

cdecode(array,key)
this expects an integer array (array) and an integer (key), and will output a text string with the decrypted text.


you can run it standalone to test its functionality, and the effectiveness of the cipher. it will print the string "hello", followed by a plot of # symbols to test the randomness of the cipher.
