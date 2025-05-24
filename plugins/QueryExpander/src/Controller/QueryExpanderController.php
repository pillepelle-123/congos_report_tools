<?php
declare(strict_types=1);

namespace QueryExpander\Controller;

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
                // $report = $this->getRequest()->getSession()->read('crt.report');
        if ($this->getRequest()->getQuery('referer') !== null && $this->getRequest()->getQuery('report') !== null && $this->getRequest()->getQuery('tool') !== null) {
            list($controller, $action) = explode('.', $this->getRequest()->getQuery('referer'));
            // $referer = ['plugin' => false, 'controller' => $controller, 'action' => $action];
            $tool = $this->fetchTable('Tools')->get($this->getRequest()->getQuery('tool'));
            $report = $this->fetchTable('Reports')->get($this->getRequest()->getQuery('report'));
            $this->getRequest()->getSession()->write(['crt.tool'=> $tool]);
            $this->getRequest()->getSession()->write(['crt.report'=> $report]);
        } else {
            // $referer = $this->getRequest()->getSession()->read('clickpath')[1]['url'];
            $tool = $this->getRequest()->getSession()->read('crt.tool');
            $report = $this->getRequest()->getSession()->read('crt.report');
        }     

        if (empty($report)) {
            $this->Flash->error('Kein Report ausgewählt. Bitte wähle einen Report aus.');
            return $this->redirect(['plugin' => false, 'controller' => 'Tools', 'action' => 'selectReport']);
        } else if (empty($tool)) {
            $this->Flash->error('Kein Tool ausgewählt. Bitte wähle ein Tool aus.');
            return $this->redirect(['plugin' => false, 'controller' => 'Tools', 'action' => 'selectTool']);
        }


        $method =  ($this->getRequest()->getMethod());
        $user = $this->my_user;

        // $report = $this->getRequest()->getSession()->read('crt.report');
        // $tool = $this->getRequest()->getSession()->read('crt.tool');
        // $this->getRequest()->getSession()->delete('crt.selectedQuery');

        // debug($this->getRequest()->getSession()->read('clickpath')[1]['url']);
                
            //debug($this->getRequest()->getSession()->read('crt.report'));

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
                // if($this->getRequest()->getSession()->read('clickpath')[1]['url'] === '/tools/process-selection') {
                    $this->Flash->error('Fehler beim Parsen der XML-Datei: ' . $error_message);
                // }
                return $this->redirect($this->referer()); 
                // return $this->redirect(['plugin' => false, 'controller' => 'Tools', 'action' => 'selectReport']);
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

                $xmlString = $query->asXML();
                $xmlObject = simplexml_load_string($xmlString);
                $data_items = [];
                if ($xmlObject !== false) {
                    $data_items = $xmlObject->xpath('//dataItem');
                }
                // $data_items = QueryExpanderUtility::extractDataItems($xmlObject);

                $queries[$i] = [
                    'name' => (string)$query['name'],
                    'xml' => $xmlString,
                    'data_items' => $data_items,
                ];
                $i++;
            }



            if (empty($queries)) {
                $this->Flash->error('Keine Queries in der XML-Datei gefunden. Ist dies eine gültige Congos Report Definition?');
                return $this->redirect($this->referer());
                // return $this->redirect(['plugin' => false, 'controller' => 'Tools', 'action' => 'selectReport']);
            }
            
            $this->set(compact('queries'));

        } catch (\Error $e) {
            $this->Flash->error('Fehler beim Parsen und Auslesen der Queries: ' . $e->getMessage());
            $this->redirect($this->referer());
            // return $this->redirect(['controller' => 'Reports', 'action' => 'index']);
        } 
        
        $this->set (compact('tool', 'user', 'report'));
        $this->set('title', 'Query Expander');
    }

    public function data()  // Umbenannt von queryExpanderDataItems()
    {
        // $this->getRequest()->allowMethod(['get', 'post']);
        $user = $this->my_user;
        $report = $this->getRequest()->getSession()->read('crt.report');
        $tool = $this->getRequest()->getSession()->read('crt.tool');
        $selectedQuery = $this->getRequest()->getSession()->read('crt.selectedQuery');

        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();  

            if(!isset($data['selected_query'])) {
                $this->Flash->warning('Bitte wähle eine Query aus');
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
            $this->getRequest()->getSession()->write(['crt.selectedQuery'=> $selectedQuery]);
            $this->getRequest()->getSession()->write(['crt.dataItems'=> $dataItems]);

            //$this->Flash->error('Ungültiger Zugriff');
            //return $this->redirect(['action' => 'queryExpander']);
        } else {
            $user = $this->my_user;
            $report = $this->getRequest()->getSession()->read('crt.report');
            $selectedQuery = $this->getRequest()->getSession()->read('crt.selectedQuery');
            $dataItems = $this->getRequest()->getSession()->read('crt.dataItems');
        }
        $this->set('title', 'Data Item Settings');
        $this->set(compact('tool', 'user', 'report', 'selectedQuery', 'dataItems'));
        // return $this->render('data' );

    }

    public function result()  // Umbenannt von queryExpanderResult()
    {
        $user = $this->my_user;
        //$session = $this->getRequest()->getSession();
        //$dataItems = $session->read('crt.dataItems');
        $report = $this->getRequest()->getSession()->read('crt.report');
        $tool = $this->getRequest()->getSession()->read('crt.tool');
        $modifiedXmlContent = $this->getRequest()->getSession()->read('crt.modifiedXmlContent');
        $selectedQuery = $this->getRequest()->getSession()->read('crt.selectedQuery');
        
        // $selectedQuery = $this->getRequest()->getSession()->read('crt.selectedQuery');

        $xml = $report->xml;

 
        if ($this->getRequest()->is('post') /* && $this->getRequest()->getQuery('form') === 'form_data_items' */ ) {
        
            // Daten aus dem Formular
            $data = $this->getRequest()->getData();
            // $query = $this->getRequest()->getQuery();
            // debug($data['name_search']);

            $no_items_selected = !isset($data['selected_items']);
            $name_search_missing = $data['name_search'] === '';

            if ($no_items_selected || $name_search_missing) { 
                if($no_items_selected) {
                    $this->Flash->error('Bitte wähle mind. ein Data Item aus');
                }
                if($name_search_missing) {
                    $this->Flash->error('Es muss einen zu suchenden Text für den Namen des/ der Data Items angegeben werden, da Data Items nicht denselben Namen haben dürfen');
                }
                return $this->redirect($this->referer());
            }

            // Das nachfolgende nicht nötig, da
            // if ($data['name_search'] === '' || $data['expr_search'] === '' || $data['name_replace'] === '' || $data['expr_replace'] === '') {
            //     $this->Flash->error('Bitte gib alle Begriffe zum Suchen und Ersetzen an');
            //     return $this->redirect($this->referer());
            // }
            // if (!isset($data['selected_query'])) {
            //     $this->Flash->error('Bitte wählen Sie ein Data Item aus');
            //     return $this->redirect($this->referer());
            // }

            // Original XML laden
            $xmlContent = $report->xml;
            preg_match('/<report[^>]+xmlns="([^"]+)"/', $xmlContent, $matches);
            $namespace = $matches[1] ?? 'http://developer.cognos.com/schemas/report/17.2/';
            
            // Temporären Namespace entfernen
            $tempXmlContent = preg_replace('/xmlns="[^"]+"/', '', $xmlContent);
            $xml = simplexml_load_string($tempXmlContent);
            
            if ($xml === false) {
                $this->Flash->error('Fehler beim Parsen der XML-Datei' . implode("\n", libxml_get_errors()));
                // return $this->redirect(['action' => 'selectReport']);
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
        
            // $this->set(name: compact('tool', 'user', 'report', 'selectedQuery', 'modifiedXmlContent'));
            $this->getRequest()->getSession()->write(['crt.modifiedXmlContent'=> $modifiedXmlContent]);
        } else if ($this->getRequest()->is('post') && $this->getRequest()->getQuery()['form'] = 'form_download') {
            $this->resultDownload();
        }
        $this->set(['title' => 'Ergebnis']);
            $this->set(name: compact('tool', 'user', 'report', 'selectedQuery', 'modifiedXmlContent'));
    }

    public function resultDownload()  // Umbenannt von downloadModifiedXml()
    {
        // 1. Nur POST erlauben
        $this->getRequest()->allowMethod(['post']);

        // 2. Session-Daten lesen
        $session = $this->getRequest()->getSession();
        $xmlContent = $session->read('crt.modifiedXmlContent');
        $report = $this->getRequest()->getSession()->read('crt.report');

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
