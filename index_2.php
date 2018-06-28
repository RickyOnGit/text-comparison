<?php
/*******************************************************************************
* Author: Riccardo Castagna MBA, web developer - Palermo (ITALY)               *
* This class is useful to compare two different texts in the hypothesis that   *
* the two source texts have a good spelling and a correct punctuation. It      *
* finds similar sentences and returns the percentages, these percentages are   *
* the measures of how much the sentences are similar with each others.         *
* Possible applications and uses could be in the field of journalism, for      *
* example, to find the similar articles, in the cases of plagiarism, for       *
* investigations of various kinds when it is necessary to analyze and compare  *
* texts with each other.                                                       *
* CLASS SIMPLE USAGE example file index.php:                                   *
* include_once('./lib/class.comparetext.php');                                 *
* $ref = new TextCompare;                                                      *
* $f = $ref->compareText($text_1, $text_2, 60, TRUE);                          *
* return $f;                                                                   *
* 1) param 1 is a source text to compare                                       *
* 2) param 2 is the second source text to compare                              *
* 3) param 3 is an integer from 0 to 100; if it is set to 0 it will return all * 
* sentences with all percentages of similarity. if it is set to 100 it will    *
* return only the sentences that are exactly the same. A good set up could be  *
* around 60 and it will return all sentences whose similarity is greater than  *
* 60 %.                                                                        *
* 4) param 4 default is set to false, if it set to true it will convert the    *
* two text in lowercase and will remove all special charset                    *
* CLASS PHP EXPERT USAGE file: index_2.php:                                    *
* include_once('./lib/class.comparetext.php');                                 *
* $ref_2 = new TextCompare;                                                    *
* $specialchars=true;                                                          *
* $arr_1 = $ref_2->processText($text_1);                                       *
* $arr_2 = $ref_2->processText($text_2);                                       *
* foreach ($arr_1 as $key_1 => $value_1){                                      *
* $nr1 = $key_1;                                                               *
* if ($specialchars==true){                                                    *
* $val_1 = $ref_2->cleanText($value_1);                                        *
* }else{                                                                       *
* $val_1 = $value_1;                                                           *
* }                                                                            *
* foreach ($arr_2 as $key_2 => $value_2){                                      *
* $nr2 = $key_2;                                                               *
* if ($specialchars==true){                                                    *
* $val_2 = $ref_2->cleanText($value_2);}                                       *
* else{$val_2 = $value_2;}                                                     *
* $index = $ref_2->correlationText($val_1,$val_2);                             *
* if ($index >= 60){                                                           *
* $q = number_format($index, 2, ',', '.').'%';                                 *
* echo 'sentence of text 1 n '.$nr1.':<br>'.$val_1.' ;<br>compared with        *
* sentence of text 2 n '.$nr2.':<br>'.$val_2.' ;                               *
* <br>is similar for the: '.$q;                                                *                              
*******************************************************************************/
/***************************************************************************************
* for demonstration, I took two articles,
*  one of the national geographic and the other of the new york times and 
*  I compared these with each other
* text 1): https://news.nationalgeographic.com/2018/06/tropical-deforestation-forest-loss-2017/
* text 2): https://www.nytimes.com/2018/06/27/climate/tropical-trees-deforestation.html
* *************************************************************************************/
$text_1 = "By Stephen Leahy -  
PUBLISHED JUNE 27, 2018
Imagine looking down on a huge swath of lush forest—but before you can pull out your phone and take a picture, it’s gone.
In tropical regions around the world, tree cover is disappearing that quickly: Every minute of every day over the last two years, a tract the size of 40 football fields was clear-cut or burned to increase production of soy, cattle, palm oil, and wood products.
Despite efforts to reduce tropical deforestation, tree cover loss has nearly doubled over the past 15 years. In 2017, 39 million acres (15.8 million hectares) disappeared — an area close to the size of Washington State — according to new data released Wednesday by the research group World Resources Institute (WRI) at the Oslo Tropical Forest Forum, where 500 forest experts and policymakers are meeting about the issue. The latest total was second only to 2016, the worst-ever year of tropical forest loss with 41.7 million acres (16.9 million hectares).
Fires, droughts, and tropical storms are also playing an increasing role in forest loss, especially as climate change makes them more frequent and severe, according to the report. The regions that lost the most forest in 2017 were in Latin America, Southeast Asia, and Central Africa.
Deforestation is itself a major driver of climate change. Tropical forest loss in 2017 added about 7.5 billion metric tons of carbon dioxide to the atmosphere, according to WRI—nearly 50 percent more than the energy-related carbon emissions from the entire U.S.
While destroying forests releases huge volumes of carbon dioxide, growing forests capture it from the atmosphere, making forest protection one of the keys to limiting climate change. And since tropical forests grow year-round, they are especially important. Proper conservation and restoration of tropical forests, mangroves, and peatlands could provide a cost-effective way to achieve up to 23 percent of the carbon dioxide reductions needed by 2030, according a WRI working paper on climate and tropical forests released at the Oslo forum.
Despite this, countries and the private sector spend about 100 billion a year subsidizing and investing in forest-destroying agricultural expansion and land development, said Frances Seymour, distinguished senior fellow at WRI. Meanwhile, she adds, only a billion dollars a year goes toward forest conservation.
“It’s like trying to put out a house fire with a teaspoon while more gas is being poured on the flame,” she said.
RANCHING IS THE BIGGEST CAUSE
A lot of that 100 billion a year in subsidies and investments goes toward exports of food and wood products to other countries. China and India are among the world’s biggest importers of soy, pulp and paper, and palm oil. China alone is a huge importer of beef, and cattle ranching is the largest single cause of deforestation, according to a WRI working paper on deforestation-free supply chains.
These subsidies and investments should be redirected to increasing sustainable agriculture on non-forest lands, said Andreas Dahl-Jørgensen, deputy director of Norway's International Climate and Forest Initiative during a press conference about the new data.
The rate of tree cover loss is less than half in community and indigenous lands compared to elsewhere. However, that comes at a high price. The human rights group Global Witness documented 197 murders of people defending land and environmental rights in 2017. Many of them were indigenous people, noted Victoria Tauli-Corpuz, a UN expert and indigenous leader.
Recognizing and supporting legal rights of the world’s indigenous people—who occupy more than 50 percent of the world’s land—is a powerful tool for protecting forests and the climate, she said.
FIVE TAKEAWAYS FROM THE NEW REPORT
* Brazil is still by far the deforestation leader with 11.1 million acres (4.5 million hectares) lost in 2017, followed by the Democratic Republic of Congo with 3.7 million acres (1.5 million hectares).
* Indonesia dramatically reduced its forest loss by 60 percent in 2017, although Sumatra, home of the extremely endangered Sumatran tiger, saw increased primary forest loss—including 7,500 hectares (18,500 acres) in the Kerinci Seblat National Park.
* Colombia’s deforestation was three times higher in 2017 than 2015 — the end of the civil war has resulted in a land rush for cattle ranching, mining, soy, timber, and land speculation.
* The Congo halted industrial logging 16 years ago, but forest loss increased in 2016-17. This year, Chinese companies were granted new logging concessions in the world’s largest remaining peatland forest.
* The island of Dominica lost 32 percent of its remaining forest due to hurricanes in 2017, while Puerto Rico lost 10 per cent.";

