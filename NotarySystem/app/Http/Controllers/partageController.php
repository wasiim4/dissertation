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
class partageController extends Controller
{
    public function generatePartage(Request $request){
        $partageantId=Input::get('inputPartegeantId');
        $noOfCPartageants=Input::get('currentYearOfCPartageants');
    
        $mainPartageant=Input::get('inputMPartegeantId');
        $witness1FN=Input::get('inputWitness1FirstName');
        $witness1LN=Input::get('inputWitness1LastName');
        $witness1Title=Input::get('inputWitness1Title');
        $witness1Address=Input::get('inputWitness1Address');
        $witness1Dob=Input::get('inputWitness1Dob');
        $witness1BCNum=Input::get('inputWitness1BcNum');
        $witness1District=Input::get('inputWitness1District');
        $witness1Profession=Input::get('inputWitness1Profession');
        $witness2FN=Input::get('inputWitness2FirstName');
        $witness2LN=Input::get('inputWitness2LastName');
        $witness2Title  =Input::get('inputWitness2Title');
        $witness2Address=Input::get('inputWitness2Address');
        $witness2Dob =Input::get('inputWitness2Dob');
        $witness2BCNum=Input::get('inputWitness2BcNum');
        $witness2District=Input::get('inputWitness2District');
        $witness2Profession=Input::get('inputWitness2Profession');

        $mPartageant= (DB::table('users')->where('id',$mainPartageant)->get());
        $buyers=(DB::table('users')->where('id',$partageantId)->get());
        $propertyDetails=(DB::table('immovableproperty')->where('propertyId',1)->get());

        //creating word document
        $wordTest = new \PhpOffice\PhpWord\PhpWord();
        $alignment= new \PhpOffice\PhpWord\SimpleType\Jc();

        //retrieving current year and converting it to integer
        $currentYear = (int)(date('Y'));

        //retrieving the current month.
        $currentMonth = date('F');

        //function to convert year/price to words in french
        // function convertcurrentYearberToWord($currentYear = false){
        //     $currentYear = str_replace(array(',', ' '), '' , trim($currentYear));
        //     if(! $currentYear) {
        //         return false;
        //     }
        //     $currentYear = (int) $currentYear;
        //     $words = array();
        //     $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        //         'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        //     );
        //     $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        //     $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        //         'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        //         'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        //     );
        //     $currentYear_length = strlen($currentYear);
        //     $levels = (int) (($currentYear_length + 2) / 3);
        //     $max_length = $levels * 3;
        //     $currentYear = substr('00' . $currentYear, -$max_length);
        //     $currentYear_levels = str_split($currentYear, 3);
        //     for ($i = 0; $i < count($currentYear_levels); $i++) {
        //         $levels--;
        //         $hundreds = (int) ($currentYear_levels[$i] / 100);
        //         $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        //         $tens = (int) ($currentYear_levels[$i] % 100);
        //         $singles = '';
        //         if ( $tens < 20 ) {
        //             $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        //         } else {
        //             $tens = (int)($tens / 10);
        //             $tens = ' ' . $list2[$tens] . ' ';
        //             $singles = (int) ($currentYear_levels[$i] % 10);
        //             $singles = ' ' . $list1[$singles] . ' ';
        //         }
        //         $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $currentYear_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        //     } //end for loop
        //     $commas = count($words);
        //     if ($commas > 1) {
        //         $commas = $commas - 1;
        //     }
        //     return implode(' ', $words);
        // }

        function asLetters($currentYear,$separateur=",") {
            $convert = explode($separateur, $currentYear);
            $num[17] = array('zero', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit',
                             'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize');
                              
            $num[100] = array(20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante',
                              60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingt', 90 => 'quatre-vingt-dix');
                                              
            if (isset($convert[1]) && $convert[1] != '') {
              return asLetters($convert[0]).' et '.asLetters($convert[1]);
            }
            if ($currentYear < 0) return 'moins '.asLetters(-$currentYear);
            if ($currentYear < 17) {
              return $num[17][$currentYear];
            }
            elseif ($currentYear < 20) {
              return 'dix-'.asLetters($currentYear-10);
            }
            elseif ($currentYear < 100) {
              if ($currentYear%10 == 0) {
                return $num[100][$currentYear];
              }
              elseif (substr($currentYear, -1) == 1) {
                if( ((int)($currentYear/10)*10)<70 ){
                  return asLetters((int)($currentYear/10)*10).'-et-un';
                }
                elseif ($currentYear == 71) {
                  return 'soixante-et-onze';
                }
                elseif ($currentYear == 81) {
                  return 'quatre-vingt-un';
                }
                elseif ($currentYear == 91) {
                  return 'quatre-vingt-onze';
                }
              }
              elseif ($currentYear < 70) {
                return asLetters($currentYear-$currentYear%10).'-'.asLetters($currentYear%10);
              }
              elseif ($currentYear < 80) {
                return asLetters(60).'-'.asLetters($currentYear%20);
              }
              else {
                return asLetters(80).'-'.asLetters($currentYear%20);
              }
            }
            elseif ($currentYear == 100) {
              return 'cent';
            }
            elseif ($currentYear < 200) {
              return asLetters(100).' '.asLetters($currentYear%100);
            }
            elseif ($currentYear < 1000) {
              return asLetters((int)($currentYear/100)).' '.asLetters(100).($currentYear%100 > 0 ? ' '.asLetters($currentYear%100): '');
            }
            elseif ($currentYear == 1000){
              return 'mille';
            }
            elseif ($currentYear < 2000) {
              return asLetters(1000).' '.asLetters($currentYear%1000).' ';
            }
            elseif ($currentYear < 1000000) {
              return asLetters((int)($currentYear/1000)).' '.asLetters(1000).($currentYear%1000 > 0 ? ' '.asLetters($currentYear%1000): '');
            }
            elseif ($currentYear == 1000000) {
              return 'un million';
            }
            elseif ($currentYear < 2000000) {
              return 'un million'.' '.asLetters($currentYear%1000000);
            }
            elseif ($currentYear < 1000000000) {
              return asLetters((int)($currentYear/1000000)).' '.'millions'.($currentYear%1000000 > 0 ? ' '.asLetters($currentYear%1000000): '');
            }
          }
        
        
        
        //converting month in french
        switch ($currentMonth) {
            case "January":
                $currentMonth="janvier";
                break;
            case "February":
                $currentMonth="février";
                break;
            case "March":
            $currentMonth="mars";
                break;              
            case "April":
                $currentMonth="avril";
                break;
            case "May":
                $currentMonth="mai";
                break;
            case "June":
                $currentMonth="juin";
                break;
            case "July":
                 $currentMonth="juillet";
                break;
            case "August":
                 $currentMonth="aout ";
                break;
            case "September":
                 $currentMonth="septembre";
                break;
            case "October":
                $currentMonth="octobre ";
                break;
            case "November":
                $currentMonth="novembre";
                break;
            case "December":
                $currentMonth="décembre ";
                break;
            
        }

        //retrieving the current day
        $currentDay = date('d');
        $newSection = $wordTest->addSection();

        //setting different paragraph styles
        $alignment=$wordTest->addParagraphStyle('centerTitles', array( 'size' => 12,'align'=>'center', 'name' => 'Times New Roman'));
        $alignment2=$wordTest->addParagraphStyle('Indent', array( 'tabPos'=>720));
        $alignment3=$wordTest->addParagraphStyle('rightAlignUnderline', array( 'size' => 12,'align'=>'right', 'underline'=> 'single','name' => 'Times New Roman','bold'=>true));
        
        $getInput = Input::get('inputCPartegeantId');
        $selectedOption = "";
        $x=1;
        $n=1;
        $I="II";
            foreach ($buyers as $buyer ) {
                $newSection->addText("TRANSCRIPTION",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
                $newSection->addText(asLetters($currentYear),array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
                $newSection->addText($currentMonth,array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
                $newSection->addText("PARTAGE EN NATURE",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
                $newSection->addText("ENTRE",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
                
                foreach ( $mPartageant as  $mPartageants ) {
                    if( $mPartageants->spouseFirstname ==null){
                        $newSection->addText($mPartageants->title." ".$mPartageants->firstname." ".strtoupper($mPartageants->lastname)." "."et autres",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
                    }
                    else{
                        $newSection->addText( $mPartageants->title." et ". $mPartageants->spouseTitle." ". $mPartageants->firstname." "
                        .strtoupper( $mPartageants->lastname)." "."et autres",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

                    }
                } 

                $newSection->addText("---",array('name' => 'Times New Roman','align'=>'center','size' => 12),'centerTitles');
                $newSection->addText("  Pardevant Mons. Jean Baptise , notaire à Port Louis, 14, Rue Sir Virgile Naz, République de Maurice, soussignée.",array('name' => 'Times New Roman','align'=>'center','size' => 12));
                $newSection->addText("ONT COMPARU",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
                $newSection->addText("I ".$buyer->title." ".$buyer->firstname." ".strtoupper($buyer->lastname)." "."né/e à ".$buyer->placeOfBirth." le".$buyer->dob.", (Acte de naissance portant) No. ".$buyer->birthCertificateNumber.", veuve de". $buyer->spouseTitle." ".$buyer->spouseFirstname." ".strtoupper($buyer->spouseLastname).", demeurant à". $buyer->address
                
                ,array('name' => 'Times New Roman','align'=>'left','size' => 12));
                $newSection->addText("Déclare ladite ".$buyer->title." de ". $buyer->spouseTitle." ".$buyer->spouseFirstname." ".strtoupper($buyer->spouseLastname).", qu’elle est veuve en uniques noces dudit Feu Sieur son époux ce dernier décède a ".$buyer->address." le ".$buyer->DeathDate.
                ", ainsi qu’il appert de son acte de décès portant le No. ".$buyer->spouseDCNum.
                " , qu’elle avait épousé sous le régime de la communauté légale de biens a défaut de contrat de mariage préalable à leur union ayant été célébrée par l’Officier de l'État Civil de ".
                $buyer->MCdistrictIssued." le " .$buyer->marriageDate.", (Acte de mariage portant le No. ".$buyer->MCNumber." de ".$buyer->MCdistrictIssued.")."
                
                ,array('name' => 'Times New Roman','align'=>'left','size' => 12));
            
                foreach ($getInput as $option => $value) {
            
                    $selectedOption = $value.','; 
                    $var="$"."person";               
                    $variable=$var.(string)($x);              
                    $variable=DB::table('users')->where('id',$value)->get();
                        
                    foreach ( $variable as $partageant ) {
                        if($x== $n){

                            $newSection->addText($I." ".$partageant->title." ".$partageant->firstname." ".strtoupper($partageant->lastname)." né/e à".$partageant->placeOfBirth.
                            " le ".$partageant->dob.
                            ", (Acte de Naissance portant le No.".$partageant->birthCertificateNumber."), propriétaire, demeurant au dit endroit.
                            ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

                            if($partageant->spouseFirstname !==null){
                            $newSection->addText("Et ".$partageant->spouseTitle." ".$partageant->spouseFirstname." ".$partageant->spouseLastname."  né/e à ".$partageant->spousePlaceOfBirth.
                            " le ".$partageant->spouseDob.", (Acte de Naissance portant le No. ".$partageant->spouseBCNum."),".$partageant->spouseProfession.", épouse commune en biens de ".
                            $partageant->title." ".$partageant->firstname." ".strtoupper($partageant->lastname).", surnomme, avec lequel elle demeure. ",
                            array('name' => 'Times New Roman','align'=>'left','size' => 12));

                            $newSection->addText("Déclarant les dits Époux ".$partageant->title." et ".$partageant->spouseTitle." ".$partageant->firstname." "
                            .strtoupper($partageant->lastname).
                            ", qu’ils sont mariés en uniques noces sous le régime légal de communauté leur union ayant été célébrée par l’Officier de l'État Civil de ".$partageant->MCdistrictIssued." le ".
                            $partageant->marriageDate.", (acte de mariage portant le No. ".$partageant->MCNumber.").",
                            array('name' => 'Times New Roman','align'=>'left','size' => 12));
                            }

                            if($partageant->marriageStatus=="Mariés" && $partageant->spouseFirstname ==null ){
                                $newSection->addText("Déclare le dit ".$partageant->title." ".strtoupper($partageant->lastname)." qu’il n’a jamais été marié civilement."
                                ,array('name' => 'Times New Roman','align'=>'left','size' => 12));
                            }
                        }
                    }            
                $x++;
                $n++;
                $I=$I."I";
            }
            $newSection->addText(strtoupper("LESQUELS COMPARANTS,"),array('name' => 'Times New Roman','size' => 12,'bold' => true,'underline'=> 'single')," préalablement au partage en nature que ces présentes ont pour but de constater, ont d’abord dit et exposé ce qui suit:-
            ",array('name' => 'Times New Roman','align'=>'left','size' => 12));
            $newSection->addText(" préalablement au partage en nature que ces présentes ont pour but de constater, ont d’abord dit et exposé ce qui suit:-
            ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

            $newSection->addText("EXPOSE",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

            foreach ( $propertyDetails as $propertyDetail ) {
                $newSection->addText("Suivant contrat dressé par ".$propertyDetail->previousNotaryTitle." ".$propertyDetail->previousNotaryFN." ".$propertyDetail->previousNotaryLN." ancien Notaire a Port Louis, le ".$propertyDetail->firstDeedRegistration." , enregistrés au Reg: ".$propertyDetail->regcurrentYearLSReport." et transcrit au volume ".$propertyDetail->transcriptionVol.",..",array('name' => 'Times New Roman','align'=>'left','size' => 12));
                
                $newSection->addText("CES FAITS EXPOSES",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

                $newSection->addText("Les comparants aux présentes désirant procéder entre eux au partage à l’amiable et en
                nature du susdit immeuble terrain érigé sur une portion de terrain, de la contenance de
                ".$propertyDetail->sizeInMSFigures."  située au quartier des ".$propertyDetail->districtSituated." lieu dit ".$propertyDetail->districtSituated.".",array('name' => 'Times New Roman','align'=>'left','size' => 12));
        
        }

        $newSection->addText("PARTAGE",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
        $newSection->addText("Les choses en l'état, les comparants, ont requis le Notaire soussigné de constater le partage à l’amiable effectuer entre eux de la manière suivante:–
        ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

        $newSection->addText("ABANDONNEMENTS",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

        $newSection->addText("Pour fournir à chaque indivisaire l'équivalent de ses droits dans le susdit terrain immeuble, il est par ces presente, abandonné sous toutes les garanties ordinaires et de droit en matière de partage, savoir:–
        ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

        $newSection->addText("CONDITIONS DU PARTAGE",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');

        $newSection->addText("1. Le présent partage est fait sans soulte ni retour de part ni d’autre.
        2. Il y aura entre les co-partageants les garanties ordinaires et de droit en matières de partage.
        3. Les co-partageants prendront les biens qui leur ont été attribués dans l'état où ils se trouvent, sans garantie ni répétition, pour raison de plus ou en moins bon état des biens, d’erreur dans la désignation, défaut d'alignement, mitoyenneté de différences quelles qu’elles soient entre les contenances ci-dessus exprimées et celles réelles, ni enfin pour quelque causes que ce soit et ils jouiront des servitudes actives et supporteront celles passives de toute nature qui peuvent exister au profit ou à la charge des biens sans recours contre leur copartageant et sans que la présente convention puisse donner a qui ce soit, des droits autres ni plus grands qu’ils n’en justifieraient avoir par titres réguliers et non prescrits ou en vertu de la loi.
        Déclarent ici les co-partageants, qu’ils sont entièrement satisfait et remplis de leurs droits
        dans le susdit terrain et n’avoir aucune réclamation à exercer entre eux et ils se font le uns envers les autres tout désistement et abandonnements nécessaires, et se consentent quittances mutuelle et réciproque.
        Les frais et honoraires des présentes seront supportées par les copartageants dans la proportion de leurs droits.
        ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

        $newSection->addText("ETAT CIVIL - SITUATION HYPOTHECAIRE",array('name' => 'Times New Roman','align'=>'center','size' => 12,'bold' => true,'underline'=> 'single'),'centerTitles');
        $newSection->addText("Déclarent les comparants, savoir:– ",array('name' => 'Times New Roman','align'=>'left','size' => 12));
        $newSection->addText("1. Confirmer l’exactitude des déclarations et indications les concernant telles figurant en tête des présentes",array('name' => 'Times New Roman','align'=>'left','size' => 12));
        $newSection->addText("2. Qu’ils ne sont pas tuteurs et ne sont pas chargés d’aucune fonction emportant hypothèque légale.
        ",array('name' => 'Times New Roman','align'=>'left','size' => 12));
        $newSection->addText("3. Que le bien objet du présent partage, n’est pas loué à bail, n’est sous le coup d’aucune saisie et n’est grevé d’aucune inscription hypothécaire de privilège ni d’aucune sûreté fixe ou flottante prise en vertu des Articles 2202 et suivants du code Civil Mauricien.",
        array('name' => 'Times New Roman','align'=>'left','size' => 12));
        $newSection->addText("Pour l'exécution des présentes, les parties, élisent domicile en leur susdite demeure",
        array('name' => 'Times New Roman','align'=>'left','size' => 12));
        $newSection->addText(strtoupper("DONT ACTE."),
        array('name' => 'Times New Roman','size' => 12,'bold' => true,'underline'=> 'single'));
        $newSection->addText("Faite et Passé en Minute à l’Ile Maurice, à Port Louis, en l'Étude du notaire soussigné.
        ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

        $newSection->addText($currentYear  ,array('name' => 'Times New Roman','align'=>'left','size' => 12,'bold' => true));
        $newSection->addText("Le".$currentDay." ".$currentMonth  ,array('name' => 'Times New Roman','align'=>'left','size' => 12,'bold' => true));
        $newSection->addText("Et après lecture des présentes faites par le notaire soussigné aux parties, en présences de ".$witness1Title." ".$witness1FN." ".strtoupper($witness1LN)." né le ". $witness1Dob.", acte de naissance portant le No. ".$witness1BCNum."-". $witness1District.","
         .$witness1Profession." demeurant à ".$witness1Address.", et ".$witness2Title." ".$witness2FN." ".strtoupper($witness2LN)." né le". $witness2Dob.", 
         acte de naissance portant le No. ".$witness2BCNum.", témoins instrumentaires requis conformément à la loi, et sur la réquisition de signer que leur a faite le Notaire soussigné en présence des témoins susnommés, les parties ont signé, quant à".
          $buyer->title." ".$buyer->firstname." ".strtoupper($buyer->lastname).", veuve de ".$buyer->spouseTitle." ".$buyer->spouseFirstname." ".strtoupper($buyer->spouseLastname)."requise de signer par le dit notaire en présence desdits témoins, elle a déclaré ne savoir écrire ni signer, mais a apposé aux présentes l’empreinte du pouce de sa main droite 
          en présences des dits témoins et notaire qui la certifie véritables et les susdits témoins requis de signer par le dit notaire ont signé le présent contrat.
        ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

        $newSection->addText("Sur l’interpellation faite à eux par le Notaire soussigné, les témoins ont déclaré qu’il ne sont ni parents, ni alliés des parties contractantes, au degrée prohibé.
        ",array('name' => 'Times New Roman','align'=>'left','size' => 12));

        $newSection->addText("Je soussigné, Mons. Jean Baptise notaire à Port Louis, Ile Maurice, certifie que cette copie est conforme à l’original avec lequel elle a été exactement collationnée,",array('name' => 'Times New Roman','align'=>'left','size' => 12));


        
    
    }
           
        // $wordFont=$wordTest->addFontStyle('header', array('bold' => true, 'size' => 20, 'name' => 'Times New Roman'));
        // $desc2=$wordTest->addParagraphStyle('header', array('align' => 'center', 'lineHeight' => 1.0, 'spaceAfter' => 40, 'keepNext' => true, 'keepLines' => true,'bold' => true));

        // $desc1 = "The Portfolio details is".$partageant->firstname." a very useful feature of the web page. You can establish your archived details and the works to the entire web community. It was outlined to bring in extra clients, get you selected based on this details.";

        // $newSection->addText($desc1, $desc2,array('name' => 'Tahoma','align'=>'center','size' => 15, 'color' => 'red','bold' => true),$wordFont);
            $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordTest, 'Word2007');
        try {
            $objectWriter->save(storage_path($buyer->firstname.$buyer->lastname.'.docx'));
            return response()->download(storage_path($buyer->firstname.$buyer->lastname.'.docx'));
        } catch (Exception $e) {
        }
        
    }

    
}
?>