<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\user;
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Datatables;
use Illuminate\Support\Facades\Validator;
use PDF;
use Dompdf\Dompdf;


class wordTest extends Controller
{
public function createWordDocx(Request $request){

//retrieving user inputs
$buyerId=Input::get('inputBuyerId');
$sellerId=Input::get('inputSellerId');
$propertyId=Input::get('inputPropertyId');
$descriptionBySurveyor=Input::get('inputSurveyorDescription');
$clause1=Input::get('inputClauses');
$secDeedRegistration=Input::get('input2ndRegDate');
$secDeedTVNum=Input::get('input2ndTVNum');

//update table immovableProperty to insert the new registration and transcription volume number
DB::table('immovableproperty')
    ->where('propertyId',$propertyId)
    ->update(['secDeedRegistration'=>$secDeedRegistration,
              'secTranscriptionVol'=>$secDeedTVNum
            ]);

//fetching data from database based on the id entered for the property,buyer and seller
$buyers=(DB::table('users')->where('id',$buyerId)->get());
$sellers=(DB::table('users')->where('id',$sellerId)->get());
$propertyDetails=(DB::table('immovableproperty')->where('propertyId',$propertyId)->get());

//creating word document
$wordTest = new \PhpOffice\PhpWord\PhpWord();
$alignment= new \PhpOffice\PhpWord\SimpleType\Jc();

//retrieving current year
$currentYear = date('Y');
$newSection = $wordTest->addSection();

//setting different paragraph styles
$alignment=$wordTest->addParagraphStyle('centerTitles', array( 'size' => 12,'align'=>'center', 'name' => 'Times New Roman'));
$alignment2=$wordTest->addParagraphStyle('Indent', array( 'tabPos'=>720));
$alignment3=$wordTest->addParagraphStyle('rightAlignUnderline', array( 'size' => 12,'align'=>'right', 'underline'=> 'single','name' => 'Times New Roman','bold'=>true));


foreach ($sellers as $seller ) {
    foreach ($buyers as $buyer ) {
        foreach($propertyDetails as $propertyDetail){

        $newSection->addText("EXPEDITION",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true),'centerTitles');

        $newSection->addText($currentYear,array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true),'centerTitles');
        
        $newSection->addText("---",array('name' => 'Times New Roman','align'=>'center','size' => 12),'centerTitles');
        
        $newSection->addText("VENTE",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true),'centerTitles');
        
        $newSection->addText("par",array('name' => 'Times New Roman','align'=>'center','size' => 12),'centerTitles');
        
        $newSection->addText("Monsieur et Madame " .$seller->firstname." ".strtoupper($seller->lastname)." " ,array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true),'centerTitles');
        
        $newSection->addText("à",array('name' => 'Times New Roman','align'=>'center','size' => 12),'centerTitles');
        
