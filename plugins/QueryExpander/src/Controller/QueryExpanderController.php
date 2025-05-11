<?php
declare(strict_types=1);

namespace QueryExpander\Controller;

use ParseError;
use QueryExpander\Controller\AppController;
use QueryExpander\Lib\QueryExpanderUtility;

/**
 * QueryExpander Controller
 *
 */
class QueryExpanderController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
    }

    public function queries()  // Umbenannt von queryExpander()
    {
        $method =  ($this->request->getMethod());
        $user = $this->my_user;
        $report = $this->request->getSession()->read('crt.report');

        // debug($this->request->getSession()->read('clickpath')[1]['url']);
                
            //debug($this->request->getSession()->read('crt.report'));

        $content = $report->xml;

        try {
            // Entfernen von xmlns-Attributen, um Namespace-Probleme zu vermeiden
            $content = preg_replace('/xmlns[^=]*="[^"]*"/i', '', $content);

            libxml_use_internal_errors(true);

            $xml = simplexml_load_string($content);
            
            // Abfangen bei erfolglosem XML-Parsing
            if ($xml === false) {
                $errors = libxml_get_errors();
                libxml_clear_errors();

                $index = 0;
                $error_messages = [];
                foreach ($errors as $index => $error) {
                    $error_messages[$index] = trim($error->message);
                    $index++;
                }
                if (empty($error)) {
                    $error_messages[$index] = 'XML ist leer';
                    $index++;
                }
                $error_messages = array_unique($error_messages);
                $error_message = implode(', ', $error_messages);

                // Redirect zur selben Seite select-report
                if($this->request->getSession()->read('clickpath')[1]['url'] === '/tools/process-selection') {
                    $this->Flash->error('Fehler beim Parsen der XML-Datei: ' . $error_message);
                }
                return $this->redirect('/tools/store?tool='. $this->getPlugin());
            };

            //Namespace-unabhängige XPath-Abfrage nach "Query"-Elementen
            $queries = [];
            $found = $xml->xpath('//*[local-name()="queries"]/*[local-name()="query"]');
            
            if (empty($found)) {
                // Alternative Suche ohne Namespace
                $found = $xml->xpath('//queries/query');
            }
            
            $i = 0;
            foreach ($found as $query) {
                $queries[$i] = [
                    'name' => (string)$query['name'],
                    'xml' => $query->asXML()
                ];
                $i++;
            }


            
            if (empty($queries)) {
                die("Keine Queries in der XML-Datei gefunden. Ist dies eine gültige Congos Report Definition?");
            }
            
            $this->set(compact('queries'));

        } catch ( ParseError $e2) {
            $this->Flash->error('Fehler beim Parsen und Auslesen der Queries: ' . $e2->getMessage());
            $this->redirect($this->referer());
            // return $this->redirect(['controller' => 'Reports', 'action' => 'index']);
        } 
        
        $this->set (compact('user', 'report'));
        $this->set('title', 'Query Expander');
    }

    public function data()  // Umbenannt von queryExpanderDataItems()
    {
        // $this->request->allowMethod(['get', 'post']);
        $user = $this->my_user;
        $report = $this->request->getSession()->read('crt.report');


        if ($this->request->is('post')) {        

            $data = $this->request->getData();   

            if (!isset($data['selected_query'])) {
                $this->Flash->error('Bitte wählen Sie eine Query aus');
                return $this->redirect($this->referer());
            }

            // Ausgewählte Query ermitteln, Name und XML auslesen
            $selectedIndex = $data['selected_query'];
            $selectedQuery = $data['queries'][$selectedIndex];


            if (!isset($selectedQuery['name']) || !isset($selectedQuery['xml'])) {
                $this->Flash->error('Ungültige Query-Daten');
                return $this->redirect($this->referer());
            }
            
            // XML verarbeiten
            $xml = simplexml_load_string($selectedQuery['xml']);
            if ($xml === false) {
                $this->Flash->error('Fehler beim Parsen der Query XML');
                return $this->redirect($this->referer());
            }
            
            $dataItems = QueryExpanderUtility::extractDataItems($xml);
    #
            $this->set(compact('user', 'report', 'selectedQuery', 'dataItems'));
            $this->request->getSession()->write(['crt.selectedQuery'=> $selectedQuery]);
            $this->request->getSession()->write(['crt.dataItems'=> $dataItems]);

            //$this->Flash->error('Ungültiger Zugriff');
            //return $this->redirect(['action' => 'queryExpander']);
        } else {
            $user = $this->my_user;
            $report = $this->request->getSession()->read('crt.report');
            $selectedQuery = $this->request->getSession()->read('crt.selectedQuery');
            $dataItems = $this->request->getSession()->read('crt.dataItems');
        }
        $this->set('title', 'Data Item Settings');
        $this->set(compact('user', 'report', 'selectedQuery', 'dataItems'));
        // return $this->render('data' );

    }

    public function result()  // Umbenannt von queryExpanderResult()
    {
        $user = $this->my_user;
        //$session = $this->request->getSession();
        //$dataItems = $session->read('crt.dataItems');
        $report = $this->request->getSession()->read('crt.report');
        $xml = $report->xml;
        // Daten aus dem Formular
        $data = $this->request->getData();
        $query = $this->request->getQuery();

 
        if ($this->request->is('post') && $this->request->getQuery('form') === 'form_data_items') {
        
            // Original XML laden
            $xmlContent = $report->xml;
            preg_match('/<report[^>]+xmlns="([^"]+)"/', $xmlContent, $matches);
            $namespace = $matches[1] ?? 'http://developer.cognos.com/schemas/report/17.2/';
            
            // Temporären Namespace entfernen
            $tempXmlContent = preg_replace('/xmlns="[^"]+"/', '', $xmlContent);
            $xml = simplexml_load_string($tempXmlContent);
            
            if ($xml === false) {
                die("Fehler beim Parsen der XML-Datei: " . implode("\n", libxml_get_errors()));
            }
        
            $selectedItems = $data['selected_items'];
            $nameSearch = $data['name_search'];
            $exprSearch = $data['expr_search'];
            
            // Replace-Pairs sammeln
            $replacePairs = [];
            if (isset($data['expr_replace'])) {
                $replacePairs[] = [
                    'name' => $data['name_replace'],
                    'expr' => $data['expr_replace']
                ];
            }
        
            // Prüfen ob Index-Operation gewünscht ist
            $nameIndexOp = preg_match('/^\[index\((\d+)\)\]$/', $nameSearch, $nameIndexMatches);
            $exprIndexOp = preg_match('/^\[index\((\d+)\)\]$/', $exprSearch, $exprIndexMatches);
        
            foreach ($selectedItems as $itemName) {
                $dataItems = $xml->xpath("//*[local-name()='dataItem'][@name='$itemName']");
                        
                foreach ($dataItems as $originalItem) {
                    $originalDom = dom_import_simplexml($originalItem);
                    
                    foreach ($replacePairs as $pair) {
                        $newItem = clone $originalItem;
                        
                        // Name bearbeiten
                        if ($nameIndexOp) {
                            $index = (int)$nameIndexMatches[1];
                            $originalName = (string)$newItem['name'];
                            $newName = substr_replace($originalName, $pair['name'], $index, 0);
                            $newItem['name'] = $newName;
                        } else {
                            $newName = str_replace($nameSearch, $pair['name'], (string)$newItem['name']);
                            $newItem['name'] = $newName;
                        }
                        
                        // Expression bearbeiten
                        if (isset($newItem->expression)) {
                            $expression = (string)$newItem->expression;
                            
                            if ($exprIndexOp) {
                                $index = (int)$exprIndexMatches[1];
                                $newExpression = substr_replace($expression, $pair['expr'], $index, 0);
                            } else {
                                $newExpression = str_replace($exprSearch, $pair['expr'], $expression);
                            }
                            
                            $newItem->expression = $newExpression;
                        }
                        
                        // Neues Element einfügen
                        $newDom = dom_import_simplexml($newItem);
                        $originalDom->parentNode->insertBefore($newDom, $originalDom->nextSibling);
                    }
                }
            }
        
            // XML mit Namespace zurück konvertieren
            $modifiedXmlContent = $xml->asXML();
            $modifiedXmlContent = preg_replace(
                '/<report ([^>]*)>/',
                "<report $1 xmlns=\"$namespace\">", 
                $modifiedXmlContent
            );
        
            $this->set(name: compact('user', 'report', 'modifiedXmlContent'));
            $this->request->getSession()->write(['crt.modifiedXmlContent'=> $modifiedXmlContent]);
        } else if ($this->request->is('post') && $this->request->getQuery()['form'] = 'form_download') {
            $this->resultDownload();
        }
        $this->set('title', 'Ergebnis');
    }

    public function resultDownload()  // Umbenannt von downloadModifiedXml()
    {
        // 1. Nur POST erlauben
        $this->request->allowMethod(['post']);

        // 2. Session-Daten lesen
        $session = $this->request->getSession();
        $xmlContent = $session->read('crt.modifiedXmlContent');
        $report = $this->request->getSession()->read('crt.report');

        // 3. Validierung
        if (empty($xmlContent)) {
            throw new \RuntimeException('Keine XML-Daten zum Download verfügbar');
        }

        // 4. Response vorbereiten
        $response = $this->response
            ->withType('application/xml')
            //->withHeader('Content-Disposition', 'attachment; filename="'.$report->report_name.'modified_report.xml"')
            ->withDownload($report->name.'_modified.xml')
            ->withStringBody($xmlContent);

        return $response;
    }
}