$text_2 = "By Brad Plumer - 
June 27, 2018
In Brazil, forest fires set by farmers and ranchers to clear land for agriculture raged out of control last year, wiping out more than 3 million acres of trees as a severe drought gripped the region. Those losses undermined Brazil’s recent efforts to protect its rain forests.
In Colombia, a landmark peace deal between the government and the country’s largest rebel group paved the way for a rush of mining, logging and farming that caused deforestation in the nation’s Amazon region to spike last year.
And in the Caribbean, Hurricanes Irma and Maria flattened nearly one-third of the forests in Dominica and a wide swath of trees in Puerto Rico last summer.
In all, the world’s tropical forests lost roughly 39 million acres of trees last year, an area  roughly the size of Bangladesh, according to a report Wednesday by Global Forest Watch that used new satellite data from the University of Maryland. Forest Watch is part of the World Resources Institute, an environmental group.
That made 2017 the second-worst year for tropical tree cover loss in the satellite record, just below the losses in 2016.
The data provides only a partial picture of forest health around the world, since it does not capture trees that are growing back after storms, fires or logging. But separate studies have confirmed that tropical forests are shrinking overall, with losses outweighing the gains.
The new report comes as ministers from forest nations around the world meet in Oslo this week to discuss how to step up efforts to protect the world’s tropical forests, which host roughly half of all species worldwide and play a key role in regulating Earth’s climate.
“These new numbers show an alarming situation for the world’s rain forests,” said Andreas Dahl-Jorgensen, deputy director of the Norwegian government’s International Climate and Forest Initiative. “We simply won’t meet the climate targets that we agreed to in Paris without a drastic reduction in tropical deforestation and restoration of forests around the world.”";

/********************** EXPERT USAGE ***************************/
include_once('./lib/class.comparetext.php');
$ref_2 = new TextCompare;
echo "<pre>";
echo "This is the demo for medium-expert php class users:";
echo "</pre><br>";
echo "<br><pre>";
echo "In this example I took two news article, one is by National Geographic and the other is by the New York Times about the climate change. 
The php class compare the full two article. I have set up to extract all the sentences that are similar with each other with a percentage grater than 60 %;  
this value, that in this case I have set up to 60,  is customizable, according to the needs of the analysis. 
In this case I have manually copied the two full article into the example files index.php and index_2.php but is also 
possible, obviously, for those who want it, to integrate the functions of the cURL, for example, to make inquiries on the web  
or for other types or purposes of analysis.
At the end, in this example, is shown the result of this analysis, and this php class, between the two article analyzed, find only one sentece similar.";
echo "<br>";
echo "Obviously, in this case, which is only a demonstrative example, we can not say that it is plagiarism but a simple quotation. 
If instead, the analysis had extracted many more similar sentences, then, perhaps, it could have been plagiarism.";
echo "</pre><br>";
echo "<br><pre>";
echo "The article N.1 is by Stephen Leahy, published: June 27, 2018  https://news.nationalgeographic.com/2018/06/tropical-deforestation-forest-loss-2017/  ";
echo "<br>";
echo "<br>";
echo "The article N.2 is by Brad Plumer, published: June 27, 2018 https://www.nytimes.com/2018/06/27/climate/tropical-trees-deforestation.html  ";
echo "<br>";
echo "<br><strong>";
echo "The result of the compare analysis is:";
echo "</strong><br>";
echo "<br><strong>";
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
echo 'sentence of text 1 n '.$nr1.':<br>'.$val_1.' ;<br>compared with sentence of text 2 n '.$nr2.':<br>'.$val_2.' ;<br>are similar with each other for: '.$q; 
echo '<br>';
echo '<br>';
}
} 
}

?>