        $newSection->addText("Monsieur " .$buyer->firstname." ".strtoupper($buyer->lastname)." " ,array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true),'centerTitles');
        
        $newSection->addText("---",array('name' => 'Times New Roman','align'=>'center','size' => 12),'centerTitles');
        
        $newSection->addText("  Pardevant Mons. Jean Baptise , notaire à Port Louis, 14, Rue Sir Virgile Naz, République de Maurice, soussignée.",array('name' => 'Times New Roman','align'=>'center','size' => 12));
        
        $newSection->addText("ONT COMPARU",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
        
        $newSection->addText($seller->title." ".$seller->firstname." ".strtoupper($seller->lastname).", né le"." ". $seller->dob." (Acte de Naissance portant le No ". $seller->birthCertificateNumber." - ".$seller->districtIssued.
        "); titulaire d'une Carte Nationale d'Identité portant le No ".$seller->nic.", ".$seller->profession."." ,array('name' => 'Times New Roman','align'=>'left','size' => 12));
        
        $newSection->addText("Et son épouse, ".$seller->spouseTitle." ".$seller->spouseFirstname." ".strtoupper($seller->spouseLastname)."  née le ". $seller->spouseDob." (Acte de Naissance portant le No ".$seller->spouseBCNum." - ".$seller->spouseBCdistrictIssued.");titulaire d'une Carte Nationale d'Identité portant le No ".$seller->spouseNic.", ".$seller->spouseProfession.", tous deux demeurant ensemble à ".$seller->address."."
        ,array('name' => 'Times New Roman','align'=>'left','size' => 12));

        $newSection->addText("Mariés en uniques noces - ainsi qu'ils le déclarent, le ".$seller->marriageDate." sous le Régime Légal de Communauté (Acte de Mariage portant le No ".$seller->MCNumber." - ".$seller->MCdistrictIssued."); ce régime matrimonial n'a subi aucun changement.
        "."( ".$seller->title. " et ".$seller->spouseTitle." ".$seller->firstname." ".strtoupper($seller->lastname)." appelés au cours des présentes: 'vendeurs').
        "
        ,array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

        $newSection->addText(strtoupper("lesquels").", déclarent par ces présentes,vendre,en s'obligeant conjointement et solidairement entre eux, sous toutes les garanties ordinaires et de droit:",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 920));
        
        $newSection->addText($buyer->title." ".$buyer->firstname." ".strtoupper($buyer->lastname)." né à ".$buyer->placeOfBirth." le ".$buyer->dob." (Acte de Naissance portant le No ".$buyer->birthCertificateNumber." - ".$buyer->districtIssued.");titulaire d'une Carte Nationale d'identité portant le No ".$buyer->nic." ".$buyer->marriageStatus." ainsi qu'il le déclare,'".$buyer->profession."', demeurant à ".
        $buyer->address.".",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720));
    
        $newSection->addText("(".$buyer->title." ".$buyer->firstname." ".strtoupper($buyer->lastname)." appelé au cours des presentes: 'acquéreur').
        ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

        $newSection->addText(strtoupper("ici present et ce acceptant"),array('name' => 'Times New Roman','size' => 12,'bold' => true,'underline'=> 'single'));

        $newSection->addText("Le bien dont suit la désignation (ci-apres designe: ‘Bien Vendu').
        ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

        $newSection->addText("DESIGNATION",
        array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

        $newSection->addText("Une portion de terrain vague située au quartier de ".$propertyDetail->districtSituated.",lieu dit ".$propertyDetail->address." de la contenance de ".$propertyDetail->sizeInPerchWords." perches soit ".strtoupper($propertyDetail->sizeInMSWords)." METRES CARRES (".$propertyDetail->sizeInMSFigures." m2) - PIN No ".$propertyDetail->pinNum."
        ] et bornée d'après le titre de propriété ci-après relate, d'après un rapport avec plan figuratif y joint,dresse par "
        .$propertyDetail->surveyorTitle." ".$propertyDetail->surveyorFN." ".$propertyDetail->surveyorLN.", arpenteur, le".$propertyDetail->surveyorDate.", enregistrée au Reg ".$propertyDetail->regNumLSReport.", comme suit:",
        array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

        $newSection->addText($descriptionBySurveyor,
        array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');
        
        $newSection->addText("Ensemble tout ce qui peut en dépendre ou en faire partie sans aucune exception
        ni réserve et sans une plus ample désignation, l'acquéreur déclarant bien connaître
        l'objet de son acquisition pour l'avoir vu et visité et en être satisfait.
        ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("JOUISSANCE",
       array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

       $newSection->addText("Pour l'acquéreur en jouir,faire et disposer comme bon lui semblera et comme de
       chose lui appartenant en toute propriété-au moyen des présentes et à compter de ce
       jour.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');
        
       $newSection->addText("ORIGINE DE PROPRIETE",
       array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

       $newSection->addText("Déclarent les vendeurs qu'ils sont propriétaires du Bien Vendu au moyen de l'acquisition que l'un d'eux en a faite
       (pendant leur susdit mariage), suivant contrat contenant quittance du prix nominal d'une
       roupie, dressé par ".$propertyDetail->previousNotaryTitle." ".$propertyDetail->previousNotaryFN." ".$propertyDetail->previousNotaryLN.", notaire,les ".
       $propertyDetail->firstDeedGeneration." et ".$propertyDetail->firstDeedRegistration.",  enregistrée et transcrit au Vol ".$propertyDetail->transcriptionVol.".",
       array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');
        
       $newSection->addText("Nota: À ce contrat, il a été dit ce qui suit littéralement:
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText($clause1,array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("CONDITIONS",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
    
       $newSection->addText("Il demeure bien convenu entre les parties comme conditions essentielles attachées
       au lotissement du terrain dont la portion présentement vendue fait partie, savoir.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("1.Que tout acquéreur prendra le terrain a lui vendu à ses risques et périls sans
       garantie de l'état du sol ou du sous-sol, fouilles ou excavations, mitoyennetés, défaut d'alignement 
       ou autres vices ou défauts cachés; de plus, la contenance du dit terrain n'est pas garantie, 
       toute différence dans la contenance en plus ou en moins, fera le profit ou la perte de l'acquéreur, mais sous la 
       condition que cette différence de contenance n'excède pas cinq pour cent - 5%.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("2.Que la Compagnie venderesse, ses ayants droit et ayants cause, ainsi que tous
       acquéreurs de son lotissement, leurs ayants droit et ayants cause, auront le droit à titre
       de servitude perpétuelle et gratuite de faire passer des tuyaux aux balisages de la portion
       de terrain à eux vendue pour conduire l'eau potable sur tous autres terrains dudit
       lotissement et des lignes aériennes ou souterraines pour le téléphone et l'électricité, ainsi que le droit de faire poser le long de ces balisages les
        colonnes ou poteaux nécessaires à cet effet.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("Et 3. Que la Compagnie venderesse ayant pris l'engagement d'entretenir à ses frais
       les chemins et les drains desservant le lotissement et d'évacuer les ordures dudit lotissement 
       pendant une période de trois années à compter de la dernière date des présentes a moins qu'avant cette date cet entretien et/ou cette évacuation 
       ne soit pris en charge par une quelconque autorité, l'acquéreur est expressement averti que dans l'éventualité ou à cette date limite l'entretien desdits chemins et 
       drains et/ou l'evacuation desdites ordures n'auront pas encore été pris en charge par une autorité à qui en incomberait l'entretien, l'acquéreur, 
       ses ayants droit et ayants cause, devront:
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');
    
       $newSection->addText("(a) Entretenir à leurs frais la moitié de la largeur desdits chemins longeant la
       portion de terrain sus décrite, et ce, tout le long de la façade de ladite portion de terrain
       dits chemins et ils ne pourront rien déposer sur ces chemins qui puisse nuire à la circulation des piétons et des véhicules.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(b) Maintenir les drains se trouvant sur ledit terrain en bon état d'entretien et de
       réparation.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText(" Et (c) évacuer ou faire évacuer à leurs frais les ordures domestiques.
       L’usage desdits chemins devra être commun à tous les acquéreurs dudit lotissement, leurs ayants droit et ayants cause, ainsi qu'à la Compagnie ayants droit et ayants cause.",
       array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("L'acquéreur aux présentes déclare bien connaître les sus dites conditions, les avoir pour agréables et 
       s'engage et s'oblige à les respecter et exécuter aux lieux et place des vendeurs, de façon à ce que ces derniers ne soit nullement inquiétés, poursuivies ni recherches a cet égard.
       Pour connaître la série des propriétaires antérieurs du sus dit bien, il est du consentement des parties référé au contrat sus relaté.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("PRIX",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

       $newSection->addText("La présente vente est faite aux charges ordinaires et de droit.",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("Et en outre, pour et moyennant le prix principal d".strtoupper($propertyDetail->priceInWords)." (Rs".$propertyDetail->priceInFigures."-) que les vendeurs reconnaissent avoir reçu et touché de l'acquéreur, à l’instant même et à la vue du notaire soussignée.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText(strtoupper("dont quittance"),'rightAlignUnderline');

       $newSection->addText("FISCALITES",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

       $newSection->addText("Reconnaissent les parties avoir été averties par le notaire soussigné, savoir:",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("1o. Des dispositions des Sections 19 et 41 de 'The Registration Duty Act' et de la Section 20 de 'The Notaries Act' sur l'Enregistrement et elles déclarent au dit notaire que le prix sus fixe, représente la valeur actuelle et réelle du Bien Vendu.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("2o. Et plus particulièrement des dispositions de la Section 41 (4) de 'The Registration Duty Act' et l'acquéreur déclare qu’il est lui-même le seul 'ultimate beneficial owner' du Bien Vendu et qu'en conséquence, il ne détient pas le Bien Vendu pour le compte et/ou bénéficie d'un 'non citizen'.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("Déclare le notaire soussigné avoir informé les parties aux présentes des dispositions de la Section 39 du 'Land (Duties and Taxes) Act' relativement a l'Anti-avoidance provisions, ce que reconnaissent les dites parties.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       
       $newSection->addText("DECLARATION SPECIALE",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

       $newSection->addText("RELATIVE À L’OBTENTION DE LA RÉDUCTION DES DROITS",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
      
       $newSection->addText("D’ENREGISTREMENT EN VERTU DE LA SECTION 27 DU",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
       
       $newSection->addText("‘REGISTRATION DUTY ACT’",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

       $newSection->addText("Déclare l'acquéreur remplir toutes les conditions nécessaires à l'obtention de la
       réduction des droits d'enregistrement prévue à la Section 27 du Registration Duty
       Act tel qu'il appert dans la déclaration faite dans les termes dûment approuvés par le
       Registrar General et le 'Director General de la Mauritius Revenue Authority en deux
       Originaux.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("Duquel il est extrait ce qui suit:
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(i)    ....",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(ii)     I am acquiring the portion of freehold bare land, or the right to construct a
       residential building on top of an existing building (droit de surelevation)
       together with his quote-part on a freehold land, for the sole purpose of
       constructing a residential building.",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(iii)     l undertake to start the construction of the residential building within a period of one year, and to complete the construction within a period of 3 years, from the date of transfer.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(iv)      I or my spouse has not already benefited from any reduction under this subsection or subsection (5) on or after 29 July 2016.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(v)    I or my spouse was not the sole owner of any immovable property in or outside at Mauritius as at 29 July 2016.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(vi)     I or my spouse is or was the co-owner of any immovable property, the
       immovable property was acquired by inheritance and is, or was, not of an
       extent exceeding 422 square metres.",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(vii)    I or my spouse is or was the co-owner of an immovable property, the
       immovable is or was acquired before 9 November 2012 and is or was of an
       extent exceeding 211 square meters.",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(viii)     The total income of the transferee and his spouse, in the income year in which
       transfer is made, does not exceed in the aggregate 2 million rupees.",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(ix)    I am a citizen of Mauritius;",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("x)     The transfer is not in respect of an immovable property, or any part thereof acquired under the Investment Promotion (Real Estate Development Scheme) Regulations 2007, and
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("(xi)     The extent of the immovable property does not exceed 844 square meters or 20
       perches.",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720),'Indent');

       $newSection->addText("I also hereby declare that the information I have given on this form is true and correct
       except in respect of paragraph (vii) relating to the total income of myself and my
       spouse which has been estimated to the best of my knowledge and belief.",array('name' => 'Times New Roman','align'=>'left','size' => 12,'tabPos' => 720));

       $newSection->addText("Date:.........................       Signature:.........................",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText('"Total income"'."  - In relation to paragraph (vii),",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("(a) means the sum of net income as computed for the purposes of income tax
       excluding gains obtained from the sale of immovable properties, and
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("(b) includes dividends paid by a resident company or a co-operative society, and
       interest on a savings or fixed deposit account and on Government securities and
       Bank of Mauritius Bills.",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("Delete whichever is not appropriate",array('name' => 'Times New Roman','align'=>'left','size' => 12));
       
       $newSection->addText("Any person who knowingly makes a declaration on this form which is incorrect, false
       or misleading in any material particular shall commit an offense and shall on
       conviction, be liable to a fine not exceeding 50,000 rupees. >>
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("L'acquéreur déclare bien connaître les susdites conditions, les avoir pour
       agréables",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("SITUATION HYPOTHECAIRE",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

       $newSection->addText("Déclarent les vendeurs sous les peines de droit, savoir:
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("1. Qu'ils ne sont pas tuteurs des mineurs ou des incapables majeurs en tutelle.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("2. Que le Bien Vendu n'est pas loué à bail, n'est sous le coup d'aucune saisie et
       n'est grevé d'aucun privilège, d'aucune inscription d'hypothèque conventionnelle ni
       d’aucune sûreté fixe et/ou flottante.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("3. Que le dit terrain est situé à plus de quatre vingt un décimal vingt et un
       mètres du niveau de la mer a marée haute.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText("4. Et qu'ils ne font l'objet d'aucune poursuite judiciaire sous le Dangerous Drugs
       Act ou sous la 'Independent Commission Against Corruption' ou toutes autres poursuites quelconques pouvant entraver l'exécution des présentes.
       Pour l'exécution des présentes, les parties élisent domiciles en leurs susdites demeures.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

       $newSection->addText(strtoupper("dont Acte"),'rightAlignUnderline');

       $newSection->addText("Fait et passé en Minute, en la République de Maurice, en l'étude du notaire soussignée, sur number of pages pages.
       ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

        //php function to get the current date
       $currentDate=date("d/m/Y");

       $newSection->addText("Le ".$currentDate  ,array('name' => 'Times New Roman','align'=>'left','size' => 12,'bold' => true));

       $newSection->addText("Et après lecture des présentes faite par le notaire soussigné, les parties - après
       avoir déclaré bien comprendre le contenu du présent contrat, l'ont signé avec le
       notaire. Le notaire soussigné fait ici mention qu'elle s'est conformée à la Section 14 du
       The Notaries Act. Suivent les signatures des parties ainsi que celle du notaire
       (Jean Baptiste)."
       ,array('name' => 'Times New Roman','align'=>'left','size' => 12));

        $newSection->addText("ENREGISTRÉ ET TRANSCRIT EN LA RÉPUBLIQUE DE MAURICE ".strtoupper($propertyDetail->secDeedRegistration)." AU VOL".$propertyDetail->secTranscriptionVol.".",array('name' => 'Times New Roman','bold'=>true,'align'=>'left','size' => 12));

        $newSection->addText(strtoupper("pour expedition"),'rightAlignUnderline');

        //creating footer
        $footer = $newSection->createFooter();
        $footer->addPreserveText(
            'Page {PAGE} de {NUMPAGES}',
            null,
            array('align' => 'right')
        );
        }
    }
}

$wordFont=$wordTest->addFontStyle('header', array('bold' => true, 'size' => 20, 'name' => 'Times New Roman'));
$desc2=$wordTest->addParagraphStyle('header', array('align' => 'center', 'lineHeight' => 1.0, 'spaceAfter' => 40, 'keepNext' => true, 'keepLines' => true,'bold' => true));

$desc1 = "The Portfolio details is a very useful feature of the web page. You can establish your archived details and the works to the entire web community. It was outlined to bring in extra clients, get you selected based on this details.";

    $newSection->addText($desc1, $desc2,array('name' => 'Tahoma','align'=>'center','size' => 15, 'color' => 'red','bold' => true),$wordFont);

    $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordTest, 'Word2007');
    try {
        $objectWriter->save(storage_path($buyer->firstname.$buyer->lastname.'.docx'));
    } catch (Exception $e) {
    }

    //if 'Download Contract' button is clicked, contract is downloaded in word document with correct formatting
    if(isset($_POST['btnSubmit'])){   
        return response()->download(storage_path($buyer->firstname.$buyer->lastname.'.docx'));
    }
    //if 'Preview Contract' button is clicked,contract is previewed on browser into pfd format since
    //word document cannot be previewed directly on browser
    else{
        
        $objReader=\PhpOffice\PhpWord\IOFactory::createReader('Word2007');
        $phpWord=$objReader->load((storage_path($buyer->firstname.$buyer->lastname.'.docx')));

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        $objWriter->save(storage_path($buyer->firstname.$buyer->lastname.'.html'));
    
        $document = new Dompdf();
        $page = file_get_contents((storage_path($buyer->firstname.$buyer->lastname.'.html')));
        $document->loadHtml($page);
        $document->setPaper('A4', 'portrait');

        //Render the HTML as PDF

        $document->render();

        //Get output of generated pdf in Browser

        $document->stream("Webslesson", array("Attachment"=>0));
        //1  = Download
        //0 = Preview
    }
}

}
