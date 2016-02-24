<?php

namespace Reviews\SimilarityBundle\Controller;

use Reviews\SimilarityBundle\Services\SimHash\Comparator\SimpleComparator;
use Reviews\SimilarityBundle\Services\SimHash\TextExtractor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Tga\SimHash\SimHash;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $text1 = 'Performanta incontestabila

Putere de procesare: paginile web, jocurile si aplicatiile se incarca mai repede gratie procesoarelor Intel® Core™ de pana la a cincea generatie, datorita performantei de calitate superioara si experientei vizuale extraordinare.

Placa grafica optionala: cu optiunile disponibile de placa grafica separata NVIDIA® GeForce®, este mai simplu sa gestionati sesiunile de editare foto si video solicitante, fara incetinirea functionarii.

Stocare considerabila: alegeti un hard disk hibrid cu spatiu de stocare de pana la 1 TB pentru reactie rapida si suficient spatiu pentru a va stoca fotografiile, fisierele si multe altele.



Centrul dvs. media portabil

Culori vii: cu tehnologia True Color, puteti regla saturatia culorilor in functie de preferintele personale. De la culori bogate si vii la nuante mai discrete, adaptati-va temperatura de culoare si tonul afisajului in functie de preferinte.

Sunet de calitate profesionala: indiferent daca mixati melodii, rulati materiale audio sau discutati prin chat, tehnologia Waves MaxxAudio® reda acute mai inalte si grave mai joase si ofera o performanta audio extraordinara.

Divertisment inclus: urmariti DVD-uri, inscriptionati CD-uri sau incarcati software-uri si aplicatii rapid pe desktop prin intermediul unitatii optice interne.






Mai multe caracteristici pentru un impact mai puternic

Productivitate fara efort: mariti si micsorati imaginea, indicati si derulati rapid prin continut cu ajutorul touchpadului mare. Continuati sa utilizati sistemul chiar si pe intuneric cu ajutorul tastaturii retroiluminate, care asigura o mai mare precizie a tastarii in conditii de lumina slaba.

Retea Wi-Fi cu raza mare de actiune: alegeti cea mai noua tehnologie 802.11ac ce asigura o conexiune Wi-Fi pe o raza extinsa de actiune, ceea ce reduce memorarea in buffer si va permite sa va bucurati de navigare pe internet, de rulare a materialelor audio sau de discutii prin chat de oriunde de acasa. (Necesita ruter 802.11ac, care se comercializeaza separat.)';
        $text2 = '
Performanta incontestabila

Putere de procesare: paginile web, jocurile si aplicatiile se incarca rapid datorita performantei superioare a procesorului pana la Intel® Core™ din a patra generatie si caracteristicilor vizuale uimitoare.
Placa grafica dedicata NVIDIA® GeForce® disponibila faciliteaza sarcinile intense de editare foto sau video, fara ca performanta sa fie incetinita.
Capacitate generoasa de stocare: alegeti un hard disk de 500 GB pentru reactie rapida si spatiu suficient de stocare a fotografiilor, a fisierelor si a altor date.
Rezistati mai mult departe de priza: lucrati neintrerupt, fara teama ca veti ramane fara energie. Autonomia impresionanta de functionare a bateriei inseamna ca puteti rezista mai mult intre incarcari




Stil si personalizare superioare

Evidentiati-va personalitatea cu ajutorul laptopului Inspiron 15 elegant. Avand o grosime mai mica de 1 inch, acest laptop versatil este creat pentru a impresiona, cu un design placut si optiuni atractive de culoare. Strecurati acest PC in geanta si porniti la drum. Optiunile de culoare depind de disponibilitatea regionala.

Mai multe caracteristici, pentru un impact mai mare

Productivitate lipsita de efort: mariti si micsorati imaginea, indicati si defilati rapid prin continut cu ajutorul touchpadului de precizie generos. Puteti lucra neintrerupt – chiar si pe intuneric – utlizand tastatura retroiluminata, care asigura o mai mare precizie a tastarii in conditii de lumina slaba.
Retea Wi-Fi cu raza mare de actiune: alegeti cea mai recenta tehnologie 802.11ac pentru a beneficia de o retea Wi-Fi rapida pe o raza mai mare de actiune, care reduce durata de incarcare in memoria cache si va permite sa va bucurati de navigare pe internet, de redare in flux si de conversatii prin chat in toata locuinta
Introducere eficienta a datelor: faceti calcule sau navigati rapid prin foile de calcul si prin documente cu ajutorul tastaturii numerice de zece cifre.



Centrul dvs. media portabil

