<?php
class Dolcore_Feed_Controller extends Horde_Controller_Base
{
    public function processRequest(Horde_Controller_Request $request, Horde_Controller_Response $response)
    {
        $injector = $this->getInjector();
        $parts = explode('/',$request->getPath());
        if (count($parts) > 2) {
            switch ($parts[3]) {
                case 'category':
                    $categories = $injector->getInstance('Dolcore_Factory_Category')->create($injector);
                    print_r($categories->listTopCategories()->count());
                    /* Write a category's currently running Umfragen */
                    $now = new Horde_Date(time());

                    $template = $this->getInjector()->createInstance('Horde_Template');

                    $template->set('updated', $now->format(DATE_ATOM));
                    $template->set('category_caption', $parts[4]);
                    $template->set('category_id', $parts[4]);
                    $response->setBody($template->fetch(DOLCORE_TEMPLATES . '/feeds/atom.xml'));
                break;

                case 'categories':

                break;
            }
        }
    }
}
