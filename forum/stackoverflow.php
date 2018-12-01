<?php
function fetch_question($url) {
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