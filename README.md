Author: Riccardo Castagna MBA, Php developer email: 3315954155@libero.it 
# text-comparison
comparison analysis between two texts

* This php class is useful to compare two different texts in the hypothesis that   
the two source texts have a good spelling and a correct punctuation. It      
finds similar sentences and returns the percentages, these percentages are   
the measures of how much the sentences are similar with each others.

* Possible applications and uses could be in the field of journalism, for      
example, to find the similar articles, in the cases of plagiarism, for       
investigations of various kinds when it is necessary to analyze and compare  
texts with each other.                                                       
 
* CLASS SIMPLE USAGE example file index.php:                                   
include_once('./lib/class.comparetext.php');                                 
$ref = new TextCompare;                                                      
$f = $ref->compareText($text_1, $text_2, 60, TRUE);                          
return $f;                                                                   
1) param 1 is a source text to compare                                       
2) param 2 is the second source text to compare                              
3) param 3 is an integer from 0 to 100; if it is set to 0 it will return all 
sentences with all percentages of similarity. if it is set to 100 it will    
return only the sentences that are exactly the same. A good set up could be  
around 60 and it will return all sentences whose similarity is greater than  
60 %.                                                                        
4) param 4 default is set to false, if it set to true it will convert the    
two text in lowercase and will remove all special charset

* CLASS PHP EXPERT USAGE example file: index_2.php:                                    
include_once('./lib/class.comparetext.php');                                 
$ref_2 = new TextCompare;                                                    
$specialchars=true;                                                          
$arr_1 = $ref_2->processText($text_1);                                       
$arr_2 = $ref_2->processText($text_2);                                       
foreach ($arr_1 as $key_1 => $value_1){                                      
$nr1 = $key_1;                                                               
if ($specialchars==true){                                                    
$val_1 = $ref_2->cleanText($value_1);                                        
}else{                                                                       
$val_1 = $value_1;                                                           
}                                                                            
foreach ($arr_2 as $key_2 => $value_2){                                      
$nr2 = $key_2;                                                               
if ($specialchars==true){                                                    
$val_2 = $ref_2->cleanText($value_2);}                                       
else{$val_2 = $value_2;}                                                     
$index = $ref_2->correlationText($val_1,$val_2);                             
if ($index >= 60){                                                           
$q = number_format($index, 2, ',', '.').'%';                                 
echo 'sentence of text 1 n '.$nr1.':<br>'.$val_1.' ;<br>compared with        
sentence of text 2 n '.$nr2.':<br>'.$val_2.' ;                               
<br>is similar for the: '.$q;                                                
