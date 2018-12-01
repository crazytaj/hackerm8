<?php
function fetch_answer($url) {
    $dom = new DOMDocument('1.0');
    @$dom->loadHTMLFile($url);
    $answers = array();
    $divs = $dom->getElementsByTagName('div');
    $i = 0;
    foreach ($divs as $div) {
        $content = $div->getAttribute('class');
        if (strpos($content, 'accepted-answer') !== FALSE) {
            $moredivs = $div->getElementsByTagName('div');
            foreach ($moredivs as $mdivs) {
                $class = $mdivs->getAttribute('class');
                if (strpos($class, 'post-text') !== FALSE) {
                    $newdoc = new DOMDocument();
                    $cloned = $mdivs->cloneNode(TRUE);
                    $newdoc->appendChild($newdoc->importNode($cloned,TRUE));
                    $content = $newdoc->saveHTML();
                    $answers = array(
                        'bestanswer'    => $content
                    );
                    $answers = array_merge($answers, $arraytopush);
                    
                }
            }
        } elseif (strpos($content, 'answercell') !== FALSE) {
            $moredivs = $div->getElementsByTagName('div');
            foreach ($moredivs as $mdivs) {
                $class = $mdivs->getAttribute('class');
                if (strpos($class, 'post-text') !== FALSE) {
                    $i++;
                    $newdoc = new DOMDocument();
                    $cloned = $mdivs->cloneNode(TRUE);
                    $newdoc->appendChild($newdoc->importNode($cloned,TRUE));
                    $content = $newdoc->saveHTML();
                    $identity = 'answer'. $i;
                    $arraytopush = array(
                        $identity    => $content
                    );
                    $answers = array_merge($answers, $arraytopush);

                }
            }
        } elseif (strpos($content, 'postcell') !== FALSE) {
            $moredivs = $div->getElementsByTagName('div');
            foreach ($moredivs as $mdivs) {
                $class = $mdivs->getAttribute('class');
                if (strpos($class, 'post-text') !== FALSE) {
                    $newdoc = new DOMDocument();
                    $cloned = $mdivs->cloneNode(TRUE);
                    $newdoc->appendChild($newdoc->importNode($cloned,TRUE));
                    $content = $newdoc->saveHTML();
                    $identity = 'question';
                    $arraytopush = array(
                        $identity    => $content
                    );
                    $answers = array_merge($answers, $arraytopush);
                }
            }
        }
    }
    return $answers;
}

function fetch_question($search) {
    $urls = array();
    $bigstring=file_get_contents($search);
    $bigstring = gzdecode($bigstring);
    $numberoflinks = substr_count($bigstring, '"link":');
    //echo $bigstring;
    $i = 0;
    for ($i = 0; $i < $numberoflinks; $i++) {
        $fsl = strpos($bigstring, '"link":');
        $fslr = substr($bigstring, $fsl, 120);
        $firstlink = explode('"', $fslr);
        foreach ($firstlink as $ind) {
            if (strpos($ind, 'https') !== FALSE && strpos($ind, 'questions') !== FALSE) {
                array_push($urls, $ind);
            }
        }
        $bigstring = str_replace_first('"link":', 'blank', $bigstring);
    }
    return $urls;
}

function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $content, 1);
}

function url_shortener($url, $type) {
    $url = str_replace('https://stackoverflow.com/questions/', '', $url);
    $url = explode('/', $url);
    foreach ($url as $seperate) {
        switch ($type) {
            case 'title':
                if (strpos($seperate, '-') !== FALSE) {
                    $seperate = str_replace('-', ' ', $seperate);
                    return $seperate;
                }
            break;
            case 'id':
                if (is_int($seperate) !== FALSE) {
                    
                } else {
                    return $seperate;
                }
            break;
        }
    }

}
?>