Culori vii:  vizualizarea True Color va permite sa reglati saturatia culorilor dupa preferinta. Puteti regla temperatura si tonul culorilor in functie de necesitati, de la tonuri intense la tonuri estompate.
Sunet de calitate profesionala:  indiferent daca mixati melodii, redati in flux sau discutati prin chat, tehnologia Waves MaxxAudio® reda acute mai inalte si grave mai joase si ofera o performanta audio extraordinara.
Divertisment integrat:  puteti sa vizionati DVD-uri, sa inscriptionati CD-uri sau sa incarcati rapid software si aplicatii pe desktop cu ajutorul unitatii optice interne.';
//        $text1 = <<<EOT
//George Headley (1909–1983) was a West Indian cricketer who played 22 Test matches, mostly before the Second World War.
//Considered one of the best batsmen to play for West Indies and one of the greatest cricketers of all time, he also
//represented Jamaica and played professionally in England. Headley was born in Panama but raised in Jamaica where he
//quickly established a cricketing reputation as a batsman. West Indies had a weak cricket team through most of Headley's
//career; as their one world-class player, he carried a heavy responsibility, and they depended on his batting. He batted
//at number three, scoring 2,190 runs in Tests at an average of 60.83, and 9,921 runs in all first-class matches at an
//average of 69.86. He was chosen as one of the Wisden Cricketers of the Year in 1934.
//EOT;
//
//        $text2 = <<<EOT
//George Headley was a West Indian cricketer who played 22 Test matches, mostly before the Second World War.
//Considered one of the best batsmen to play for West Indies and one of the greatest cricketers of all time, he also
//represented Jamaica and played professionally in England. Headley was born in Panama but raised in Jamaica where he
//quickly established a cricketing reputation as a batsman. West Indies had a weak cricket team through most of Headley's
//career; as their one world-class player, he carried a heavy responsibility, and they depended on his batting. He batted
//at number three, scoring 2,190 runs in tests at an average of 60.83, and 9,921 runs in all first-class matches at an
//average of 69.86. He was chosen as one of the Wisden Cricketers of the Year.
//EOT;

        $text1 = preg_replace("/[\n\r]/","",$text1);
        $text2 = preg_replace("/[\n\r]/","",$text2);
        $text1 = preg_replace('/[0-9]*/','', $text1);
        $text2 = preg_replace('/[0-9]*/','', $text2);
        dump($text1);
        dump($text2);
        similar_text(strtolower($text1), strtolower($text2), $percent);
        dump($percent);
        $similarity = new SimHash();
        $extractor = new TextExtractor();
        $comparator = new SimpleComparator();
dump($this->compareStrings(implode(' ',$extractor->extract($text1)), implode(' ',$extractor->extract($text2))));

        $fp1 = $similarity->hash($extractor->extract($text1), \Tga\SimHash\SimHash::SIMHASH_64);
        $fp2 = $similarity->hash($extractor->extract($text2), \Tga\SimHash\SimHash::SIMHASH_64);

        dump($fp1->getBinary());
        dump($fp2->getBinary());

// Index between 0 and 1 : 0.80073740291681
        dump($comparator->compare($fp1, $fp2));
        die;

        return new Response();
    }

    function compareStrings($s1, $s2)
    {
        //one is empty, so no result
        if (strlen($s1) == 0 || strlen($s2) == 0) {
            return 0;
        }

        //replace none alphanumeric charactors
        //i left - in case its used to combine words
        $s1clean = preg_replace("/[^A-Za-z0-9-]/", ' ', $s1);
        $s2clean = preg_replace("/[^A-Za-z0-9-]/", ' ', $s2);

        //remove double spaces
        while (strpos($s1clean, "  ") !== false) {
            $s1clean = str_replace("  ", " ", $s1clean);
        }
        while (strpos($s2clean, "  ") !== false) {
            $s2clean = str_replace("  ", " ", $s2clean);
        }

        //create arrays
        $ar1 = explode(" ", $s1clean);
        $ar2 = explode(" ", $s2clean);
        $l1 = count($ar1);
        $l2 = count($ar2);

        //flip the arrays if needed so ar1 is always largest.
        if ($l2 > $l1) {
            $t = $ar2;
            $ar2 = $ar1;
            $ar1 = $t;
        }

        //flip array 2, to make the words the keys
        $ar2 = array_flip($ar2);


        $maxwords = max($l1, $l2);
        $matches = 0;

        //find matching words
        foreach ($ar1 as $word) {
            if (array_key_exists($word, $ar2)) {
                $matches++;
            }
        }

        return ($matches / $maxwords) * 100;
    }
}
