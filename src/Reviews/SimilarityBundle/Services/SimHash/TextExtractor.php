<?php

namespace Reviews\SimilarityBundle\Services\SimHash;

use Cocur\Slugify\Slugify;
use Reviews\SimilarityBundle\Services\StopWords\Remove;
use Reviews\SimilarityBundle\Services\StopWords\RomanianRepository;
use Tga\SimHash\Extractor\ExtractorInterface;
use Webmozart\Assert\Assert;

/**
 * Created by PhpStorm.
 * User: george
 * Date: 2/20/2016
 * Time: 11:48 AM
 */
class TextExtractor implements ExtractorInterface
{
    /**
     * A list with default stopwords
     */
    const STOP_WORDS_LIST = 'a,abia,acea,aceasta,aceea,aceeasi,aceia,acel,acela,acelasi,acelea,acest,acesta,aceste,acestea,
        acestei,acestia,acestui,acolo,acum,adica,ai,aia,aici,aiurea,al,ala,alaturi,ale,alt,alta,altceva,alte,altfel,alti,altii,
        altul,am,anume,apoi,ar,are,as,asa,asemenea,asta,astazi,astfel,asupra,atare,ati,atit,atita,atitea,atitia,atunci,au,avea,
        avem,avut,azi,b,ba,bine,c,ca,cam,capat,care,careia,carora,caruia,catre,ce,cea,ceea,cei,ceilalti,cel,cele,celor,ceva,chiar,
        ci,cind,cine,cineva,cit,cita,cite,citeva,citi,citiva,conform,cu,cui,cum,cumva,d,da,daca,dar,dat,de,deasupra,deci,decit,
        degraba,deja,desi,despre,din,dintr,dintre,doar,dupa,e,ea,ei,el,ele,era,este,eu,exact,f,face,fara,fata,fel,fi,fie,foarte,
        fost,g,geaba,h,i,ia,iar,ii,il,imi,in,inainte,inapoi,inca,incit,insa,intr,intre,isi,iti,j,k,l,la,le,li,lor,lui,m,ma,mai,
        mare,mi,mod,mult,multa,multe,multi,n,ne,ni,nici,niciodata,nimeni,nimic,niste,noi,nostri,nou,noua,nu,numai,o,or,ori,orice,
        oricum,p,pai,parca,pe,pentru,peste,pina,plus,prea,prin,putini,r,s,sa,sai,sale,sau,se,si,sint,sintem,spre,sub,sus,t,te,ti,
        toata,toate,tocmai,tot,toti,totul,totusi,tu,tuturor,u,un,una,unde,unei,unele,uneori,unii,unor,unui,unul,v,va,voi,vom,vor,
        vreo,vreun,x,z,a,abia,acea,aceasta,această,această,aceea,aceia,acel,acela,acelaşi,acelaşi,acele,acelea,aceluiaşi,acest,
        acesta,aceste,acestea,acestei,aceşti,aceştia,acestor,acestora,acestui,acolo,acum,adică,ai,aia,aici,al,ăla,alături,ale,alt,
        alta,altă,altceva,alte,altele,altfel,alţi,alţii,altul,am,anume,apoi,ar,are,aş,aşa,asemenea,asta,astăzi,astfel,asupra,atare,
        atât,atâta,atâtea,atâţi,atâţia,aţi,atît,atîti,atîţia,atunci,au,avea,avem,avut,azi,ba,bine,ca,că,cam,când,care,căreia,cărora,
        căruia,cât,câtă,câte,câţi,către,ce,cea,ceea,cei,ceilalţi,cel,cele,celelalte,celor,ceva,chiar,ci,cînd,cine,cineva,cît,cîte,
        cîteva,cîţi,cîţiva,cu,cui,cum,cumva,da,daca,dacă,dar,de,deasupra,decât,deci,decît,deja,deşi,despre,din,dintr,dintre,doar,
        după,ea,ei,el,ele,era,este,eu,fără,fecăreia,fel,fi,fie,fiecare,fiecărui,fiecăruia,fiind,foarte,fost,i-au,iar,ieri,îi,îl,
        îmi,împotriva,în,în,înainte,înapoi,înca,încît,însă,însă,însuşi,într,între,între,îşi,îţi,l-am,la,le,li,lor,lui,mă,mai,mare,
        mereu,mod,mult,multă,multe,mulţi,ne,nici,niciodata,nimeni,nimic,nişte,noi,noştri,noştri,nostru,nouă,nu,numai,o,oarecare,
        oarece,oarecine,oarecui,or,orice,oricum,până,pe,pentru,peste,pînă,plus,poată,prea,prin,printr-o,puţini,s-ar,sa,să,să-i,
        să-mi,să-şi,să-ţi,săi,sale,sau,său,se,şi,sînt,sîntem,sînteţi,spre,sub,sunt,suntem,sunteţi,te,ţi,toată,toate,tocmai,tot,
        toţi,totul,totuşi,tu,tuturor,un,una,unde,unei,unele,uneori,unii,unor,unui,unul,va,vă,voi,vom,vor,vreo,vreun';

    /**
     * Delimitator between two stopwords from list
     */
    const STOP_WORDS_DELIMITATOR = ',';

    private $rules = array(
        'ă' => 'a',
        'Ă' => 'A',
        'â' => 'a',
        'Â' => 'A',
        'î' => 'i',
        'Î' => 'I',
        'ş' => 's',
        'Ş' => 'S',
        'ţ' => 't',
        'Ţ' => 'T'
    );

    /**
     * Extract the important information from the input and return an array
     * of elements to use in SimHash
     *
     * @param mixed $input
     * @return array
     */
    public function extract($text)
    {
        $slugify = new Slugify();
        $slugify->addRules($this->rules);
//        $text = $this->removeStopWords($text);
        $slugifiedText = $slugify->slugify($text);

        return explode('-', $slugifiedText);
    }

    /**
     * Remove stopwords from string
     * @param $text
     * @return mixed|string
     */
    private function removeStopWords($text)
    {
        $text = str_replace('  ', ' ', $text);
        $stopWordRepository = RomanianRepository::fromString(self::STOP_WORDS_LIST, self::STOP_WORDS_DELIMITATOR);
        $removableObject = new Remove($stopWordRepository);
        $text = $removableObject->remove($text);

        return $text;
    }
}